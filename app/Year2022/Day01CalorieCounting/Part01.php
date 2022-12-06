<?php

namespace App\Year2022\Day01CalorieCounting;

use App\Tools\FileReader;
use Exception;

class Part01 {
    public function __construct(private readonly FileReader $fileReader)
    {

    }
    /**
     * @throws Exception
     */
    public function run(): int
    {
        $file = $this->fileReader->readFile(dirname(__FILE__) . '/input.txt');

        $max = 0;
        $elfCalories = 0;

        while (($line = fgets($file)) !== false) {
            $calories = self::getCaloriesFromLine($line);
            $elfCalories += $calories;

            if ($calories === 0) {
                if ($elfCalories > $max) {
                    $max = $elfCalories;
                }
                $elfCalories = 0;
            }
        }

        fclose($file);

        return $max;
    }

    /**
     * @param bool|string $line
     * @return int
     */
    public function getCaloriesFromLine(bool|string $line): int
    {
        return (int)str_replace("\n", "", $line);
    }
}
