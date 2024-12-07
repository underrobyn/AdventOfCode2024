<?php

function getPuzzleInput(): array {
	$fc = file_get_contents('input-01.txt');
	$lines = explode("\n", $fc);

	$positionsArray = [];
	foreach ($lines as $line) {
		$positionsArray[] = str_split(trim($line));
	}
	return $positionsArray;
}

function clearScreen(): void {
	echo chr(27).chr(91).'H'.chr(27).chr(91).'J';
}

function debugMap($map, &$guard, &$guardPositions) {
	clearScreen();
	$br = " ";
	for ($y = 0; $y < sizeof($map); $y++) {
		if ($y === 0) {
			for ($x = 0; $x < sizeof($map[$y]); $x++) {
				//print("\t{$x}");
			}
			print("\n");
		}

		print("{$y}{$br}");
		for ($x = 0; $x < sizeof($map[$y]); $x++) {
			$sym = $map[$y][$x];
			if (in_array([$x, $y], $guardPositions)) {
				$sym = "X";
			}
			if ($guard["coords"][0] === $x && $guard["coords"][1] === $y) {
				$sym = $guard["position"];
			}
			print("$sym{$br}");
		}
		print("\n");
	}
	print("Guard is facing: {$guard['position']}, at coords (" . json_encode($guard['coords']) . ")\n");
	print("Guard has moved " . count($guardPositions) . " times\n");

	$guardPositionsStrings = [];
	foreach ($guardPositions as $guardPosition) {
		$guardPositionsStrings[] = implode("_", $guardPosition);
	}
	print("Guard has been in " . count(array_unique($guardPositionsStrings)) . " unique coordinates");
}

function findGuardPosition(&$map) {
	$pos = "";
	$x = 0;
	$y = 0;
	for (; $y < sizeof($map); $y++) {
		$foundGuardUp = array_search("^", $map[$y]);
		$foundGuardDown = array_search("v", $map[$y]);
		$foundGuardLeft = array_search("<", $map[$y]);
		$foundGuardRight = array_search(">", $map[$y]);

		if ($foundGuardUp) {
			$pos = "^";
			$x = $foundGuardUp;
			break;
		}
		if ($foundGuardDown) {
			$pos = "v";
			$x = $foundGuardDown;
			break;
		}
		if ($foundGuardLeft) {
			$pos = "<";
			$x = $foundGuardLeft;
			break;
		}
		if ($foundGuardRight) {
			$pos = ">";
			$x = $foundGuardRight;
			break;
		}
	}

	return array(
		"position" => $pos,
		"coords" => array($x, $y)
	);
}

function getNextGuardPosition(&$guard): string {
	return array(
		"^" => ">",
		">" => "v",
		"v" => "<",
		"<" => "^"
	)[$guard["position"]];
}

function moveGuard(&$map, &$guard): bool {
	$xMove = 0;
	$yMove = 0;
	if ($guard["position"] === "^") $yMove = -1;
	if ($guard["position"] === "v") $yMove = 1;
	if ($guard["position"] === "<") $xMove = -1;
	if ($guard["position"] === ">") $xMove = 1;

	$newX = $guard["coords"][0] + $xMove;
	$newY = $guard["coords"][1] + $yMove;
	#print("\n\tTrying to move guard by ($xMove, $yMove) to ($newX, $newY)\n");

	// Check if guard left the map bounds
	if ($newY < 0 || $newX < 0 || (!isset($map[$newY]) && !isset($map[$newY][$newX]))) {
		$guard["position"] = "";
		$guard["coords"] = [$newX, $newY];
		return true;
	}

	$mapValue = $map[$newY][$newX];
	if ($mapValue === "#") {
		$guard["position"] = getNextGuardPosition($guard);
		#print_r("\nGuard has rotated to: {$guard['position']}");
		return false;
	}

	$guard["coords"] = [$newX, $newY];
	return false;
}


$puzzle = getPuzzleInput();
$map = $puzzle;

$guard = findGuardPosition($map);
$guardPositions = [];
while ($guard["position"] !== "") {
	$guardPositions[] = $guard["coords"];
	if (moveGuard($map, $guard)) {
		break;
	}

	#debugMap($map, $guard, $guardPositions);
	print("Guard is facing: {$guard['position']}, at coords (" . json_encode($guard['coords']) . ")\r");

	#usleep(40000);
}

debugMap($map, $guard, $guardPositions);