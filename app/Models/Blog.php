<?php

namespace App\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends BaseModel
{
    use SoftDeletes;
    
    protected $guarded = [];

    public static function rule(){
        return [
            // Define rule here to display data on datatable and generate form builder
            // Example : 'name' => 'required|string|min:8|max:10',
            'name' => 'required|string',
			'protocol' => 'required|string',
			'url' => 'required|string',
			'language_id' => 'exists:languages,id',

        ];
    
    }

    public static function ruleUpdate(){
        return [
            // Define rule here to display data on datatable and generate form builder
            // Example : 'name' => 'required|string|min:8|max:10',
            'name' => 'required|string',
			'protocol' => 'required|string',
			'url' => 'required|string',
			'language_id' => 'exists:languages,id',

        ];
    
    }

    public function blog_category()
	{
		return $this->hasMany($this->_blog_has_category());
	}

	public static function _blog_category()
	{
		return '\\App\Models\BlogHasCategory';
	}

	public function language()
	{
		return $this->belongsTo($this->_language(), 'language_id');
	}

	public static function _language()
	{
		return '\\App\Models\Language';
	}

	public static function labelText()
	{
		return ['name'];
	}

    public function scopeWithCategory($query)
    {

        $query->leftJoin('blog_has_categories', 'blog_has_categories.blog_id', 'blogs.id')
        	->leftJoin('blog_categories', 'blog_categories.id', 'blog_has_categories.blog_category_id')
        	->groupBy('blogs.id')
        	->addSelect(\DB::raw('GROUP_CONCAT(blog_categories.name) as blog_category'));
	}

    public function scopeGenerateQuery($query, $filter = [])
    {
        $query->join('languages', 'languages.id', 'blogs.language_id')
			->select('blogs.*', 'languages.name as language_name')
			->withCategory()
			->
            when(!empty($filter), function($q) use ($filter){
                $q->filter($filter);
            });
    }
}
