<?php
namespace Winnipass\Readers;

use Generator;
use Winnipass\Interfaces\FileReaderInterface;

class CsvFileReader implements FileReaderInterface
{
    protected array $fileContents = [];
    protected $handle;
    protected $filePath;

    public function read(string $filePath): CsvFileReader
    {
        $this->filePath = $filePath;
        $this->handle = fopen($filePath, 'r');
        foreach ($this->rows() as $row) {
            array_push($this->fileContents, $row);
        }

        return $this;
    }

    protected function rows(): Generator
    {
        while (!feof($this->handle)) {
            $row = fgetcsv($this->handle, 4095);
            yield $row;
        }
        return;
    }

    public function print(): array
    {
        fclose($this->handle);
        return $this->fileContents;
    }
}