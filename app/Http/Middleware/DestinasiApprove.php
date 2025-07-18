<?php

namespace App\Http\Middleware;

use App\Models\Destinasi;
use Closure;
use Illuminate\Http\Request;

class DestinasiApprove
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
        $id = $request->route('id'); // Mendapatkan nilai ID dari route
        $destinasi = Destinasi::find($id);

        if ($destinasi->approve == '0') {
            return redirect('/');
        }
        return $next($request);
    }
}
