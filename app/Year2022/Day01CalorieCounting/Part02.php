<?php

namespace App\Year2022\Day01CalorieCounting;

use App\Tools\FileReader;
use Exception;

class Part02 {
    public function __construct(private readonly FileReader $fileReader)
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
        $max = [0, 0, 0];
        $elfCalories = 0;

        while (($line = fgets($file)) !== false) {
            $calories = $this->getCaloriesFromLine($line);
            $elfCalories += $calories;

            if ($calories !== 0) {
                continue;
            }

            foreach ($max as $key => $value) {
                if ($elfCalories > $value) {
                    $max[$key] = $elfCalories;
                    break;
                }
            }

            $elfCalories = 0;
        }

        return array_sum($max);
    }

    /**
     * @param bool|string $line
     * @return int
     */
    private function getCaloriesFromLine(bool|string $line): int
    {
        return (int)str_replace("\n", "", $line);
    }
}
