<?php 
namespace Winnipass\Utils;

class UtilityFunctions {

    public function getFIleExtension(string $filePath): string
    {
        $path_parts = pathinfo($filePath);

        return $path_parts['extension'] ?? '';
    }
}