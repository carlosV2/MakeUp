<?php

namespace carlosV2\MakeUp\NodeBuilder;

final class FloatNodeBuilder extends ScalarNodeBuilder
{
    /**
     * @inheritDoc
     */
    protected function getType()
    {
        return 'float';
    }

    /**
     * @inheritDoc
     */
    protected function isCorrectFormat($value)
    {
        return is_float($value) || is_integer($value);
    }

    /**
     * @inheritDoc
     */
    protected function castToFormat($value)
    {
        return (float) $value;
    }
}
