<?php

namespace App\Components\Filters;

class ProvinceFilter extends QueryFilters
{
	public function province($value)
	{
		return is_array($value) ? $this->builder->whereIn('provinces.name', $value) : $this->builder->where('provinces.name', $value);
	}

	public function groupBy($value)
	{
		return $this->builder->groupBy($value);
	}

	public function name($value)
	{
		return is_array($value) ? $this->builder->whereIn('provinces.name', $value) : $this->builder->where('provinces.name', $value);
	}
	public function _name($value)
	{
		return $this->builder->where('provinces.name', 'like', '%'.$value.'%');
	}

}