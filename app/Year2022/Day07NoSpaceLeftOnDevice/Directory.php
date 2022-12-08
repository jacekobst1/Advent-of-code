<?php

namespace App\Year2022\Day07NoSpaceLeftOnDevice;

class Directory implements Element
{
    public readonly Directory $parentDirectory;
    private readonly string $name;

    /** @var Element[] $elements */
    protected array $elements = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setParentDirectory(Directory $directory): void
    {
        $this->parentDirectory = $directory;
    }

    public function addElement(Element $element): void
    {
        $element->setParentDirectory($this);
        $this->elements[] = $element;
    }

    public function getElements(): array
    {
        return $this->elements;
    }

    public function getChildDirectory(string $name): ?Directory
    {
        foreach ($this->elements as $element) {
            if ($element->name() === $name && $element instanceof Directory) {
                return $element;
            }
        }

        return null;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function size(): int
    {
        return array_reduce(
            $this->elements,
            fn (int $carry, Element $element) => $carry + $element->size(),
            0,
        );
    }
}