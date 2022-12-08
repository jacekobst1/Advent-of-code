<?php

namespace App\Year2022\Day07NoSpaceLeftOnDevice;

class File implements Element
{
    public readonly Directory $parentDirectory;
    private readonly string $name;
    private readonly int $size;

    public function __construct(string $name, int $size) {
        $this->name = $name;
        $this->size = $size;
    }

    public function setParentDirectory(Directory $directory): void
    {
        $this->parentDirectory = $directory;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function size(): int
    {
        return $this->size;
    }
}