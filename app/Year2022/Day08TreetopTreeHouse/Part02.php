<?php

namespace App\Year2022\Day08TreetopTreeHouse;

use App\Tools\FileReader;
use Exception;
use function array_filter;
use function array_search;
use function count;
use function sizeof;
use function var_dump;

class Part02
{
    public function __construct(
        private readonly FileReader $fileReader,
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
        $rows = [];

        while (($line = fgets($file)) !== false) {
            $line = str_replace("\n", "", $line);
            $rows[] = str_split($line);
        }

        return $this->getMaxScenicScore($rows);
    }

    private function getMaxScenicScore(array $rows): int
    {
        $maxScore = 0;

        foreach ($rows as $rowKey => $columns) {
            foreach ($columns as $colKey => $treeHeight) {
                $scoreForTree = $this->getScenicScore($rows, $rowKey, $colKey, $treeHeight);
                if ($scoreForTree > $maxScore) {
                    $maxScore = $scoreForTree;
                }
            }
        }

        return $maxScore;
    }

    private function getScenicScore(array $rows, int $rowKey, int $colKey, int $treeHeight): int
    {
        $forestWidth = count($rows[$rowKey]);
        $forestLength = count($rows);

        $distance = [
            'left' => 0,
            'right' => 0,
            'top' => 0,
            'bottom' => 0,
        ];

        for ($i = $colKey-1; $i >= 0; $i--) {
            $distance['left']++;
            if ($rows[$rowKey][$i] >= $treeHeight) {
                break;
            }
        }

        for ($i = $colKey+1; $i < $forestWidth; $i++) {
            $distance['right']++;
            if ($rows[$rowKey][$i] >= $treeHeight) {
                break;
            }
        }

        for ($i = $rowKey-1; $i >= 0; $i--) {
            $distance['top']++;
            if ($rows[$i][$colKey] >= $treeHeight) {
                break;
            }
        }

        for ($i = $rowKey+1; $i < $forestLength; $i++) {
            $distance['bottom']++;
            if ($rows[$i][$colKey] >= $treeHeight) {
                break;
            }
        }

        return array_product($distance);
    }
}