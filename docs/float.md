# Float

This node returns always a float value.

If the final value is not of type float, an exception will be raised unless the optional
cast parameter is set to true.

## Definition

* type: "float" (Mandatory)
* value: A value or expression to be evaluated (Mandatory)
* cast: Boolean (Optional)

## Examples

Building a float from value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'float',
    'value' => 1.23
]);

var_dump($result); // float(1.23)
```

Throwing an exception when trying to build a non float value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

// An exception will be raised
$nodeBuilder->build([
    'type' => 'float',
    'value' => '4.56'
]);
```

Building a float value by casting a non float value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'integer',
    'value' => '7.89',
    'cast' => true
]);

var_dump($result); // float(7.89)
```
