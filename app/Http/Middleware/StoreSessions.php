<?php

namespace App\Http\Middleware;

use App\Session;
use Closure;
use Jenssegers\Agent\Agent;

class StoreSessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate()
    {
        // store user session if not stored yet
        $sessionId = session()->getId();
        if (!Session::find($sessionId)) {
            $agent = new Agent();
            Session::create([
                'id'         => $sessionId,
                'ip_address' => request()->ip(),
                'browser'    => $agent->browser(),
            ]);
        }
    }
}
