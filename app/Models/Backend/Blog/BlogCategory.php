<?php

namespace App\Models\Backend\Blog;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['blog_id', 'category_id'];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
