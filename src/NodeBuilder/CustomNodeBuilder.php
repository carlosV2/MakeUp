<?php

namespace carlosV2\MakeUp\NodeBuilder;

use carlosV2\Can\To;
use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilder;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;

final class CustomNodeBuilder implements NodeBuilderInterface
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
     * @var string
     */
    private $type;

    /**
     * @var mixed[]
     */
    private $node;

    /**
     * @param NodeBuilder $nodeBuilder
     * @param Expression  $expression
     * @param string      $type
     * @param mixed[]     $node
     */
    public function __construct(NodeBuilder $nodeBuilder, Expression $expression, $type, array $node)
    {
        $this->nodeBuilder = $nodeBuilder;
        $this->expression = $expression;
        $this->type = $type;
        $this->node = $node;
    }

    /**
     * @inheritDoc
     */
    public function supports(array $node)
    {
        return can($node)->claim(
            To::beArray()
                ->withKey('type')->expected(To::beEqualsTo($this->type))
                ->withKey('parameters')->expected(To::beOptionalAnd(To::beArray()))
                ->withKey('combine')->expected(To::beOptionalAnd(To::beArray()))
        );
    }

    /**
     * @inheritDoc
     */
    public function build(array $node, ParameterBag $parameterBag)
    {
        $parameters = [];
        if (isset($node['parameters'])) {
            $parameters = $node['parameters'];
        }

        $newParameterBag = ParameterBag::fromParameterBag($parameterBag);
        foreach ($parameters as $name => $value) {
            $newParameterBag->add($name, $this->expression->evaluate($value, $parameterBag));
        }

        $combine = [];
        if (isset($node['combine'])) {
            $combine = $node['combine'];
        }

        return $this->nodeBuilder->build(array_merge_recursive($this->node, $combine), $newParameterBag);
    }
}
