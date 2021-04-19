<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoginCandidate
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
        if (!session("candidate")) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Bạn phải đăng nhập"]);
        }
        return $next($request);
    }
}
