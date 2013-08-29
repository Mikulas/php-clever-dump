<?php

require __DIR__ . '/../vendor/nette/tester/Tester/bootstrap.php';
require __DIR__ . '/../src/CleverDump.php';

class Assert extends Tester\Assert
{

	public static function output($closure, $expected)
	{
		ob_start();
		$closure();
		$actual = rtrim(ob_get_clean());
		Assert::same($expected, $actual);
	}

}
