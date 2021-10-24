<?php

namespace App\Templates;

use App\Templates\CityImportInputTemplate;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CityImportSheetTemplate implements WithMultipleSheets
{
    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets  = [];
        $foreign = ['CityImportDataProvinceTemplate'];

        $sheets[] = new CityImportInputTemplate();

        foreach ($foreign as $key => $value) {
            $class    = "\\App\\Templates\\".$value;
            $sheets[] = new $class();
        }

        return $sheets;
    }
}