<?php

namespace App\Exports;

use \App\Models\Language;
use App\Components\Filters\LanguageFilter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;

class LanguageExportXls implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected static $params;

    public function __construct($params)
    {
        self::$params = $params;
    }

    public function collection()
    {
        $filter = new LanguageFilter(new Request(self::$params));
        return Language::generateQuery($filter)->get();
    }

    public function headings(): array
    {
        return ['NAME'];
    }

    public function registerEvents(): array
    {
    	$alphabet = range('A','Z');
    	$max = $alphabet[count($this->headings())-1];
        return [
            AfterSheet::class => function(AfterSheet $event) use($max){
                $cellRange = 'A1:'.$max.'1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->setAutoFilter($cellRange);
                $event->sheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('809fff');
            },
        ];
    }
}
