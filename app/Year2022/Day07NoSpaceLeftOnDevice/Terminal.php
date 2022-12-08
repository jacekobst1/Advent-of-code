<?php

namespace App\Year2022\Day07NoSpaceLeftOnDevice;

class Terminal
{
    public readonly Directory $mainDirectory;
    private Directory $currentDirectory;
    private Command $command;

    public function __construct()
    {
        $this->mainDirectory = new Directory('/');
    }

    public function read(string $input): void
    {
        if ($this->isCommand($input)) {
            $this->setCommand($input);
        }

        if ($this->command === Command::CD) {
            $input = substr($input, 2);
            $this->changeDirectory($input);
        }

        if ($this->command === Command::LS) {
            $this->scanFiles($input);
        };
    }

    private function isCommand(string $input): bool
    {
        return str_starts_with($input, '$');
    }

    private function setCommand(string $input): void
    {
        $inputArray = (explode(' ', $input));
        $this->command = Command::tryFrom($inputArray[1]);
    }

    private function changeDirectory(string $input): void
    {
        $inputArray = (explode(' ', $input));
        $text = $inputArray[1];

        match ($text) {
            '/' => $this->currentDirectory = $this->mainDirectory,
            '..' => $this->currentDirectory = $this->currentDirectory->parentDirectory,
            default => $this->currentDirectory = $this->currentDirectory->getChildDirectory($text),
        };
    }

    private function scanFiles(string $input): void
    {
        $inputArray = (explode(' ', $input));

        if ($inputArray[0] === 'dir') {
            $this->currentDirectory->addElement(new Directory($inputArray[1]));
        }

        if (is_numeric($inputArray[0])) {
            $this->currentDirectory->addElement(new File($inputArray[1], $inputArray[0]));
        }
    }
}