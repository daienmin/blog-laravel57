<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        // 如果没有登录;则重定向到登录页面
        if (!session('user')) {
//            return redirect('admin/login/index');
        }
        return $next($request);
    }
}
