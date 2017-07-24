<?php

namespace spec\carlosV2\MakeUp\NodeBuilder;

use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilder;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use stdClass;

class ObjectNodeBuilderSpec extends ObjectBehavior
{
    function let(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $this->beConstructedWith($nodeBuilder, $expression);
    }

    function it_is_a_NodeBuilder()
    {
        $this->shouldHaveType(NodeBuilderInterface::class);
    }

    function it_supports_nodes_with_type_object()
    {
        $this->supports(['type' => 'object'])->shouldReturn(true);
    }

    function it_does_not_support_nodes_with_other_types()
    {
        $this->supports(['type' => 'thing'])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_type()
    {
        $this->supports(['category' => 'object'])->shouldReturn(false);
    }

    function it_supports_optional_keys()
    {
        $this->supports(['type' => 'object', 'keys' => [['name' => 'key']]])->shouldReturn(true);
    }

    function it_does_not_support_non_array_keys()
    {
        $this->supports(['type' => 'object', 'keys' => 'key'])->shouldReturn(false);
    }

    function it_does_not_support_non_array_of_arrays_keys()
    {
        $this->supports(['type' => 'object', 'keys' => ['key']])->shouldReturn(false);
    }

    function it_does_not_support_keys_without_name()
    {
        $this->supports(['type' => 'object', 'keys' => [['key' => 'key']]])->shouldReturn(false);
    }

    function it_builds_an_object_node()
    {
        $parameterBag = ParameterBag::fromArray([]);
        $object = new stdClass();

        $this->build(['type' => 'object'], $parameterBag)->shouldBeLike($object);
    }

    function it_builds_an_object_node_with_keys(NodeBuilder $nodeBuilder, Expression $expression)
    {
        $parameterBag = ParameterBag::fromArray([]);
        $object = new stdClass();
        $object->key = 'value';

        $expression->evaluate(':=key', $parameterBag)->willReturn('key');
        $nodeBuilder->build(['name' => ':=key'], Argument::type(ParameterBag::class))->willReturn('value');

        $this->build([
            'type' => 'object',
            'keys' => [
                [
                    'name' => ':=key'
                ]
            ]
        ], $parameterBag)->shouldBeLike($object);
    }
}
