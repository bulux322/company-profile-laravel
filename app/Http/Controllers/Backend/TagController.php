<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Blog\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index()
    {
        $title = 'Tag';
        $tag = Tag::latest()->paginate(10)->withQueryString();

        return view('backend.blog.tag.index', compact('title', 'tag'));
    }

    public function store(Request $request)
    {
        $rule = [
            'tag' => ['required'],
            'description' => ['nullable'],
        ];

        $validatedData = $request->validate($rule);

        DB::beginTransaction();
        try {
            Tag::create($validatedData);

            DB::commit();

            return redirect(route('blog.tag.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function update(Tag $tag, Request $request)
    {
        $rule = [
            'tag' => ['required'],
            'description' => ['nullable'],
        ];

        $validatedData = $request->validate($rule);

        DB::beginTransaction();
        try {
            Tag::where('id', $tag->id)->update($validatedData);

            DB::commit();

            return redirect(route('blog.tag.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function destroy(Tag $tag)
    {
        Tag::destroy($tag->id);

        return redirect(route('blog.tag.index'))->with('success', 'Success!');
    }
}
