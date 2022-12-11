<?php

namespace App\Year2022\Day10CathodeRayTube\Part01;

enum Instruction: string
{
    case NOOP = 'noop';
    case ADDX = 'addx';

    public function cycles(): int
    {
        return match ($this) {
            Instruction::NOOP => 1,
            Instruction::ADDX => 2,
        };
    }
}
