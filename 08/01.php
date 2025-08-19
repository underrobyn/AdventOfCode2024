<?php

use drupol\phpermutations\Generators\Combinations;
require_once '../vendor/autoload.php';
require_once 'shared.php';

$fc = file_get_contents('input-01.txt');
$puzzle = explode("\r\n", $fc);
$antennas = findAntennas($puzzle);

$antinodeLocations = [];
foreach ($antennas as $antennaId => $antennaLocations) {
    print("AntennaID: $antennaId\n");
    $combinations = new Combinations($antennaLocations, 2);
    foreach ($combinations->generator() as $combination) {
        $distanceX = $combination[0][0] - $combination[1][0];
        $distanceY = $combination[0][1] - $combination[1][1];
        #print("\tCombination: [{$combination[0][0]}, {$combination[0][1]}], [{$combination[1][0]}, {$combination[1][1]}]");
        #print("\n\t\tDistance: [$distanceX, $distanceY]\n");

        $pNode = [$combination[0][0] + $distanceX, $combination[0][1] + $distanceY];
        $nNode = [$combination[1][0] + ($distanceX*-1), $combination[1][1] + ($distanceY*-1)];
        if (isCoordinateInPuzzle($puzzle, $pNode)) {
            $antinodeLocations[] = $pNode;
        }
        if (isCoordinateInPuzzle($puzzle, $nNode)) {
            $antinodeLocations[] = $nNode;
        }
    }
}

$nAntiNodes = count($antinodeLocations);
print("\nnAntiNodes={$nAntiNodes}\n");

$numValidAntinodes = 0;
for ($y = 0; $y < count($puzzle); $y++) {
    $line = str_split($puzzle[$y]);
    for ($x = 0; $x < count($line); $x++) {
        $char = $line[$x];
        if (in_array(array($x, $y), $antinodeLocations)) {
            $char = "#";
            $numValidAntinodes += 1;
        }
        print($char . " ");
    }
    print("\n");
}

print("$numValidAntinodes anti-nodes");