### CleverDump for php

Dumps variable and argument of the dump function.

```php
require __DIR__ . '/src/CleverDump.php';

d('test a');
// output:
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

```php
d('a'); d('b'); // solution: write on statement per line
```
```
Unresolvable = 'a'
Unresolvable = 'a'
```

```php
foo(d('a'), d('b')); // This is a viable use case. No solution exists.
```
```
Unresolvable = 'a'
Unresolvable = 'a'
```

```php
d(d('a')); // solution: I don't have any
```
```
Unresolvable = 'a'
Unresolvable = 'a'
```

It has problems with the `d` being called multiple times on the same line. This is because php stack trace returns only line, not call column. It can be bypassed for simple usage, but will always usually fail on edge cases. It's best to use one `d` per line now.

The impossible case:
```php
$a = 'X';
$b = 'X';
$chance = mt_rand(0, 1) ? d($a) : d($b);
```
