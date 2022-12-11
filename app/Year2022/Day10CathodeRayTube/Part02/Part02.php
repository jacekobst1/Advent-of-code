<?php

namespace App\Year2022\Day10CathodeRayTube\Part02;

use App\Tools\FileReader;
use Exception;

class Part02
{
    public function __construct(
        private readonly FileReader $fileReader,
        private readonly Device $device,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $file = $this->fileReader->readFile(dirname(__FILE__, 2) . '/input.txt');

        $this->calculateResult($file);

        $this->fileReader->closeFile($file);
    }

    private function calculateResult(mixed $file): void
    {
        while (($line = fgets($file)) !== false) {
            $command = $this->getCommand($line);
            $this->device->addCommand($command);
        }

        $this->device->work();
        $this->device->showImage();
    }

    private function getCommand(string $text): Command
    {
        $text = str_replace("\n", "", $text);
        $array = explode(' ', $text);

        return new Command(
            Instruction::tryFrom($array[0]),
            $array[1] ?? null,
        );
    }
}