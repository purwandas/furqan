<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BlogImport implements WithMultipleSheets 
{
   
    public function sheets(): array
    {
        return [
            0 => new BlogImportSheet(),
        ];
    }
}