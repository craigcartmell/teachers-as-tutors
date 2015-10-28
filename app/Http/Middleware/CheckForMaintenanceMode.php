<?php

namespace TeachersAsTutors\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckForMaintenanceMode
{
    /**
     * The application implementation.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Create a new filter instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        $allowed = [
            'admin',
            'admin/*',
            'auth',
            'auth/*',
            'reports',
            'reports/*',
            'resources',
            'resources/*',
            'calendar',
            'calendar/*',
            'lessons',
            'lessons/*',
            'profile',
            'password/*',
            'contact',
        ];

        if ($this->app->isDownForMaintenance()) {
            $bypass = false;

            foreach ($allowed as $route) {
                if ($request->is($route)) {
                    $bypass = true;
                }
            }

            if (! $bypass) {
                throw new HttpException(503);
            }
        }

        return $next($request);
    }
}
