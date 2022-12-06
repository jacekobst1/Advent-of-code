<?php

namespace App\Year2022\Day02RockPaperScissors;

class ShapeFactory
{
    public function createShapeFromChar(string $char): Shape
    {
        return match($char) {
            'A' => new Rock(),
            'B' => new Paper(),
            'C' => new Scissors(),
        };
    }
}
