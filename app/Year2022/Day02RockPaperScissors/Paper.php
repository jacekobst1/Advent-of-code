<?php

namespace App\Year2022\Day02RockPaperScissors;

class Paper implements Shape
{
    use ComputeSecondShape;

    public function getPoints(): int
    {
        return 2;
    }

    public function winningAgainst(): Shape
    {
        return new Rock();
    }

    public function losingAgainst(): Shape
    {
        return new Scissors();
    }

    public function drawingAgainst(): Shape
    {
        return new Paper();
    }
}
