<?php

namespace spec\carlosV2\MakeUp\NodeBuilder;

use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use Exception;
use PhpSpec\ObjectBehavior;

class IntegerNodeBuilderSpec extends ObjectBehavior
{
    function let(Expression $expression)
    {
        $this->beConstructedWith($expression);
    }

    function it_is_a_NodeBuilder()
    {
        $this->shouldHaveType(NodeBuilderInterface::class);
    }

    function it_supports_nodes_with_type_integer_and_value()
    {
        $this->supports(['type' => 'integer', 'value' => 'val'])->shouldReturn(true);
    }

    function it_does_not_support_nodes_with_other_types()
    {
        $this->supports(['type' => 'number', 'value' => 'val'])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_type()
    {
        $this->supports(['category' => 'integer', 'value' => 'val'])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_value()
    {
        $this->supports(['type' => 'integer'])->shouldReturn(false);
    }

    function it_also_supports_a_casting_option()
    {
        $this->supports([
            'type' => 'integer',
            'value' => 'val',
            'cast' => true
        ])->shouldReturn(true);
    }

    function it_does_not_support_a_non_boolean_casting_option()
    {
        $this->supports([
            'type' => 'integer',
            'value' => 'val',
            'cast' => 'true'
        ])->shouldReturn(false);
    }

    function it_builds_a_integer_node(Expression $expression)
    {
        $parameterBag = ParameterBag::fromArray([]);

        $expression->evaluate(':=val', $parameterBag)->willReturn(4);

        $this->build(['type' => 'integer', 'value' => ':=val'], $parameterBag)->shouldReturn(4);
    }

    function it_throws_an_exception_if_the_built_node_is_not_integer(Expression $expression)
    {
        $parameterBag = ParameterBag::fromArray([]);

        $expression->evaluate(':=val', $parameterBag)->willReturn('4');

        $this->shouldThrow(Exception::class)->duringBuild(['type' => 'integer', 'value' => ':=val'], $parameterBag);
    }

    function it_casts_the_value_to_integer_if_the_built_node_is_not_integer_but_the_cast_option_is_true(
        Expression $expression
    ) {
        $parameterBag = ParameterBag::fromArray([]);

        $expression->evaluate(':=val', $parameterBag)->willReturn('4');

        $this->build(['type' => 'integer', 'value' => ':=val', 'cast' => true], $parameterBag)->shouldReturn(4);
    }
}
