<?php

namespace App\Year2022\Day03RucksackReorganization;

use App\Tools\FileReader;
use Exception;

class Part02 {
    public function __construct(
        private readonly FileReader $fileReader,
    ) {
    }

    /**
     * @throws Exception
     */
    public function run(): int
    {
        $file = $this->fileReader->readFile(dirname(__FILE__) . '/input.txt');

        $result = $this->calculateResult($file);

        $this->fileReader->closeFile($file);

        return $result;
    }

    private function calculateResult(mixed $file): int
    {
        $result = 0;
        $groupContents = [];

        while (($line = fgets($file)) !== false) {
            $groupContents[] = $this->getRucksackContent($line);

            if (count($groupContents) === 3) {
                $letter = $this->findDuplicatedLetter($groupContents);
                $result += $this->calculatePointsOfLetter($letter);

                $groupContents = [];
            }
        }

        return $result;
    }

    private function getRucksackContent(string $line): string
    {
        return str_replace("\n", "", $line);
    }

    private function findDuplicatedLetter(array $groupContents): string
    {
        $contentArr1 = str_split($groupContents[0]);
        $contentArr2 = str_split($groupContents[1]);
        $contentArr3 = str_split($groupContents[2]);

        $duplicatedValues = array_intersect($contentArr1, $contentArr2, $contentArr3);

        return array_values($duplicatedValues)[0];
    }

    private function calculatePointsOfLetter(string $letter): int
    {
        // Lowercase item types a through z have priorities 1 through 26.
        // Uppercase item types A through Z have priorities 27 through 52

        // a-z
        // 1-26 points
        // 97-122 ascii
        // 97-1 = 96

        // A-Z
        // 27-52 points
        // 65-90 ascii
        // 65-27 = 38

        if (ctype_upper($letter)) {
            return ord($letter) - 38;
        }

        return ord($letter) - 96;
    }
}
