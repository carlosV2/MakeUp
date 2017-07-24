<?php

namespace carlosV2\MakeUp\NodeBuilder;

final class StringNodeBuilder extends ScalarNodeBuilder
{
    /**
     * @inheritDoc
     */
    protected function getType()
    {
        return 'string';
    }

    /**
     * @inheritDoc
     */
    protected function isCorrectFormat($value)
    {
        return is_string($value);
    }

    /**
     * @inheritDoc
     */
    protected function castToFormat($value)
    {
        return (string) $value;
    }
}
