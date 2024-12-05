<?php

require_once 'shared.php';

$puzzle = getPuzzleInput();

$newUpdates = array();
foreach ($puzzle["pageNumberUpdates"] as $update) {
	$intersections = getRuleBreakingIntersection($update, $puzzle["pageOrderingRules"]);
	if (sizeof($intersections) == 0) {
		continue;
	}
	//print("\n\n");

	//print_r("Value: " . json_encode($update) . "\n");
	//print_r("Broken: " . json_encode($intersections) . "\n");

	$newUpdate = $update;
	while (count(getRuleBreakingIntersection($newUpdate, $puzzle["pageOrderingRules"])) !== 0) {
		$intersections = getRuleBreakingIntersection($newUpdate, $puzzle["pageOrderingRules"]);
		foreach ($intersections as $intersection) {
			//print("Moving $intersection\n");
			do {
				$pos = array_search($intersection, $newUpdate);
				//print("\t- found element $intersection at $pos\n");
				moveElement($newUpdate, $pos, $pos+1);
				//print(json_encode($newUpdate) . "\n");
			} while(sizeof(getRuleBreakingIntersection($newUpdate, $puzzle["pageOrderingRules"])) >= sizeof($intersections));

			if (sizeof(getRuleBreakingIntersection($newUpdate, $puzzle["pageOrderingRules"])) !== 0) {
				print(json_encode($update) . "\n");
				print(json_encode($newUpdate) . "\n");
				print_r(json_encode(getRuleBreakingIntersection($newUpdate, $puzzle["pageOrderingRules"])) . "\n\n");
			}
		}
	}

	//print(json_encode($newUpdate) . "\n");

	$newUpdates[] = $newUpdate;
}

$updateCount = 0;
foreach ($newUpdates as $newUpdate) {
	$updateCount += (int)$newUpdate[getMiddleValue($newUpdate)];
}

print("\nCorrect update count: {$updateCount}");

