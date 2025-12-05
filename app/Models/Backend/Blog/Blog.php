<?php

namespace App\Models\Backend\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'article',
        'subarticle',
        'image',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->hasMany(BlogCategory::class, 'blog_id');
    }

    public function tag()
    {
        return $this->hasMany(BlogTag::class, 'blog_id');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleting(function (Blog $blog) {
            $blog->category()->delete();
            $blog->tag()->delete();
        });
    }
}
