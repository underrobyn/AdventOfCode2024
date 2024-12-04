<?php

require_once 'shared.php';

$puzzleInput = file_get_contents('input-02.txt');

$splitDont = explode("don't()", $puzzleInput);
$partsToInclude = $splitDont[0];
foreach ($splitDont as $splitString) {
	$splitDo = explode("do()", $splitString);
	if (count($splitDo) < 2) {
		continue;
	}
	array_splice($splitDo, 0, 1);
	$partsToInclude .= implode($splitDo);
}

part1($partsToInclude);