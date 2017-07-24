# Null

This node returns always the `null` value.

## Definition

* type: "null" (Mandatory)

## Examples

Building a `null` value:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build(['type' => 'null']);

var_dump($result); // NULL
```
