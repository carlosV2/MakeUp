# Boolean

This node returns always a boolean value.

If the final value is not of type boolean, an exception will be raised unless the optional
cast parameter is set to true.

## Definition

* type: "boolean" (Mandatory)
* value: A value or expression to be evaluated (Mandatory)
* cast: Boolean (Optional)

## Examples

Building a boolean from value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'boolean',
    'value' => true
]);

var_dump($result); // bool(true)
```

Throwing an exception when trying to build a non boolean value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

// An exception will be raised
$nodeBuilder->build([
    'type' => 'boolean',
    'value' => 'false'
]);
```

Building a boolean value by casting a non boolean value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'boolean',
    'value' => 'false',
    'cast' => true
]);

var_dump($result); // bool(false)
```
