<?php

namespace App\Year2022\Day11MonkeyInTheMiddle\Part02;

use App\Tools\FileReader;
use Exception;

class Handler
{
    public function __construct(
        private readonly FileReader $fileReader,
        private readonly MonkeyFactory $monkeyFactory,
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
        $monkeys = $this->monkeyFactory->createMonkeysFromFile($file);
        $forest = new Forest($monkeys);
        $forest->startMonkeying(10000);

        return $forest->getMonkeyBusiness();
    }
}