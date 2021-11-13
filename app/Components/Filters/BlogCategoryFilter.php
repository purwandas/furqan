<?php

namespace App\Components\Filters;

class BlogCategoryFilter extends QueryFilters
{
	public function blog_category($value)
	{
		return is_array($value) ? $this->builder->whereIn('blog_categories.name', $value) : $this->builder->where('blog_categories.name', $value);
	}

	public function groupBy($value)
	{
		return $this->builder->groupBy($value);
	}

	public function name($value)
	{
		return is_array($value) ? $this->builder->whereIn('blog_categories.name', $value) : $this->builder->where('blog_categories.name', $value);
	}
	public function _name($value)
	{
		return $this->builder->where('blog_categories.name', 'like', '%'.$value.'%');
	}

}