<?php

namespace App\Exports;

use \App\Models\Blog;
use App\Components\Filters\BlogFilter;
use Illuminate\Http\Request;
use \PDF;

class BlogExportPdf
{
	public static function print($params = [], $fileName)
	{
		$filter = new BlogFilter(new Request($params));
		$data   = Blog::generateQuery($filter)->get();

		dirExists($fileName);

		$pdf    = PDF::loadView('components.pdf_template', [
			'data'   => $data,
			'header' => [
				['NAME','text'],
				['PROTOCOL','text'],
				['URL','text'],
				['BLOG CATEGORY NAME','text'],
				['LANGUAGE NAME','text']
			],
			'columns' => [
				'name', 'protocol', 'url', 'blog_category_name', 'language_name'
			],
			'modelName' => "Blog"
		]);

        $pdf
	        ->setOptions(["isPhpEnabled"=> true, 'isRemoteEnabled'=>true])
	        ->setPaper('a4', 'landscape')
	        ->save(public_path($fileName));
	}
}