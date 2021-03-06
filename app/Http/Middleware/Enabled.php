<?php

namespace TeachersAsTutors\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Enabled
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
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
        if (! $this->auth->user()->is_enabled) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                abort(404);
            }
        }

        return $next($request);
    }
}
