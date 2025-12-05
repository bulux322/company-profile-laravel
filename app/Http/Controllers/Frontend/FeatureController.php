<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Feature\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $title = 'Feature';
        $feature = Feature::latest()->where('status', true)->get();

        return view('frontend.feature.index', compact('title', 'feature'));
    }
}
