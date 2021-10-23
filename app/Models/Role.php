<?php

namespace App\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends BaseModel
{
    use SoftDeletes;

    const MASTER_ADMIN = 1;

    protected $guarded = [];

    public static function rule(){
        return [
        	// Define rule here to display data on datatable and generate form builder
            // Example : 'name' => 'required|string|min:8|max:10',
            'name' => 'required|string',

        ];
    
    }

    public static function labelText()
	{
		return ['name'];
	}

    public function scopeNoMasterAdmin($query)
    {
        $query->where(Role::getTable().'.id', '!=', Role::MASTER_ADMIN);
    }

}
