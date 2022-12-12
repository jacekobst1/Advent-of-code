<?php

namespace App\Year2022\Day10CathodeRayTube\Part02;

class CRT
{
    private const ROW_LENGTH = 40;
    
    private array $pixels = [];
    private int $currentRow = 0;

    public function draw(int $cycle, int $register): void
    {
        $pixel = false;

        if ($this->spriteIsPositioned($cycle, $register)) {
            $pixel = true;
        }

        $this->addPixel($pixel);
    }

    public function produceImage(): void
    {
        foreach ($this->pixels as $row) {
            foreach ($row as $pixel) {
                echo $pixel ? '#' : '.';
            }
            echo "\n";
        }
    }

    private function spriteIsPositioned(int $cycle, int $register): bool
    {
        $pixelPosition = --$cycle - ($this->currentRow * self::ROW_LENGTH);

        return in_array(
            $pixelPosition,
            [$register-1, $register, $register+1],
        );
    }

    private function addPixel(bool $pixel): void
    {
        $this->pixels[$this->currentRow][] = $pixel;

        if (count($this->pixels[$this->currentRow]) === 40) {
            $this->currentRow++;
        }
    }
}