<?php

use App\Models\Backend\Blog\Blog;
use App\Models\Backend\Blog\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Blog::class, 'blog_id');
            $table->foreignIdFor(Tag::class, 'tag_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_tags');
    }
};
