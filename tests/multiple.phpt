<?php

require __DIR__ . '/bootstrap.php';

// this is a tough one
Assert::output(function() {
	d( d('test') );
}, "'test' = 'test'\nd('test') = 'test");

Assert::output(function() {
	d('a'); d('b');
}, "'a' = 'a'\n'b' = 'b'");

Assert::output(function() {
	for ($i = 0; $i < 2; ++$i) {
		d('a'); d('b');
	}
}, "this is a hard one");

// Having a 50:50 chance, it seems impossible to
// determine which of the functions was called;
// both calls have identical stack trace.
$chance = mt_rand(0, 1);
$l = $chance ? 'a' : 'b';
Assert::output(function() use ($chance) {
	$chance ? d('a') : d('b');
}, "'$l' = '$l'");
