<?php

require "Combinations.php";

function getPuzzleInput() {
	$fc = file_get_contents('input-01.txt');
	$lines = explode("\n", $fc);

	$equations = array();
	foreach ($lines as $line) {
		$qa = explode(":", $line);
		$equations[trim($qa[0])] = explode(" ", trim($qa[1]));
	}

	return $equations;
}

function doMathUnsafe($mathString) {
	# YOLO
	return eval("return $mathString;");
}

$input = getPuzzleInput();

$sum = 0;
foreach($input as $ans => $numbers) {
	#print ("\nSolve for " . implode(" ? ", $numbers) . " = {$ans}\n");

	$operatorsNeeded = count($numbers) - 1;

	$allowedOperators = ["+", "*"];
	$permutations = new Combinations($allowedOperators);
	foreach ($permutations->Permutations($operatorsNeeded, true) as $operatorsChosen) {
		$math = str_repeat("(", count($operatorsChosen));
		$math .= $numbers[0];
		for ($i = 0; $i < sizeof($operatorsChosen); $i++) {
			$math .= $operatorsChosen[$i] . $numbers[$i + 1] . ")";
		}

		$result = doMathUnsafe($math);

		if ($result === $ans) {
			$sum += (int) $ans;
			print("$math = $result \n");
			break;
		}
	}
}

print("\nAnswer: $sum");