<?php

namespace App\Imports;

use \App\Models\User;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImportSheet implements OnEachRow, WithHeadingRow
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

        $role = \App\Models\Role::where('name',$row['role_name'])->first();

        $data = User::firstOrCreate([
            'name' => $row['name'],
			'password' => $row['password'],
			'role_id' => $role->id
        ]);

    }
}
