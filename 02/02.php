<?php

require_once 'shared.php';

$levelData = getPuzzleInput();

$safeLevels = 0;
foreach ($levelData as $numbers) {
	if (!isLevelUnsafe($numbers)) {
		print(json_encode($numbers) . " was skipped as it is already safe.\n");
		$safeLevels++;
		continue;
	}

	$safeMutations = 0;
	for ($i = 0; $i < sizeof($numbers); $i++) {
		$tempNumbers = json_decode(json_encode($numbers));
		array_splice($tempNumbers, $i, 1);
		//print("Trying Mutation: " . json_encode($tempNumbers) . "\n");

		if (!isLevelUnsafe($tempNumbers)) {
			$safeMutations++;
		}
	}

	if ($safeMutations > 0) {
		print(json_encode($numbers) . " can be made safe in $safeMutations ways\n");
		$safeLevels++;
	}
}

print("Total of $safeLevels safe levels with dampener applied\n");