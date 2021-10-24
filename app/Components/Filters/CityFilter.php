<?php

namespace App\Components\Filters;

class CityFilter extends QueryFilters
{
	public function city($value)
	{
		return is_array($value) ? $this->builder->whereIn('cities.name', $value) : $this->builder->where('cities.name', $value);
	}

	public function groupBy($value)
	{
		return $this->builder->groupBy($value);
	}

	public function name($value)
	{
		return is_array($value) ? $this->builder->whereIn('cities.name', $value) : $this->builder->where('cities.name', $value);
	}
	public function _name($value)
	{
		return $this->builder->where('cities.name', 'like', '%'.$value.'%');
	}

	public function type($value)
	{
		return is_array($value) ? $this->builder->whereIn('cities.type', $value) : $this->builder->where('cities.type', $value);
	}
	public function _type($value)
	{
		return $this->builder->where('cities.type', 'like', '%'.$value.'%');
	}

	public function province_id($value)
	{
		return is_array($value) ? $this->builder->whereIn('provinces.id', $value) : $this->builder->where('provinces.id', $value);
	}

}