<?php

namespace carlosV2\MakeUp\NodeBuilder;

use carlosV2\Can\To;
use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilder;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;

final class ConditionalNodeBuilder implements NodeBuilderInterface
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
                ->withKey('if')->expected(To::beOneOf(To::beString(), To::beBoolean()))
                ->withKey('then')->expected(To::beArray())
                ->withKey('else')->expected(To::beArray())
        );
    }

    /**
     * @inheritDoc
     */
    public function build(array $node, ParameterBag $parameterBag)
    {
        $condition = filter_var($this->expression->evaluate($node['if'], $parameterBag), FILTER_VALIDATE_BOOLEAN);

        return $this->nodeBuilder->build(
            ($condition ? $node['then'] : $node['else']),
            ParameterBag::fromParameterBag($parameterBag)
        );
    }
}
