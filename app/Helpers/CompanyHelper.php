<?php

namespace App\Helpers;

use App\Models\Backend\Utilities\Company;

class CompanyHelper
{
    public static function get()
    {
        $companyData = Company::select('name', 'nickname', 'logos', 'ico')->first();

        // Mengembalikan nilai-nilai tertentu
        return $companyData ? $companyData->toArray() : null;
    }

    public static function description()
    {
        $description = Company::all()->pluck('description')->first();

        return $description;
    }
}
