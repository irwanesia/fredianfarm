<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\MediaSosial;
use App\Models\Setting;
use App\Services\NotificationService;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        RedirectIfAuthenticated::redirectUsing(fn () => route('admin.dashboard'));

        if (! $this->app->runningInConsole()) {
            URL::forceRootUrl(request()->schemeAndHttpHost());
        }

        Blade::directive('money', function (string $expression) {
            return "<?php echo \$expression ? 'Rp ' . number_format(\$expression, 0, ',', '.') : '-'; ?>";
        });

        View::composer(['layouts.public', 'public.*'], function ($view) {
            $view->with('mediaSosials', MediaSosial::where('is_active', true)->orderBy('urutan')->get());
            $view->with('settings', Setting::all()->keyBy('key'));
        });

        View::composer('layouts.admin', function ($view) {
            $notifications = app(NotificationService::class);
            $view->with('adminNotifications', $notifications->feed());
            $view->with('adminNotificationCount', $notifications->count());
        });
    }
}
