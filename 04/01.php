<?php

function getPuzzleInput() {
	$puzzleInput = file_get_contents('input-01.txt');
	$puzzleRows = explode("\n", $puzzleInput);
	return array_map('str_split', $puzzleRows);
}


function findAllStartingChars(&$puzzleIn): array {
	$xLocations = array();
	for ($y = 0; $y < sizeof($puzzleIn); $y++) {
		for ($x = 0; $x < sizeof($puzzleIn[$y]); $x++) {
			if ($puzzleIn[$y][$x] === "X") {
				$xLocations[] = [$y, $x];
			}
		}
	}
	return $xLocations;
}

function findAll(&$puzzleIn, &$searchLocations): int {
	$found = 0;
	foreach ($searchLocations as $sl) {
		print("Investigating X at: " . json_encode($sl) . "\n");

		$topRight = "";
		$topLeft = "";
		$bottomRight = "";
		$bottomLeft = "";
		$left = "";
		$right = "";
		$top = "";
		$bottom = "";
		for ($i = 0; $i < 4; $i++) {
			// Top right
			if (!empty($puzzleIn[$sl[0] + $i]) && !empty($puzzleIn[$sl[0] + $i][$sl[1] + $i])) {
				$topRight .= $puzzleIn[$sl[0] + $i][$sl[1] + $i];
			}
			// Top left
			if (!empty($puzzleIn[$sl[0] + $i]) && !empty($puzzleIn[$sl[0] + $i][$sl[1] - $i])) {
				$topLeft .= $puzzleIn[$sl[0] + $i][$sl[1] - $i];
			}
			// Bottom right
			if (!empty($puzzleIn[$sl[0] - $i]) && !empty($puzzleIn[$sl[0] - $i][$sl[1] + $i])) {
				$bottomRight .= $puzzleIn[$sl[0] - $i][$sl[1] + $i];
			}
			// Bottom left
			if (!empty($puzzleIn[$sl[0] - $i]) && !empty($puzzleIn[$sl[0] - $i][$sl[1] - $i])) {
				$bottomLeft .= $puzzleIn[$sl[0] - $i][$sl[1] - $i];
			}

			// Right
			if (!empty($puzzleIn[$sl[0]][$sl[1] + $i])) {
				$right .= $puzzleIn[$sl[0]][$sl[1] + $i];
			}
			// Left
			if (!empty($puzzleIn[$sl[0]][$sl[1] - $i])) {
				$left .= $puzzleIn[$sl[0]][$sl[1] - $i];
			}
			// Bottom
			if (!empty($puzzleIn[$sl[0] - $i]) && !empty($puzzleIn[$sl[0] - $i][$sl[1]])) {
				$bottom .= $puzzleIn[$sl[0] - $i][$sl[1]];
			}
			// Top
			if (!empty($puzzleIn[$sl[0] + $i]) && !empty($puzzleIn[$sl[0] + $i][$sl[1]])) {
				$top .= $puzzleIn[$sl[0] + $i][$sl[1]];
			}
		}
		print ("TR: $topRight, TL: $topLeft, BR: $bottomRight, BL: $bottomLeft\n");
		print ("T: $top, R: $right, B: $bottom, L: $left\n");

		if ($topRight === "XMAS") $found++;
		if ($topLeft === "XMAS") $found++;
		if ($bottomRight === "XMAS") $found++;
		if ($bottomLeft === "XMAS") $found++;
		if ($top === "XMAS") $found++;
		if ($right === "XMAS") $found++;
		if ($bottom === "XMAS") $found++;
		if ($left === "XMAS") $found++;
	}

	return $found;
}

function part1 () {
	$puzzleIn = getPuzzleInput();

	$searchLocations = findAllStartingChars($puzzleIn);

	print_r(json_encode($searchLocations) . "\n");
	print_r("Found: " . findAll($puzzleIn, $searchLocations));
}

part1();