<?php

namespace App\Helpers;

use App\Models\Backend\Utilities\Review;

class ReviewHelper
{
    public static function get()
    {
        $review = Review::latest()->where('status', true)->get();

        return $review;
    }
}
