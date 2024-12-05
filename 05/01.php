<?php

require_once 'shared.php';

$puzzle = getPuzzleInput();

$updateCount = 0;
foreach ($puzzle["pageNumberUpdates"] as $update) {
	$badUpdate = doesUpdateBreakRules($update, $puzzle["pageOrderingRules"]);
	if (!$badUpdate) {
		$updateCount += (int)$update[getMiddleValue($update)];
	}
}

print("\nCorrect update count: {$updateCount}");
