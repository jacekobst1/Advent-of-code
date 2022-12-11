<?php

namespace App\Year2022\Day10CathodeRayTube\Part02;

class Signal
{
    private array $cyclePoints = [20, 60, 100, 140, 180, 220];
    private int $strength = 0;

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function computeStrength(int $cycle, int $register): void
    {
        if (in_array($cycle, $this->cyclePoints)) {
            $this->strength += ($cycle * $register);
        }
    }
}