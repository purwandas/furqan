<?php

namespace App\Components\Filters;

class RoleFilter extends QueryFilters
{
	public function role($value)
	{
		return is_array($value) ? $this->builder->whereIn('roles.name', $value) : $this->builder->where('roles.name', $value);
	}

	public function groupBy($value)
	{
		return $this->builder->groupBy($value);
	}

	public function name($value)
	{
		return is_array($value) ? $this->builder->whereIn('roles.name', $value) : $this->builder->where('roles.name', $value);
	}
	public function _name($value)
	{
		return $this->builder->where('roles.name', 'like', '%'.$value.'%');
	}

	public function code($value)
	{
		return is_array($value) ? $this->builder->whereIn('roles.code', $value) : $this->builder->where('roles.code', $value);
	}
	public function _code($value)
	{
		return $this->builder->where('roles.code', 'like', '%'.$value.'%');
	}

}