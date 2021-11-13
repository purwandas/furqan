<?php

namespace App\Components\Filters;

class BlogFilter extends QueryFilters
{
	public function blog($value)
	{
		return is_array($value) ? $this->builder->whereIn('blogs.name', $value) : $this->builder->where('blogs.name', $value);
	}

	public function groupBy($value)
	{
		return $this->builder->groupBy($value);
	}

	public function name($value)
	{
		return is_array($value) ? $this->builder->whereIn('blogs.name', $value) : $this->builder->where('blogs.name', $value);
	}
	public function _name($value)
	{
		return $this->builder->where('blogs.name', 'like', '%'.$value.'%');
	}

	public function protocol($value)
	{
		return is_array($value) ? $this->builder->whereIn('blogs.protocol', $value) : $this->builder->where('blogs.protocol', $value);
	}
	public function _protocol($value)
	{
		return $this->builder->where('blogs.protocol', 'like', '%'.$value.'%');
	}

	public function url($value)
	{
		return is_array($value) ? $this->builder->whereIn('blogs.url', $value) : $this->builder->where('blogs.url', $value);
	}
	public function _url($value)
	{
		return $this->builder->where('blogs.url', 'like', '%'.$value.'%');
	}

	public function blog_category_id($value)
	{
		return is_array($value) ? $this->builder->whereIn('blog_categories.id', $value) : $this->builder->where('blog_categories.id', $value);
	}

	public function language_id($value)
	{
		return is_array($value) ? $this->builder->whereIn('languages.id', $value) : $this->builder->where('languages.id', $value);
	}

}