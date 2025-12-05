<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Blog\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Category';
        $category = Category::latest()->paginate(10)->withQueryString();

        return view('backend.blog.category.index', compact('title', 'category'));
    }

    public function store(Request $request)
    {
        $rule = [
            'category' => ['required'],
            'description' => ['nullable'],
        ];

        $validatedData = $request->validate($rule);

        DB::beginTransaction();
        try {
            Category::create($validatedData);

            DB::commit();

            return redirect(route('blog.category.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function update(Category $category, Request $request)
    {
        $rule = [
            'category' => ['required'],
            'description' => ['nullable'],
        ];

        $validatedData = $request->validate($rule);

        DB::beginTransaction();
        try {
            Category::where('id', $category->id)->update($validatedData);

            DB::commit();

            return redirect(route('blog.category.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        Category::destroy($category->id);

        return redirect(route('blog.category.index'))->with('success', 'Success!');
    }
}
