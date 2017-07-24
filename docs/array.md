# Array

This node builds an array.

It uses the source to fetch the items that will be assigned to the variable name
defined in variable. Each item in the generated array will be built from the elements
part.

## Definition

* type: "array" (Mandatory)
* provider: Array (Mandatory)
    * source: An array or expression to be evaluated (Mandatory)
    * variable: String (Mandatory)
* elements: Node definition (Mandatory)

## Examples

Building an array from source:

```php
$nodeBuilder = // Instance of carlosV2/MakeUp/NodeBuilder

$result = $nodeBuilder->build([
    'type' => 'array',
    'provider' => [
        'source' => [1, 2, 3],
        'variable' => 'number'
    ]
    'elements' => [
        'type' => 'integer',
        'value' => ':=number'
    ]
]);

var_dump($result); // array(3) {[0]=>int(1) [1]=>int(2) [2]=>int(3)}
```
