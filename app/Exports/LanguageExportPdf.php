<?php

namespace App\Exports;

use \App\Models\Language;
use App\Components\Filters\LanguageFilter;
use Illuminate\Http\Request;
use \PDF;

class LanguageExportPdf
{
	public static function print($params = [], $fileName)
	{
		$filter = new LanguageFilter(new Request($params));
		$data   = Language::generateQuery($filter)->get();

		dirExists($fileName);

		$pdf    = PDF::loadView('components.pdf_template', [
			'data'   => $data,
			'header' => [
				['NAME','text']
			],
			'columns' => [
				'name'
			],
			'modelName' => "Language"
		]);

        $pdf
	        ->setOptions(["isPhpEnabled"=> true, 'isRemoteEnabled'=>true])
	        ->setPaper('a4', 'potrait')
	        ->save(public_path($fileName));
	}
}