<?php

namespace App\Exports;

use \App\Models\Province;
use App\Components\Filters\ProvinceFilter;
use Illuminate\Http\Request;
use \PDF;

class ProvinceExportPdf
{
	public static function print($params = [], $fileName)
	{
		$filter = new ProvinceFilter(new Request($params));
		$data   = Province::filter($filter)->get();

		dirExists($fileName);

		$pdf    = PDF::loadView('components.pdf_template', [
			'data'   => $data,
			'header' => [
				['NAME','text']
			],
			'columns' => [
				'name'
			],
			'modelName' => "Province"
		]);

        $pdf
	        ->setOptions(["isPhpEnabled"=> true, 'isRemoteEnabled'=>true])
	        ->setPaper('a4', 'potrait')
	        ->save(public_path($fileName));
	}
}