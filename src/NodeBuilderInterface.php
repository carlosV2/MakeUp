<?php

namespace carlosV2\MakeUp;

interface NodeBuilderInterface
{
    /**
     * @param mixed[] $node
     *
     * @return bool
     */
    public function supports(array $node);

    /**
     * @param mixed[]      $node
     * @param ParameterBag $parameterBag
     *
     * @return mixed
     */
    public function build(array $node, ParameterBag $parameterBag);
}
