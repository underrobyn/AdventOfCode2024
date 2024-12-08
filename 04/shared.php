<?php

function getPuzzleInput($inputFile) {
	$puzzleInput = file_get_contents($inputFile);
	$puzzleRows = explode("\n", $puzzleInput);
	return array_map('str_split', $puzzleRows);
}


function findAllStartingChars(&$puzzleIn, $startingChar): array {
	$locations = array();
	for ($y = 0; $y < sizeof($puzzleIn); $y++) {
		for ($x = 0; $x < sizeof($puzzleIn[$y]); $x++) {
			if ($puzzleIn[$y][$x] === $startingChar) {
				$locations[] = [$y, $x];
			}
		}
	}
	return $locations;
}