<?php

namespace spec\carlosV2\MakeUp\NodeBuilder;

use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilder;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConditionalNodeBuilderSpec extends ObjectBehavior
{
    function let(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $this->beConstructedWith($nodeBuilder, $expression);
    }

    function it_is_a_NodeBuilder()
    {
        $this->shouldHaveType(NodeBuilderInterface::class);
    }

    function it_supports_nodes_with_if_then_and_else()
    {
        $this->supports([
            'if' => true,
            'then' => ['then'],
            'else' => ['else']
        ])->shouldReturn(true);
    }

    function it_does_not_support_nodes_without_if()
    {
        $this->supports([
            'then' => ['then'],
            'else' => ['else']
        ])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_then()
    {
        $this->supports([
            'if' => true,
            'else' => ['else']
        ])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_else()
    {
        $this->supports([
            'if' => true,
            'then' => ['then']
        ])->shouldReturn(false);
    }

    function it_builds_the_then_part_if_the_condition_is_true(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $parameterBag = ParameterBag::fromArray([]);

        $expression->evaluate(':=condition', $parameterBag)->willReturn(true);
        $nodeBuilder->build(['then'], Argument::type(ParameterBag::class))->willReturn('then elem');

        $this->build([
            'if' => ':=condition',
            'then' => ['then'],
            'else' => ['else']
        ], $parameterBag)->shouldReturn('then elem');
    }

    function it_builds_the_else_part_if_the_condition_is_false(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $parameterBag = ParameterBag::fromArray([]);

        $expression->evaluate(':=condition', $parameterBag)->willReturn(false);
        $nodeBuilder->build(['else'], Argument::type(ParameterBag::class))->willReturn('else elem');

        $this->build([
            'if' => ':=condition',
            'then' => ['then'],
            'else' => ['else']
        ], $parameterBag)->shouldReturn('else elem');
    }
}
