<?php

namespace App\Imports;

use \App\Models\City;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CityImportSheet implements OnEachRow, WithHeadingRow
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

        $province = \App\Models\Province::where('name',$row['province_name'])->first();

        $data = City::firstOrCreate([
            'name' => $row['name'],
			'type' => $row['type'],
			'province_id' => $province->id
        ]);

    }
}
