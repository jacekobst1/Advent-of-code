<?php

namespace App\Year2022\Day07NoSpaceLeftOnDevice;

interface Element
{
    public function size(): int;

    public function name(): string;

    public function setParentDirectory(Directory $directory): void;
}