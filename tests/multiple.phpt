<?php

require __DIR__ . '/bootstrap.php';

// This is actually solvable, but I don't
// really see the use-case.
Assert::error(function() {
	d( d('test') );
}, E_USER_ERROR);

Assert::error(function() {
	d('a'); d('b');
}, E_USER_ERROR);
