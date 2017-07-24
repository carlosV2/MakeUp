<?php

namespace carlosV2\MakeUp\NodeBuilder;

use carlosV2\Can\To;
use carlosV2\MakeUp\Expression;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;
use RuntimeException;

abstract class ScalarNodeBuilder implements NodeBuilderInterface
{
    /**
     * @var Expression
     */
    private $expression;

    /**
     * @param Expression $expression
     */
    public function __construct(Expression $expression)
    {
        $this->expression = $expression;
    }

    /**
     * @inheritDoc
     */
    final public function supports(array $node)
    {
        return can($node)->claim(
            To::beArray()
                ->withKey('type')->expected(To::beEqualsTo($this->getType()))
                ->withKey('value')->expected(To::beSet())
                ->withKey('cast')->expected(To::beOptionalAnd(To::beBoolean()))
        );
    }

    /**
     * @inheritDoc
     */
    final public function build(array $node, ParameterBag $parameterBag)
    {
        $value = $this->expression->evaluate($node['value'], $parameterBag);

        $cast = false;
        if (isset($node['cast'])) {
            $cast = $node['cast'];
        }

        if ($cast || $this->isCorrectFormat($value)) {
            return $this->castToFormat($value);
        }

        throw new RuntimeException(
            sprintf('Unable to return %s. The obtained value is `%s`.', $this->getType(), var_export($value, true))
        );
    }

    /**
     * @return string
     */
    abstract protected function getType();

    /**
     * @param mixed $value
     *
     * @return bool
     */
    abstract protected function isCorrectFormat($value);

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    abstract protected function castToFormat($value);
}
