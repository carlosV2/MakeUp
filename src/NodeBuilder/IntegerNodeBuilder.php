<?php

namespace carlosV2\MakeUp\NodeBuilder;

final class IntegerNodeBuilder extends ScalarNodeBuilder
{
    /**
     * @inheritDoc
     */
    protected function getType()
    {
        return 'integer';
    }

    /**
     * @inheritDoc
     */
    protected function isCorrectFormat($value)
    {
        return is_integer($value);
    }

    /**
     * @inheritDoc
     */
    protected function castToFormat($value)
    {
        return (integer) $value;
    }
}
