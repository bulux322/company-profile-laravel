<?php

namespace App\Helpers;

class StoreFileHelper
{
    public static function storeLogos($name, $extension)
    {
        return 'img/logos/' . $name . '.' . $extension;
    }

    public static function storeIco($name, $extension)
    {
        return 'ico/' . $name . '.' . $extension;
    }

    public static function storeHeroImage($name, $extension)
    {
        return 'img/hero/' . $name . '.' . $extension;
    }

    public static function storeHighlightImage($name, $extension)
    {
        return 'img/highlight/' . $name . '.' . $extension;
    }

    public static function storeReviewImage($name, $extension)
    {
        return 'img/review/' . $name . '.' . $extension;
    }

    public static function storeFeatureImage($name, $extension)
    {
        return 'img/feature/' . $name . '.' . $extension;
    }

    public static function storeBlogImage($name, $extension)
    {
        return 'img/blog/' . $name . '.' . $extension;
    }
}
