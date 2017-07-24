<?php

namespace carlosV2\MakeUp\NodeBuilder;

final class BooleanNodeBuilder extends ScalarNodeBuilder
{
    /**
     * @inheritDoc
     */
    protected function getType()
    {
        return 'boolean';
    }

    /**
     * @inheritDoc
     */
    protected function isCorrectFormat($value)
    {
        return is_bool($value);
    }

    /**
     * @inheritDoc
     */
    protected function castToFormat($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
