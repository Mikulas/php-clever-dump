<?php

require __DIR__ . '/bootstrap.php';

foreach (array(
	'Hello John',
	1,
	1.5,
	array('test'),
	(object) array('a' => 'b')
) as $test) {
	Assert::same($test, d($test));
}


Assert::error(function() {
	Assert::same(1, d(d(1)));
}, E_USER_ERROR);
