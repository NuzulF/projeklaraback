<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Destinasi;
use Illuminate\Support\Str;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Paket;
use App\Models\ProfilDesa;
use App\Models\ProfilKabupaten;
use App\Models\Role;
use App\Models\Transaksi;
use App\Models\Village;
use App\Models\Wahana;
use App\Models\JenisPembayaran;
use App\Models\ReplyAduan;
use App\Models\Reschedule;
use App\Models\RiwayatEdit;
use Illuminate\Support\Facades\Auth;

use App\Helpers\SadewaPDF;

class Admin extends Controller
{
    //superadmin
    public function superadmin()
    {
        $user  = count(User::latest()->isPengunjung()->get());
        $admin = count(User::latest()->isAdminKabupaten()->orWhere->isAdminDesa()->orWhere->isAdminDestinasi()->aktif()->get());
        $destinasi = count(Destinasi::where('aktif', true)->latest()->get());

        $banner = Banner::first()->gambar ?? "Banner1.png|Banner2.png|Banner3.png";
        $banner = explode("|", $banner);

        $transaksi_raw  = Transaksi::where('status', '1');
        $transaksi      = $transaksi_raw->paginate(5);
        $transaksiCount = count($transaksi_raw->get());

        $listDestinasi  = Destinasi::aktif()->get();

        $paket = Paket::aktif()->get();

        return view('superadmin.dashboard2', [
            'user' => $user,
            'admin' => $admin,
            'destinasi' => $destinasi,
            'banner' => $banner,
            'transaksi' => $transaksi,
            'listDestinasi' => $listDestinasi,
            'paket' => $paket,
            'transaksiCount' => $transaksiCount
        ]);
    }

    public function gantiBanner(Request $request)
    {
        try {
            $this->validate($request, [
                'gambar.*' => 'image'
            ]);

            $files = [];

            if ($request->hasfile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('/images'), $name);
                    $files[] = $name;
                }

                Banner::where('id', 1)->update([
                    'gambar' => implode("|", $files),
                ]);

                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Banner Telah Diubah',
                    'status' => 'success'
                ];

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Banner',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah Banner Menjadi ' . implode("|", $files),
                ]);

                return redirect('/superadmin')->with('pop-up', $pop);
            } else {
                $imagePost = "Banner1.png|Banner2.png|Banner3.png";

                Banner::where('id', 1)->update([
                    'gambar' => $imagePost,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Banner',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah Banner Menjadi ' . $imagePost,
                ]);

                throw new \Exception('Formulir Tidak Memiliki File');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Mengganti Banner',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Mengganti Banner',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function admin()
    {
        $data = User::aktif()->latest()->isAdminKabupaten()->orWhere->isAdminDesa()->orWhere->isAdminDestinasi()->paginate(8);
        $province = Province::all();

        return view('superadmin.admin2', [
            'admin'     => $data,
            'province'  => $province
        ]);
    }

    public function kategori()
    {
        $kategori = Kategori::aktif()->latest()->paginate(7);

        return view('superadmin.kategori2', [
            'kategori' => $kategori
        ]);
    }

    public function tambahKategori(Request $request)
    {

        try {
            $this->validate($request, [
                'nama_kategori' => 'required',
                'deskripsi' => 'required',
            ]);
            if ($request->icon == null) {
                $new_kategori = Kategori::create([
                    'nama_kategori' => $request->nama_kategori,
                    'icon' => 'fas fa-tree',
                    'deskripsi' => $request->deskripsi,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Kategori',
                    'aksi' => 'Tambah',
                    'deskripsi' => 'Menambahkan kategori ' . $request->nama_kategori,
                ]);
            } else {
                $new_kategori = Kategori::create([
                    'nama_kategori' => $request->nama_kategori,
                    'icon' => $request->icon,
                    'deskripsi' => $request->deskripsi,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Kategori',
                    'aksi' => 'Tambah',
                    'deskripsi' => 'Menambahkan kategori ' . $new_kategori->nama_kategori,
                ]);
            }

            if ($new_kategori) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Kategori Telah Ditambahkan',
                    'status' => 'success'
                ];

                return redirect('/superadmin/kategori')->with('pop-up', $pop);
            } else {
                throw new \Exception('Silakan Cek Kembali Kategori Anda');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menambah Kategori',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menambah Kategori',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function editKategori(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'nama_kategori' => 'required',
                'deskripsi' => 'required',
            ]);

            $up_kategori = Kategori::id($id)->update([
                'nama_kategori' => $request->nama_kategori,
                'icon' => $request->icon,
                'deskripsi' => $request->deskripsi,
            ]);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Kategori',
                'aksi' => 'Edit',
                'deskripsi' => 'Mengubah kategori ' . $request->nama_kategori,
            ]);

            if ($up_kategori) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Kategori Telah Diubah',
                    'status' => 'success'
                ];

                return redirect('/superadmin/kategori')->with('pop-up', $pop);
            } else {
                throw new \Exception('Kategori dengan ID ' . $id . ' tidak ditemukan');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Mengubah Kategori',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Mengubah Kategori',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function prosesHapusKategori($id)
    {
        try {
            $del_kategori = Kategori::id($id)->update(['aktif' => false]);
            $kategori = Kategori::id($id)->first();

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Kategori',
                'aksi' => 'Edit',
                'deskripsi' => 'Menghapus kategori ' . $kategori->nama_kategori,
            ]);

            if ($del_kategori) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Kategori Telah Dihapus',
                    'status' => 'success'
                ];

                return redirect('/superadmin/kategori')->with('pop-up', $pop);
            } else {
                throw new \Exception('Kategori dengan ID ' . $id . ' tidak ditemukan');
            }
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menghapus Kategori',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    //API
    public function getRegency(Request $request)
    {
        $province_id = $request->province_id;

        $regencies = Regency::where('province_id', $province_id)->get();

        $option = "<option>Pilih Kabupaten/Kota</option>";
        foreach ($regencies as $kabupaten) {
            $option .= "<option value='$kabupaten->id'>$kabupaten->name</option>";
        }
        echo $option;
    }

    //API
    public function getDistrict(Request $request)
    {
        $districts = District::where('regency_id', $request->regency_id)->get();

        $option = "<option>Pilih Kecamatan</option>";
        foreach ($districts as $kecamatan) {
            $option .=  "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }
        echo $option;
    }

    //API
    public function getVillage(Request $request)
    {
        $villages = Village::where('district_id', $request->district_id)->get();

        $option = "<option>Pilih Desa/Kelurahan</option>";
        foreach ($villages as $desa) {
            $option .=  "<option value='$desa->id'>$desa->name</option>";
        }
        echo $option;
    }

    //unchecked
    public function prosesTambahAdmin(Request $request)
    {

        try {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:6|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                    // English uppercase characters (A – Z)
                    // English lowercase characters (a – z)
                    // Base 10 digits (0 – 9)
                    // Non-alphanumeric (For example: !, $, #, or %)
                    'phone' => 'regex:/^\+?\d+$/',
                    'role_id' => 'required',
                ],
                [
                    'phone.regex' => 'Format Nomor Telepon Tidak Valid.',
                    'password.regex' => 'Password Wajib Menggunakan Karakter: A-Z,a-z,0-9, dan non-alphanumberic (contoh: !, $, #, atau %).'
                ]
            );
            switch ($request->role_id) {
                case '2':
                    $add = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'province_id' => $request->province_id,
                        'regency_id' => $request->regency_id,
                        'password' => bcrypt($request->password),
                        'phone' => $request->phone,
                        'role_id' => $request->role_id,
                        'edit_admin_desa' => '1',
                        'approve_wisata' => '1',
                        'tambah_edit_admin_destinasi' => '0',
                        'mengajukan_destinasi' => '0',
                        'konfirmasi_tiket' => '0',
                    ]);

                    RiwayatEdit::create([
                        'admin_id' => Auth::user()->id,
                        'bagian' => 'Admin',
                        'aksi' => 'Tambah',
                        'deskripsi' => 'Menambahkan admin ' . $request->name,
                    ]);

                    if ($add) {
                        $profilKabupaten = ProfilKabupaten::where('regency_id', $add->regency_id)->first();
                        if ($profilKabupaten) {
                            $profilKabupaten->update([
                                'admin_id' => $profilKabupaten->admin_id . '|' . $add->id,
                            ]);

                            RiwayatEdit::create([
                                'admin_id' => Auth::user()->id,
                                'bagian' => 'Profil Kabupaten',
                                'aksi' => 'Edit',
                                'deskripsi' => 'Menambah admin ' . $request->name . ' sebagai admin ' . $profilKabupaten->nama_kabupaten,
                            ]);
                        } else {
                            $profilKabupaten = ProfilKabupaten::create([
                                'admin_id' => $add->id,
                                'nama_kabupaten' => Regency::where('id', $request->regency_id)->first()->name,
                                'province_id' => $request->province_id,
                                'regency_id' => $request->regency_id,
                                'foto_kabupaten' => 'kabupaten_default.jpg',
                            ]);

                            RiwayatEdit::create([
                                'admin_id' => Auth::user()->id,
                                'bagian' => 'Profil Kabupaten',
                                'aksi' => 'Edit',
                                'deskripsi' => 'Menambah admin ' . $request->name . ' sebagai admin ' . $profilKabupaten->nama_kabupaten,
                            ]);
                        }
                    }
                    break;
                case '3':
                    $add = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'province_id' => $request->province_id,
                        'regency_id' => $request->regency_id,
                        'district_id' => $request->district_id,
                        'village_id' => $request->village_id,
                        'password' => bcrypt($request->password),
                        'phone' => $request->phone,
                        'role_id' => $request->role_id,
                        'edit_admin_desa' => '0',
                        'approve_wisata' => '0',
                        'tambah_edit_admin_destinasi' => '1',
                        'mengajukan_destinasi' => '1',
                        'konfirmasi_tiket' => '0',
                    ]);

                    RiwayatEdit::create([
                        'admin_id' => Auth::user()->id,
                        'bagian' => 'Admin',
                        'aksi' => 'Tambah',
                        'deskripsi' => 'Menambahkan admin ' . $request->name,
                    ]);

                    if ($add) {
                        $profilDesa = ProfilDesa::where('village_id', $add->village_id)->first();
                        if ($profilDesa) {
                            $profilDesa->update([
                                'admin_id' => $profilDesa->admin_id . '|' . $add->id,
                            ]);

                            RiwayatEdit::create([
                                'admin_id' => Auth::user()->id,
                                'bagian' => 'Profil Desa',
                                'aksi' => 'Edit',
                                'deskripsi' => 'Menambah admin ' . $request->name . ' sebagai admin ' . $profilDesa->nama_desa,
                            ]);
                        } else {
                            $profilDesa = ProfilDesa::create([
                                'admin_id' => $add->id,
                                'nama_desa' => $request->name,
                                'province_id' => $request->province_id,
                                'regency_id' => $request->regency_id,
                                'district_id' => $request->district_id,
                                'village_id' => $request->village_id,
                                'foto_desa' => 'kabupaten_default.jpg',
                            ]);

                            RiwayatEdit::create([
                                'admin_id' => Auth::user()->id,
                                'bagian' => 'Profil Desa',
                                'aksi' => 'Edit',
                                'deskripsi' => 'Menambah admin ' . $request->name . ' sebagai admin ' . $profilDesa->nama_desa,
                            ]);
                        }
                    }
                    break;
                default:
                    $add = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'province_id' => $request->province_id,
                        'regency_id' => $request->regency_id,
                        'district_id' => $request->district_id,
                        'village_id' => $request->village_id,
                        'password' => bcrypt($request->password),
                        'phone' => $request->phone,
                        'role_id' => $request->role_id,
                        'edit_admin_desa' => '0',
                        'approve_wisata' => '0',
                        'tambah_edit_admin_destinasi' => '0',
                        'mengajukan_destinasi' => '0',
                        'konfirmasi_tiket' => '1',
                    ]);
            }
            $pop = [
                'head' => 'Berhasil',
                'body' => 'Akun Telah Ditambahkan',
                'status' => 'success'
            ];

            return redirect('/superadmin/daftar-admin')->with('pop-up', $pop);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menambah Akun',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menambah Akun',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function hapusAdmin($id)
    {
        try {
            $del_user = User::where('id', $id)->update(['aktif' => false]);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Admin',
                'aksi' => 'Edit',
                'deskripsi' => 'Menghapus admin ' . User::where('id', $id)->first()->name,
            ]);

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Akun Telah Dihapus',
                'status' => 'success'
            ];

            if ($del_user) {
                return redirect('/superadmin/daftar-admin')->with('pop-up', $pop);
            }
            throw new \Exception('akun dengan id ' . $id . ' tidak ditemukan');
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menghapus Akun',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function nonaktifEditAdminDesa($id)
    {
        User::where('id', $id)->update([
            'edit_admin_desa' => '0',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan Edit Admin Desa dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifEditAdminDesa($id)
    {
        User::where('id', $id)->update([
            'edit_admin_desa' => '1',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengaktifkan Edit Admin Desa dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function nonaktifApproveWisata($id)
    {
        User::where('id', $id)->update([
            'approve_wisata' => '0',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan Approve Destinasi Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifApproveWisata($id)
    {
        User::where('id', $id)->update([
            'approve_wisata' => '1',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengaktifkan Approve Destinasi Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function nonaktifTambahEditAdminDestinasi($id)
    {
        User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '0',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan Tambah Edit Admin Destinasi dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifTambahEditAdminDestinasi($id)
    {
        User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '1',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengaktifkan Tambah Edit Admin Destinasi dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function nonaktifMengajukanDestinasi($id)
    {
        User::where('id', $id)->update([
            'mengajukan_destinasi' => '0',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan Mengajukan Destinasi dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifMengajukanDestinasi($id)
    {
        User::where('id', $id)->update([
            'mengajukan_destinasi' => '1',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengaktifkan Mengajukan Destinasi dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function nonaktifKonfirmasiTiket($id)
    {
        User::where('id', $id)->update([
            'konfirmasi_tiket' => '0',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan Konfirmasi Tiket dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifKonfirmasiTiket($id)
    {
        User::where('id', $id)->update([
            'konfirmasi_tiket' => '1',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengaktifkan Konfirmasi Tiket dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function pembayaran()
    {
        $tipe_pembayaran = JenisPembayaran::enabledPayment()->latest()->paginate(7);

        return view('superadmin.pembayaran', [
            'tipe_pembayaran' => $tipe_pembayaran
        ]);
    }

    public function aktifPembayaran($id)
    {
        $tipe_pembayaran = JenisPembayaran::where('id', $id)->first();
        $tipe_pembayaran->update(['status' => true]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Pembayaran',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengaktifkan Pembayaran ' . $tipe_pembayaran->nama,
        ]);

        return redirect('/superadmin/pembayaran');
    }

    public function nonaktifPembayaran($id)
    {
        $tipe_pembayaran = JenisPembayaran::where('id', $id)->first();
        $tipe_pembayaran->update(['status' => false]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Pembayaran',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan Pembayaran ' . $tipe_pembayaran->nama,
        ]);

        return redirect('/superadmin/pembayaran');
    }

    public function aduan()
    {
        $aduan = Reschedule::latest()->paginate(7);

        $statuses = ['pending', 'approve', 'reject'];

        return view('superadmin.aduan', [
            'aduan' => $aduan,
            'statuses' => $statuses
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            // Validasi request jika diperlukan
            $request->validate([
                'status' => 'required|in:pending,approve,reject',
            ]);

            // Ambil data dari request
            $newStatus = $request->input('status');

            // Lakukan perubahan status dan simpan ke database (contoh menggunakan Eloquent)
            $aduan = Reschedule::find($id);

            // Check if the status transition is allowed
            if (!$this->isStatusTransitionAllowed($aduan->status, $newStatus)) {
                throw new \Exception('Status hanya dapat diganti satu kali.');
            }

            $aduan->status = $newStatus;
            $aduan->save();

            // komentar
            ReplyAduan::create([
                'reschedule_id' => $id,
                'admin_id' => Auth::user()->id,
                'jawaban' => $request->input('form-komentar'),
            ]);

            // ganti tanggal kunjungan pada tabel keranjang
            $keranjang = Keranjang::where('id', $aduan->keranjang_id)->first();
            $keranjang->update([
                'tanggal_kunjungan' => $aduan->tanggalBaru,
            ]);

            if ($aduan) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Status Telah Diubah',
                    'status' => 'success'
                ];
                return redirect('/superadmin/aduan')->with('pop-up', $pop);
            }
            throw new \Exception('Anda Tidak Bisa Mengganti Status');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Mengganti Status',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Mengganti Status',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    private function isStatusTransitionAllowed($currentStatus, $newStatus)
    {
        // Define the allowed status transitions
        $allowedTransitions = [
            'pending' => ['approve', 'reject'],
            'approve' => [], // No transitions allowed from 'approve'
            'reject' => [], // No transitions allowed from 'reject'
        ];

        // Check if the new status is allowed based on the current status
        return in_array($newStatus, $allowedTransitions[$currentStatus]);
    }

    public function riwayatEdit()
    {
        $riwayat = RiwayatEdit::latest()->paginate(10);
        return view('superadmin.riwayatEdit', [
            'riwayat' => $riwayat
        ]);
    }


    // ADMIN KABUPATEN
    public function adminKabupaten()
    {
        $user = User::isAuth()->first();
        $provinsi = $user->province()->first();
        $kabupaten = $user->regency()->first();

        $profil = $user->profilKabupaten()->first();

        $transaksi_raw = Transaksi::isKabupaten($kabupaten)->where('status', "1");

        $transaksi = $transaksi_raw->paginate(7);

        $destinasi = $kabupaten->destinasi()->aktif()->get();
        $jumlahDestinasi = count($destinasi);

        $desa = $kabupaten->profilDesa()->get();
        $jumlahDesa = count($desa);

        $admin = User::where('regency_id', $kabupaten->id)->where('aktif', true)->isAdminDesa()->orWhere->isAdminDestinasi()->get();

        $jumlahAdmin = count($admin);

        $jumlahTransaksi = $transaksi_raw->count();

        return view('adminkabupaten.dashboard2', [
            'profil' => $profil,
            'transaksi' => $transaksi,
            'jumlahDestinasi' => $jumlahDestinasi,
            'jumlahDesa' => $jumlahDesa,
            'jumlahAdmin' => $jumlahAdmin,
            'provinsi' => $provinsi,
            'jumlahTransaksi' => $jumlahTransaksi
        ]);
    }

    public function editProfilAdminKabupaten(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'nama_kabupaten' => 'required',
                'foto_kabupaten' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasfile('foto_kabupaten')) {
                $file = $request->file('foto_kabupaten');
                $name = $file->getClientOriginalName();
                $file->move(public_path('/images'), $name);

                $profil_up = ProfilKabupaten::where('admin_id', 'like', '%' . $id . '%')->update([
                    'nama_kabupaten' => $request->nama_kabupaten,
                    'foto_kabupaten' => $name,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Profil Kabupaten',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah Profil ' . ProfilKabupaten::where('admin_id', 'like', '%' . $id . '%')->first()->nama_kabupaten,
                ]);
            } else {
                $profil_up = ProfilKabupaten::where('admin_id', 'like', '%' . $id . '%')->update([
                    'nama_kabupaten' => $request->nama_kabupaten,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Profil Kabupaten',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah Profil ' . ProfilKabupaten::where('admin_id', 'like', '%' . $id . '%')->first()->nama_kabupaten,
                ]);
            }
            if ($profil_up) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Profil Telah Diubah',
                    'status' => 'success'
                ];
                return redirect('/admin-kabupaten')->with('pop-up', $pop);
            }
            throw new \Exception('Silakan Cek Kembali Formulir Anda');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Mengganti Profil',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Mengganti Profil',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function daftarAdminKabupaten()
    {
        $kabupaten = User::isAuth()->first()->regency()->first();
        $admin = $kabupaten->user()->isAdminDesa()->aktif()->paginate(10);

        return view('adminkabupaten.daftarAdmin2', [
            'admin' => $admin
        ]);
    }

    public function tambahAdminDesa(Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:6|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                    // English uppercase characters (A – Z)
                    // English lowercase characters (a – z)
                    // Base 10 digits (0 – 9)
                    // Non-alphanumeric (For example: !, $, #, or %)
                    'phone' => 'regex:/^\+?\d+$/',
                ],
                [
                    'phone.regex' => 'Format Nomor Telepon Tidak Valid.',
                    'password.regex' => 'Password Wajib Menggunakan Karakter: A-Z,a-z,0-9, dan non-alphanumberic (contoh: !, $, #, atau %).'
                ]
            );
            $add = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => 3,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'province_id' => Auth::user()->province_id,
                'regency_id' => Auth::user()->regency_id,
                'district_id' => $request->district_id,
                'village_id' => $request->village_id,
                'edit_admin_desa' => '0',
                'approve_wisata' => '0',
                'tambah_edit_admin_destinasi' => '1',
                'mengajukan_destinasi' => '1',
                'konfirmasi_tiket' => '0',
            ]);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Admin',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambahkan Admin ' . $add->name,
            ]);

            $profilDesa = ProfilDesa::where('village_id', $add->village_id)->first();
            if ($profilDesa) {
                $profilDesa->update([
                    'admin_id' => $profilDesa->admin_id . '|' . $add->id,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Profil Desa',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Menambahkan Admin ' . $add->name . ' sebagai admin ' . $profilDesa->nama_desa,
                ]);
            } else {
                $profilDesa = ProfilDesa::create([
                    'admin_id' => $add->id,
                    'nama_desa' => $request->name,
                    'province_id' => $add->province_id,
                    'regency_id' => $add->regency_id,
                    'district_id' => $add->district_id,
                    'village_id' => $add->village_id,
                    'foto_desa' => 'kabupaten_default.jpg',
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Profil Desa',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Menambahkan Admin ' . $add->name . ' sebagai admin ' . $profilDesa->nama_desa,
                ]);
            }
            $pop = [
                'head' => 'Berhasil',
                'body' => 'Akun Telah Ditambahkan',
                'status' => 'success'
            ];

            return redirect('/admin-kabupaten/daftar-admin')->with('pop-up', $pop);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menambah Akun',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menambah Akun',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function kabNonaktifTambahEditAdminDestinasi($id)
    {
        User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '0',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan Tambah Edit Admin Destinasi dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/admin-kabupaten/daftar-admin');
    }

    public function kabAktifTambahEditAdminDestinasi($id)
    {
        User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '1',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengaktifkan Tambah Edit Admin Destinasi dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/admin-kabupaten/daftar-admin');
    }

    public function kabNonaktifMengajukanDestinasi($id)
    {
        User::where('id', $id)->update([
            'mengajukan_destinasi' => '0',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan Mengajukan Destinasi dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/admin-kabupaten/daftar-admin');
    }

    public function kabAktifMengajukanDestinasi($id)
    {
        User::where('id', $id)->update([
            'mengajukan_destinasi' => '1',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengaktifkan Mengajukan Destinasi dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/admin-kabupaten/daftar-admin');
    }

    public function kabHapusAdminDesa($id)
    {
        try {
            $user = User::where('regency_id', Auth::user()->regency_id);
            if ($user) {
                $del_user = User::where('id', $id)->update(['aktif' => false]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Admin',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Menghapus admin ' . User::where('id', $id)->first()->name,
                ]);
            }

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Akun Telah Dihapus',
                'status' => 'success'
            ];

            if ($del_user) {
                return redirect('/admin-kabupaten/daftar-admin')->with('pop-up', $pop);
            }
            throw new \Exception('Akun Dengan ID ' . $id . ' Tidak Ditemukan');
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menghapus Akun',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function destinasiAdminKabupaten()
    {
        $destinasi = Destinasi::latest()->where('regency_id', Auth::user()->regency_id)->aktif()->paginate(10);

        $kategori = Kategori::aktif()->latest()->get();

        $kecamatan = District::all();

        return view('adminkabupaten.destinasi2', [
            'destinasi' => $destinasi,
            'kategori' => $kategori,
            'kecamatan' => $kecamatan
        ]);
    }

    public function approveDestinasiAdminKabupaten($id)
    {
        Destinasi::id($id)->update([
            'approve' => '1',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Destinasi',
            'aksi' => 'Edit',
            'deskripsi' => 'Menyetujui destinasi ' . Destinasi::id($id)->first()->nama_destinasi,
        ]);

        return redirect('/admin-kabupaten/destinasi');
    }

    public function rejectDestinasiAdminKabupaten($id)
    {
        Destinasi::id($id)->update([
            'approve' => '0',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Destinasi',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan destinasi ' . Destinasi::id($id)->first()->nama_destinasi,
        ]);

        return redirect('/admin-kabupaten/destinasi');
    }

    public function hapusDestinasiAdminKabupaten($id)
    {
        $destinasi = Destinasi::where('regency_id', Auth::user()->regency_id);
        if ($destinasi) {
            Destinasi::id($id)->update(['aktif' => false]);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Destinasi',
                'aksi' => 'Edit',
                'deskripsi' => 'Menghapus destinasi ' . Destinasi::id($id)->first()->nama_destinasi,
            ]);

            return redirect('/admin-kabupaten/destinasi');
        } else {
            return redirect('/admin-kabupaten/destinasi');
        }
    }

    public function riwayatEditAdminKabupaten()
    {
        $idKabupaten = Auth::user()->regency_id;

        $riwayat = RiwayatEdit::whereHas('admin', function ($query) use ($idKabupaten) {
            $query->where('regency_id', $idKabupaten);
        })->latest()->paginate(10);

        return view('adminkabupaten.riwayatEdit', [
            'riwayat' => $riwayat
        ]);
    }


    // ADMIN DESA
    public function adminDesa()
    {
        $user = User::isAuth()->first();
        $destinasi = Destinasi::where('village_id', $user->village_id)->aktif()->get();
        $jumlahDestinasi = count($destinasi);

        $admin = User::where('village_id', $user->village_id)->isAdminDestinasi()->aktif()->get();
        $jumlahAdmin = count($admin);

        $village = $user->village()->first();

        $transaksi_raw = Transaksi::isDesa($village)->where('status', '1');

        $transaksi = $transaksi_raw->paginate(5);
        $jumlahTransaksi = $transaksi_raw->count();

        $paket = Paket::isVillage($village)->aktif();

        $jumlahPaket = $paket->count();

        $profil = $user->profilDesa()->first();

        $foto = $profil->foto_desa;
        $foto = explode("|", $foto);

        return view('admindesa.dashboard2', [
            'transaksi' => $transaksi,
            'jumlahDestinasi' => $jumlahDestinasi,
            'jumlahAdmin' => $jumlahAdmin,
            'jumlahTransaksi' => $jumlahTransaksi,
            'jumlahPaket' => $jumlahPaket,
            'profil' => $profil,
            'user' => $user,
            'foto' => $foto
        ]);
    }

    public function editProfilAdminDesa(Request $request, $id)
    {
        try {
            $this->validate(
                $request,
                [
                    // 'email' => 'required|email',
                    // 'phone' => 'regex:/^\+?\d+$/',
                    'alamat_desa' => 'required',
                    'foto_desa.*' => 'image'
                ],
                [
                    'phone.regex' => 'Format Nomor Telepon Tidak Valid.'
                ]
            );
            $files = [];
            if ($request->hasfile('foto_desa')) {
                foreach ($request->file('foto_desa') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('/images'), $name);
                    $files[] = $name;
                }

                $edit_profil = ProfilDesa::where('admin_id', 'like', '%' .  $id . '%')->update([
                    'alamat_desa' => $request->alamat_desa,
                    'deskripsi_desa' => $request->deskripsi_desa,
                    'foto_desa' => implode("|", $files),
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Profil Desa',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah profil ' . ProfilDesa::where('admin_id', 'like', '%' .  $id . '%')->first()->nama_desa,
                ]);
            } else {
                $edit_profil = ProfilDesa::where('admin_id', 'like', '%' .  $id . '%')->update([
                    'alamat_desa' => $request->alamat_desa,
                    'deskripsi_desa' => $request->deskripsi_desa,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Profil Desa',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah profil ' . ProfilDesa::where('admin_id', 'like', '%' .  $id . '%')->first()->nama_desa,
                ]);
            }
            if ($edit_profil) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Profil Telah Diubah',
                    'status' => 'success'
                ];
                return redirect('/admin-desa')->with('pop-up', $pop);
            }
            throw new \Exception('Akun dengan ID ' . $id . ' Tidak Ditemukan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Mengganti Profil',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Mengganti Profil',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function daftarAdminDestinasi()
    {
        $user = User::latest()->where('village_id', Auth::user()->village_id)->isAdminDestinasi()->aktif()->paginate(7);

        $destinasi = Destinasi::latest()->where('approve', '1')->aktif()->get();

        return view('admindesa.daftarAdmin2', [
            'user' => $user,
            'destinasi' => $destinasi
        ]);
    }

    public function tambahAdminDestinasi(Request $request)
    {

        try {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:6|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                    // English uppercase characters (A – Z)
                    // English lowercase characters (a – z)
                    // Base 10 digits (0 – 9)
                    // Non-alphanumeric (For example: !, $, #, or %)
                    'phone' => 'regex:/^\+?\d+$/',
                ],
                [
                    'phone.regex' => 'Format Nomor Telepon Tidak Valid.',
                    'password.regex' => 'Password Wajib Menggunakan Karakter: A-Z,a-z,0-9, dan non-alphanumberic (contoh: !, $, #, atau %).'
                ]
            );

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'province_id' => Auth::user()->province_id,
                'regency_id' => Auth::user()->regency_id,
                'district_id' => Auth::user()->district_id,
                'village_id' => Auth::user()->village_id,
                'destinasi_id' => $request->destinasi_id,
                'phone' => $request->phone,
                'role_id' => '4',
                'edit_admin_desa' => '0',
                'approve_wisata' => '0',
                'tambah_edit_admin_destinasi' => '0',
                'mengajukan_destinasi' => '0',
                'konfirmasi_tiket' => '1',
            ]);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Admin',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambahkan admin ' . $request->name,
            ]);

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Akun Telah Ditambahkan',
                'status' => 'success'
            ];

            return redirect('/admin-desa/daftar-admin')->with('pop-up', $pop);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menambah Akun',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menambah Akun',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function hapusAdminDestinasi($id)
    {
        try {
            $del_user = User::where('id', $id)->where('village_id', Auth::user()->village_id)->isAdminDestinasi()->update(['aktif' => false]);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Admin',
                'aksi' => 'Edit',
                'deskripsi' => 'Menghapus admin ' . User::where('id', $id)->first()->name,
            ]);

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Akun Telah Dihapus',
                'status' => 'success'
            ];
            if ($del_user) {
                return redirect('/admin-desa/daftar-admin')->with('pop-up', $pop);
            }
            throw new \Exception('Akun dengan ID ' . $id . ' tidak ditemukan');
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menghapus Akun',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function desNonaktifKonfirmasiTiket($id)
    {
        User::where('id', $id)->update([
            'konfirmasi_tiket' => '0',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Menonaktifkan Konfirmasi Tiket dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/admin-desa/daftar-admin');
    }

    public function desAktifKonfirmasiTiket($id)
    {
        User::where('id', $id)->update([
            'konfirmasi_tiket' => '1',
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Admin',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengaktifkan Konfirmasi Tiket dari Admin ' . User::where('id', $id)->first()->name,
        ]);

        return redirect('/admin-desa/daftar-admin');
    }

    public function destinasiAdminDesa()
    {
        $destinasi = Destinasi::latest()->where('village_id', Auth::user()->village_id)->aktif()->paginate(7);

        $kategori = Kategori::latest()->aktif()->get();

        return view('admindesa.destinasi2', [
            'destinasi' => $destinasi,
            'kategori' => $kategori
        ]);
    }

    public function desTambahDestinasi(Request $request)
    {
        try {
            $this->validate($request, [
                'nama_destinasi' => 'required',
                'kategori_id' => 'required',
                'alamat_destinasi' => 'required',
                'deskripsi_destinasi' => 'required',
                'maps_destinasi' => 'required',
                'htm_destinasi' => 'required',
            ]);

            $files = [];
            if ($request->hasfile('foto_destinasi')) {
                foreach ($request->file('foto_destinasi') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('/images'), $name);
                    $files[] = $name;
                }

                $destinasi = Destinasi::create([
                    'nama_destinasi' => $request->nama_destinasi,
                    'kategori_id' => $request->kategori_id,
                    'alamat_destinasi' => $request->alamat_destinasi,
                    'deskripsi_destinasi' => $request->deskripsi_destinasi,
                    'maps_destinasi' => $request->maps_destinasi,
                    'htm_destinasi' => $request->htm_destinasi,
                    'foto_destinasi' => implode("|", $files),
                    'logo' => 'default.png',
                    'province_id' => Auth::user()->province_id,
                    'regency_id' => Auth::user()->regency_id,
                    'district_id' => Auth::user()->district_id,
                    'village_id' => Auth::user()->village_id,
                    'approve' => '0',
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Destinasi',
                    'aksi' => 'Tambah',
                    'deskripsi' => 'Menambah destinasi ' . $request->nama_destinasi,
                ]);
            } else {
                $imagePost = "default_kabupaten.jpg";

                $destinasi = Destinasi::create([
                    'nama_destinasi' => $request->nama_destinasi,
                    'kategori_id' => $request->kategori_id,
                    'alamat_destinasi' => $request->alamat_destinasi,
                    'deskripsi_destinasi' => $request->deskripsi_destinasi,
                    'maps_destinasi' => $request->maps_destinasi,
                    'htm_destinasi' => $request->htm_destinasi,
                    'foto_destinasi' => $imagePost,
                    'logo' => 'default.png',
                    'province_id' => Auth::user()->province_id,
                    'regency_id' => Auth::user()->regency_id,
                    'district_id' => Auth::user()->district_id,
                    'village_id' => Auth::user()->village_id,
                    'approve' => '0',
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Destinasi',
                    'aksi' => 'Tambah',
                    'deskripsi' => 'Menambah destinasi ' . $request->nama_destinasi,
                ]);
            }

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Destinasi Telah Ditambahkan',
                'status' => 'success'
            ];
            if ($destinasi) {

                return redirect('/admin-desa/destinasi')->with('pop-up', $pop);
            }
            throw new \Exception('Cek Kembali Formulir Anda');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menambah Destinasi',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal menambah destinasi',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function desEditDestinasi(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'nama_destinasi' => 'required',
                'kategori_id' => 'required',
                'alamat_destinasi' => 'required',
                'deskripsi_destinasi' => 'required',
                'maps_destinasi' => 'required',
                'htm_destinasi' => 'required',
            ]);
            $files = [];
            if ($request->hasfile('foto_destinasi')) {
                foreach ($request->file('foto_destinasi') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('/images'), $name);
                    $files[] = $name;
                }

                $destinasi = Destinasi::id($id)->update([
                    'nama_destinasi' => $request->nama_destinasi,
                    'kategori_id' => $request->kategori_id,
                    'alamat_destinasi' => $request->alamat_destinasi,
                    'deskripsi_destinasi' => $request->deskripsi_destinasi,
                    'maps_destinasi' => $request->maps_destinasi,
                    'htm_destinasi' => $request->htm_destinasi,
                    'foto_destinasi' => implode("|", $files),
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Destinasi',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah destinasi ' . Destinasi::id($id)->first()->nama_destinasi,
                ]);
            } else {
                $destinasi = Destinasi::id($id)->update([
                    'nama_destinasi' => $request->nama_destinasi,
                    'kategori_id' => $request->kategori_id,
                    'alamat_destinasi' => $request->alamat_destinasi,
                    'deskripsi_destinasi' => $request->deskripsi_destinasi,
                    'maps_destinasi' => $request->maps_destinasi,
                    'htm_destinasi' => $request->htm_destinasi,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Destinasi',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah destinasi ' . Destinasi::id($id)->first()->nama_destinasi,
                ]);
            }
            $pop = [
                'head' => 'Berhasil',
                'body' => 'Destinasi Telah Diubah',
                'status' => 'success'
            ];

            if ($destinasi) {
                return redirect('/admin-desa/destinasi')->with('pop-up', $pop);
            }
            throw new \Exception('Destinasi dengan ID ' . $id . ' tidak ditemukan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Mengubah Destinasi',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Mengubah Destinasi',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function desHapusDestinasi($id)
    {
        try {
            $destinasi = Destinasi::id($id)->where('village_id', Auth::user()->village_id)->update(['aktif' => false]);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Destinasi',
                'aksi' => 'Edit',
                'deskripsi' => 'Menghapus destinasi ' . Destinasi::id($id)->first()->nama_destinasi,
            ]);

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Destinasi Telah Dihapus',
                'status' => 'success'
            ];
            if ($destinasi) {
                return redirect('/admin-desa/destinasi')->with('pop-up', $pop);
            }
            throw new \Exception('Destinasi dengan ID ' . $id . ' tidak ditemukan');
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menghapus Destinasi',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function desPaketDestinasi()
    {
        $village = Auth::user()->village;
        $paket = Paket::isVillage($village)->paginate(6);

        $destinasi = Destinasi::where('village_id', Auth::user()->village_id)->where('approve', '1')->get();

        return view('admindesa.paketDestinasi2', [
            'paket' => $paket,
            'destinasi' => $destinasi
        ]);
    }

    public function desTambahPaket(Request $request)
    {
        try {
            $this->validate($request, [
                'nama_paket' => 'required',
                'harga_paket' => 'required',
            ]);
            // Mendapatkan nilai checkbox yang dipilih
            $checkboxValues = $request->input('checkbox', []);

            $paket = Paket::create([
                'nama_paket' => $request->nama_paket,
                'harga_paket' => $request->harga_paket
            ]);

            $paket->destinasi()->attach($checkboxValues);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Paket',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah paket ' . $request->nama_paket . ' pada desa ' . Auth::user()->village->name,
            ]);

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Paket Telah Ditambahkan',
                'status' => 'success'
            ];

            return redirect('/admin-desa/paket-destinasi')->with('pop-up', $pop);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menambah Paket',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menambah Paket',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function desHapusPaket($id)
    {
        try {
            $paket = Paket::where('id', $id)->first();
            $paket->update(['aktif' => false]);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Paket',
                'aksi' => 'Edit',
                'deskripsi' => 'Menghapus paket ' . $paket->nama_paket,
            ]);

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Paket Telah Dihapus',
                'status' => 'success'
            ];
            return redirect('/admin-desa/paket-destinasi')->with('pop-up', $pop);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menghapus Paket',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menghapus Paket',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function riwayatEditAdminDesa()
    {
        $idDesa = Auth::user()->village_id;

        $riwayat = RiwayatEdit::whereHas('admin', function ($query) use ($idDesa) {
            $query->where('village_id', $idDesa);
        })->latest()->paginate(10);
        return view('admindesa.riwayatEdit', ['riwayat' => $riwayat]);
    }

    // Admin Destinasi
    public function adminDestinasi()
    {
        $admin = User::isAuth()->first();
        $jumlahUser = User::isPengunjung()->aktif()->count();

        $destinasi = $admin->destinasi()->first();
        $transaksi = Transaksi::isDestinasi($destinasi)->where('status', '1');

        $jumlahPaket = Paket::isDestinasiByWahana($destinasi)->aktif()->count();

        $jumlahTransaksi = $transaksi->count();

        $jumlahWahana = $destinasi->wahana()->aktif()->count();

        $profil = $destinasi;

        $foto = $profil->foto_destinasi;

        $foto = explode("|", $foto);

        $logo = $profil->logo;

        $kategori = Kategori::aktif()->latest()->get();

        return view('admindestinasi.dashboard2', [
            'profil' => $profil,
            'foto' => $foto,
            'logo' => $logo,
            'kategori' => $kategori,
            'jumlahUser' => $jumlahUser,
            'jumlahTransaksi' => $jumlahTransaksi,
            'jumlahWahana' => $jumlahWahana,
            'jumlahPaket' => $jumlahPaket
        ]);
    }

    public function editProfilAdminDestinasi(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'nama_destinasi' => 'required',
                'kategori_id' => 'required',
                'alamat_destinasi' => 'required',
                'deskripsi_destinasi' => 'required',
                'htm_destinasi' => 'required',
            ]);

            $files = [];
            if ($request->hasfile('foto_destinasi')) {
                foreach ($request->file('foto_destinasi') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('/images'), $name);
                    $files[] = $name;
                }

                if ($request->hasfile('logo')) {
                    $logoName = $request->file('logo')->getClientOriginalName();
                    $namaDestinasi = $request->nama_destinasi;
                    $namaDestinasi = str_replace(' ', '_', strtolower($namaDestinasi));
                    $newLogo = $namaDestinasi . '_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
                    $request->file('logo')->move(public_path('/logo'), $newLogo);

                    $edit = Destinasi::id($id)->update([
                        'nama_destinasi' => $request->nama_destinasi,
                        'kategori_id' => $request->kategori_id,
                        'alamat_destinasi' => $request->alamat_destinasi,
                        'deskripsi_destinasi' => $request->deskripsi_destinasi,
                        'htm_destinasi' => $request->htm_destinasi,
                        'foto_destinasi' => implode("|", $files),
                        'logo' => $newLogo,
                    ]);
                } else {
                    $edit = Destinasi::id($id)->update([
                        'nama_destinasi' => $request->nama_destinasi,
                        'kategori_id' => $request->kategori_id,
                        'alamat_destinasi' => $request->alamat_destinasi,
                        'deskripsi_destinasi' => $request->deskripsi_destinasi,
                        'htm_destinasi' => $request->htm_destinasi,
                        'foto_destinasi' => implode("|", $files),
                    ]);
                }

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Profil Destinasi',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah Profil Destinasi ' . Destinasi::id($id)->first()->nama_destinasi,
                ]);
            } else {
                if ($request->hasfile('logo')) {
                    $logoName = $request->file('logo')->getClientOriginalName();
                    $namaDestinasi = $request->nama_destinasi;
                    $namaDestinasi = str_replace(' ', '_', strtolower($namaDestinasi));
                    $newLogo = $namaDestinasi . '_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
                    $request->file('logo')->move(public_path('/logo'), $newLogo);

                    $edit = Destinasi::id($id)->update([
                        'nama_destinasi' => $request->nama_destinasi,
                        'kategori_id' => $request->kategori_id,
                        'alamat_destinasi' => $request->alamat_destinasi,
                        'deskripsi_destinasi' => $request->deskripsi_destinasi,
                        'htm_destinasi' => $request->htm_destinasi,
                        'logo' => $newLogo,
                    ]);
                } else {
                    $edit = Destinasi::id($id)->update([
                        'nama_destinasi' => $request->nama_destinasi,
                        'kategori_id' => $request->kategori_id,
                        'alamat_destinasi' => $request->alamat_destinasi,
                        'deskripsi_destinasi' => $request->deskripsi_destinasi,
                        'htm_destinasi' => $request->htm_destinasi,
                    ]);
                }

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Profil Destinasi',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah Profil Destinasi ' . Destinasi::id($id)->first()->nama_destinasi,
                ]);
            }

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Profil Destinasi Telah Diubah',
                'status' => 'success'
            ];
            if ($edit) {

                return redirect('/admin-destinasi')->with('pop-up', $pop);
            }
            throw new \Exception('Cek Kembali Formulir Anda');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Mengubah Destinasi',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Mengubah Destinasi',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function konfirmasiTiket()
    {
        $admin = User::isAuth()->first();
        $destinasi = $admin->destinasi()->first();
        $transaksi = Transaksi::isDestinasi($destinasi)->where('status', '1')->latest()->paginate(7);

        return view('admindestinasi.konfirmasiTiket2', [
            'transaksi' => $transaksi,
            'destinasi' => $destinasi
        ]);
    }

    public function aduanAdminDestinasi()
    {
        $admin = User::isAuth()->first();
        $destinasi = $admin->destinasi()->first();

        $aduan = Reschedule::with('keranjang.keranjangItem.destinasi')
            ->whereHas('keranjang.keranjangItem.destinasi', function ($query) use ($destinasi) {
                $query->where('destinasi_id', $destinasi->id);
            })->get();

        $statuses = ['pending', 'approve', 'reject'];

        return view('admindestinasi.aduan', [
            'aduan' => $aduan,
            'statuses' => $statuses
        ]);
    }

    public function updateStatusAdminDestinasi(Request $request, $id)
    {
        try {
            // Validasi request jika diperlukan
            $request->validate([
                'status' => 'required|in:pending,approve,reject',
            ]);

            // Ambil data dari request
            $newStatus = $request->input('status');

            // Lakukan perubahan status dan simpan ke database (contoh menggunakan Eloquent)
            $aduan = Reschedule::find($id);

            // Check if the status transition is allowed
            if (!$this->isStatusTransitionAllowed($aduan->status, $newStatus)) {
                throw new \Exception('Status hanya dapat diganti satu kali.');
            }

            $aduan->status = $newStatus;
            $aduan->save();

            // komentar
            ReplyAduan::create([
                'reschedule_id' => $id,
                'admin_id' => Auth::user()->id,
                'jawaban' => $request->input('form-komentar'),
            ]);

            // ganti tanggal kunjungan pada tabel keranjang
            $keranjang = Keranjang::where('id', $aduan->keranjang_id)->first();
            $keranjang->update([
                'tanggal_kunjungan' => $aduan->tanggalBaru,
            ]);

            if ($aduan) {
                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Status Telah Diubah',
                    'status' => 'success'
                ];
                return redirect('/admin-destinasi/aduan')->with('pop-up', $pop);
            }
            throw new \Exception('Anda Tidak Bisa Mengganti Status');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Mengganti Status',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Mengganti Status',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function storeKomentar(Request $request, $id)
    {
        ReplyAduan::create([
            'reschedule_id' => $id,
            'admin_id' => Auth::user()->id,
            'jawaban' => $request->input('komentar'),
        ]);

        // Response jika perlu
        return response()->json(['message' => 'Komentar berhasil disimpan']);
    }

    //deceased
    public function konfirmasiTiketId($id)
    {
        Transaksi::where('id', $id)->update([
            'status' => '1'
        ]);

        RiwayatEdit::create([
            'admin_id' => Auth::user()->id,
            'bagian' => 'Konfirmasi Tiket',
            'aksi' => 'Edit',
            'deskripsi' => 'Mengkonfirmasi Pembelian Tiket ' . Transaksi::where('id', $id)->first()->order_id,
        ]);

        return redirect('/admin-destinasi/konfirmasi-tiket');
    }

    public function wahana()
    {
        $wahana = Wahana::latest()->where('destinasi_id', Auth::user()->destinasi_id)->aktif()->paginate(6);

        return view('admindestinasi.wahana2', [
            'wahana' => $wahana
        ]);
    }

    public function tambahWahana(Request $request)
    {
        try {
            $this->validate($request, [
                'nama_wahana' => 'required',
                'htm_wahana' => 'required',
                'deskripsi_wahana' => 'required',
            ]);

            $files = [];
            if ($request->hasfile('foto_wahana')) {
                foreach ($request->file('foto_wahana') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('/images'), $name);
                    $files[] = $name;
                }

                $add = Wahana::create([
                    'nama_wahana' => $request->nama_wahana,
                    'foto_wahana' => implode("|", $files),
                    'htm_wahana' => $request->htm_wahana,
                    'deskripsi_wahana' => $request->deskripsi_wahana,
                    'destinasi_id' => Auth::user()->destinasi_id,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Wahana',
                    'aksi' => 'Tambah',
                    'deskripsi' => 'Menambah wahana ' . $request->nama_wahana,
                ]);
            } else {
                $imagePost = "ktp.png";

                $add = Wahana::create([
                    'nama_wahana' => $request->name,
                    'foto_wahana' => $imagePost,
                    'htm_wahana' => $request->harga,
                    'deskripsi_wahana' => $request->deskripsi_wahana,
                    'destinasi_id' => Auth::user()->destinasi_id,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Wahana',
                    'aksi' => 'Tambah',
                    'deskripsi' => 'Menambah wahana ' . $request->nama_wahana,
                ]);
            }
            $pop = [
                'head' => 'Berhasil',
                'body' => 'Wahana Telah Ditambahkan',
                'status' => 'success'
            ];
            if ($add) {

                return redirect('/admin-destinasi/wahana')->with('pop-up', $pop);
            }
            throw new \Exception('Cek Kembali Formulir Anda');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menambah Wahana',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menambah Wahana',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function editWahana(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'nama_wahana' => 'required',
                'htm_wahana' => 'required',
                'deskripsi_wahana' => 'required',
            ]);
            $files = [];
            if ($request->hasfile('foto_wahana')) {
                foreach ($request->file('foto_wahana') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('/images'), $name);
                    $files[] = $name;
                }

                $edit = Wahana::id($id)->update([
                    'nama_wahana' => $request->nama_wahana,
                    'foto_wahana' => implode("|", $files),
                    'htm_wahana' => $request->htm_wahana,
                    'deskripsi_wahana' => $request->deskripsi_wahana,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Wahana',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah wahana ' . Wahana::id($id)->first()->nama_wahana,
                ]);
            } else {
                $edit = Wahana::id($id)->update([
                    'nama_wahana' => $request->nama_wahana,
                    'htm_wahana' => $request->htm_wahana,
                    'deskripsi_wahana' => $request->deskripsi_wahana,
                ]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Wahana',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Mengubah wahana ' . Wahana::id($id)->first()->nama_wahana,
                ]);
            }
            $pop = [
                'head' => 'Berhasil',
                'body' => 'Wahana Telah Diubah',
                'status' => 'success'
            ];
            if ($edit) {

                return redirect('/admin-destinasi/wahana')->with('pop-up', $pop);
            }
            throw new \Exception('Wahana dengan ID ' . $id . ' tidak ditemukan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Mengedit Wahana',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Mengedit Wahana',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function hapusWahana($id)
    {
        try {
            if (Wahana::where('destinasi_id', Auth::user()->destinasi->destinasi_id)) {
                $destinasi = Wahana::id($id)->update(['aktif' => false]);

                RiwayatEdit::create([
                    'admin_id' => Auth::user()->id,
                    'bagian' => 'Wahana',
                    'aksi' => 'Edit',
                    'deskripsi' => 'Menghapus wahana ' . Wahana::id($id)->first()->nama_wahana,
                ]);

                $pop = [
                    'head' => 'Berhasil',
                    'body' => 'Wahana Telah Dihapus',
                    'status' => 'success'
                ];
                if ($destinasi) {
                    return redirect('/admin-destinasi/wahana')->with('pop-up', $pop);
                }
                throw new \Exception('Wahana dengan ID ' . $id . ' tidak ditemukan');
            }
            throw new \Exception('Pengguna Tidak Memiliki Authorisasi Untuk Menghapus Wahana Ini');
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menghapus Wahana',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function paketWahana()
    {
        $admin      = User::isAuth()->first();
        $destinasi  = $admin->destinasi()->first();
        $paket      = Paket::isDestinasiByWahana($destinasi)->aktif()->latest()->paginate(6);
        $wahana     = $destinasi->wahana()->aktif()->get();

        return view('admindestinasi.paketWahana2', [
            'paket'     => $paket,
            'wahana'    => $wahana,
            'destinasi' => $destinasi
        ]);
    }

    public function destTambahPaket(Request $request)
    {
        try {
            $this->validate($request, [
                'nama_paket' => 'required',
                'harga_paket' => 'required',
            ]);

            $checkboxValues = $request->input('checkbox', []);
            $paket = Paket::create([
                'nama_paket' => $request->nama_paket,
                'harga_paket' => $request->harga_paket
            ]);

            $paket->wahana()->attach($checkboxValues);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Paket',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah paket ' . $request->nama_paket . ' pada destinasi ' . Auth::user()->destinasi->nama_destinasi,
            ]);

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Paket Telah Ditambahkan',
                'status' => 'success'
            ];

            return redirect('/admin-destinasi/paket-wahana')->with('pop-up', $pop);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menambah Paket',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menambah Paket',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function destHapusPaket($id)
    {

        try {
            $paket = Paket::id($id)->first();
            $paket->update(['aktif' => false]);

            RiwayatEdit::create([
                'admin_id' => Auth::user()->id,
                'bagian' => 'Paket',
                'aksi' => 'Edit',
                'deskripsi' => 'Menghapus paket ' . $paket->nama_paket,
            ]);

            $pop = [
                'head' => 'Berhasil',
                'body' => 'Paket Telah Dihapus',
                'status' => 'success'
            ];

            return redirect('/admin-destinasi/paket-wahana')->with('pop-up', $pop);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'Gagal Menghapus Paket',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'Gagal Menghapus Paket',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function scanQrAdmin()
    {
        $auth = Auth::user();
        $destinasi = $auth->destinasi;
        $gagal = false;
        $transaksi = Transaksi::isDestinasi($destinasi)->where('order_id', request()->order_id)->where('status', '1')->first();

        if (request()->order_id && !$transaksi) {
            $gagal = true;
        }
        return view('admindestinasi.scanQrAdmin', [
            'transaksi' => $transaksi,
            'gagal'     => $gagal,
            'destinasi' => $destinasi
        ]);
    }

    public function scanQrUser()
    {
        $auth = Auth::user();
        $destinasi = $auth->destinasi;
        $gagal = false;
        $transaksi = Transaksi::isDestinasi($destinasi)->where('order_id', request()->order_id)->where('status', '1')->first();

        if (request()->order_id && !$transaksi) {
            $gagal = true;
        }
        return view('admindestinasi.scanQrUser', [
            'transaksi' => $transaksi,
            'gagal'     => $gagal,
            'destinasi' => $destinasi
        ]);
    }

    public function tesPrint()
    {
        $auth = Auth::user();
        $destinasi = $auth->destinasi;
        $gagal = false;
        $transaksi = Transaksi::isDestinasi($destinasi)->where('order_id', request()->order_id)->where('status', '1')->first();
        if ($transaksi) {
            foreach($transaksi->keranjang()->with('destinasi')->get() as $ker) {
                        $items = $ker->destinasi->where('id', $destinasi->id);
                        $groupItemWithSameIndex = [];
                        foreach($items as $item) {
                            $tiket = $ker->tikets->where('id', $item->pivot->tikets_id)->first();
                            $index = $item->pivot->index;
                            if (!isset($groupItemWithSameIndex[$index])) {
                                $groupItemWithSameIndex[$index] = [
                                    "id_tiket" => $tiket->id,
                                    "kode_tiket" => $tiket->kode_tiket,
                                    "paket_wahana" => []
                                ];
                            }
                            array_push($groupItemWithSameIndex[$index]["paket_wahana"], $item->pivot->paket_wahana_id);
                        }
            }
            foreach($groupItemWithSameIndex as $index => $item)
            {
                SadewaPDF::Tiket($item["id_tiket"])->Output('F', public_path('pdf\tiket\Tiket '.$item['kode_tiket'].'.pdf'));
            }
        }
        //return response()->json(["tes"=>mb_convert_encoding($pdf, 'UTF-8')]);
        if (request()->order_id && !$transaksi) {
            $gagal = true;
        }
        return view('admindestinasi.contoh', [
            'transaksi' => $transaksi,
            'gagal'     => $gagal,
            'destinasi' => $destinasi
        ]);
    }

    public function scanBarcode()
    {
        $destinasi = Auth::user()->destinasi;
        $wahana = $destinasi->wahana()->get();

        return view('admindestinasi.scanBarcode', [
            'wahana' => $wahana
        ]);
    }

    public function scanBarcodeProses(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'id_wahana' => 'required',
        ]);

        $kode = $request->kode;
        $id_wahana = $request->id_wahana;

        $destinasi = Auth::user()->destinasi;
        $wahana = $destinasi->wahana()->where('id', $id_wahana)->first();

        $tiket_diwahana = $wahana->tikets()->where('kode_tiket', $kode)->get();

        if (!$tiket_diwahana->isEmpty()) {
            $tiket_belum_dipakai = $wahana->tikets()->where('kode_tiket', $kode)->wherePivot('status_tiket', 0)->first();

            if ($tiket_belum_dipakai) {
                $tiket_belum_dipakai->pivot->update([
                    'status_tiket' => 1
                ]);
                $pop = [
                    'head' => 'Berhasil Scan Tiket',
                    'body' => 'Tiket berhasil di scan',
                    'status' => 'success'
                ];

                return redirect('barcode/scan')->with('pop-up', $pop);
            }
            $pop = [
                'head' => 'Tiket Sudah Digunakan',
                "body" => "Tiket yang anda scan sudah digunakan",
                'status' => 'error'
            ];

            return redirect('barcode/scan')->with('pop-up', $pop);
        }
        $pop = [
            'head' => 'Tiket Bukan Untuk Wahana Ini',
            "body" => "Tiket yang anda scan bukan untuk wahana ini",
            'status' => 'error'
        ];

        return redirect('barcode/scan')->with('pop-up', $pop);
    }
}
