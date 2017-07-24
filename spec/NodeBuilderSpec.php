<?php

namespace spec\carlosV2\MakeUp;

use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use Exception;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NodeBuilderSpec extends ObjectBehavior
{
    function let(
        NodeBuilderInterface $nodeBuilder1,
        NodeBuilderInterface $nodeBuilder2,
        NodeBuilderInterface $nodeBuilder3
    ) {
        $nodeBuilder1->supports(Argument::any())->willReturn(false);
        $nodeBuilder2->supports(Argument::any())->willReturn(false);
        $nodeBuilder2->supports(['node2'])->willReturn(true);
        $nodeBuilder3->supports(Argument::any())->willReturn(false);

        $this->addNodeBuilder($nodeBuilder1);
        $this->addNodeBuilder($nodeBuilder2);
        $this->addNodeBuilder($nodeBuilder3);
    }

    function it_selects_a_node_builder_that_supports_the_given_node(
        NodeBuilderInterface $nodeBuilder1,
        NodeBuilderInterface $nodeBuilder2,
        NodeBuilderInterface $nodeBuilder3
    ) {
        $parameterBag = ParameterBag::fromArray([]);

        $nodeBuilder1->build(['node2'], $parameterBag)->shouldNotBeCalled();
        $nodeBuilder2->build(['node2'], $parameterBag)->shouldBeCalled();
        $nodeBuilder3->build(['node2'], $parameterBag)->shouldNotBeCalled();

        $this->build(['node2'], $parameterBag);
    }

    function it_throws_an_exception_if_the_node_builder_is_not_found(
        NodeBuilderInterface $nodeBuilder1,
        NodeBuilderInterface $nodeBuilder2,
        NodeBuilderInterface $nodeBuilder3
    ) {
        $parameterBag = ParameterBag::fromArray([]);

        $nodeBuilder1->build(['node4'], $parameterBag)->shouldNotBeCalled();
        $nodeBuilder2->build(['node4'], $parameterBag)->shouldNotBeCalled();
        $nodeBuilder3->build(['node4'], $parameterBag)->shouldNotBeCalled();

        $this->shouldThrow(Exception::class)->duringBuild(['node4'], $parameterBag);
    }
}
