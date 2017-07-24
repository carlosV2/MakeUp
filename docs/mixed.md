# Mixed

This node returns always the given value.

## Definition

* type: "mixed" (Mandatory)
* value: A value or expression to be evaluated (Mandatory)

## Examples

Building an string from value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'mixed',
    'value' => 'abc'
]);

var_dump($result); // string(3) "abc"
```

Building an integer from value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'mixed',
    'value' => 4
]);

var_dump($result); // int(4)
```

Building an array from value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'mixed',
    'value' => []
]);

var_dump($result); // array(0) {}
```
