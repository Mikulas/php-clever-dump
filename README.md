### CleverDump for php

Dumps variable and argument of the dump function.

```php
require __DIR__ . '/src/CleverDump.php';

d('test a');
// 'test a' = 'test a'

$budget = 1000;
$price = 600;
d($budget);
d($price);
// $budget = 1000
// $price = 600

d($budget - $price);
// $budget - $price = 400

function meta($a, $b) {return $a + $b;}
d(sum(1, 1));
// sum(1, 1) = 2
```


### Caveats

It has problems with the `d` being called multiple times on the same line. This is because php stack trace returns only line, not call column. It can be bypassed for simple usage, but will always usually fail on weird edge cases. It's best to use one `d` per line now.
