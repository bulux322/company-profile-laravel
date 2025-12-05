<?php

namespace App\Http\Controllers\Backend\Utilities;

use App\Helpers\StoreFileHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Utilities\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $title = 'Review Customer';
        $review = Review::latest()->paginate(10)->withQueryString();

        return view('backend.utilities.review.index', compact('title', 'review'));
    }

    public function store(Request $request)
    {
        $rule = [
            'name' => ['required'],
            'subject' => ['required', 'max:30'],
            'message' => ['required', 'max:100'],
            'star' => ['required', 'numeric', 'between:0,5'],
            'image' => ['nullable', 'max:800'],
        ];

        $request->validate($rule);

        if ($request->status) {
            $getReview = Review::all()->where('status', true);
            if ($getReview->count() >= 3) {
                return back()->with('error', 'Active status for the "Review" section is limited to three (3) options.');
            }
        }

        DB::beginTransaction();
        try {
            $review = new Review;
            $review->name = $request->name;
            $review->subject = $request->subject;
            $review->message = $request->message;
            $review->star = $request->star;
            if ($request->status) {
                $review->status = true;
            } else {
                $review->status = false;
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->name . "-" . Str::random(5);
                $storeReviewImage = StoreFileHelper::storeReviewImage($imageName, $image->getClientOriginalExtension());

                $review->image = $image->storeAs($storeReviewImage, $image->getClientOriginalName(), 'public');
            }
            $review->save();

            DB::commit();

            return redirect(route('review.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function update(Review $review, Request $request)
    {
        $rule = [
            'name' => ['required'],
            'subject' => ['required', 'max:30'],
            'message' => ['required', 'max:100'],
            'star' => ['required', 'numeric', 'between:0,5'],
            'image' => ['nullable', 'max:800'],
        ];

        $request->validate($rule);

        if ($request->status) {
            $status = 1;
            if ($review->status !== $status) {
                $getReview = Review::all()->where('status', true);
                if ($getReview->count() >= 3) {
                    return back()->with('error', 'Active status for the "Highlight" section is limited to three (3) options.');
                }
            }
        }

        DB::beginTransaction();
        try {
            $review->name = $request->name;
            $review->subject = $request->subject;
            $review->message = $request->message;
            $review->star = $request->star;
            if ($request->status) {
                $review->status = true;
            } else {
                $review->status = false;
            }
            if ($request->hasFile('image')) {
                if ($review->image !== null) {
                    Storage::delete($review->image);
                }
                $image = $request->file('image');
                $imageName = $request->name . "-" . Str::random(5);
                $storeReviewImage = StoreFileHelper::storeReviewImage($imageName, $image->getClientOriginalExtension());

                $review->image = $image->storeAs($storeReviewImage, $image->getClientOriginalName(), 'public');
            }
            $review->save();

            DB::commit();

            return redirect(route('review.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function destroy(Review $review)
    {
        Review::destroy($review->id);

        return redirect(route('review.index'))->with('success', 'Success!');
    }
}
