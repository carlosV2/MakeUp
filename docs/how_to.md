# How to

In order to use MakeUp you first need to instantiate the `NodeBuilder` and inject the other node builders:

```php
$nodeBuilder = new carlosV2\MakeUp\NodeBuilder();

$expressionToken = ':='; // Beginnig of expressions
$expressionLanguage = new Symfony\Component\ExpressionLanguage\ExpressionLanguage();
$expression = new carlosV2\MakeUp\Expression($expressionLanguage, $expressionToken);

$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\ArrayNodeBuilder($nodeBuilder, $expression));
$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\BooleanNodeBuilder());
$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\ConditionalNodeBuilder($nodeBuilder, $expression));
$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\FloatNodeBuilder());
$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\IntegerNodeBuilder());
$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\MixedNodeBuilder($expression));
$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\NullNodeBuilder());
$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\ObjectNodeBuilder($nodeBuilder, $expression));
$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\StringNodeBuilder());
```

Once the node builder has been instantiated you can start rendering any data:

```php
$result = $nodeBuilder->build([
    'type' => 'object',
    'keys' => [
        [
            'name' => 'date',
            'type' => 'string',
            'value' => ':=now.format("Y-m-d")'
        ], [
            'name' => 'time',
            'type' => 'string',
            'value' => ':=now.format("H:i:s")'
        ]
    ]
], carlosV2\MakeUp\ParameterBag::fromArray(['now' => new \DateTime()]));

var_dump($result); // object(stdClass)#1 (2) {["date"] => string(10) "2017-07-24" ["time"] => string(8) "21:46:00"}
```

You can add as many custom node builders as you want:

```php
$nodeBuilder->addNodeBuilder(new carlosV2\MakeUp\NodeBuilder\CustomNodeBuilder($nodeBuilder, $expression, 'datetime', [
    'type' => 'object',
    'keys' => [
        [
            'name' => 'date',
            'type' => 'string',
            'value' => ':=timestamp.format("Y-m-d")'
        ], [
            'name' => 'time',
            'type' => 'string',
            'value' => ':=timestamp.format("H:i:s")'
        ]
    ]
]));

$result = $nodeBuilder->build([
    'type' => 'datetime',
    'parameters' => [
        'timestamp' => ':=now'
    ]
], carlosV2\MakeUp\ParameterBag::fromArray(['now' => new \DateTime()]));

var_dump($result); // object(stdClass)#1 (2) {["date"] => string(10) "2017-07-24" ["time"] => string(8) "21:46:00"}
```

## NodeBuilders

Here is the list of the available node builders and how to use them:

- [Array](https://github.com/carlosV2/MakeUp/blob/master/docs/array.md)
- [Boolean](https://github.com/carlosV2/MakeUp/blob/master/docs/boolean.md)
- [Conditional](https://github.com/carlosV2/MakeUp/blob/master/docs/conditional.md)
- [Custom](https://github.com/carlosV2/MakeUp/blob/master/docs/custom.md)
- [Float](https://github.com/carlosV2/MakeUp/blob/master/docs/float.md)
- [Integer](https://github.com/carlosV2/MakeUp/blob/master/docs/integer.md)
- [Mixed](https://github.com/carlosV2/MakeUp/blob/master/docs/mixed.md)
- [Null](https://github.com/carlosV2/MakeUp/blob/master/docs/null.md)
- [Object](https://github.com/carlosV2/MakeUp/blob/master/docs/object.md)
- [String](https://github.com/carlosV2/MakeUp/blob/master/docs/string.md)
