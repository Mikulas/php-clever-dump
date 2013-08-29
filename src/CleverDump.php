<?php

function d($d)
{
	static $lastCall;

	$trace = debug_backtrace(NULL, 1)[0];
	$hitline = $trace['line'];
	$source = file_get_contents($trace['file']);
	$tokens = token_get_all($source);

	if ($lastCall['trace']['file'] === $trace['file']
	 && $lastCall['trace']['line'] === $trace['line']
	 && $lastCall['trace']['args'] !== $trace['args']
	) {
		// multiple calls to __FUNCTION__ on the same line,
		// skip to end of previous call in source
		$ptr = $lastCall['ptr'];
		$line = $hitline;

	} else {
		$ptr = -1;
		$line = 0;
		while ($line < $hitline) {
			$ptr++;
			$token = $tokens[$ptr];
			if (!is_array($token)) {
				continue;
			}
			$line = $token[2];
		}
	}

	// find function call
	do {
		$token = $tokens[$ptr];
		$ptr++;
	} while (!is_array($token) || $token[0] !== T_STRING && strToLower($token[1]) !== strToLower(__FUNCTION__));

	// skip whitespace
	while ($token[0] === T_WHITESPACE) {
		$token = $tokens[$ptr];
		$ptr++;
	}

	// if function call, parenthesis must follow
	if ($tokens[$ptr] !== '(') {
		var_dump($tokens[$ptr]);
		throw new Exception;
	}
	$ptr++;

	$depth = 1;
	$arg = '';
	do {
		$token = $tokens[$ptr];

		if ($token === '(') {
			$depth++;

		} else if ($token === ')') {
			$depth--;
			if ($depth <= 0) {
				break;
			}
		}

		$arg .= is_array($token) ? $token[1] : $token;
		$ptr++;
	} while (TRUE);

	$var = $d instanceof Closure ? 'Closure' : var_export($d, TRUE);
	echo trim($arg) . ' = ' . $var . "\n";

	$lastCall = array('trace' => $trace, 'ptr' => $ptr);
	return $d;
}
