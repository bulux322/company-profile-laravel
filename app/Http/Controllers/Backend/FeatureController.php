<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StoreFileHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Feature\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    public function index()
    {
        $title = 'Feature';
        $feature = Feature::latest()->paginate(10)->withQueryString();

        return view('backend.feature.index', compact('title', 'feature'));
    }

    public function store(Request $request)
    {
        $rule = [
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['nullable', 'max:2040'],
        ];

        $request->validate($rule);

        if ($request->status) {
            $getFeature = Feature::all()->where('status', true);
            if ($getFeature->count() >= 4) {
                return back()->with('error', 'Active status for the "Feature" section is limited to four (4) options.');
            }
        }

        DB::beginTransaction();
        try {
            $feature = new Feature;
            $feature->title = $request->title;
            $feature->description = $request->description;
            if ($request->status) {
                $feature->status = true;
            } else {
                $feature->status = false;
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->title . "-" . Str::random(5);
                $storeFeatureImage = StoreFileHelper::storeFeatureImage($imageName, $image->getClientOriginalExtension());

                $feature->image = $image->storeAs($storeFeatureImage);
            }
            $feature->save();

            DB::commit();

            return redirect(route('feature.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function update(Feature $feature, Request $request)
    {
        $rule = [
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['nullable', 'max:2040'],
        ];

        $request->validate($rule);

        if ($request->status) {
            $status = 1;
            if ($feature->status !== $status) {
                $getFeature = Feature::all()->where('status', true);
                if ($getFeature->count() >= 4) {
                    return back()->with('error', 'Active status for the "Feature" section is limited to four (4) options.');
                }
            }
        }

        DB::beginTransaction();
        try {
            $feature->title = $request->title;
            $feature->description = $request->description;
            if ($request->status) {
                $feature->status = true;
            } else {
                $feature->status = false;
            }
            if ($request->hasFile('image')) {
                if ($feature->image !== null) {
                    Storage::delete($feature->image);
                }
                $image = $request->file('image');
                $imageName = $request->title . "-" . Str::random(5);
                $storeFeatureImage = StoreFileHelper::storeFeatureImage($imageName, $image->getClientOriginalExtension());

                $feature->image = $image->storeAs($storeFeatureImage);
            }
            $feature->save();

            DB::commit();

            return redirect(route('feature.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function destroy(Feature $feature)
    {
        Feature::destroy($feature->id);

        return redirect(route('feature.index'))->with('success', 'Success!');
    }
}
