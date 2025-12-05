<?php

namespace App\Models\Backend\Blog;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['tag', 'description'];

    public function blog()
    {
        return $this->hasMany(BlogTag::class, 'tag_id');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleting(function (Tag $tag) {
            $tag->blog()->delete();
        });
    }
}
