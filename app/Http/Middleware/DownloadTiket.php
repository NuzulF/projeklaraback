<?php

namespace App\Http\Middleware;

use App\Models\Tiket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadTiket
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $id)
    {
        $ticket = Tiket::where('id', $id)->latest();
        
        if (Tiket::where('id', $id)->konfirmasi == 0) {
            return redirect('daftar-pemesanan');
        }

        return $next($request);
    }
}
