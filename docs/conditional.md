# Conditional

This node builds either node depending on the condition given.

## Definition

* if: Boolean or expression to be evaluated (Mandatory)
* then: Node definition (Mandatory)
* else: Node definitions (Mandatory)

## Examples

Building the node under `then`: 

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'if' => true,
    'then' => ['type' => 'string', 'value' => 'abc']
    'else' => ['type' => 'integer', 'value' => 4]
]);

var_dump($result); // string(3) "abc"
```

Building the node under `else`: 

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'if' => false,
    'then' => ['type' => 'string', 'value' => 'abc']
    'else' => ['type' => 'integer', 'value' => 4]
]);

var_dump($result); // int(4)
```
