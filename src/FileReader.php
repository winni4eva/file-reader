<?php
namespace Winnipass;

use Winnipass\Exceptions\FilePathNotFoundException;
use Winnipass\Exceptions\FileTypeNotSupportedException;
use Winnipass\Utils\UtilityFunctions;

class FileReader {

    protected string $filePath = '';
    protected $utilityFunctions;
    protected $fileContents;

    public function __construct()
    {
        $this->utilityFunctions = new UtilityFunctions;
    }

    public function read(array $arguments = null): FileReader 
    {
        if (!$this->filePath) {
            $this->setFilePath($arguments);
        }

        $fileExtension = $this->utilityFunctions->getFIleExtension($this->filePath);
        $formattedFileExtension = ucfirst($fileExtension);
        $readerClass = "Winnipass\Readers\\$formattedFileExtension"."FileReader";
        
        if (!class_exists($readerClass)) {
            throw new FileTypeNotSupportedException(
                "The $formattedFileExtension file format is not supported"
            );
        }

        $this->fileContents = (new $readerClass())->read($this->filePath)->print(); 

        return $this;
    }

    public function setFilePath(array $arguments): FileReader
    {
        if (!$arguments || !$arguments[1]) 
            throw new FilePathNotFoundException('No file path was passed');

        [ $scriptPath, $filePath ] = $arguments;
        $fileParts = explode('=', $filePath);
        $param = strtolower($fileParts[0]);
        $path = $fileParts[1];
       
        if (!strpos($param, 'path') || !$path) 
            throw new FilePathNotFoundException('No file path was passed');

        $this->filePath = $path;

        return $this;
    }

    public function render(): string
    {
        return json_encode($this->fileContents);
    }
}