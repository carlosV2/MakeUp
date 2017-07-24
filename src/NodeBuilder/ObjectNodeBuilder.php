<?php

namespace carlosV2\MakeUp\NodeBuilder;

use carlosV2\Can\To;
use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilder;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use stdClass;

final class ObjectNodeBuilder implements NodeBuilderInterface
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
        return can($node)->claim(To::beArray()
            ->withKey('type')->expected(To::beEqualsTo('object'))
            ->withKey('keys')->expected(To::beOptionalAnd(To::beArray()
                ->withValuesExpected(To::beArray()->withKey('name')->expected(To::beSet()))
            ))
        );
    }

    /**
     * @inheritDoc
     */
    public function build(array $node, ParameterBag $parameterBag)
    {
        $keys = [];
        if (isset($node['keys'])) {
            $keys = $node['keys'];
        }

        $object = new stdClass();
        foreach ($keys as $key) {
            $name = $this->expression->evaluate($key['name'], $parameterBag);

            $object->$name = $this->nodeBuilder->build($key, ParameterBag::fromParameterBag($parameterBag));
        }

        return $object;
    }
}
