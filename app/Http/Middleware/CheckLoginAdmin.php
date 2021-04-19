<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoginAdmin
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
        if (!in_array(session("admin.Level"), [4, 5, 6])) {
            return redirect()->route("admin.user.login")->with("error", ["title" => "Thông báo", "message" => "Bạn vui lòng đăng nhập"]);
        }
        return $next($request);
    }
}
