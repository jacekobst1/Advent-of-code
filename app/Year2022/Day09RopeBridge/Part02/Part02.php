<?php

namespace App\Year2022\Day09RopeBridge\Part02;

use App\Tools\FileReader;
use Exception;

class Part02
{
    public function __construct(
        private readonly FileReader $fileReader,
        private readonly BridgeWalker $bridgeWalker,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function run(): int
    {
        $file = $this->fileReader->readFile(dirname(__FILE__, 2) . '/input.txt');

        $result = $this->calculateResult($file);

        $this->fileReader->closeFile($file);

        return $result;
    }

    private function calculateResult(mixed $file): int
    {
        while (($line = fgets($file)) !== false) {
            $instruction = $this->getInstruction($line);
            $this->bridgeWalker->executeInstruction($instruction);
        }

        return $this->bridgeWalker->getNumberOfVisitedPositions();
    }

    private function getInstruction(string $text): Instruction
    {
        $text = str_replace("\n", "", $text);
        $array = explode(' ', $text);

        return new Instruction(
            Direction::tryFrom($array[0]),
            $array[1],
        );
    }
}