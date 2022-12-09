<?php

namespace App\Year2022\Day08TreetopTreeHouse;

use App\Tools\FileReader;
use Exception;

class Part01
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

        return $this->getNumberOfVisibleTress($rows);
    }

    private function getNumberOfVisibleTress(array $rows): int
    {
        $visibleTrees = 0;

        foreach ($rows as $rowKey => $columns) {
            foreach ($columns as $colKey => $treeHeight) {
                if ($this->treeIsVisible($rows, $rowKey, $colKey, $treeHeight)) {
                    $visibleTrees++;
                }
            }
        }

        return $visibleTrees;
    }

    private function treeIsVisible(array $rows, int $rowKey, int $colKey, int $treeHeight): bool
    {
        $forestWidth = count($rows[$rowKey]);
        $forestLength = count($rows);

        $visibleFrom = [
            'left' => true,
            'right' => true,
            'top' => true,
            'bottom' => true,
        ];

        for ($i = 0; $i < $colKey; $i++) {
            if ($rows[$rowKey][$i] >= $treeHeight) {
                $visibleFrom['left'] = false;
                break;
            }
        }

        for ($i = $colKey+1; $i < $forestWidth; $i++) {
            if ($rows[$rowKey][$i] >= $treeHeight) {
                $visibleFrom['right'] = false;
                break;
            }
        }

        for ($i = 0; $i < $rowKey; $i++) {
            if ($rows[$i][$colKey] >= $treeHeight) {
                $visibleFrom['top'] = false;
                break;
            }
        }

        for ($i = $rowKey+1; $i < $forestLength; $i++) {
            if ($rows[$i][$colKey] >= $treeHeight) {
                $visibleFrom['bottom'] = false;
                break;
            }
        }

        return sizeof(array_filter($visibleFrom)) > 0;
    }
}