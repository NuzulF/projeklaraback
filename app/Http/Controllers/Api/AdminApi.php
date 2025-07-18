<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FormatApi;
use App\Models\Destinasi;
use App\Models\District;
use App\Models\Kategori;
use App\Models\ProfilDesa;
use App\Models\ProfilKabupaten;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Role;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminApi extends Controller
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

    public function userCount()
    {
        $user = User::latest()->where('role_id', '5')->get();
        $total = count($user);
        return new FormatApi(true, 'List User', $total);
    }

    public function admin()
    {
        $role_id = ['2', '3', '4'];
        $user = User::latest()->whereIn('role_id', $role_id)->get();
        return new FormatApi(true, 'List User', $user);
    }

    public function adminCount()
    {
        $role_id = ['2', '3', '4'];
        $user = User::latest()->whereIn('role_id', $role_id)->get();
        $total = count($user);
        return new FormatApi(true, 'List User', $total);
    }

    public function kabupatenCount()
    {
        $kabupaten = ProfilKabupaten::latest()->get();
        $total = count($kabupaten);
        return new FormatApi(true, 'List Profil Kabupaten', $total);
    }

    public function desaCount()
    {
        $desa = ProfilDesa::latest()->get();
        $total = count($desa);
        return new FormatApi(true, 'List Profil Desa', $total);
    }

    public function destinasiCount()
    {
        $destinasi = Destinasi::latest()->get();
        $total = count($destinasi);
        return new FormatApi(true, 'List Destinasi', $total);
    }

    public function role()
    {
        $role = Role::whereIn('id', [2, 3, 4])->latest()->get();
        return new FormatApi(true, 'List Role', $role);
    }

    public function tambahAdmin(Request $request)
    {
        if ($request->role_id == '2') {
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
                'edit_admin_desa' => '1',
                'approve_wisata' => '1',
                'tambah_edit_admin_destinasi' => '0',
                'mengajukan_destinasi' => '0',
                'konfirmasi_tiket' => '0',
            ]);
        } elseif ($request->role_id == '3') {
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
                'approve_wisata' => '1',
                'tambah_edit_admin_destinasi' => '1',
                'mengajukan_destinasi' => '1',
                'konfirmasi_tiket' => '0',
            ]);
        }

        return new FormatApi(true, 'Admin Kabupaten Berhasil Ditambahkan', $add);
    }

    public function tambahProfilKabupaten(Request $request)
    {
        $add = ProfilKabupaten::create([
            'nama_kabupaten' => $request->nama_kabupaten,
            'admin_id' => $request->admin_id,
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
        ]);

        return new FormatApi(true, 'Profil Kabupaten Berhasil Ditambahkan', $add);
    }

    public function profilKabupaten($id)
    {
        $profil = ProfilKabupaten::where('admin_id', $id)->first();
        return new FormatApi(true, 'Profil Kabupaten', $profil);
    }

    public function profilKabupatenSpesifik($id)
    {
        $profil = ProfilKabupaten::where('id', $id)->get();
        return new FormatApi(true, 'Profil Kabupaten', $profil);
    }

    public function editProfilAdminKabupaten(Request $request, $id)
    {
        $edit = ProfilKabupaten::where('admin_id', $id)->update([
            'nama_kabupaten' => $request->nama_kabupaten,
            'foto_kabupaten' => $request->foto_kabupaten,
        ]);

        return new FormatApi(true, 'Profil Kabupaten Berhasil Diubah', $edit);
    }

    public function daftarAdminDariKabupaten($id)
    {
        $role_id = ['3', '4'];
        $admin = User::latest()->where('role_id', $role_id)->where('regency_id', $id)->get();
        return new FormatApi(true, 'List Admin Dari Kabupaten', $admin);
    }

    public function hapusAdmin($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->role_id == '2') {
            $hapus = ProfilKabupaten::where('admin_id', $id)->delete();
        } elseif ($user->role_id == '3') {
            $hapus = ProfilDesa::where('admin_id', $id)->delete();
        } else {
            $hapus = 'Gagal';
        }

        $hapus = User::where('id', $id)->delete();

        return new FormatApi(true, 'Admin Berhasil Dihapus', $hapus);
    }

    public function nonaktifEditAdminDesa($id)
    {
        $edit = User::where('id', $id)->update([
            'edit_admin_desa' => '0',
        ]);

        return new FormatApi(true, 'Edit Admin Desa Berhasil Dinonaktifkan', $edit);
    }

    public function aktifEditAdminDesa($id)
    {
        $edit = User::where('id', $id)->update([
            'edit_admin_desa' => '1',
        ]);

        return new FormatApi(true, 'Edit Admin Desa Berhasil Diaktifkan', $edit);
    }

    public function nonaktifApproveWisata($id)
    {
        $edit = User::where('id', $id)->update([
            'approve_wisata' => '0',
        ]);

        return new FormatApi(true, 'Approve Wisata Berhasil Dinonaktifkan', $edit);
    }

    public function aktifApproveWisata($id)
    {
        $edit = User::where('id', $id)->update([
            'approve_wisata' => '1',
        ]);

        return new FormatApi(true, 'Approve Wisata Berhasil Diaktifkan', $edit);
    }

    public function nonaktifTambahEditAdminDestinasi($id)
    {
        $edit = User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '0',
        ]);

        return new FormatApi(true, 'Tambah Edit Admin Destinasi Berhasil Dinonaktifkan', $edit);
    }

    public function aktifTambahEditAdminDestinasi($id)
    {
        $edit = User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '1',
        ]);

        return new FormatApi(true, 'Tambah Edit Admin Destinasi Berhasil Diaktifkan', $edit);
    }

    public function nonaktifMengajukanDestinasi($id)
    {
        $edit = User::where('id', $id)->update([
            'mengajukan_destinasi' => '0',
        ]);

        return new FormatApi(true, 'Mengajukan Destinasi Berhasil Dinonaktifkan', $edit);
    }

    public function aktifMengajukanDestinasi($id)
    {
        $edit = User::where('id', $id)->update([
            'mengajukan_destinasi' => '1',
        ]);

        return new FormatApi(true, 'Mengajukan Destinasi Berhasil Diaktifkan', $edit);
    }

    public function nonaktifKonfirmasiTiket($id)
    {
        $edit = User::where('id', $id)->update([
            'konfirmasi_tiket' => '0',
        ]);

        return new FormatApi(true, 'Konfirmasi Tiket Berhasil Dinonaktifkan', $edit);
    }

    public function aktifKonfirmasiTiket($id)
    {
        $edit = User::where('id', $id)->update([
            'konfirmasi_tiket' => '1',
        ]);

        return new FormatApi(true, 'Konfirmasi Tiket Berhasil Diaktifkan', $edit);
    }

    public function kategori()
    {
        $kategori = Kategori::latest()->get();
        return new FormatApi(true, 'List Kategori', $kategori);
    }

    public function tambahKategori(Request $request)
    {
        $add = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return new FormatApi(true, 'Kategori Berhasil Ditambahkan', $add);
    }

    public function getKategori($id)
    {
        $kategori = Kategori::find($id);
        return new FormatApi(true, 'List Kategori', $kategori);
    }

    public function editKategori(Request $request, $id)
    {
        $edit = Kategori::where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori,
            'icon' => $request->icon,
        ]);

        return new FormatApi(true, 'Kategori Berhasil Diubah', $edit);
    }

    public function hapusKategori($id)
    {
        $hapus = Kategori::where('id', $id)->delete();

        return new FormatApi(true, 'Kategori Berhasil Dihapus', $hapus);
    }

    public function province()
    {
        $province = Province::all();
        return new FormatApi(true, 'List Provinsi', $province);
    }

    public function regency()
    {
        $regency = Regency::all();
        return new FormatApi(true, 'List Kabupaten', $regency);
    }

    public function district()
    {
        $district = District::all();
        return new FormatApi(true, 'List Kecamatan', $district);
    }

    public function village()
    {
        $village = Village::all();
        return new FormatApi(true, 'List Desa', $village);
    }

    public function adminDestinasi()
    {
        $user = User::where('role_id', 4)->get();

        return new FormatApi(true, 'List Admin Destinasi', $user);
    }

    public function destinasi()
    {
        $destinasi = Destinasi::latest()->get();
        return new FormatApi(true, 'List Destinasi', $destinasi);
    }

    public function jumlahDestinasiSpesifik($id)
    {
        $destinasi = Destinasi::where('regency_id', $id)->get();
        $total = count($destinasi);
        return new FormatApi(true, 'Jumlah Destinasi', $total);
    }

    public function jumlahDesaSpesifik($id)
    {
        $desa = ProfilDesa::where('regency_id', $id)->get();
        $total = count($desa);
        return new FormatApi(true, 'Jumlah Desa', $total);
    }

    public function jumlahAdminDesaSpesifik($id)
    {
        $desa = User::where('role_id', 3)->where('regency_id', $id)->get();
        $total = count($desa);
        return new FormatApi(true, 'Jumlah Admin Desa', $total);
    }

    public function provinsiSpesifik($id)
    {
        $province = Province::where('id', $id)->get();
        return new FormatApi(true, 'Provinsi Admin', $province);
    }

    public function tambahDestinasi(Request $request)
    {
        $add = Destinasi::create([
            'nama_destinasi' => $request->nama_destinasi,
            'kategori_id' => $request->kategori_id,
            'deskripsi_destinasi' => $request->deskripsi_destinasi,
            'alamat_destinasi' => $request->alamat_destinasi,
            'htm_destinasi' => $request->htm_destinasi,
            'foto_destinasi' => $request->foto_destinasi,
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
        ]);

        return new FormatApi(true, 'Destinasi Berhasil Ditambahkan', $add);
    }

    public function tambahAdminDestinasi(Request $request)
    {
        $add = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'destinasi_id' => $request->destinasi_id,
            'phone' => $request->phone,
            'role_id' => '4',
            'edit_admin_desa' => '0',
            'approve_wisata' => '0',
            'tambah_edit_admin_destinasi' => '0',
            'mengajukan_destinasi' => '0',
            'konfirmasi_tiket' => '1',
        ]);

        return new FormatApi(true, 'Admin Destinasi Berhasil Ditambahkan', $add);
    }

    public function approveDestinasi($id)
    {
        $destinasi = Destinasi::where('id', $id)->update([
            'approve' => '1',
        ]);
        return new FormatApi(true, 'Approve', $destinasi);
    }

    public function rejectDestinasi($id)
    {
        $destinasi = Destinasi::where('id', $id)->update([
            'approve' => '0',
        ]);
        return new FormatApi(true, 'Reject', $destinasi);
    }

    // User
    public function semuaProfilKabupaten()
    {
        $kabupaten = ProfilKabupaten::all();
        return new FormatApi(true, 'List Profil Kabupaten', $kabupaten);
    }

    public function semuaProfilDesa()
    {
        $desa = ProfilDesa::all();
        return new FormatApi(true, 'List Profil Desa', $desa);
    }
}
