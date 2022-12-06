<?php

namespace App\Tools;

use Exception;

class FileReader
{
    /**
     * @throws Exception
     */
    public function readFile(string $pathname): mixed
    {
        $file = fopen(
            $pathname,
            "r",
        );

        if (!$file) {
            throw new Exception("Cannot read input from file");
        }

        return $file;
    }

    /**
     * @throws Exception
     */
    public function closeFile(mixed $file): void
    {
        fclose($file);
    }
}