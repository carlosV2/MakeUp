<?php

namespace spec\carlosV2\MakeUp\NodeBuilder;

use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use PhpSpec\ObjectBehavior;

class MixedNodeBuilderSpec extends ObjectBehavior
{
    function let(Expression $expression)
    {
        $this->beConstructedWith($expression);
    }

    function it_is_a_NodeBuilder()
    {
        $this->shouldHaveType(NodeBuilderInterface::class);
    }

    function it_supports_nodes_with_type_mixed_and_value()
    {
        $this->supports(['type' => 'mixed', 'value' => 'val'])->shouldReturn(true);
    }

    function it_does_not_support_nodes_with_other_types()
    {
        $this->supports(['type' => 'scrambled', 'value' => 'val'])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_type()
    {
        $this->supports(['category' => 'mixed', 'value' => 'val'])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_value()
    {
        $this->supports(['type' => 'mixed'])->shouldReturn(false);
    }

    function it_builds_a_mixed_node(Expression $expression)
    {
        $parameterBag = ParameterBag::fromArray([]);

        $expression->evaluate(':=val', $parameterBag)->willReturn(4);

        $this->build(['type' => 'mixed', 'value' => ':=val'], $parameterBag)->shouldReturn(4);
    }
}
