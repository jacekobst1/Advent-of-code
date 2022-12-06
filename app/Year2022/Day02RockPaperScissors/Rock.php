<?php

namespace App\Year2022\Day02RockPaperScissors;

class Rock implements Shape
{
    use ComputeSecondShape;

    public function getPoints(): int
    {
        return 1;
    }

    public function winningAgainst(): Shape
    {
        return new Scissors();
    }

    public function losingAgainst(): Shape
    {
        return new Paper();
    }

    public function drawingAgainst(): Shape
    {
        return new Rock();
    }
}
