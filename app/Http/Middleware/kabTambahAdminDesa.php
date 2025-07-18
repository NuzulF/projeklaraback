<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class kabTambahAdminDesa
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
        if ($request->user()->edit_admin_desa == '0') {
            return redirect('/admin-kabupaten/daftar-admin');
        }

        return $next($request);
    }
}
