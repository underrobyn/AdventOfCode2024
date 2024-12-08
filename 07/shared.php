<?php

require "Combinations.php";

function getPuzzleInput() {
	$fc = file_get_contents('input-01.txt');
	$lines = explode("\n", $fc);
	print("Number of lines: ". count($lines) . "\n");

	$equations = array();
	foreach ($lines as $line) {
		$qa = explode(":", $line);
		# Cannot use desired answer as key here, as there can be duplicates
		$equations[] = array(
			"ans" => trim($qa[0]),
			"numbers" => explode(" ", trim($qa[1]))
		);
	}

	return $equations;
}

function doMathUnsafe($mathString) {
	# YOLO
	return eval("return $mathString;");
}
