<?php

namespace App\Year2022\Day02RockPaperScissors;

trait ComputeSecondShape
{
    public function computeSecondShape(Result $result): Shape
    {
        return match($result) {
            Result::WIN => $this->losingAgainst(),
            Result::DRAW => $this->drawingAgainst(),
            Result::LOSE => $this->winningAgainst(),
        };
    }
}
