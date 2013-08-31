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

// not first function on line
Assert::output(function() {
	echo ""; abs(1); $a = 'x'; function(){}; for($i = 0; $i<-1;++$i){}; d('a');
}, "'a' = 'a'");

// not last function on line
Assert::output(function() {
	d('a'); echo ""; abs(1); $a = 'x'; function(){}; for($i = 0; $i<-1;++$i){};
}, "'a' = 'a'");
