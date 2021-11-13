<?php

namespace App\Components\Filters;

class LanguageFilter extends QueryFilters
{
	public function language($value)
	{
		return is_array($value) ? $this->builder->whereIn('languages.name', $value) : $this->builder->where('languages.name', $value);
	}

	public function groupBy($value)
	{
		return $this->builder->groupBy($value);
	}

	public function name($value)
	{
		return is_array($value) ? $this->builder->whereIn('languages.name', $value) : $this->builder->where('languages.name', $value);
	}
	public function _name($value)
	{
		return $this->builder->where('languages.name', 'like', '%'.$value.'%');
	}

}