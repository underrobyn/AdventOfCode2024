<?php

require_once 'shared.php';

$list1 = array();
$list2 = array();
fillPuzzleInputLists($list1, $list2);

// Sort the lists smallest to largest
sort($list1);
sort($list2);

$runningTotal = 0;
for ($i = 0; $i < sizeof($list1); $i++) {
	$difference = abs($list1[$i] - $list2[$i]);
	$runningTotal += $difference;
}

print($runningTotal);