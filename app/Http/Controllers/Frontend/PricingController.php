<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Pricing\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $title = 'Pricing';
        $pricing = Pricing::orderBy('price', 'asc')->get();

        return view('frontend.pricing.index', compact('title', 'pricing'));
    }
}
