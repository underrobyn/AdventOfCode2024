<?php

function part1($input) {
	$mul_statements = explode('mul(', $input);

	$runningTotal = 0;
	foreach ($mul_statements as $mul_statement) {
		$statement = explode(')', $mul_statement)[0];

		$numbers = explode(',', $statement);

		if (sizeof($numbers) !== 2) {
			continue;
		}
		if (!is_numeric($numbers[0]) || !is_numeric($numbers[1])) {
			continue;
		}
		$n1 = (int)$numbers[0];
		$n2 = (int)$numbers[1];
		$a1 = $n1 * $n2;
		$runningTotal += $a1;

		print("$n1 * $n2 = $a1\n");
	}

	print($runningTotal);
}