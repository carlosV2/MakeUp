<?php

namespace carlosV2\MakeUp\NodeBuilder;

use carlosV2\Can\To;
use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilder;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;

final class ArrayNodeBuilder implements NodeBuilderInterface
{
    /**
     * @var NodeBuilder
     */
    private $nodeBuilder;

    /**
     * @var Expression
     */
    private $expression;

    /**
     * @param NodeBuilder $nodeBuilder
     * @param Expression  $expression
     */
    public function __construct(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $this->nodeBuilder = $nodeBuilder;
        $this->expression = $expression;
    }

    /**
     * @inheritDoc
     */
    public function supports(array $node)
    {
        return can($node)->claim(
            To::beArray()
                ->withKey('type')->expected(To::beEqualsTo('array'))
                ->withKey('provider')->expected(
                    To::beArray()
                        ->withKey('source')->expected(To::beOneOf(To::beArray(), To::beString()))
                        ->withKey('variable')->expected(To::beString())
                )
                ->withKey('elements')->expected(To::beArray())
        );
    }

    /**
     * @inheritDoc
     */
    public function build(array $node, ParameterBag $parameterBag)
    {
        $values = $this->expression->evaluate($node['provider']['source'], $parameterBag);

        $array = [];
        foreach ($values as $value) {
            $newParameterBag = ParameterBag::fromParameterBag($parameterBag);
            $newParameterBag->add($node['provider']['variable'], $value);

            $array[] = $this->nodeBuilder->build($node['elements'], $newParameterBag);
        }

        return $array;
    }
}
