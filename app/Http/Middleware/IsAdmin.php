<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
{
    // Cek: Kalau user login DAN emailnya admin
    if(auth()->check() && auth()->user()->email == 'admin@toko.com'){
        return $next($request); // Silakan masuk bos
    }

    // Kalau bukan, tendang ke halaman utama
    return redirect('/')->with('error', 'Anda bukan Admin!');
}
}
