<?php

namespace carlosV2\MakeUp\NodeBuilder;

use carlosV2\Can\To;
use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;

final class MixedNodeBuilder implements NodeBuilderInterface
{
    /**
     * @var Expression
     */
    private $expression;

    /**
     * @param Expression $expression
     */
    public function __construct(Expression $expression)
    {
        $this->expression = $expression;
    }

    /**
     * @inheritDoc
     */
    final public function supports(array $node)
    {
        return can($node)->claim(
            To::beArray()
                ->withKey('type')->expected(To::beEqualsTo('mixed'))
                ->withKey('value')->expected(To::beSet())
        );
    }

    /**
     * @inheritDoc
     */
    final public function build(array $node, ParameterBag $parameterBag)
    {
        return $this->expression->evaluate($node['value'], $parameterBag);
    }
}
