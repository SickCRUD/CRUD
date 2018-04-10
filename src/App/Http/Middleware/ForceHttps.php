<?php

namespace SickCRUD\CRUD\App\Http\Middleware;

use Closure;

class ForceHttps
{
    /**
     * Force non-local requests to be HTTPS
     * From: https://gist.github.com/barryvdh/2578593e89d252737279f40b82be5b61
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (! $request->isSecure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
