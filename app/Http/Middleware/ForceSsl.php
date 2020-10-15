<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceSsl
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // For Proxies
        $request->setTrustedProxies([$request->getClientIp()], Request::HEADER_X_FORWARDED_ALL);

        if (! $request->isSecure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
