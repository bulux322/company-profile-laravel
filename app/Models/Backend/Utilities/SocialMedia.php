<?php

namespace App\Models\Backend\Utilities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'icon',
        'url',
        'description',
    ];
}
