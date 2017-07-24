# Object

This node builds an object.

It uses the name under each key item for the name of the object's keys.

## Definition

* type: "object" (Mandatory)
* keys: Array (Mandatory)

## Examples

Building an empty object:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build(['type' => 'object']);

var_dump($result); // object(stdClass)#1 (0) {}
```

Building an object with keys:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'object',
    'keys' => [
        ['name' => 'id', 'type' => 'integer', 'value' => 123],
        ['name' => 'name', 'type' => 'string', 'value' => 'MakeUp']
    ]
]);

var_dump($result); // object(stdClass)#1 (2) {["id"]=>int(123) ["name"]=>string(6) "MakeUp"}
```
