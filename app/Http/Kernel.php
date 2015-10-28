<?php

namespace TeachersAsTutors\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware
        = [
            \TeachersAsTutors\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \TeachersAsTutors\Http\Middleware\VerifyCsrfToken::class,
            \TeachersAsTutors\Http\Middleware\CheckForMaintenanceMode::class,
        ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware
        = [
            'auth'           => \TeachersAsTutors\Http\Middleware\Authenticate::class,
            'auth.basic'     => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'guest'          => \TeachersAsTutors\Http\Middleware\RedirectIfAuthenticated::class,
            'admin'          => \TeachersAsTutors\Http\Middleware\Admin::class,
            'admin_or_tutor' => \TeachersAsTutors\Http\Middleware\AdminOrTutor::class,
            'enabled'        => \TeachersAsTutors\Http\Middleware\Enabled::class,
        ];
}
