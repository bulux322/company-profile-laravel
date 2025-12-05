<?php

namespace App\Helpers;

use App\Models\Backend\Blog\BlogCategory;
use App\Models\Backend\Blog\BlogTag;

class BlogHelper
{
    public static function category($blog_id)
    {
        $category = BlogCategory::where('blog_id', $blog_id)->pluck('category_id')->toArray();

        return $category;
    }

    public static function tag($blog_id)
    {
        $tag = BlogTag::where('blog_id', $blog_id)->pluck('tag_id')->toArray();

        return $tag;
    }
}
