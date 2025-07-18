<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class destKonfirmasiTiket
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
        if ($request->user()->konfirmasi_tiket == '0') {
            return redirect('/admin-destinasi/konfirmasi-tiket');
        }

        return $next($request);
    }
}
