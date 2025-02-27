<?php

namespace ThachVd\LaravelSiteControllerApi\Http\Middleware;

use Closure;

class ScApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('apiKey');
        if ($apiKey !== config('sc.api_key')) {
            abort(403);
        }
        $response = $next($request);

        return $response;
    }
}
