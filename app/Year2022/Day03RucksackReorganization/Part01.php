<?php

namespace App\Year2022\Day03RucksackReorganization;

use App\Tools\FileReader;
use Exception;

class Part01 {
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

        while (($line = fgets($file)) !== false) {
            $contents = $this->getRucksackContents($line);
            $letter = $this->findDuplicatedLetter($contents);

            $result += $this->calculatePointsOfLetter($letter);
        }

        return $result;
    }

    private function getRucksackContents(string $line): array
    {
        $string = str_replace("\n", "", $line);
        $half = strlen($string) / 2;

        return [
            substr($string, 0, $half),
            substr($string, $half),
        ];
    }

    private function findDuplicatedLetter(array $contents): string
    {
        $contentArr1 = str_split($contents[0]);
        $contentArr2 = str_split($contents[1]);

        $duplicatedValue = array_intersect($contentArr1, $contentArr2);

        return implode($duplicatedValue);
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
