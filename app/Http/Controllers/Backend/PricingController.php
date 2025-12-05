<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Pricing\Pricing;
use App\Models\Backend\Pricing\PricingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricingController extends Controller
{
    public function index()
    {
        $title = 'Pricing';
        $pricing = Pricing::latest()->paginate(10)->withQueryString();

        return view('backend.pricing.index', compact('title', 'pricing'));
    }

    public function store(Request $request)
    {
        $rule = [
            'title' => ['required', 'max:30'],
            'category' => ['nullable', 'max:30'],
            'price' => ['nullable', 'gte:0'],
            'payment_period' => ['required'],
        ];

        $request->validate($rule);

        if ($request->best) {
            $getHighlight = Pricing::all()->where('best', true);
            if ($getHighlight->count() >= 1) {
                return back()->with('error', 'Best Product for the "Pricing" section is limited to one (1) options.');
            }
        }

        DB::beginTransaction();
        try {
            $pricing = new Pricing;
            $pricing->title = $request->title;
            $pricing->category = $request->category;
            if ($request->best) {
                $pricing->best = true;
            } else {
                $pricing->best = false;
            }
            $pricing->price = $request->price ?? 0;
            $pricing->payment_period = $request->payment_period;
            $pricing->save();

            DB::commit();

            return redirect(route('pricing.show', $pricing->id))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function show(Pricing $pricing)
    {
        $title = 'Pricing ' . $pricing->title;

        return view('backend.pricing.show', compact('title', 'pricing'));
    }

    public function update(Pricing $pricing, Request $request)
    {
        $rule = [
            'title' => ['required', 'max:30'],
            'category' => ['nullable', 'max:30'],
            'price' => ['nullable', 'gte:0'],
            'payment_period' => ['required'],
        ];

        $request->validate($rule);

        if ($request->best) {
            $best = 1;
            if ($pricing->best !== $best) {
                $getHighlight = Pricing::all()->where('best', true);
                if ($getHighlight->count() >= 1) {
                    return back()->with('error', 'Best Product for the "Pricing" section is limited to one (1) options.');
                }
            }
        }

        DB::beginTransaction();
        try {
            $pricing->title = $request->title;
            $pricing->category = $request->category;
            if ($request->best) {
                $pricing->best = true;
            } else {
                $pricing->best = false;
            }
            $pricing->price = $request->price ?? 0;
            $pricing->payment_period = $request->payment_period;
            $pricing->save();

            DB::commit();

            return redirect(route('pricing.show', $pricing->id))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function destroy(Pricing $pricing)
    {
        Pricing::destroy($pricing->id);

        return redirect(route('pricing.index'))->with('success', 'Success!');
    }

    public function detailStore(Pricing $pricing, Request $request)
    {
        $rule = [
            'list' => ['required'],
        ];

        $request->validate($rule);

        DB::beginTransaction();
        try {
            $detail = new PricingDetail;
            $detail->pricing_id = $pricing->id;
            $detail->list = $request->list;
            $detail->save();

            DB::commit();

            return redirect(route('pricing.show', $pricing->id))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function detailDestroy(PricingDetail $pricingDetail)
    {
        PricingDetail::destroy($pricingDetail->id);

        return redirect(route('pricing.show', $pricingDetail->pricing_id))->with('success', 'Success!');
    }
}
