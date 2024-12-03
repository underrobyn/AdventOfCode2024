<?php

require_once 'shared.php';

$levelData = getPuzzleInput();

$safeLevels = 0;
foreach ($levelData as $numbers) {
	$unsafe = isLevelUnsafe($numbers);
	if (!$unsafe) {
		$safeLevels++;
	}
}

print("Total of $safeLevels safe levels\n");