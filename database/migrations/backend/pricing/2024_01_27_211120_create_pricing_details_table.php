<?php

use App\Models\Backend\Pricing\Pricing;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pricing_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Pricing::class);
            $table->string('list');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_details');
    }
};
