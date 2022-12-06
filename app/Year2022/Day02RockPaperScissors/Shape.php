<?php

namespace App\Year2022\Day02RockPaperScissors;

interface Shape
{
    public function getPoints(): int;
    public function computeSecondShape(Result $result): Shape;
    public function winningAgainst(): Shape;
    public function losingAgainst(): Shape;
    public function drawingAgainst(): Shape;
}
