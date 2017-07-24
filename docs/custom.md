# Custom

This node allows you to create new types of nodes.

Optionally it can parametrize and extend the new types.

## Definition

* type: String (Mandatory)
* parameters: Associative array with keys and values (Optional)
* combine: Node parts to be added to the custom type (Optional)

## Examples

Building a node with a custom type: 

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder
$expression = // Instance of carlosV2/MakeUp/Expression

$nodeBuilder->addNodeBuilder($nodeBuilder, $expression, 'AbcString', [
    'type' => 'string',
    'value' => 'abc'
]);

$result = $nodeBuilder->build(['type' => 'AbcString']);

var_dump($result); // string(3) "abc"
```

Building a node with a custom type with parameters: 

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder
$expression = // Instance of carlosV2/MakeUp/Expression

$nodeBuilder->addNodeBuilder($nodeBuilder, $expression, 'IntegerNumber', [
    'type' => 'integer',
    'value' => ':=number'
]);

$result = $nodeBuilder->build([
    'type' => 'IntegerNumber',
    'parameters' => [
        'number' => 4
    ]
]);

var_dump($result); // int(4)
```

Building a node with a custom type combining parts: 

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder
$expression = // Instance of carlosV2/MakeUp/Expression

$nodeBuilder->addNodeBuilder($nodeBuilder, $expression, 'IntegerNumber', [
    'type' => 'integer',
    'value' => '5'
]);

$result = $nodeBuilder->build([
    'type' => 'IntegerNumber',
    'combine' => [
        'cast' => true
    ]
]);

var_dump($result); // int(5)
```
