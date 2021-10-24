<?php

namespace App\Templates;

use App\Templates\ProvinceImportInputTemplate;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProvinceImportSheetTemplate implements WithMultipleSheets
{
    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets  = [];
        $foreign = [];

        $sheets[] = new ProvinceImportInputTemplate();

        foreach ($foreign as $key => $value) {
            $class    = "\\App\\Templates\\".$value;
            $sheets[] = new $class();
        }

        return $sheets;
    }
}