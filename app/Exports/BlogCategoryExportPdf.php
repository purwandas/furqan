<?php

namespace App\Exports;

use \App\Models\BlogCategory;
use App\Components\Filters\BlogCategoryFilter;
use Illuminate\Http\Request;
use \PDF;

class BlogCategoryExportPdf
{
	public static function print($params = [], $fileName)
	{
		$filter = new BlogCategoryFilter(new Request($params));
		$data   = BlogCategory::generateQuery($filter)->get();

		dirExists($fileName);

		$pdf    = PDF::loadView('components.pdf_template', [
			'data'   => $data,
			'header' => [
				['NAME','text']
			],
			'columns' => [
				'name'
			],
			'modelName' => "BlogCategory"
		]);

        $pdf
	        ->setOptions(["isPhpEnabled"=> true, 'isRemoteEnabled'=>true])
	        ->setPaper('a4', 'potrait')
	        ->save(public_path($fileName));
	}
}