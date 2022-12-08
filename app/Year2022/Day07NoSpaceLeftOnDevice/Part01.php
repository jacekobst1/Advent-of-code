<?php

namespace App\Year2022\Day07NoSpaceLeftOnDevice;

use App\Tools\FileReader;
use Exception;

class Part01
{
    public function __construct(
        private readonly FileReader $fileReader,
        private readonly Terminal $terminal,
        private readonly DirectorySizeCalculator $directorySizeCalculator,
    ) {
    }

    /**
     * @throws Exception
     */
    public function run(): string
    {
        $file = $this->fileReader->readFile(dirname(__FILE__) . '/input.txt');

        $size = $this->calculateSize($file);

        $this->fileReader->closeFile($file);

        return $size;
    }


    private function calculateSize(mixed $file): int
    {
        while (($line = fgets($file)) !== false) {
            $line = str_replace("\n", "", $line);
            $this->terminal->read($line);
        }

        return $this->directorySizeCalculator->getTotalSizeOfDirectoriesWhichHaveAtMost100k(
            $this->terminal->mainDirectory
        );
    }
}