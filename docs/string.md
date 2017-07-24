# String

This node returns always an string value.

If the final value is not of type string, an exception will be raised unless the optional
cast parameter is set to true.

## Definition

* type: "string" (Mandatory)
* value: A value or expression to be evaluated (Mandatory)
* cast: Boolean (Optional)

## Examples

Building an string from value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'string',
    'value' => 'abc'
]);

var_dump($result); // string(3) "abc"
```

Throwing an exception when trying to build a non string value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

// An exception will be raised
$nodeBuilder->build([
    'type' => 'string',
    'value' => 4
]);
```

Building an string value by casting a non string value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'string',
    'value' => 5,
    'cast' => true
]);

var_dump($result); // string(1) "5"
```
