<?php

namespace App\Year2022\Day07NoSpaceLeftOnDevice;

class DirectorySizeCalculator
{
    public function getTotalSizeOfDirectoriesWhichHaveAtMost100k(Directory $mainDirectory): int
    {
        return $this->sumSizeAtMost($mainDirectory, 100000);
    }

    public function getMinTotalSizeOfAtLeast(Directory $mainDirectory, int $size): int
    {
        $smallestSize = PHP_INT_MAX;
        $this->minSizeAtLeast($mainDirectory, $size, $smallestSize);

        return $smallestSize;
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

    private function minSizeAtLeast(Element $element, int $limit, int &$smallestSize): void
    {
        if ($element instanceof Directory) {
            $elementSize = $element->size();

            if ($elementSize >= $limit && $elementSize < $smallestSize) {
                $smallestSize = $element->size();
            }

            foreach ($element->getElements() as $el) {
                $this->minSizeAtLeast($el, $limit, $smallestSize);
            }
        }
    }
}