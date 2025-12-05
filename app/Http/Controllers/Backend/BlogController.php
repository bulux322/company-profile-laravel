<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StoreFileHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Blog\Blog;
use App\Models\Backend\Blog\BlogCategory;
use App\Models\Backend\Blog\BlogTag;
use App\Models\Backend\Blog\Category;
use App\Models\Backend\Blog\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $title = 'Blog';
        $blog = Blog::latest()->paginate(10)->withQueryString();

        return view('backend.blog.index', compact('title', 'blog'));
    }

    public function create()
    {
        $title = 'Create Blog';
        $category = Category::latest()->get();
        $tag = Tag::latest()->get();

        return view('backend.blog.create', compact('title', 'category', 'tag'));
    }

    public function store(Request $request)
    {
        $rule = [
            'title' => ['required'],
            'subtitle' => ['nullable'],
            'article' => ['required'],
            'subarticle' => ['nullable'],
            'paragraph' => ['required'],
            'image' => ['nullable', 'max:2040'],
            'category.*' => ['nullable'],
            'tag.*' => ['nullable'],
        ];

        $request->validate($rule);

        DB::beginTransaction();
        try {
            /* Blog */
            $blog = new Blog;
            $blog->user_id = Auth::user()->id;
            $blog->title = $request->title;
            $blog->subtitle = $request->subtitle;
            $blog->article = $request->article;
            $blog->subarticle = $request->subarticle;
            $blog->paragraph = $request->paragraph;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->title . "-" . Str::random(5);
                $storeBlogImage = StoreFileHelper::storeBlogImage($imageName, $image->getClientOriginalExtension());
                $blog->image = $image->storeAs($storeBlogImage, $image->getClientOriginalName(), 'public');
            }
            $blog->save();

            /* Category */
            if ($request->category) {
                foreach ($request->category as $value) {
                    $category = new BlogCategory;
                    $category->blog_id = $blog->id;
                    $category->category_id = $value;
                    $category->save();
                }
            }

            /* Tag */
            if ($request->tag) {
                foreach ($request->tag as $value) {
                    $tag = new BlogTag;
                    $tag->blog_id = $blog->id;
                    $tag->tag_id = $value;
                    $tag->save();
                }
            }

            DB::commit();

            return redirect(route('blog.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function edit(Blog $blog, Request $request)
    {
        $title = 'Edit ' . $blog->title;
        $category = Category::latest()->get();
        $tag = Tag::latest()->get();

        return view('backend.blog.edit', compact('title', 'blog', 'category', 'tag'));
    }

    public function update(Blog $blog, Request $request)
    {
        $rule = [
            'title' => ['required'],
            'subtitle' => ['nullable'],
            'article' => ['required'],
            'subarticle' => ['nullable'],
            'paragraph' => ['required'],
            'image' => ['nullable', 'max:2040'],
            'category.*' => ['nullable'],
            'tag.*' => ['nullable'],
        ];

        $request->validate($rule);

        DB::beginTransaction();
        try {
            /* Blog */
            $blog->title = $request->title;
            $blog->subtitle = $request->subtitle;
            $blog->article = $request->article;
            $blog->subarticle = $request->subarticle;
            $blog->paragraph = $request->paragraph;
            if ($request->hasFile('image')) {
                if ($blog->image !== null) {
                    Storage::delete($blog->image);
                }
                $image = $request->file('image');
                $imageName = $request->title . "-" . Str::random(5);
                $storeBlogImage = StoreFileHelper::storeBlogImage($imageName, $image->getClientOriginalExtension());
                $blog->image = $image->storeAs($storeBlogImage, $image->getClientOriginalName(), 'public');
            }
            $blog->save();

            /* Category */
            if ($request->category) {
                $blogCategory = BlogCategory::where('blog_id', $blog->id);
                $blogCategory->delete();

                foreach ($request->category as $value) {
                    $category = new BlogCategory;
                    $category->blog_id = $blog->id;
                    $category->category_id = $value;
                    $category->save();
                }
            } else {
                $blogCategory = BlogCategory::where('blog_id', $blog->id);
                $blogCategory->delete();
            }

            /* Tag */
            if ($request->tag) {
                $blogTag = BlogTag::where('blog_id', $blog->id);
                $blogTag->delete();

                foreach ($request->tag as $value) {
                    $tag = new BlogTag;
                    $tag->blog_id = $blog->id;
                    $tag->tag_id = $value;
                    $tag->save();
                }
            } else {
                $blogTag = BlogTag::where('blog_id', $blog->id);
                $blogTag->delete();
            }

            DB::commit();

            return redirect(route('blog.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function destroy(Blog $blog)
    {
        Blog::destroy($blog->id);

        return redirect(route('blog.index'))->with('success', 'Success!');
    }
}
