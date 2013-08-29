<?php

require __DIR__ . '/bootstrap.php';

Assert::output(function() {
	d('a'); d('b');
}, "'a' = 'a'\n'b' = 'b'");

Assert::output(function() {
	for ($i = 0; $i < 2; ++$i) {
		d('a'); d('b');
	}
}, "'a' = 'a'\n'b' = 'b'");
