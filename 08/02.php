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

    if (count($antennaLocations) == 1) {
        print("Only one antenna with ID $antennaId. Skipping.\n");
        continue;
    }

    $combinations = new Combinations($antennaLocations, 2);
    foreach ($combinations->generator() as $combination) {
        $distanceX = $combination[0][0] - $combination[1][0];
        $distanceY = $combination[0][1] - $combination[1][1];
        #print("\tCombination: [{$combination[0][0]}, {$combination[0][1]}], [{$combination[1][0]}, {$combination[1][1]}]");
        #print("\n\t\tDistance: [$distanceX, $distanceY]\n");

        $continue = true;
        $i = 0;
        while ($continue) {
            $i += 1;
            $pNode = [$combination[0][0] + $distanceX*$i, $combination[0][1] + $distanceY*$i];
            $nNode = [$combination[1][0] + ($distanceX*-$i), $combination[1][1] + ($distanceY*-$i)];

            $continue = false;
            if (isCoordinateInPuzzle($puzzle, $pNode)) {
                $continue = true;
                $antinodeLocations[] = $pNode;
            }
            if (isCoordinateInPuzzle($puzzle, $nNode)) {
                $continue = true;
                $antinodeLocations[] = $nNode;
            }
        }

        $aNode = [$combination[0][0], $combination[0][1]];
        $bNode = [$combination[1][0], $combination[1][1]];
        $antinodeLocations[] = $aNode;
        $antinodeLocations[] = $bNode;
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