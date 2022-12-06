<?php

namespace App\Year2022\Day02RockPaperScissors;

class Scissors implements Shape
{
    use ComputeSecondShape;

    public function getPoints(): int
    {
        return 3;
    }

    public function winningAgainst(): Shape
    {
        return new Paper();
    }

    public function losingAgainst(): Shape
    {
        return new Rock();
    }

    public function drawingAgainst(): Shape
    {
        return new Scissors();
    }
}
