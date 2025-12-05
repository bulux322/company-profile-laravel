<?php

namespace App\Models\Backend\Blog;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['category', 'description'];

    public function blog()
    {
        return $this->hasMany(BlogCategory::class, 'category_id');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleting(function (Category $category) {
            $category->blog()->delete();
        });
    }

    public function scopeTopFive($query)
    {
        return $query->withCount('blog')
            ->orderByDesc('blog_count')
            ->take(5);
    }
}
