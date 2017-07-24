<?php

namespace carlosV2\MakeUp;

final class ParameterBag
{
    /**
     * @var mixed[]
     */
    private $parameters;

    /**
     * @param mixed[] $parameters
     */
    private function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param array $parameters
     *
     * @return ParameterBag
     */
    public static function fromArray(array $parameters)
    {
        return new self($parameters);
    }

    /**
     * @param ParameterBag $parameterBag
     *
     * @return ParameterBag
     */
    public static function fromParameterBag(ParameterBag $parameterBag)
    {
        return self::fromArray($parameterBag->toArray());
    }

    /**
     * @param string $parameter
     *
     * @return bool
     */
    public function has($parameter)
    {
        return isset($this->parameters[$parameter]);
    }

    /**
     * @param string $parameter
     *
     * @return mixed
     */
    public function get($parameter)
    {
        if ($this->has($parameter)) {
            return $this->parameters[$parameter];
        }

        return null;
    }

    /**
     * @param string $parameter
     * @param mixed  $value
     */
    public function add($parameter, $value)
    {
        $this->parameters[$parameter] = $value;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->parameters;
    }
}
