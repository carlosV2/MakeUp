<?php

namespace carlosV2\MakeUp\NodeBuilder;

use carlosV2\Can\To;
use carlosV2\MakeUp\NodeBuilderInterface;
use carlosV2\MakeUp\ParameterBag;

final class NullNodeBuilder implements NodeBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function supports(array $node)
    {
        return can($node)->claim(
            To::beArray()
                ->withKey('type')->expected(To::beEqualsTo('null'))
        );
    }

    /**
     * @inheritDoc
     */
    public function build(array $node, ParameterBag $parameterBag)
    {
        return null;
    }
}
