<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoginEmployer
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
        if (!session("employer.Employer_ID")) {
            return redirect()->route("employer.home")->with("error", ["title" => "Thông báo", "message" => "Bạn vui lòng login"]);
        }
        return $next($request);
    }
}
