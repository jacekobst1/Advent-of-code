<?php

namespace App\Year2022\Day06TuningTrouble;

use App\Tools\FileReader;
use Exception;

class Part02
{
    public function __construct(
        private readonly FileReader $fileReader,
    ) {
    }

    /**
     * @throws Exception
     */
    public function run(): string
    {
        $file = $this->fileReader->readFile(dirname(__FILE__) . '/input.txt');
        $text = fgets($file);

        $result = $this->calculateResult($text);

        $this->fileReader->closeFile($file);

        return $result;
    }


    private function calculateResult(string $text): int
    {
        $sizeOfPacket = 14;
        $lastChars = $this->getLastChars($text, $sizeOfPacket);

        foreach (str_split($text) as $key => $char) {
            if (count((array_unique($lastChars))) === $sizeOfPacket) {
                return $key;
            }
            array_shift($lastChars);
            array_push($lastChars, $char);
        }

        return 0;
    }

    private function getLastChars(string $text, int $sizeOfPacket): array
    {
        $allChars = str_split($text);
        $lastChars = [];

        for ($i = 0; $i < $sizeOfPacket; $i++) {
            $lastChars[] = $allChars[$i];
        }

        return $lastChars;
    }
}