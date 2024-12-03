<?php

function getPuzzleInput() {
	$puzzleInput = trim(file_get_contents('input-01.txt'));
	$puzzleRows = explode("\n", $puzzleInput);

	function convertRowToIntegers($row) {
		return array_map('intval', explode(' ', $row));
	}

	return array_map('convertRowToIntegers', $puzzleRows);
}

// Checks if number less than zero
function ltz($n) {
	return $n < 0;
}

// Checks if number greater than zero
function gtz($n) {
	return $n > 0;
}

function isLevelUnsafe ($numbers): bool {
	// Make new array with the differences between each element
	$diffArray = [];
	for ($i = 0; $i < sizeof($numbers) - 1; $i++) {
		$diffElement = $numbers[$i] - $numbers[$i+1];
		$diffArray[] = $diffElement;
	}

	$unsafe = false;
	foreach ($diffArray as $element) {
		// Check if all the signs are the same in the array to find increasing / decreasing difference
		$negativeValues = array_filter($diffArray, "ltz");
		$positiveValues = array_filter($diffArray, "gtz");
		if (sizeof($negativeValues) != 0 && sizeof($positiveValues) != 0) {
			$unsafe = true;
		}

		// Check if there is no increase/decrease
		if ($element === 0) {
			$unsafe = true;
		}

		// Check if any of the absolute values are > 3
		if (abs($element) > 3) {
			$unsafe = true;
		}
	}

	return $unsafe;
}
