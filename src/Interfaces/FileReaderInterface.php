<?php
namespace Winnipass\Interfaces;

interface FileReaderInterface {
    public function read(string $filePath): self;
    public function print(): array;
}