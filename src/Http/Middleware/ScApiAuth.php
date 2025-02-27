<?php

namespace ThachVd\LaravelSiteControllerApi\Http\Middleware;

use Closure;
use ThachVd\LaravelSiteControllerApi\Models\TllincolnAccount;

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
            abort(403, 'Unauthorized');
        }

        $tllincolnAccount = TllincolnAccount::first();
        if (!$tllincolnAccount) {
            \Log::error('no have setting account TL found. Please insert data in tllincoln_accounts');
            return response()->json([
                'success' => false,
                'message' => 'no have setting account TL found. Please setting account first',
            ]);
        }

        $response = $next($request);

        return $response;
    }
}
