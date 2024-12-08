<?php

require "Combinations.php";

function getPuzzleInput() {
	$fc = file_get_contents('input-01.txt');
	$lines = explode("\n", $fc);
	print("Number of lines: ". count($lines) . "\n");

	$equations = array();
	foreach ($lines as $line) {
		$qa = explode(":", $line);
		# Cannot use desired answer as key here, as there can be duplicates
		$equations[] = array(
			"ans" => trim($qa[0]),
			"numbers" => explode(" ", trim($qa[1]))
		);
	}

	return $equations;
}

function doMathUnsafe($mathString) {
	# YOLO
	return eval("return $mathString;");
}

$input = getPuzzleInput();

$sum = 0;
foreach($input as $equation) {
	$ans = $equation["ans"];
	$numbers = $equation["numbers"];

	print ("\nSolve for " . implode(" ? ", $numbers) . " = {$ans}\n");

	if (strlen($ans) > 19) {
		die("$ans will cause issues with PHPs max int size");
	}

	$operatorsNeeded = count($numbers) - 1;

	$allowedOperators = ["+", "*"];
	$permutations = new Combinations($allowedOperators);
	foreach ($permutations->Permutations($operatorsNeeded, true) as $operatorsChosen) {
		$lastResult = $numbers[0];
		for ($i = 0; $i < sizeof($operatorsChosen); $i++) {
			$mathStr = $lastResult . $operatorsChosen[$i] . $numbers[$i+1];
			$lastResult = (int)doMathUnsafe($mathStr);
			//print("{$mathStr} = $lastResult\n");
		}

		if ($lastResult === (int)$ans) {
			$sum += (int) $ans;
			break;
		}
	}
}

print("\nAnswer: $sum");