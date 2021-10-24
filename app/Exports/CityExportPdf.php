<?php

namespace App\Exports;

use \App\Models\City;
use App\Components\Filters\CityFilter;
use Illuminate\Http\Request;
use \PDF;

class CityExportPdf
{
	public static function print($params = [], $fileName)
	{
		$filter = new CityFilter(new Request($params));
		$data   = City::join('provinces', 'provinces.id', 'cities.province_id')
			->select('cities.name', 'cities.type', 'provinces.name as province_name')
			->filter($filter)->get();

		dirExists($fileName);

		$pdf    = PDF::loadView('components.pdf_template', [
			'data'   => $data,
			'header' => [
				['NAME','text'],
				['TYPE','number'],
				['PROVINCE NAME','text']
			],
			'columns' => [
				'name', 'type', 'province_name'
			],
			'modelName' => "City"
		]);

        $pdf
	        ->setOptions(["isPhpEnabled"=> true, 'isRemoteEnabled'=>true])
	        ->setPaper('a4', 'potrait')
	        ->save(public_path($fileName));
	}
}