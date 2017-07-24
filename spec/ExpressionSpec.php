<?php

namespace spec\carlosV2\MakeUp;

use carlosV2\MakeUp\ParameterBag;
use PhpSpec\ObjectBehavior;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class ExpressionSpec extends ObjectBehavior
{
    function let(ExpressionLanguage $expressionLanguage)
    {
        $this->beConstructedWith($expressionLanguage, ':=');
    }

    function it_returns_the_same_value_if_it_is_not_an_string()
    {
        $this->evaluate(4, ParameterBag::fromArray([]))->shouldReturn(4);
    }

    function it_returns_the_same_string_if_it_does_not_start_with_the_token()
    {
        $this->evaluate('number', ParameterBag::fromArray(['number' => 4]))->shouldReturn('number');
    }

    function it_returns_the_expression_result_if_the_string_starts_with_the_token(ExpressionLanguage $expressionLanguage)
    {
        $parameterBag = ParameterBag::fromArray(['number' => 4]);

        $expressionLanguage->evaluate('number', $parameterBag->toArray())->willReturn(4);

        $this->evaluate(':=number', $parameterBag)->shouldReturn(4);
    }
}
