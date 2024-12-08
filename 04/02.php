<?php

require_once 'shared.php';


function findMas(&$puzzleIn, &$searchLocations): int {
	$found = 0;
	foreach ($searchLocations as $sl) {
		print("Investigating X at: " . json_encode($sl) . "\n");

		$topRight = "";
		$topLeft = "";
		$bottomRight = "";
		$bottomLeft = "";
		// Top right
		if (!empty($puzzleIn[$sl[0] + 1]) && !empty($puzzleIn[$sl[0] + 1][$sl[1] + 1])) {
			$topRight .= $puzzleIn[$sl[0] + 1][$sl[1] + 1];
		}
		// Top left
		if (!empty($puzzleIn[$sl[0] + 1]) && !empty($puzzleIn[$sl[0] + 1][$sl[1] - 1])) {
			$topLeft .= $puzzleIn[$sl[0] + 1][$sl[1] - 1];
		}
		// Bottom right
		if (!empty($puzzleIn[$sl[0] - 1]) && !empty($puzzleIn[$sl[0] - 1][$sl[1] + 1])) {
			$bottomRight .= $puzzleIn[$sl[0] - 1][$sl[1] + 1];
		}
		// Bottom left
		if (!empty($puzzleIn[$sl[0] - 1]) && !empty($puzzleIn[$sl[0] - 1][$sl[1] - 1])) {
			$bottomLeft .= $puzzleIn[$sl[0] - 1][$sl[1] - 1];
		}
		print ("TR: $topRight, TL: $topLeft, BR: $bottomRight, BL: $bottomLeft\n");
		if ($topRight === "M" && $topLeft === "S" && $bottomRight === "M" && $bottomLeft === "S") $found++;
		if ($topRight === "M" && $topLeft === "M" && $bottomRight === "S" && $bottomLeft === "S") $found++;
		if ($topRight === "S" && $topLeft === "S" && $bottomRight === "M" && $bottomLeft === "M") $found++;
		if ($topRight === "S" && $topLeft === "M" && $bottomRight === "S" && $bottomLeft === "M") $found++;
	}

	return $found;
}

$puzzleIn = getPuzzleInput('input-02.txt');
$searchLocations = findAllStartingChars($puzzleIn, "A");

print_r(json_encode($searchLocations) . "\n");
print_r(findMas($puzzleIn, $searchLocations) . "\n");
