<?php

namespace App\Models;

use App\BaseModel;

class BlogHasCategory extends BaseModel
{
    protected $guarded = [];

    public function scopeGenerateQuery($query)
    {
        $query->leftJoin('blog_categories', 'blog_categories.id', 'blog_has_categories.blog_category_id')
            ->select('blog_has_categories.*', 'blog_categories.name as blog_category');
    }
}
