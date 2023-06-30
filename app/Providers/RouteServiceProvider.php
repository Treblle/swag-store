<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

final class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';

    public function boot(): void
    {
        RateLimiter::for(
            'api',
            static fn (Request $request): Limit => Limit::perMinute(60)->by($request->user()?->id ?: $request->ip())
        );

        $this->routes(function (): void {
            Route::middleware('api')->prefix('api')->group(
                base_path('routes/api/routes.php')
            );

            Route::middleware('web')->group(
                base_path('routes/web/routes.php')
            );
        });
    }
}
