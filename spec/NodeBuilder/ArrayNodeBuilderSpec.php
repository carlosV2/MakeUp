<?php

namespace spec\carlosV2\MakeUp\NodeBuilder;

use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilder;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArrayNodeBuilderSpec extends ObjectBehavior
{
    function let(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $this->beConstructedWith($nodeBuilder, $expression);
    }

    function it_is_a_NodeBuilder()
    {
        $this->shouldHaveType(NodeBuilderInterface::class);
    }

    function it_supports_nodes_with_type_array_provider_and_elements()
    {
        $this->supports([
            'type' => 'array',
            'provider' => [
                'source' => ['a', 'b'],
                'variable' => 'var'
            ],
            'elements' => ['element']
        ])->shouldReturn(true);
    }

    function it_does_not_support_nodes_with_other_types()
    {
        $this->supports([
            'type' => 'items',
            'provider' => [
                'source' => ['a', 'b'],
                'variable' => 'var'
            ],
            'elements' => ['element']
        ])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_type()
    {
        $this->supports([
            'category' => 'array',
            'provider' => [
                'source' => ['a', 'b'],
                'variable' => 'var'
            ],
            'elements' => ['element']
        ])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_source_in_the_provider()
    {
        $this->supports([
            'type' => 'array',
            'provider' => [
                'variable' => 'var'
            ],
            'elements' => ['element']
        ])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_variable_in_the_provider()
    {
        $this->supports([
            'type' => 'array',
            'provider' => [
                'source' => ['a', 'b']
            ],
            'elements' => ['element']
        ])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_elements()
    {
        $this->supports([
            'type' => 'array',
            'provider' => [
                'source' => ['a', 'b'],
                'variable' => 'var'
            ]
        ])->shouldReturn(false);
    }

    function it_builds_an_array_node(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $parameterBag = ParameterBag::fromArray([]);

        $expression->evaluate(':=items', $parameterBag)->willReturn(['a', 'b']);
        $nodeBuilder->build(['element'], Argument::type(ParameterBag::class))->willReturn('itemA', 'itemB');

        $this->build([
            'type' => 'array',
            'provider' => [
                'source' => ':=items',
                'variable' => 'var'
            ],
            'elements' => ['element']
        ], $parameterBag)->shouldReturn(['itemA', 'itemB']);
    }
}
