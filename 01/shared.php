<?php

function fillPuzzleInputLists(&$list1, &$list2) {
	$puzzleInput = trim(file_get_contents('input-01.txt'));

	$puzzleRows = explode("\n", $puzzleInput);
	print_r($puzzleRows);

	foreach ($puzzleRows as $row) {
		$cleanString = trim($row); // Remove pesky windows line-endings
		$spaceValues = explode(' ', $cleanString); // Split array at space
		$rowValues = array_filter($spaceValues); // Remove empty values
		$puzzleValues = array_values($rowValues); // Reset array index

		// Add values to their respective list and cast them to integers
		$list1[] = (int)$puzzleValues[0];
		$list2[] = (int)$puzzleValues[1];
	}
}