<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FormatApi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticateApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id != '5') { // 5 = User
                return new FormatApi(false, 'Akun Admin', $credentials);
            } else {
                return new FormatApi(true, 'Akun Ada', $credentials);
            }
        } else {
            return new FormatApi(false, 'Akun Tidak Ada', $credentials);
        }
    }

    public function prosesRegister(Request $request)
    {
        $add = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role_id' => '5', // 5 = user
            'status' => 0,
            'verifikasi_token' => sha1(time().$request->email)
        ]);

        return new FormatApi(true, 'Akun Berhasil Dibuat', $add);
    }

    public function prosesLoginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id == '5') { // 5 = User
                return new FormatApi(false, 'Akun User', $credentials);
            } elseif (Auth::user()->role_id == '4') {
                return new FormatApi(true, 'Akun Admin Wisata', $credentials);
            } elseif (Auth::user()->role_id == '3') {
                return new FormatApi(true, 'Akun Admin Desa', $credentials);
            } elseif (Auth::user()->role_id == '2') {
                return new FormatApi(true, 'Akun Admin Kabupaten', $credentials);
            } elseif (Auth::user()->role_id == '1') {
                return new FormatApi(true, 'Akun Super Admin', $credentials);
            } else {
                return new FormatApi(false, 'Role Tidak Ada', $credentials);
            }
        } else {
            return new FormatApi(false, 'Akun Tidak Ada', $credentials);
        }
    }

    public function logout()
    {
        Auth::logout();
        return new FormatApi(true, 'Berhasil Logout', null);
    }

    public function prosesResetPassword(Request $request)
    {
        $user = User::where('forgot_password_token',$request->token);
        if($user->count() > 0){
            $user = $user->first();
            $user->password = bcrypt($request->password);
            $user->forgot_password_token = null;
            $user->save();

            return new FormatApi(true, 'Password Berhasil Diganti', $user);
        }else{
            return new FormatApi(false, 'Token Tidak Ditemukan', null);
        }
    }
}
