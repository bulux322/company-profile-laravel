<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Home\About;
use App\Models\Backend\Home\Hero;
use App\Models\Backend\Home\Highlight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Home';
        $hero = Hero::all()->first();
        $about = About::latest()->where('status', true)->take(3)->get();
        $highlight = Highlight::latest()->where('status', true)->take(2)->get();

        return view('frontend.home.index', compact('title', 'hero', 'about', 'highlight'));
    }
}
