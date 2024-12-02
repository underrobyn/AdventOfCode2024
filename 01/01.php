<?php

$puzzleInput = trim(file_get_contents('input-01.txt'));

$puzzleRows = explode("\n", $puzzleInput);
print_r($puzzleRows);

$list1 = array();
$list2 = array();

foreach ($puzzleRows as $row) {
	$cleanString = trim($row); // Remove pesky windows line-endings
	$spaceValues = explode(' ', $cleanString); // Split array at space
	$rowValues = array_filter($spaceValues); // Remove empty values
	$puzzleValues = array_values($rowValues); // Reset array index

	// Add values to their respective list and cast them to integers
	$list1[] = (int)$puzzleValues[0];
	$list2[] = (int)$puzzleValues[1];
}

// Sort the lists smallest to largest
sort($list1);
sort($list2);

$runningTotal = 0;
for ($i = 0; $i < sizeof($list1); $i++) {
	$difference = abs($list1[$i] - $list2[$i]);
	$runningTotal += $difference;
}

print($runningTotal);