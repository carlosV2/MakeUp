<?php

namespace spec\carlosV2\MakeUp\NodeBuilder;

use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilder;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CustomNodeBuilderSpec extends ObjectBehavior
{
    function let(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $this->beConstructedWith($nodeBuilder, $expression, 'CustomType', ['node']);
    }

    function it_is_a_NodeBuilder()
    {
        $this->shouldHaveType(NodeBuilderInterface::class);
    }

    function it_supports_nodes_with_the_custom_type()
    {
        $this->supports(['type' => 'CustomType'])->shouldReturn(true);
    }

    function it_does_not_support_nodes_with_other_types()
    {
        $this->supports(['type' => 'CustomCategory'])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_type()
    {
        $this->supports(['category' => 'CustomType'])->shouldReturn(false);
    }

    function it_supports_optional_parameters()
    {
        $this->supports(['type' => 'CustomType', 'parameters' => ['params']])->shouldReturn(true);
    }

    function it_does_not_support_non_array_parameters()
    {
        $this->supports(['type' => 'CustomType', 'parameters' => 'params'])->shouldReturn(false);
    }

    function it_supports_optional_combine()
    {
        $this->supports(['type' => 'CustomType', 'combine' => ['combine']])->shouldReturn(true);
    }

    function it_does_not_support_non_array_combine()
    {
        $this->supports(['type' => 'CustomType', 'combine' => 'combine'])->shouldReturn(false);
    }

    function it_builds_an_array_node(NodeBuilder $nodeBuilder)
    {
        $parameterBag = ParameterBag::fromArray([]);

        $nodeBuilder->build(['node'], Argument::type(ParameterBag::class))->willReturn('result');

        $this->build(['type' => 'CustomType'], $parameterBag)->shouldReturn('result');
    }

    function it_builds_an_array_populating_the_optional_parameters(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $parameterBag = ParameterBag::fromArray([]);

        $expression->evaluate(':=val1', $parameterBag)->shouldBeCalled();
        $expression->evaluate(':=val2', $parameterBag)->shouldBeCalled();
        $nodeBuilder->build(['node'], Argument::type(ParameterBag::class))->willReturn('result');

        $this->build([
            'type' => 'CustomType',
            'parameters' => [
                'param1' => ':=val1',
                'param2' => ':=val2'
            ]
        ], $parameterBag)->shouldReturn('result');
    }

    function it_builds_an_array_node_combining_it_with_combine(NodeBuilder $nodeBuilder)
    {
        $parameterBag = ParameterBag::fromArray([]);

        $nodeBuilder->build(['node', 'combine'], Argument::type(ParameterBag::class))->willReturn('result');

        $this->build([
            'type' => 'CustomType',
            'combine' => ['combine']
        ], $parameterBag)->shouldReturn('result');
    }
}
