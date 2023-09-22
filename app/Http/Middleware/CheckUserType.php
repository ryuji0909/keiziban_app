<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $userType): Response
    {
        if (Auth::check() && Auth::user()->user_type_id != (int)$userType) {
            return redirect('/login'); // 不正なアクセスの場合、ユーザートップ画面へリダイレク
    }
    return $next($request);
}
}
