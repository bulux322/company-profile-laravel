<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom([
            database_path('migrations'), // default
            database_path('migrations/backend/utilities/company'),
            database_path('migrations/backend/utilities/review'),
            database_path('migrations/backend/utilities/footer'),
            database_path('migrations/backend/home'),
            database_path('migrations/backend/feature'),
            database_path('migrations/backend/pricing'),
            database_path('migrations/backend/blog'),
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Blade::directive('IDR', function ($rupiah) {
            return "Rp.<?php echo number_format($rupiah, 0); ?>,-";
        });
    }
}
