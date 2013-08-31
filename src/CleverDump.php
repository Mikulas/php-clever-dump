<?php

function d($d)
{
	static $lastCall;

	$trace = debug_backtrace(NULL, 1)[0];
	$hitline = $trace['line'];
	$source = file_get_contents($trace['file']);
	$tokens = token_get_all($source);

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

	// find function call
	while (TRUE) {
		$token = $tokens[$ptr];
		$ptr++;
		if (!is_array($token)) {
			continue;
		}
		if ($token[0] === T_STRING && strToLower($token[1]) === strToLower(__FUNCTION__)) {
			break;
		}
	};

	// skip whitespace
	while ($token[0] === T_WHITESPACE) {
		$token = $tokens[$ptr];
		$ptr++;
	}

	// if function call, parenthesis must follow
	if ($tokens[$ptr] !== '(') {
		throw new Exception; // this should not happen
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

	return $d;
}
