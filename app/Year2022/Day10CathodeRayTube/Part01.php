<?php

namespace App\Year2022\Day10CathodeRayTube;

use App\Tools\FileReader;
use Exception;

class Part01
{
    public function __construct(
        private readonly FileReader $fileReader,
        private readonly CPU $cpu,
    )
    {
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
        while (($line = fgets($file)) !== false) {
            $instruction = $this->getInstruction($line);
            $this->cpu->add($instruction);
        }

        $this->cpu->work();
        return $this->cpu->signalStrength();
    }

    private function getInstruction(string $text): Command
    {
        $text = str_replace("\n", "", $text);
        $array = explode(' ', $text);

        return new Command(
            Instruction::tryFrom($array[0]),
            $array[1] ?? null,
        );
    }
}