<?php

namespace App\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends BaseModel
{
    use SoftDeletes;
    
    protected $guarded = [];

    const
        ADMIN       = 1,
        ADMIN_LABEL = 'Admin';

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


    public function scopeGenerateQuery($query, $filter = [])
    {
        $query->when(!empty($filter), function($q) use ($filter){
                $q->filter($filter);
            });
    }
}
