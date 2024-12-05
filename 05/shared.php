<?php

function getPuzzleInput(): array {
	$fc = file_get_contents('input-01.txt');
	$lines = explode("\n", $fc);

	$pageOrderingRules = array();
	$pageNumberUpdates = array();
	foreach ($lines as $line) {
		if (str_contains($line, "|")) {
			$rule = explode("|", $line);
			if (!array_key_exists($rule[0], $pageOrderingRules)) {
				$pageOrderingRules[$rule[0]] = array();
			}
			$pageOrderingRules[$rule[0]][] = trim($rule[1]);
		}
		if (str_contains($line, ",")) {
			$pageNumberUpdates[] = explode(",", trim($line));
		}
	}

	return array (
		"pageOrderingRules"=>$pageOrderingRules,
		"pageNumberUpdates"=>$pageNumberUpdates
	);
}

function getMiddleValue(array $array): int {
	return floor(sizeof($array)/2) ;
}

function getRuleBreakingIntersection($update, $rules): array {
	$seenElements = array();
	$intersection = array();
	for ($i = 0; $i < sizeof($update); $i++) {
		$updatePage = $update[$i];
		$seenElements[] = $updatePage;
		// print("Checking if {$updatePage} has any rules...\n");
		if (!isset($rules[$updatePage])) {
			continue;
		}

		#print("Page {$updatePage} cannot be before: " . json_encode($rules[$updatePage]) . "\n");

		#print_r("seen: " . json_encode($seenElements) . "\n");
		#print_r("Intersection: " . json_encode(array_intersect($seenElements, $rules[$updatePage])) . "\n");
		$intersection += array_intersect($seenElements, $rules[$updatePage]);
	}
	return array_values($intersection);
}

function doesUpdateBreakRules($update, $rules): bool {
	return sizeof(getRuleBreakingIntersection($update, $rules)) > 0;
}

function moveElement(&$array, $a, $b) {
	$out = array_splice($array, $a, 1);
	array_splice($array, $b, 0, $out);
}