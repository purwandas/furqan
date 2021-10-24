<?php

namespace App\Models;

use App\BaseModel;

class City extends BaseModel
{
    protected $guarded = [];

    public static function rule(){
        return [
        	// Define rule here to display data on datatable and generate form builder
            // Example : 'name' => 'required|string|min:8|max:10',
            'name' => 'required|string',
			'type' => 'required|numeric',
			'province_id' => 'exists:provinces,id',

        ];
    
    }

    public function province()
	{
		return $this->belongsTo($this->_province(), 'province_id');
	}

	public static function _province()
	{
		return '\\App\Models\Province';
	}

	public static function labelText()
	{
		return ['name'];
	}

}
