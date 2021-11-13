<?php

namespace App\Imports;

use \App\Models\Blog;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BlogImportSheet implements OnEachRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        $blog_category = \App\Models\BlogCategory::where('name',$row['blog_category_name'])->first();
		$language = \App\Models\Language::where('name',$row['language_name'])->first();

        $data = Blog::firstOrCreate([
            'name' => $row['name'],
			'protocol' => $row['protocol'],
			'url' => $row['url'],
			'blog_category_id' => $blog_category->id,
			'language_id' => $language->id
        ]);

    }
}
