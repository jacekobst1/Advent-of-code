<?php

namespace App\Year2022\Day07NoSpaceLeftOnDevice;

class DirectorySizeCalculator
{
    public function getTotalSizeOfDirectoriesWhichHaveAtMost100k(Directory $mainDirectory): int
    {
        return $this->sumSizeAtMost($mainDirectory, 100000);
    }

    private function sumSizeAtMost(Element $element, int $limit): int
    {
        $size = 0;

        if ($element instanceof Directory) {
            foreach ($element->getElements() as $el) {
                $size += $this->sumSizeAtMost($el, $limit);
            }

            if ($element->size() <= $limit) {
                $size += $element->size();
            }
        }

        return $size;
    }
}