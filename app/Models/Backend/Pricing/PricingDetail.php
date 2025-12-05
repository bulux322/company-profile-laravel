<?php

namespace App\Models\Backend\Pricing;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingDetail extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'pricing_id',
        'list'
    ];

    protected $with = ['pricing'];

    public function pricing()
    {
        return $this->belongsTo(Pricing::class, 'pricing_id');
    }
}
