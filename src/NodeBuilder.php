<?php

namespace carlosV2\MakeUp;

use RuntimeException;

class NodeBuilder
{
    /**
     * @var NodeBuilderInterface[]
     */
    private $nodeBuilders;

    public function __construct()
    {
        $this->nodeBuilders = [];
    }

    /**
     * @param NodeBuilderInterface $nodeBuilder
     */
    public function addNodeBuilder(NodeBuilderInterface $nodeBuilder)
    {
        $this->nodeBuilders[] = $nodeBuilder;
    }

    /**
     * @param mixed[]      $node
     * @param ParameterBag $parameterBag
     *
     * @return mixed
     */
    public function build(array $node, ParameterBag $parameterBag = null)
    {
        if (is_null($parameterBag)) {
            $parameterBag = ParameterBag::fromArray([]);
        }

        foreach ($this->nodeBuilders as $nodeBuilder) {
            if ($nodeBuilder->supports($node)) {
                return $nodeBuilder->build($node, $parameterBag);
            }
        }

        throw new RuntimeException();
    }
}
