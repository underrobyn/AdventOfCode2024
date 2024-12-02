<?php

require_once 'shared.php';

$list1 = array();
$list2 = array();
fillPuzzleInputLists($list1, $list2);

$list1Instances = array_count_values($list1);
$list2Instances = array_count_values($list2);

// If there are items in one array but not in the other, the multiplication will be *0
// We only need to worry about the elements at the intersection of the two arrays.
$intersectingKeys = array_intersect(array_keys($list1Instances), array_keys($list2Instances));
$numIntersectingKeys = sizeof($intersectingKeys);
print("There are {$numIntersectingKeys} intersecting keys\n");

$runningTotal = 0;
foreach ($intersectingKeys as $key) {
	$thisVal = $list1Instances[$key] * $list2Instances[$key];
	print("Value {$key} appears in List 1: {$list1Instances[$key]} times, List 2: {$list2Instances[$key]} times, so value is {$thisVal}\n");
	$runningTotal += $thisVal * $key;
}

print($runningTotal);