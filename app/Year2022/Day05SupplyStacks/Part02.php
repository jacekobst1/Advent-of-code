<?php

namespace App\Year2022\Day05SupplyStacks;

use App\Tools\FileReader;
use Exception;
use SplStack;

class Part02
{
    public function __construct(
        private readonly FileReader $fileReader,
    ) {
    }

    /**
     * @throws Exception
     */
    public function run(): string
    {
        $stacksFile = $this->fileReader->readFile(dirname(__FILE__) . '/stacks.txt');
        $operationsFile = $this->fileReader->readFile(dirname(__FILE__) . '/operations.txt');

        $stacks = $this->getStacks($stacksFile);
        $result = $this->calculateResult($stacks, $operationsFile);

        $this->fileReader->closeFile($stacksFile);
        $this->fileReader->closeFile($operationsFile);

        return $result;
    }

    private function getStacks(mixed $stacksFile): array
    {
        $reverseArrays = [];
        $stacks = [];

        while (($line = fgets($stacksFile)) !== false) {
            $values = $this->getValuesForStacks($line);
            foreach ($values as $key => $value) {
                $reverseArrays[$key][] = $value;
            }
        }

        foreach ($reverseArrays as $arrKey => $arrValues) {
            $stack = new SplStack();
            foreach (array_reverse($arrValues) as $value) {
                $stack->push($value);
            }
            $stacks[$arrKey] = $stack;
        }

        return $stacks;
    }

    private function getValuesForStacks(string $line): array
    {
        $charsDistance = 4;
        $chars = str_replace("\n", "", $line);
        $arrayOfAllChars = str_split($chars);
        $arrayOfConcreteChars = array_filter($arrayOfAllChars, fn (string $char) => ctype_upper($char));
        $numberOfIterations = (array_key_last($arrayOfConcreteChars) - 1) / $charsDistance;

        $stacks = [];
        for ($i = 0; $i <= $numberOfIterations; $i++) {
            $charIndex = ($i * $charsDistance) + 1;
            if (isset($arrayOfConcreteChars[$charIndex])) {
                $stacks[$i] = $arrayOfConcreteChars[$charIndex];
            }
        }

        return $stacks;
    }

    private function calculateResult(array $stacks, mixed $operationsFile): string
    {
        while (($line = fgets($operationsFile)) !== false) {
            $operationDetails = $this->getOperationDetails($line);
            $this->executeOperation(
                $operationDetails['move'],
                $stacks[$operationDetails['from'] - 1],
                $stacks[$operationDetails['to'] - 1],
            );
        }

        return $this->getTopValues($stacks);
    }

    private function getOperationDetails(string $line): array
    {
        $string = str_replace("\n", "", $line);
        $arrayOfChars = explode(' ', $string);
        $indexedNumbers = array_filter($arrayOfChars, fn (string $char) => ctype_digit($char));
        $details = array_values($indexedNumbers);

        return [
            'move' => (int)$details[0],
            'from' => (int)$details[1],
            'to' => (int)$details[2],
        ];
    }

    private function executeOperation(int $numberOfItemsToMove, SplStack $sourceStack, SplStack $targetStack): void
    {
        $items = [];

        for ($i = 1; $i <= $numberOfItemsToMove; $i++) {
            $items[] = $sourceStack->pop();
        }

        foreach (array_reverse($items) as $item) {
            $targetStack->push($item);
        }
    }

    /** @var SplStack[] $stacks */
    private function getTopValues(array $stacks): string
    {
        $result = '';
        ksort($stacks);

        foreach ($stacks as $stack) {
            $result .= $stack->top();
        }

        return $result;
    }
}
