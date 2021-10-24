<?php

namespace App\Models;

use App\BaseModel;

class Province extends BaseModel
{
    
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

}
