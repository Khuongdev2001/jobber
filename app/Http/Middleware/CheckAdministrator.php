<?php

// đây là kiểm tra xem có admin cấp cao nhất không 6

namespace App\Http\Middleware;

use Closure;

class CheckAdministrator
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
        if (session("admin.Level") != 6) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Bạn không có quyền :)"]);
        }
        return $next($request);
    }
}
