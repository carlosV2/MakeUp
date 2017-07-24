<?php

namespace spec\carlosV2\MakeUp;

use carlosV2\MakeUp\ParameterBag;
use PhpSpec\ObjectBehavior;

class ParameterBagSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedFromArray(['param' => 'value']);
    }

    function it_knows_it_has_a_parameter()
    {
        $this->has('param')->shouldReturn(true);
    }

    function it_knows_it_does_not_have_a_parameter()
    {
        $this->has('other_param')->shouldReturn(false);
    }

    function it_returns_an_existing_parameter()
    {
        $this->get('param')->shouldReturn('value');
    }

    function it_returns_null_for_non_existing_parameters()
    {
        $this->get('other_param')->shouldReturn(null);
    }

    function it_adds_more_parameters()
    {
        $this->add('new_param', 'new_value');
        $this->get('new_param')->shouldReturn('new_value');
    }

    function it_exposes_the_array_of_parameters()
    {
        $this->toArray()->shouldReturn(['param' => 'value']);
    }

    function it_can_be_constructed_from_another_parameter_bag()
    {
        $parametersBag = ParameterBag::fromArray(['other_param' => 'other_value']);

        $this->beConstructedFromParameterBag($parametersBag);

        $this->has('other_param')->shouldReturn(true);
    }
}
