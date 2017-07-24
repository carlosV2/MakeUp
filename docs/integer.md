# Integer

This node returns always an integer value.

If the final value is not of type integer, an exception will be raised unless the optional
cast parameter is set to true.

## Definition

* type: "integer" (Mandatory)
* value: A value or expression to be evaluated (Mandatory)
* cast: Boolean (Optional)

## Examples

Building an integer from value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'integer',
    'value' => 4
]);

var_dump($result); // int(4)
```

Throwing an exception when trying to build a non integer value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

// An exception will be raised
$nodeBuilder->build([
    'type' => 'integer',
    'value' => '5'
]);
```

Building an integer value by casting a non integer value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'integer',
    'value' => '6',
    'cast' => true
]);

var_dump($result); // int(6)
```
