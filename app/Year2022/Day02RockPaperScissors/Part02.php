<?php

namespace App\Year2022\Day02RockPaperScissors;

use App\Tools\FileReader;
use Exception;

class Part02 {
    public function __construct(
        private readonly FileReader $fileReader,
        private readonly ShapeFactory $shapeCreator,
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
            $chars = $this->getSign($line);
            $opponentChar = $chars[0];
            $endResultChar = $chars[2];

            $result += $this->compute($opponentChar, $endResultChar);
        }

        return $result;
    }

    private function getSign(bool|string $line): string
    {
        return str_replace("\n", "", $line);
    }

    private function compute(string $opponentChar, string $endResultChar): int
    {
        $endResult = Result::tryFrom($endResultChar);
        $opponentShape = $this->shapeCreator->createShapeFromChar($opponentChar);
        $oursShape = $opponentShape->computeSecondShape($endResult);

        return $endResult->getPoints() + $oursShape->getPoints();
    }

}
