<?php

namespace App\Year2022\Day07NoSpaceLeftOnDevice;

use App\Tools\FileReader;
use Exception;

class Part02
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

        $totalMemory = 70000000;
        $requiredMemory = 30000000;
        $currentMemory = $totalMemory - $this->terminal->mainDirectory->size();

        $memoryToRelease = $requiredMemory - $currentMemory;

        return $this->directorySizeCalculator->getMinTotalSizeOfAtLeast($this->terminal->mainDirectory, $memoryToRelease);
    }
}