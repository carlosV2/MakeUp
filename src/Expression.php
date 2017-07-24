<?php

namespace carlosV2\MakeUp;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Expression
{
    /**
     * @var ExpressionLanguage
     */
    private $expressionLanguage;

    /**
     * @var string
     */
    private $token;

    /**
     * @param ExpressionLanguage $expressionLanguage
     * @param string             $token
     */
    public function __construct(ExpressionLanguage $expressionLanguage, $token = ':=')
    {
        $this->expressionLanguage = $expressionLanguage;
        $this->token = $token;
    }

    /**
     * @inheritdoc
     */
    public function evaluate($expression, ParameterBag $parameterBag)
    {
        if (is_string($expression)) {
            $length = strlen($this->token);

            if (substr($expression, 0, $length) === $this->token) {
                return $this->expressionLanguage->evaluate(substr($expression, $length), $parameterBag->toArray());
            }
        }

        return $expression;
    }
}
