<?php

namespace App\Http\Middleware;

use App\Models\Tiket;
use Closure;
use Illuminate\Http\Request;

class TiketConfirm
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
        $tiketId = $request->route('id'); // Ganti dengan parameter route tiket ID yang sesuai

        $tiket = Tiket::findOrFail($tiketId);

        if (!$tiket->dikonfirmasi) {
            // Tiket belum dikonfirmasi, lakukan tindakan sesuai kebutuhan
            return redirect()->route('daftar-pemesanan');
        }
        
        return $next($request);
    }
}
