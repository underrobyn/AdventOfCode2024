<?php

class FileSystem {

    private string $map;
    private array $files;

    public function __construct($map) {
        $this->map = $map;
        $this->files = [];
    }

    public function build() {
        $chars = str_split($this->map);
        $id = 0;
        for ($i = 0; $i < count($chars); $i++) {
            if ($i % 2 == 0) {
                print("File ID {$id} at $i is length {$chars[$i]}\n");
                $id += 1;
            } else {
                print("Empty space length {$chars[$i]}\n");
            }
        }
    }
}

$puzzle = trim(file_get_contents('input-01.txt'));
$fs = new FileSystem($puzzle);
$fs->build();