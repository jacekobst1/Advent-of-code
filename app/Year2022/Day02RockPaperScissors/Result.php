<?php

namespace App\Year2022\Day02RockPaperScissors;

enum Result: string
{
    case WIN = 'Z';
    case LOSE = 'X';
    case DRAW = 'Y';

    public function getPoints(): int
    {
        return match($this) {
            Result::WIN => 6,
            Result::DRAW => 3,
            Result::LOSE => 0,
        };
    }
}
