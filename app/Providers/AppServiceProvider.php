<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('general', function (string $value) {
            return "<?php echo __('general.' . $value) ?>";
        });

        Carbon::setLocale('fr');

        if (env('FORCE_HTTPS')) {
            URL::forceScheme('https');
        }

        Blade::withoutDoubleEncoding();
    }
}
