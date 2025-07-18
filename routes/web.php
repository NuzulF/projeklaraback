<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Authenticate;
use App\Http\Controllers\Home;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

//Validation
Route::get('/register', [FormController::class, 'create']);
Route::post('/proses-register', [FormController::class, 'store']);
Route::get('/login', [FormController::class, 'index']);
Route::post('/proses-login', [FormController::class, 'prosesLogin']);
Route::get('/testing', [Home::class, 'testingEmail']);
Route::get('/test-helper', [Home::class, 'testHelper']);


// User
Route::get('/', [Home::class, 'index'])->name('home');
Route::get('/kabupaten', [Home::class, 'kabupaten']);
Route::get('/kabupaten/{id}', [Home::class, 'detailKabupaten']);
Route::get('/desa', [Home::class, 'desa']);
Route::get('/desa/{id}', [Home::class, 'detailDesa']);
Route::get('/destinasi', [Home::class, 'destinasi']);
Route::get('/destinasi/{id}', [Home::class, 'detailDestinasi'])->middleware('approve');
Route::get('/maps', [Home::class, 'map']);
Route::get('/tiket/detail/{order_id}', [Home::class, 'detailTiket']);


Route::get('/pesan/destinasi/{id}', [Home::class, 'pesanDestinasi'])->middleware('approve');
Route::get('/pesan/paket/{id}', [Home::class, 'pesanPaketDestinasi']);
Route::post('/proses-pesan/destinasi/{id_destinasi}', [Home::class, 'prosesPesanDestinasi']);
Route::post('/proses-pesan/paket/{id_paket}', [Home::class, 'prosesPesanPaketDestinasi']);
Route::get('/invoice/tiket/{id}', [Home::class, 'invoice']);
Route::get('/pdf/{id}', [Home::class, 'newDownloadTiket']);


Route::middleware(['auth'])->group(
    function () {
        Route::get('/daftar-pemesanan', [Home::class, 'daftarPemesanan'])->name('daftar-pemesanan'); // tambah tabel aduan
        Route::get('/daftar-pemesanan/refresh/{id}', [Home::class, 'refreshPemesanan']);
        // Form Aduan masih statik
        Route::get('/form-aduan/{id}', [Home::class, 'formAduan']);
        Route::post('/aduan/{id}', [Home::class, 'aduan']);
        // Keranjang masih statik
        Route::get('/keranjang', [Home::class, 'keranjang']);
        Route::get('/keranjang/edit/{id}', [Home::class, 'editKeranjang']);
        Route::post('/keranjang/edit/{id}/destinasi', [Home::class, 'updateKeranjangDes']);
        Route::post('/keranjang/edit/{id}/paket', [Home::class, 'updateKeranjangPaket']);
        Route::get('/keranjang/delete/{id}', [Home::class, 'hapusKeranjang']);
        Route::post('/keranjang/checkout', [Home::class, 'prosesPesanKeranjang']);
        Route::get('/keranjang/checkout', [Home::class, 'prosesPesanKeranjang']);
        // Wallet masih statik
        Route::get('/wallet', [Home::class, 'wallet']);
        // Review
        Route::post('/reviews', [Home::class, 'storeReview'])->name('reviews.store');
        Route::post('/review/store', [Home::class, 'store_new'])->name('review.store');

    }
);


// Authenticate User
Route::get('/login', [Authenticate::class, 'login'])->name('login');
Route::post('/proses-login', [Authenticate::class, 'prosesLogin']);
Route::get('/register', [Authenticate::class, 'register']);
Route::post('/proses-register', [Authenticate::class, 'prosesRegister']);
Route::get('/verifikasi-email', [Authenticate::class, 'verifikasiEmail']);
Route::get('/forgot-password', [Authenticate::class, 'forgotPassword']);
Route::post('/check-email', [Authenticate::class, 'checkEmail']);
Route::get('/reset-password/{id}', [Authenticate::class, 'resetPassword']);
Route::put('/proses-reset-password/{token}', [Authenticate::class, 'prosesResetPassword']);
Route::get('/logout', [Authenticate::class, 'logout']);

// IndoRegion
Route::post('/getRegency', [Admin::class, 'getRegency'])->name('getRegency');
Route::post('/getDistrict', [Admin::class, 'getDistrict'])->name('getDistrict');
Route::post('/getVillage', [Admin::class, 'getVillage'])->name('getVillage');


// SuperAdmin
Route::middleware(['auth', 'superadmin'])->group(
    function () {
        Route::get('/superadmin', [Admin::class, 'superadmin']);
        Route::put('/superadmin/ganti-banner', [Admin::class, 'gantiBanner']);
        // Admin
        Route::get('/superadmin/daftar-admin', [Admin::class, 'admin']);
        Route::get('/superadmin/daftar-admin/tambah', [Admin::class, 'tambahAdmin']);
        Route::post('/superadmin/daftar-admin/proses-tambah', [Admin::class, 'prosesTambahAdmin'])->name('prosesTambahAdmin');
        Route::get('/superadmin/daftar-admin/hapus/{id}', [Admin::class, 'hapusAdmin']); // hapus diganti nonaktif
        // aktif nonaktif
        Route::get('/superadmin/daftar-admin/nonaktifkan-edit-admin-desa/{id}', [Admin::class, 'nonaktifEditAdminDesa']);
        Route::get('/superadmin/daftar-admin/aktifkan-edit-admin-desa/{id}', [Admin::class, 'aktifEditAdminDesa']);
        Route::get('/superadmin/daftar-admin/nonaktifkan-approve-wisata/{id}', [Admin::class, 'nonaktifApproveWisata']);
        Route::get('/superadmin/daftar-admin/aktifkan-approve-wisata/{id}', [Admin::class, 'aktifApproveWisata']);
        Route::get('/superadmin/daftar-admin/nonaktifkan-tambah-edit-admin-destinasi/{id}', [Admin::class, 'nonaktifTambahEditAdminDestinasi']);
        Route::get('/superadmin/daftar-admin/aktifkan-tambah-edit-admin-destinasi/{id}', [Admin::class, 'aktifTambahEditAdminDestinasi']);
        Route::get('/superadmin/daftar-admin/nonaktifkan-mengajukan-destinasi/{id}', [Admin::class, 'nonaktifMengajukanDestinasi']);
        Route::get('/superadmin/daftar-admin/aktifkan-mengajukan-destinasi/{id}', [Admin::class, 'aktifMengajukanDestinasi']);
        Route::get('/superadmin/daftar-admin/nonaktifkan-konfirmasi-tiket/{id}', [Admin::class, 'nonaktifKonfirmasiTiket']);
        Route::get('/superadmin/daftar-admin/aktifkan-konfirmasi-tiket/{id}', [Admin::class, 'aktifKonfirmasiTiket']);

        // Kategori
        Route::get('/superadmin/kategori', [Admin::class, 'kategori']);
        Route::post('/superadmin/tambah-kategori', [Admin::class, 'tambahKategori']);
        Route::put('/superadmin/edit-kategori/{id}', [Admin::class, 'editKategori']);
        Route::get('/superadmin/kategori/proses-hapus/{id}', [Admin::class, 'prosesHapusKategori']);  // hapus diganti nonaktif

        // Pembayaran
        Route::get('/superadmin/pembayaran', [Admin::class, 'pembayaran']);
        Route::get('/superadmin/pembayaran/{id}/aktif', [Admin::class, 'aktifPembayaran']);
        Route::get('/superadmin/pembayaran/{id}/nonaktif', [Admin::class, 'nonaktifPembayaran']);

        // Aduan
        Route::get('/superadmin/aduan', [Admin::class, 'aduan']);
        Route::post('/superadmin/update-status/{id}', [Admin::class, 'updateStatus']);

        // Riwayat Edit
        Route::get('/superadmin/riwayat-edit', [Admin::class, 'riwayatEdit']);
    }
);

// Admin Kabupaten
Route::middleware(['auth', 'admin-kabupaten'])->group(
    function () {
        Route::get('/admin-kabupaten', [Admin::class, 'adminKabupaten']);
        Route::put('/admin-kabupaten/edit-profil/{id}', [Admin::class, 'editProfilAdminKabupaten']);
        Route::get('/admin-kabupaten/daftar-admin', [Admin::class, 'daftarAdminKabupaten']);
        Route::post('/admin-kabupaten/tambah-admin-desa', [Admin::class, 'tambahAdminDesa'])->middleware('kab-tambah-admin-desa')->middleware('kab-tambah-admin-desa'); // middleware
        Route::get('/admin-kabupaten/nonaktifkan-tambah-edit-admin-destinasi/{id}', [Admin::class, 'kabNonaktifTambahEditAdminDestinasi'])->middleware('kab-tambah-admin-desa');
        Route::get('/admin-kabupaten/aktifkan-tambah-edit-admin-destinasi/{id}', [Admin::class, 'kabAktifTambahEditAdminDestinasi'])->middleware('kab-tambah-admin-desa');
        Route::get('/admin-kabupaten/nonaktifkan-mengajukan-destinasi/{id}', [Admin::class, 'kabNonaktifMengajukanDestinasi'])->middleware('kab-tambah-admin-desa');
        Route::get('/admin-kabupaten/aktifkan-mengajukan-destinasi/{id}', [Admin::class, 'kabAktifMengajukanDestinasi'])->middleware('kab-tambah-admin-desa');
        Route::get('/admin-kabupaten/hapus-admin-desa/{id}', [Admin::class, 'kabHapusAdminDesa'])->middleware('kab-tambah-admin-desa');  // hapus diganti nonaktif
        Route::get('/admin-kabupaten/destinasi', [Admin::class, 'destinasiAdminKabupaten']);
        Route::get('/admin-kabupaten/destinasi/approve/{id}', [Admin::class, 'approveDestinasiAdminKabupaten'])->middleware('kab-approve-destinasi'); // middleware
        Route::get('/admin-kabupaten/destinasi/reject/{id}', [Admin::class, 'rejectDestinasiAdminKabupaten'])->middleware('kab-approve-destinasi'); // middleware
        Route::get('/admin-kabupaten/destinasi/hapus/{id}', [Admin::class, 'hapusDestinasiAdminKabupaten'])->middleware('kab-approve-destinasi'); // middleware  // hapus diganti nonaktif

        // Riwayat Edit
        Route::get('/admin-kabupaten/riwayat-edit', [Admin::class, 'riwayatEditAdminKabupaten']);
    }
);

// Admin Desa
Route::middleware(['auth', 'admin-desa'])->group(
    function () {
        Route::get('/admin-desa', [Admin::class, 'adminDesa']);
        Route::put('/admin-desa/edit-profil/{id}', [Admin::class, 'editProfilAdminDesa']);
        Route::get('/admin-desa/daftar-admin', [Admin::class, 'daftarAdminDestinasi']);
        Route::post('/admin-desa/tambah-admin-destinasi', [Admin::class, 'tambahAdminDestinasi'])->middleware('des-tambah-admin-destinasi'); // middleware
        Route::get('/admin-desa/daftar-admin/hapus/{id}', [Admin::class, 'hapusAdminDestinasi'])->middleware('des-tambah-admin-destinasi'); // middleware ->middleware('des-tambah-admin-destinasi')  // hapus diganti nonaktif
        Route::get('/admin-desa/nonaktifkan-konfirmasi-tiket/{id}', [Admin::class, 'desNonaktifKonfirmasiTiket'])->middleware('des-tambah-admin-destinasi');
        Route::get('/admin-desa/aktifkan-konfirmasi-tiket/{id}', [Admin::class, 'desAktifKonfirmasiTiket'])->middleware('des-tambah-admin-destinasi');
        Route::get('/admin-desa/destinasi', [Admin::class, 'destinasiAdminDesa']);
        Route::post('/admin-desa/tambah-destinasi', [Admin::class, 'desTambahDestinasi'])->middleware('des-mengajukan-destinasi'); // middleware ->middleware('des-mengajukan-destinasi')
        Route::put('/admin-desa/edit-destinasi/{id}', [Admin::class, 'desEditDestinasi']);
        Route::get('/admin-desa/hapus-destinasi/{id}', [Admin::class, 'desHapusDestinasi']);  // hapus diganti nonaktif
        Route::get('/admin-desa/paket-destinasi', [Admin::class, 'desPaketDestinasi']);
        Route::post('/admin-desa/tambah-paket', [Admin::class, 'desTambahPaket']);
        Route::get('/admin-desa/hapus-paket/{id}', [Admin::class, 'desHapusPaket']);  // hapus diganti nonaktif

        // Riwayat Edit
        Route::get('/admin-desa/riwayat-edit', [Admin::class, 'riwayatEditAdminDesa']);
    }
);

// Admin Destinasi
Route::middleware(['auth', 'admin-destinasi'])->group(
    function () {
        Route::get('/admin-destinasi', [Admin::class, 'adminDestinasi']);
        Route::put('/admin-destinasi/edit-profil/{id}', [Admin::class, 'editProfilAdminDestinasi']);
        Route::get('/admin-destinasi/konfirmasi-tiket', [Admin::class, 'konfirmasiTiket']);
        Route::get('/admin-destinasi/konfirmasi-tiket/{id}', [Admin::class, 'konfirmasiTiketId'])->middleware('dest-konfirmasi-tiket'); // middleware
        Route::get('admin-destinasi/wahana', [Admin::class, 'wahana']);
        Route::post('/admin-destinasi/tambah-wahana', [Admin::class, 'tambahWahana']);
        Route::put('/admin-destinasi/edit-wahana/{id}', [Admin::class, 'editWahana']);
        Route::get('/admin-destinasi/hapus-wahana/{id}', [Admin::class, 'hapusWahana']);  // hapus diganti nonaktif
        Route::get('/admin-destinasi/paket-wahana', [Admin::class, 'paketWahana']);
        Route::post('/admin-destinasi/tambah-paket', [Admin::class, 'destTambahPaket']);
        Route::get('/admin-destinasi/hapus-paket/{id}', [Admin::class, 'destHapusPaket']);  // hapus diganti nonaktif
        Route::get('/qr/admin/scan', [Admin::class, 'scanQrAdmin']);
        Route::get('/barcode/scan', [Admin::class, 'scanBarcode']);
        Route::post('/barcode/scan', [Admin::class, 'scanBarcodeProses']);
        Route::get('/qr/scan', [Admin::class, 'scanQrUser']);

        Route::get('/admin-destinasi/aduan', [Admin::class, 'aduanAdminDestinasi']);
        Route::post('/admin-destinasi/update-status/{id}', [Admin::class, 'updateStatusAdminDestinasi']);
        Route::post('/admin-destinasi/komentar/{id}', [Admin::class, 'storeKomentar']);

        Route::get('/tesprint', [Admin::class, 'tesPrint']);
    }
);
// wahana


// Authenticate Admin
Route::get('/login-admin', [Authenticate::class, 'loginAdmin']);
Route::post('/proses-login-admin', [Authenticate::class, 'prosesLoginAdmin']);


// Socialite Auth
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
