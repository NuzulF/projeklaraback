<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\baseMail;

class Authenticate extends Controller
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
    public function create()
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

    public function login()
    {
        return view('authenticate.login');
    }

    public function prosesLogin(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];

            // dd($data);

            if (Auth::attempt($data)) {
                // if (Auth::user()->role_id != '5') {
                //     Auth::logout();
                //     throw new \Exception('Silahkan cek kembali akun anda');
                // }
                $pop = [
                    'head' => 'Berhasil Login',
                    'body' => 'Selamat Datang '.Auth::user()->name,
                    'status' => 'success'
                ];

                return redirect('/')->with('pop-up',$pop);
            }
            throw new \Exception('Gagal Autentikasi, Silakan Cek Kembali Akun Anda');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Login',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Login',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function register()
    {
        return view('authenticate.register');
    }

    public function prosesRegister(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'regex:/^\+?\d+$/',
                'password' => 'required|confirmed|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
                // English uppercase characters (A – Z)
                // English lowercase characters (a – z)
                // Base 10 digits (0 – 9)
                // Non-alphanumeric (For example: !, $, #, or %)
            ],
            [
                'phone.regex' => 'Format Nomor Telepon Tidak Valid.',
                'password.regex' => 'Password Wajib Menggunakan Karakter: A-Z,a-z,0-9, dan non-alphanumberic (contoh: !, $, #, atau %).'
            ]);

            $client = new Client();
            $response = $client->request('POST', config('app.url').'/api/proses-register', [
                'form_params' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => $request->password,
                ]
            ]);

            $statusCode = $response->getStatusCode();

            $body = $response->getBody();

            $data = json_decode($body, true);

            if ($statusCode == 201 && $data['success'] == true) {
                Mail::to($request->email)->send(new baseMail(
                    [
                        "view" => "emails.akun",
                        "from" => [
                            "address" => "sadewa.no-reply@paling.kencang.id",
                            "name" => "Notifikasi SADEWA"
                        ],
                        "tags" => [ "verifikasi", "akun", "sadewa", "notifikasi" ],
                        "subject" => "Verifikasi Akun",
                        "content" => [
                            "nama_user" => $data["data"]["name"],
                            "judul" => "Verifikasi Akun",
                            "pesan" => "Selamat datang di SADEWA. Lakukan verifikasi email Anda dengan membuka tautan berikut atau abaikan email ini jika Anda tidak merasa mendaftar di SADEWA.",
                            "tautan" => config('app.url').'/verifikasi-email?email='.$data["data"]["email"].'&token='.$data["data"]["verifikasi_token"]
                        ],
                        "attachments" => []
                    ]
                ));

                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Registrasi Sukses',
                    'status' => 'success'
                ];

                return redirect('/login')->with('pop-up',$pop);
            }
            throw new \Exception('Silakan Cek Kembali Formulir Anda');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Registrasi',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Registrasi',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function verifikasiEmail(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'token' => 'required'
            ]);

            $found = User::where('email', $request->email)->where('verifikasi_token', $request->token)->first();

            $verified = $found->update([
                'verifikasi_token' => null,
                'aktif' => 1
            ]);

            if ($verified) {
                $pop = [
                    'head' => 'berhasil',
                    'body' => 'Akun berhasil diverifikasi',
                    'status' => 'success'
                ];

                return redirect('/login')->with('pop-up',$pop);
            }
            throw new \Exception('Akun tidak ditemukan atau sudah diverifikasi');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'gagal verifikasi email',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect('/login')->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'gagal verifikasi email',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect('/login')->with('pop-up', $pop);
        }
    }


    public function forgotPassword()
    {
        return view('authenticate.forgotPassword');
    }

    public function checkEmail(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email'
            ]);
            $user = User::where('email', $request->email)->first();
            if ($user && $user->role_id == '5') {
                $user->update([
                    'forgot_password_token' => sha1(time().$request->email)
                ]);
                Mail::to($request->email)->send(new baseMail(
                    [
                        "view" => "emails.akun",
                        "from" => [
                            "address" => "sadewa.no-reply@paling.kencang.id",
                            "name" => "Notifikasi SADEWA"
                        ],
                        "tags" => [ "password", "akun", "sadewa", "notifikasi" ],
                        "subject" => "Ubah Password",
                        "content" => [
                            "nama_user" => $user->name,
                            "judul" => "Ubah Password",
                            "pesan" => "Silahkan ubah password anda dengan membuka tautan berikut atau abaikan email ini jika Anda tidak merasa meminta perubahan password di SADEWA. Jangan berikan tautan ini kepada siapapun.",
                            "tautan" => config('app.url').'/reset-password/'.$user->forgot_password_token
                        ]
                    ]
                ));

                $pop = [
                    'head' => 'berhasil menemukan email',
                    'body' => 'Silahkan cek email anda untuk mengubah password',
                    'status' => 'success'
                ];

                return redirect('/login')->with('pop-up',$pop);
            } else {
                throw new \Exception('Email Tidak Ditemukan');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Ubah Password',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Ubah Password',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function resetPassword($id)
    {
        $id = User::findorfail($id);
        return view('authenticate.resetPassword', compact('id'));
    }

    public function prosesResetPassword(Request $request, $token)
    {
        try {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
                // English uppercase characters (A – Z)
                // English lowercase characters (a – z)
                // Base 10 digits (0 – 9)
                // Non-alphanumeric (For example: !, $, #, or %)
            ],
            [
                'password.regex' => 'Password Wajib Menggunakan Karakter: A-Z,a-z,0-9, dan non-alphanumberic (contoh: !, $, #, atau %).'
            ]);

            $client = new Client();
            $response = $client->request('PUT', 'http://localhost/wisata/public/api/proses-reset-password/', [
                'form_params' => [
                    'token' => $token,
                    'password' => $request->password,
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();

            $data = json_decode($body, true);

            if ($statusCode == 201 && $data['success'] == true) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Password Telah Diubah',
                    'status' => 'success'
                ];

                return redirect('/login')->with('pop-up',$pop);
            }

            throw new \Exception('Akun tidak ditemukan atau token sudah tidak berlaku');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Reset Password',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Reset Password',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function loginAdmin()
    {
        return view('superadmin.login');
    }

    public function prosesLoginAdmin(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            $data = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];

            if (Auth::attempt($data) && Auth::user()->aktif == 1) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Selamat Datang '.Auth::user()->name,
                    'status' => 'success'
                ];
                switch(Auth::user()->role_id) {
                    case '1':
                        return redirect('/superadmin')->with('pop-up',$pop);
                        break;
                    case '2':
                        return redirect('/admin-kabupaten')->with('pop-up',$pop);
                        break;
                    case '3':
                        return redirect('/admin-desa')->with('pop-up',$pop);
                        break;
                    case '4':
                        return redirect('/admin-destinasi')->with('pop-up',$pop);
                        break;
                    default:
                        Auth::logout();
                        throw new \Exception('Pengguna Bukan Admin');
                }
            }
            throw new \Exception('Gagal Autentikasi, Silakan Cek Kembali Akun Anda');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Login',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Login',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }
}
