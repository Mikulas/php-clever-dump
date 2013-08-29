<?php

require __DIR__ . '/bootstrap.php';

Assert::output(function() {
	d('test a');
}, "'test a' = 'test a'");

Assert::output(function() {
	$a = 'x';
	d($a);
}, "\$a = 'x'");

Assert::output(function() {
	$a = 'x';
	d($a . $a);
}, "\$a . \$a = 'xx'");

Assert::output(function() {
	$a = 'x';
	$b = 'y';
	d($a.$b);
}, "\$a.\$b = 'xy'");

Assert::output(function() {
	$a = 'x';
	d((($a)));
}, "((\$a)) = 'x'");

Assert::output(function() {
	$a = 'x';
	d( ( ( $a ) . $a ) );
}, "( ( \$a ) . \$a ) = 'xx'");

Assert::output(function() {
	d( array('a', 'b') );
}, "array('a', 'b') = array (
  0 => 'a',
  1 => 'b',
)");

Assert::output(function() {
	d( function() { return 'foo';} );
}, "function() { return 'foo';} = Closure");

Assert::output(function() {
	d( d('test') );
}, "'test' = 'test'\nd('test') = 'test");
