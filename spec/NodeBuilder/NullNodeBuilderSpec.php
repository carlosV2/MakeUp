<?php

namespace spec\carlosV2\MakeUp\NodeBuilder;

use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use PhpSpec\ObjectBehavior;

class NullNodeBuilderSpec extends ObjectBehavior
{
    function it_is_a_NodeBuilder()
    {
        $this->shouldHaveType(NodeBuilderInterface::class);
    }

    function it_supports_nodes_with_type_null()
    {
        $this->supports(['type' => 'null'])->shouldReturn(true);
    }

    function it_does_not_support_nodes_with_other_types()
    {
        $this->supports(['type' => 'invalid'])->shouldReturn(false);
    }

    function it_does_not_support_nodes_without_type()
    {
        $this->supports(['category' => 'null'])->shouldReturn(false);
    }

    function it_builds_a_null_node()
    {
        $this->build(['type' => 'null'], ParameterBag::fromArray([]))->shouldReturn(null);
    }
}
