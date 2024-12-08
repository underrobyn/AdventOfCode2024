<?php

function getPuzzleInput() {
	$puzzleInput = file_get_contents('input.txt');
	$puzzleRows = explode("\n", $puzzleInput);

	return $puzzleRows;
}

function charMatrixRotate($inputRows) {
	$characterRows = array();
	$newMatrix = array();

	foreach ($inputRows as $inputRow) {
		$newMatrix[] = array();
	}

	for ($i = 0; $i < count($inputRows); $i++) {
		$chars = str_split($inputRows[$i]);
		for ($j = 0; $j < count($chars); $j++) {
			$newMatrix[$j][$i] = $chars[$j];
		}
	}

	foreach ($newMatrix as $newMatrixRow) {
		$characterRows[] = implode($newMatrixRow);
	}

	return array_values($characterRows);
}

function countInstancesOfString($str): int {
	return substr_count($str, 'XMAS') + substr_count($str, 'SAMX');
}


function part1 () {
	$puzzleIn = getPuzzleInput();
	$puzzleRotated = charMatrixRotate($puzzleIn);

	$found = 0;

	// Check for forwards and backwards strings in rows
	foreach ($puzzleIn as $puzzleRow) {
		$found += countInstancesOfString($puzzleRow);
	}

	// Check for forwards and backwards strings in columns
	foreach ($puzzleRotated as $puzzleRow) {
		$found += countInstancesOfString($puzzleRow);
	}


	print($found);
}

part1();