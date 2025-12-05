<?php

namespace App\Models\Backend\Pricing;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pricing extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'title',
        'category',
        'best',
        'price',
        'payment_period',
    ];

    /* Payment Period */
    const SINGLE_PAYMENT = "Single Payment";
    const MONTHLY_PAYMENT = "Monthly Payment";
    const ANNUAL_PAYMENT = "Annual Payment";

    /* Select Option Payment Period */
    const STATUS_FILTER_CHOICE = [
        self::SINGLE_PAYMENT => self::SINGLE_PAYMENT,
        self::MONTHLY_PAYMENT => self::MONTHLY_PAYMENT,
        self::ANNUAL_PAYMENT => self::ANNUAL_PAYMENT,
    ];

    public function detail()
    {
        return $this->hasMany(PricingDetail::class, 'pricing_id');
    }
}
