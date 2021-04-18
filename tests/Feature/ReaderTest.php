<?php

use PHPUnit\Framework\TestCase;
use Winnipass\FileReader;

use function PHPUnit\Framework\assertJson;

class ReaderTest extends TestCase 
{
    public function testTxtFileGenerator()
    {
        $txtFilePath = __DIR__.'../../templates/sample3.txt';
        $reader = new FileReader();
        $args = ['src/reader', "--path=$txtFilePath"];

        $fileContents = $reader->setFilePath($args)->read()->render();
        
        $this->assertJson($fileContents);
    }

    public function testCsvFileGenerator()
    {
        $txtFilePath = __DIR__.'../../templates/sample4.csv';
        $reader = new FileReader();
        $args = ['src/reader', "--path=$txtFilePath"];

        $fileContents = $reader->setFilePath($args)->read()->render();
        
        $this->assertJson($fileContents);
    }
}