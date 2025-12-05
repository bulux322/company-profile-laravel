<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StoreFileHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Home\About;
use App\Models\Backend\Home\Hero;
use App\Models\Backend\Home\Highlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /* Hero */
    public function heroIndex()
    {
        $title = 'Hero';
        $hero = Hero::all()->first();

        return view('backend.home.hero.index', compact('title', 'hero'));
    }

    public function heroUpdate(Request $request)
    {
        $rule = [
            'title' => 'required',
            'subtitle' => 'required|max:100',
            'image' => 'nullable|max:2040',
            'background_image' => 'nullable|max:2040',
        ];

        $request->validate($rule);

        DB::beginTransaction();
        try {
            $hero = Hero::first() ?? new Hero;
            $hero->title = $request->title;
            $hero->subtitle = $request->subtitle;

            // Hero image
            if ($request->hasFile('image')) {
                if ($hero->image !== null) {
                    Storage::delete('public/' . $hero->image);
                }
                $hero->image = $request->file('image')->store('hero', 'public');
            }

            // Background image
            if ($request->hasFile('background_image')) {
                if ($hero->background_image !== null) {
                    Storage::delete('public/' . $hero->background_image);
                }
                $hero->background_image = $request->file('background_image')->store('hero_background', 'public');
            }

            $hero->save();

            DB::commit();
            return redirect()->route('home.hero.index')->with('success', 'Hero section updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $th->getMessage());
        }
    }


    /* About */
    public function aboutIndex()
    {
        $title = 'About';
        $about = About::latest()->paginate(10)->withQueryString();

        return view('backend.home.about.index', compact('title', 'about'));
    }

    public function aboutStore(Request $request)
    {
        $rule = [
            'title' => ['required'],
            'subtitle' => ['required'],
            'icon' => ['required'],
        ];

        $request->validate($rule);

        if ($request->status) {
            $getAbout = About::all()->where('status', true);
            if ($getAbout->count() >= 3) {
                return back()->with('error', 'Active status for the "About" section is limited to three (3) options.');
            }
        }

        DB::beginTransaction();
        try {
            $about = new About;
            $about->title = $request->title;
            $about->subtitle = $request->subtitle;
            $about->icon = $request->icon;
            if ($request->status) {
                $about->status = true;
            } else {
                $about->status = false;
            }
            $about->save();

            DB::commit();

            return redirect(route('home.about.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function aboutUpdate(About $about, Request $request)
    {
        $rule = [
            'title' => ['required'],
            'subtitle' => ['required'],
            'icon' => ['required'],
        ];

        $request->validate($rule);

        if ($request->status) {
            $status = 1;
            if ($about->status !== $status) {
                $getAbout = About::all()->where('status', true);
                if ($getAbout->count() >= 3) {
                    return back()->with('error', 'Active status for the "About" section is limited to three (3) options.');
                }
            }
        }

        DB::beginTransaction();
        try {
            $about->title = $request->title;
            $about->subtitle = $request->subtitle;
            $about->icon = $request->icon;
            if ($request->status) {
                $about->status = true;
            } else {
                $about->status = false;
            }
            $about->save();

            DB::commit();

            return redirect(route('home.about.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function aboutDestroy(About $about)
    {
        About::destroy($about->id);

        return redirect(route('home.about.index'))->with('success', 'Success!');
    }

    /* Highlight */
    public function highlightIndex()
    {
        $title = 'Highlight';
        $highlight = Highlight::latest()->paginate(10)->withQueryString();

        return view('backend.home.highlight.index', compact('title', 'highlight'));
    }

    public function highlightStore(Request $request)
    {
        $rule = [
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['nullable', 'max:2040'],
        ];

        $request->validate($rule);

        if ($request->status) {
            $getHighlight = Highlight::all()->where('status', true);
            if ($getHighlight->count() >= 2) {
                return back()->with('error', 'Active status for the "Highlight" section is limited to two (2) options.');
            }
        }

        DB::beginTransaction();
        try {
            $highlight = new Highlight;
            $highlight->title = $request->title;
            $highlight->description = $request->description;
            if ($request->status) {
                $highlight->status = true;
            } else {
                $highlight->status = false;
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->title . "-" . Str::random(5);
                $storeHighlightImage = StoreFileHelper::storeHighlightImage($imageName, $image->getClientOriginalExtension());
                $highlight->image = $image->storeAs($storeHighlightImage, $image->getClientOriginalName(), 'public');

            }
            $highlight->save();

            DB::commit();

            return redirect(route('home.highlight.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function highlightUpdate(Highlight $highlight, Request $request)
    {
        $rule = [
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['nullable', 'max:2040'],
        ];

        $request->validate($rule);

        if ($request->status) {
            $status = 1;
            if ($highlight->status !== $status) {
                $getHighlight = Highlight::all()->where('status', true);
                if ($getHighlight->count() >= 2) {
                    return back()->with('error', 'Active status for the "Highlight" section is limited to two (2) options.');
                }
            }
        }

        DB::beginTransaction();
        try {
            $highlight->title = $request->title;
            $highlight->description = $request->description;
            if ($request->status) {
                $highlight->status = true;
            } else {
                $highlight->status = false;
            }
            if ($request->hasFile('image')) {
                if ($highlight->image !== null) {
                    Storage::delete($highlight->image);
                }
                $image = $request->file('image');
                $imageName = $request->title . "-" . Str::random(5);
                $storeHighlightImage = StoreFileHelper::storeHighlightImage($imageName, $image->getClientOriginalExtension());
                $highlight->image = $image->storeAs($storeHighlightImage, $image->getClientOriginalName(), 'public');

            }
            $highlight->save();

            DB::commit();

            return redirect(route('home.highlight.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function highlightDestroy(Highlight $highlight)
    {
        Highlight::destroy($highlight->id);

        return redirect(route('home.highlight.index'))->with('success', 'Success!');
    }
}
