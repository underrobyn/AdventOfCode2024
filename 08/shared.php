<?php


# Identify antenna locations in terms of coordinate pairs
function findAntennas($puzzle): array {
    $antennas = [];
    for ($y = 0; $y < count($puzzle); $y++) {
        $row = str_split($puzzle[$y]);
        for ($x = 0; $x < count($row); $x++) {
            $char = $row[$x];
            if ($char != ".") {
                if (!isset($antennas[$char])) {
                    $antennas[$char] = [];
                }
                $antennas[$char][] = [$x, $y];
            }
            print($char . " ");
        }
        print ("\n");
    }

    print("Puzzle grid size: [" . count($puzzle) . ", " . strlen($puzzle[0]) .  "]\n");
    print("Number of antennas: ". count($antennas) . "\n");

    return $antennas;
}

function isCoordinateInPuzzle($puzzle, $coordinate): bool {
    if ($coordinate[0] > strlen($puzzle[0]) || $coordinate[1] > count($puzzle)) {
        return false;
    }

    if ($coordinate[0] < 0 || $coordinate[1] < 0) {
        return false;
    }

    return true;
}