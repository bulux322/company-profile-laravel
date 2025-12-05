<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Utilities\Company;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $title = 'Contact Us';
        $company = Company::all()->first();

        return view('frontend.contact-us.index', compact('title', 'company'));
    }
}
