<?php

namespace App\Year2022\Day04CampCleanup;

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
            $sections = $this->getSections($line);

            if ($this->sectionsOverlaps($sections[0], $sections[1])) {
                $result++;
            }
        }

        return $result;
    }

    private function getSections(string $line): array
    {
        $string = str_replace("\n", "", $line);
        $sections = explode(',', $string);
        $assignment1 = explode('-', $sections[0]);
        $assignment2 = explode('-', $sections[1]);

        return [
            ['start' => $assignment1[0], 'end' => $assignment1[1]],
            ['start' => $assignment2[0], 'end' => $assignment2[1]],
        ];
    }

    private function sectionsOverlaps(array $assignment1, array $assignment2): bool
    {
        $sectionsOverlaps = fn($a, $b) => $a['start'] >= $b['start'] && $a['start'] <= $b['end'];

        return $sectionsOverlaps($assignment1, $assignment2) || $sectionsOverlaps($assignment2, $assignment1);
    }
}
