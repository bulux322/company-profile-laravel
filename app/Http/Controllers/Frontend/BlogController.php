<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Blog\Blog;
use App\Models\Backend\Blog\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Blog';
        $blog = Blog::latest()->paginate(9)->withQueryString();

        if ($request->search) {
            $blog = Blog::latest()
                ->where("title", "LIKE", "%{$request->search}%")
                ->orWhere("subtitle", "LIKE", "%{$request->search}%")
                ->orWhere("article", "LIKE", "%{$request->search}%")
                ->orWhere("subarticle", "LIKE", "%{$request->search}%")
                ->paginate(9)
                ->withQueryString();
        }

        if ($request->category) {
            $blog = Blog::latest()
                ->whereHas('category', function ($query) use ($request) {
                    $query->whereHas('category', function ($category) use ($request) {
                        $category->where('category', "LIKE", "%{$request->category}%");
                    });
                })
                ->paginate(9)
                ->withQueryString();
        }

        if ($request->tag) {
            $blog = Blog::latest()
                ->whereHas('tag', function ($query) use ($request) {
                    $query->whereHas('tag', function ($tag) use ($request) {
                        $tag->where('tag', "LIKE", "%{$request->tag}%");
                    });
                })
                ->paginate(9)
                ->withQueryString();
        }

        return view('frontend.blog.index', compact('title', 'blog'));
    }

    public function show(Blog $blog)
    {
        $title = $blog->title;
        $category = Category::topFive()->get();

        return view('frontend.blog.show', compact('title', 'blog', 'category'));
    }
}
