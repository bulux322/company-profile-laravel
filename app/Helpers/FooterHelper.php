<?php

namespace App\Helpers;

use App\Models\Backend\Utilities\Navigation;
use App\Models\Backend\Utilities\SocialMedia;

class FooterHelper
{
    public static function socialMedia()
    {
        $socialMedia = SocialMedia::all();

        return $socialMedia;
    }

    public static function navigation()
    {
        $navigation = Navigation::all();

        return $navigation;
    }
}
