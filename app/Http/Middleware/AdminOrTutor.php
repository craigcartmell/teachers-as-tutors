<?php

namespace TeachersAsTutors\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminOrTutor
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
        if (! $this->auth->user()->is_admin && ! $this->auth->user()->is_tutor) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                abort(401);
            }
        }

        return $next($request);
    }
}
