<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Destinasi;
use App\Models\JenisAduan;
use App\Models\Kategori;
use App\Models\Paket;
use App\Models\ProfilDesa;
use App\Models\ProfilKabupaten;
use App\Models\Village;
use App\Models\Regency;
use App\Models\Transaksi;
use App\Models\Keranjang;
use App\Models\User;
use App\Models\Tikets;
use App\Models\JenisPembayaran;
use App\Models\Reschedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\baseMail;
use App\Helpers\SadewaPDF;
use App\Helpers\OrderId;
use App\Helpers\Midtrans;
use App\Models\Review;
use Illuminate\Support\Facades\Http;

class Home extends Controller
{
    public function index()
    {
        // Ambil username pengguna yang sedang login
        $username = auth()->check() ? auth()->user()->username : 'guest';

        $kategoriList = [
            'Pantai',
            'Pegunungan',
            'Sejarah',
            'Kuliner',
            'Taman Hiburan',
            'Budaya',
            'Belanja'
        ];

        $pernahReview = false;
        if (auth()->check()) {
            $pernahReview = Review::where('reviewer_id', auth()->id())->exists();
        }

        // Ambil daftar rekomendasi dari API
        $rekomendasi = [];
        $destinasi = [];
        try {
            $response = Http::get('http://localhost:5000/rekomendasi', [
                'user' => $username
            ]);

            if ($response->successful() && $response->json()['status'] === 'success') {
                // Ambil data dari API dan urutkan berdasarkan Weighted_Average tertinggi
                $apiData = collect($response->json()['data'])
                    ->sortByDesc('Weighted_Average'); // Urutkan dari skor tertinggi

                // Ambil daftar nama DTW
                $dtwNames = $apiData->pluck('nama DTW')->toArray();

                // Cari destinasi di database berdasarkan nama DTW
                $rekomendasi = Destinasi::whereIn('nama_destinasi', $dtwNames)
                    ->approve()
                    ->aktif()
                    ->get()
                    ->sortBy(function ($item) use ($dtwNames) {
                        // Urutkan sesuai urutan di API (berdasarkan Weighted_Average)
                        return array_search($item->nama, $dtwNames);
                    });

                // Ambil 6 destinasi teratas berdasarkan Weighted_Average
                $destinasi = $rekomendasi->take(6);
            }
        } catch (\Exception $e) {
            // Log error jika API gagal
            dd('Gagal mengakses API rekomendasi: ' . $e->getMessage());
        }

        // Jika destinasi kosong (misalnya, API gagal), gunakan fallback
        if ($destinasi->isEmpty()) {
            $destinasi = Destinasi::approve()->aktif()->inRandomOrder()->take(6)->get();
        }

        // Data banner
        $banner = Banner::first()->gambar ?? "Banner1.png|Banner2.png|Banner3.png";
        $banner = explode("|", $banner);

        // Data kategori
        $kategori = Kategori::aktif()->latest()->get();

        // Data kabupaten
        $kabupaten = ProfilKabupaten::all();

        // Data regency
        $regency = Regency::destinasiAktif()
            ->with('profilKabupaten')
            ->withCount(['profildesa' => function ($query) {
                $query->destinasiAktif();
            }])
            ->get();

        // Data desa
        $desa = ProfilDesa::all();

        // Data village
        $village = Village::destinasiAktif()->with('profilDesa')->take(4)->get();

        // Kirim data ke view
        return view('home.index', [
            'banner' => $banner,
            'kategori' => $kategori,
            'regency' => $regency,
            'destinasi' => $destinasi,
            'kabupaten' => $kabupaten,
            'desa' => $desa,
            'village' => $village,
            'rekomendasi' => $rekomendasi,
            'pernahReview' => $pernahReview,
            'kategoriList' => $kategoriList
        ]);
    }

    public function kabupaten()
    {
        $kabupaten = Regency::destinasiAktif()->with('profilKabupaten')->withCount(['profildesa' => function ($query) {
            $query->destinasiAktif();
        }])->paginate(9);

        return view('home.kabupaten', [
            'kabupaten' => $kabupaten
        ]);
    }

    public function detailKabupaten($id)
    {
        $kabupaten = Regency::id($id)->with('profilKabupaten')->first();

        $desa = Village::isKabupaten($kabupaten->id)->destinasiAktif()->with('profilDesa')->paginate(9);

        return view('home.detailKabupaten', [
            'kabupaten' => $kabupaten,
            'desa' => $desa
        ]);
    }

    public function desa()
    {
        $desa = Village::destinasiAktif()->paginate(9);

        return view('home.desa', [
            'desa' => $desa
        ]);
    }

    public function detailDesa($id)
    {
        $desa   = Village::id($id)->first();
        $detail = optional($desa->profilDesa())->first();

        $dataGambar = $detail->foto_desa ?? 'kabupaten_default.jpg';
        $arrayGambar = explode("|", $dataGambar);

        $destinasi = $desa->destinasi()->approve()->aktif()->paginate(6, ['*'], 'destinasiPage')->withQueryString();

        $kategori = Kategori::aktif()->latest();

        $paket = Paket::isDestinasi()->destinasiAktif()->isVillage($desa)->aktif()->latest()->with('destinasi')->paginate(4, ['*'], 'paketPage')->withQueryString();

        return view('home.detailDesa', [
            'desa' => $desa,
            'detail' => $detail,
            'arrayGambar' => $arrayGambar,
            'destinasi' => $destinasi,
            'kategori' => $kategori,
            'paket' => $paket
        ]);
    }

    public function destinasi(Request $request)
    {
        $kabupaten_nama = strtoupper($request->kabupaten ?? "");
        $kategori_nama = ucfirst($request->kategori ?? "");

        // $kabupaten = Regency::where('name', $kabupaten_nama)->first();
        // $kategori = Kategori::where('nama_kategori', $kategori_nama)->first();
        $destinasi = Destinasi::approve()->aktif()->latest();

        // if ($kabupaten) {
        //     $destinasi->whereHas('regency', function ($query) use ($kabupaten) {
        //         $query->where('id', $kabupaten->id);
        //     });
        // }

        // if ($kategori) {
        //     $destinasi->whereHas('kategori', function ($query) use ($kategori) {
        //         $query->where('id', $kategori->id);
        //     });
        // }
        $destinasi = $destinasi->with('kategori')->paginate(9)->withQueryString();

        return view('home.destinasi', [
            'destinasi' => $destinasi
        ]);
    }

    public function detailDestinasi($id)
    {
        $destinasi = Destinasi::id($id)->aktif()->with('kategori')->first();

        if (!$destinasi) {
            abort(404);
        }

        $dataGambar = $destinasi->foto_destinasi;
        $arrayGambar = explode("|", $dataGambar);

        $wahana = $destinasi->wahana()->aktif()->paginate(4, ['*'], 'wahanaPage')->withQueryString();
        $paket = $destinasi->paketWahana()->isWahana()->with('wahana')->paginate(4, ['*'], 'paketPage')->withQueryString();

        // Ambil rating rata-rata dari review
        $averageRating = \App\Models\Review::where('destinasi_id', $id)->avg('rating');

        // Ambil daftar review (misalnya yang status-nya aktif), bisa dengan pagination juga
        $reviews = \App\Models\Review::where('destinasi_id', $id)
            ->with('reviewer') // mengambil data reviewer
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('home.detailDestinasi', [
            'destinasi' => $destinasi,
            'arrayGambar' => $arrayGambar,
            'wahana' => $wahana,
            'paket' => $paket,
            'averageRating' => round($averageRating, 1),
            'reviews' => $reviews
        ]);
    }


    public function pesanDestinasi($id)
    {
        $destinasi = Destinasi::id($id)->aktif()->with([
            'paketWahana' => function ($query) {
                $query->isWahana()->aktif()->with('wahana:nama_wahana');
            },
            'wahana' => function ($query) {
                $query->aktif();
            },
        ])->first();
        if ($destinasi == null) {
            return redirect()->back()->with('error', 'Destinasi tidak ditemukan');
        }
        return view('home.pesanDestinasi', [
            'destinasi' => $destinasi
        ]);
    }

    public function pesanPaketDestinasi($id)
    {
        $paket = Paket::id($id)->isDestinasi()->aktif()->with([
            'destinasi' => function ($query) {
                $query->aktif()->with([
                    'paketWahana' => function ($query) {
                        $query->isWahana()->aktif()->with('wahana:nama_wahana');
                    },
                ]);
            },
        ])->first();

        if ($paket == null) {
            return redirect()->back()->with('error', 'Paket tidak ditemukan');
        }

        return view('home.pesanPaketDestinasi', [
            'paket' => $paket
        ]);
    }

    public function prosesPesanDestinasi(Request $request, $id)
    {
        try {
            if (auth()->check()) {
                //request untuk user yang sudah login
                $request->validate([
                    'tanggal' => 'required|date|after_or_equal:today',
                    'jumlah' => 'required|integer|min:1',
                    'wahana' => 'required|array',
                    'aksi' => 'required|in:Pesan,Keranjang'
                ]);
                $user = Auth::user();
                $request->request->add([
                    'nama_pemesan' => $user['name'],
                    'email_pemesan' => $user['email'],
                    'no_telp_pemesan' => $user['phone']
                ]);
            } else {
                //request untuk user yang belum login
                $request->validate([
                    'nama_pemesan' => 'required|max:255',
                    'email_pemesan' => 'required|email|max:255',
                    'tanggal' => 'required|date|after_or_equal:today',
                    'jumlah' => 'required|integer|min:1',
                    'no_telp_pemesan' => 'required|numeric|digits_between:10,13',
                    'wahana' => 'required|array',
                    'aksi' => 'required|in:Pesan'
                ]);
            }
            //mengambil destinasi
            $destinasi = Destinasi::id($id)->aktif()->first();

            //harga total wahana
            $harga_total_wahana = 0;

            //untuk midtrans' item details
            $midtrans_items = [];

            //untuk metadata transaksi
            $array_wahana_id = [];

            //tambah destinasi ke item details
            $midtrans_items[] = [
                'id'        => $destinasi->id,
                'price'     => $destinasi->htm_destinasi,
                'quantity'  => $request->jumlah,
                'name'      => $destinasi->nama_destinasi,
                'brand'     => 'destinasi',
                'category'  => '-'
            ];

            foreach ($request->wahana as $wahana) {
                if ($wahana != "0") {
                    //memverifikasi paket wahana
                    $paket = $destinasi->paketWahana()->aktif()->id($wahana)->isWahana()->first();

                    //jika paket wahana tidak valid
                    if ($paket == null) {
                        throw new \Exception('ada paket wahana yang tidak valid');
                    }

                    //menambahkan harga total
                    $harga_total_wahana += $paket->harga_paket;

                    //tambah wahana ke item details
                    $midtrans_items[] = [
                        'id'        => $paket->id,
                        'price'     => $paket->harga_paket,
                        'quantity'  => $request->jumlah,
                        'name'      => $paket->nama_paket,
                        'brand'     => 'wahana',
                        'category'  => $destinasi->id,
                    ];

                    //tambah wahana ke metadata transaksi
                    $array_wahana_id[] = $paket->id;
                }
            }

            if (count($array_wahana_id) == 0) {
                $array_wahana_id = 0;
            }

            //menghitung total harga di keranjang
            $total_keranjang = $destinasi['htm_destinasi'] + $harga_total_wahana;

            //mengalikan harga keranjang dengan jumlah keranjang
            $total = $request->jumlah * $total_keranjang;

            //membuat order_id
            $order_id = OrderId::generate();

            if (auth()->check()) {
                //bikin keranjang untuk user yang sudah login

                //membuat keranjang
                $keranjang = Keranjang::create([
                    'user_id' => $user['id'],
                    'tipe' => 'destinasi',
                    'jumlah' => $request->jumlah,
                    'total_pembayaran' => $total_keranjang,
                    'tanggal_kunjungan' => $request->tanggal,
                    'status_id' => 1
                ]);

                //menambahkan paket wahana ke keranjang
                for ($i = 1; $i <= $request->jumlah; $i++) {
                    foreach ($request->wahana as $wahana) {
                        if ($wahana != "0") {
                            $keranjang->paketWahana()->attach($wahana, [
                                'index' => $i,
                                'destinasi_id' => $destinasi->id
                            ]);
                        } else {
                            $keranjang->destinasi()->attach($destinasi->id, [
                                'index' => $i
                            ]);
                        }
                    }
                }
                if ($request->aksi == 'Keranjang') {
                    //jika user hanya ingin menambahkan ke keranjang

                    return redirect()->to('/keranjang')->with('success', 'Berhasil menambahkan ke keranjang');
                } else {
                    //jika user ingin langsung melakukan pembayaran


                    //membuat transaksi
                    $transaksi_db = Transaksi::create([
                        'order_id' => $order_id,
                        'nama_pemesan' => $request->nama_pemesan,
                        'email_pemesan' => $request->email_pemesan,
                        'no_telp_pemesan' => $request->no_telp_pemesan,
                        'user_id' => $user['id'],
                        'status' => '0',
                        'total_pembayaran' => $total,
                        'jenis_pembayaran_id' => null
                    ]);

                    //menambahkan keranjang ke transaksi
                    $keranjang->update(['status_id' => 2]);
                    $transaksi_db->keranjang()->attach($keranjang->id);

                    //membuat metadata transaksi user login
                    $transaksi = [
                        'order_id' => $transaksi_db->order_id,
                        'nama_pemesan' => $transaksi_db->nama_pemesan,
                        'email_pemesan' => $transaksi_db->email_pemesan,
                        'no_telp_pemesan' => $transaksi_db->no_telp_pemesan,
                        'total_pembayaran' => $total,
                        'auth' => 'login',
                        'keranjang' => [
                            [
                                'tanggal' => $keranjang->tanggal_kunjungan,
                                'tipe' => 'destinasi',
                                'jumlah' => $keranjang->jumlah,
                                'total' => $keranjang->total_pembayaran,
                                'item' => [
                                    'destinasi_id' => $destinasi->id,
                                    'wahana' => $array_wahana_id
                                ]
                            ]
                        ]
                    ];
                }
            } else {
                //jika user belum login

                //membuat metadata transaksi user non-login
                $transaksi = [
                    'order_id' => $order_id,
                    'nama_pemesan' => $request->nama_pemesan,
                    'email_pemesan' => $request->email_pemesan,
                    'no_telp_pemesan' => $request->no_telp_pemesan,
                    'total_pembayaran' => $total,
                    'auth' => 'non-login',
                    'keranjang' => [
                        [
                            'tanggal' => $request->tanggal,
                            'tipe' => 'destinasi',
                            'jumlah' => $request->jumlah,
                            'total' => $total_keranjang,
                            'item' => [
                                'destinasi_id' => $destinasi->id,
                                'wahana' => $array_wahana_id
                            ]
                        ]
                    ]
                ];
            }

            //mengambil tipe pembayaran yang aktif untuk ditampilkan di midtrans
            $tipe_pembayaran = JenisPembayaran::enabledPayment()->aktif()->pluck('kode')->toArray();

            $response = Midtrans::http([
                'transaction_details'   => [
                    'order_id'      => $order_id,
                    'gross_amount'  => $total //total harga ( jumlah x harga keranjang = jumlah x (harga destinasi + (harga paket + harga paket + ...))  )
                ],
                'customer_details'      => [
                    'first_name'    => $request->nama_pemesan,
                    'email'         => $request->email_pemesan,
                    'phone'         => $request->no_telp_pemesan
                ],
                'item_details'          => $midtrans_items,
                'enabled_payments'      => $tipe_pembayaran,
                'metadata'              => [
                    'transaksi'     => $transaksi
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 201) {
                $body       = $response->getBody();
                $data       = json_decode($body, true);
                $snapToken  = $data['token'];
            } else {
                throw new \Exception('gagal meraih server');
            }

            $tipe = (auth()->check()) ? 'login' : 'non-login';

            return view('home.checkout', [
                'snapToken' => $snapToken,
                'tipe'      => $tipe,
                'transaksi' => $transaksi
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'gagal melakukan pemesanan',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'gagal melakukan pemesanan',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function prosesPesanPaketDestinasi(Request $request, $id)
    {
        try {
            if (auth()->check()) {
                //request untuk user yang sudah login
                $request->validate([
                    'tanggal' => 'required|date|after_or_equal:today',
                    'jumlah' => 'required|integer|min:1',
                    'wahana' => 'required|array',
                    'aksi' => 'required|in:Pesan,Keranjang'
                ]);
                $user = Auth::user();
                $request->request->add([
                    'nama_pemesan' => $user['name'],
                    'email_pemesan' => $user['email'],
                    'no_telp_pemesan' => $user['phone']
                ]);
            } else {
                //request untuk user yang belum login
                $request->validate([
                    'nama_pemesan' => 'required|max:255',
                    'email_pemesan' => 'required|email|max:255',
                    'tanggal' => 'required|date|after_or_equal:today',
                    'jumlah' => 'required|integer|min:1',
                    'no_telp_pemesan' => 'required|numeric|digits_between:10,13',
                    'wahana' => 'required|array',
                    'aksi' => 'required|in:Pesan'
                ]);
            }

            //mengambil paket
            $paket = Paket::id($id)->isDestinasi()->aktif()->first();

            //harga total wahana
            $harga_total_wahana = 0;

            //untuk midtrans' item details
            $midtrans_items = [];

            //tambah paket ke item details
            $midtrans_items[] = [
                'id'        => $paket->id,
                'price'     => $paket->harga_paket,
                'quantity'  => $request->jumlah,
                'name'      => $paket->nama_paket,
                'brand'     => 'paket',
                'category'  => '-'
            ];

            //untuk metadata transaksi
            $array_items = [];
            foreach ($request->wahana as $destinasi_id => $wahana_id) {

                //memverifikasi destinasi
                $destinasi = $paket->destinasi()->where('aktif', true)->where('destinasi.id', $destinasi_id)->first();

                if ($destinasi == null) {
                    throw new \Exception('ada destinasi yang tidak valid');
                }
                //array untuk menyimpan id wahana setiap destinasi
                $arr_paket_wahana_id = null;

                //setiap id didalam array wahana_id
                foreach ($wahana_id as $id_wahana) {

                    //jika id wahana tidak 0
                    if ($id_wahana != 0) {

                        //memverifikasi paket wahana
                        $paket_wahana = $destinasi->paketWahana()->where('aktif', true)->where('id', $id_wahana)->first();
                        if ($paket_wahana == null) {
                            throw new \Exception('ada paket wahana yang tidak valid');
                        }

                        //menambahkan harga total
                        $harga_total_wahana += $paket_wahana->harga_paket;

                        //tambah wahana ke item details
                        $midtrans_items[] = [
                            'id'        => $paket_wahana->id,
                            'price'     => $paket_wahana->harga_paket,
                            'quantity'  => $request->jumlah,
                            'name'      => $paket_wahana->nama_paket,
                            'brand'     => 'wahana',
                            'category'  => $destinasi->id,
                        ];

                        //tambah paket wahana ke metadata transaksi
                        $arr_paket_wahana_id[] = $paket_wahana->id;
                    }
                }

                $arr_paket_wahana_id =  ($arr_paket_wahana_id == null) ? 0 : $arr_paket_wahana_id;

                //tambah destinasi ke metadata transaksi beserta paket wahana yang ada didalamnya
                $array_items[] = [
                    'paket_id' => $paket->id,
                    'destinasi_id' => $destinasi->id,
                    'wahana' => $arr_paket_wahana_id
                ];
            }

            //menghitung total harga dan membuat order_id
            $total_keranjang = $paket['harga_paket'] + $harga_total_wahana;
            $total = $request->jumlah * $total_keranjang;
            $order_id = OrderId::generate();

            if (auth()->check()) {
                //bikin keranjang untuk user yang sudah login

                //membuat keranjang
                $keranjang = Keranjang::create([
                    'user_id' => $user['id'],
                    'tipe' => 'paket',
                    'jumlah' => $request->jumlah,
                    'total_pembayaran' => $total_keranjang,
                    'tanggal_kunjungan' => $request->tanggal,
                    'status_id' => 1
                ]);

                //menambahkan paket wahana ke keranjang
                for ($i = 1; $i <= $request->jumlah; $i++) {
                    foreach ($request->wahana as $destinasi_id => $wah_id) {
                        foreach ($wah_id as $id_wah) {
                            if ($id_wah != 0) {
                                $keranjang->paketWahana()->attach($id_wah, [
                                    'index' => $i,
                                    'destinasi_id' => $destinasi_id,
                                    'paket_destinasi_id' => $paket->id
                                ]);
                            } else {
                                $keranjang->destinasi()->attach($destinasi_id, [
                                    'index' => $i,
                                    'paket_destinasi_id' => $paket->id
                                ]);
                            }
                        }
                    }
                }

                if ($request->aksi == 'Keranjang') {

                    //jika user hanya ingin menambahkan ke keranjang
                    return redirect()->to('/keranjang')->with('success', 'Berhasil menambahkan ke keranjang');
                } else {
                    //jika user ingin langsung melakukan pembayaran

                    //membuat transaksi
                    $transaksi_db = Transaksi::create([
                        'order_id' => $order_id,
                        'nama_pemesan' => $request->nama_pemesan,
                        'email_pemesan' => $request->email_pemesan,
                        'no_telp_pemesan' => $request->no_telp_pemesan,
                        'user_id' => $user['id'],
                        'status' => '0',
                        'total_pembayaran' => $total,
                        'jenis_pembayaran_id' => null
                    ]);
                    //menambahkan keranjang ke transaksi
                    $keranjang->update(['status_id' => 2]);
                    $transaksi_db->keranjang()->attach($keranjang->id);

                    //membuat metadata transaksi user login
                    $transaksi = [
                        'order_id' => $transaksi_db->order_id,
                        'nama_pemesan' => $transaksi_db->nama_pemesan,
                        'email_pemesan' => $transaksi_db->email_pemesan,
                        'no_telp_pemesan' => $transaksi_db->no_telp_pemesan,
                        'total_pembayaran' => $total,
                        'auth' => 'login',
                        'keranjang' => [
                            [
                                'total' => $keranjang->total_pembayaran,
                                'tanggal' => $keranjang->tanggal_kunjungan,
                                'tipe' => 'paket',
                                'jumlah' => $keranjang->jumlah,
                                'item' => $array_items
                            ]
                        ]
                    ];
                }
            } else {
                //jika user belum login

                //membuat metadata transaksi user non-login
                $transaksi = [
                    'order_id' => $order_id,
                    'nama_pemesan' => $request->nama_pemesan,
                    'email_pemesan' => $request->email_pemesan,
                    'no_telp_pemesan' => $request->no_telp_pemesan,
                    'total_pembayaran' => $total,
                    'auth' => 'non-login',
                    'keranjang' => [
                        [
                            'total' => $total_keranjang,
                            'tanggal' => $request->tanggal,
                            'tipe' => 'paket',
                            'jumlah' => $request->jumlah,
                            'item' => $array_items
                        ]
                    ]
                ];
            }

            //mengambil tipe pembayaran yang aktif untuk ditampilkan di midtrans
            $tipe_pembayaran = JenisPembayaran::where('enabled_payment', true)->where('status', true)->pluck('kode')->toArray();

            $response = Midtrans::http([
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $total //total harga ( jumlah x harga keranjang = jumlah x (harga paket destinasi + (harga paket wahana untuk destinasi n + harga paket wahana untuk destinasi n + ...))  )
                ],
                'customer_details' => [
                    'first_name' => $request->nama_pemesan,
                    'email' => $request->email_pemesan,
                    'phone' => $request->no_telp_pemesan
                ],
                'item_details' => $midtrans_items,
                'enabled_payments' => $tipe_pembayaran,
                'metadata' => [
                    'transaksi' => $transaksi
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 201) {
                $body = $response->getBody();
                $data = json_decode($body, true);
                $snapToken = $data['token'];
            } else {
                throw new \Exception('gagal meraih server');
            }

            $tipe = (auth()->check()) ? 'login' : 'non-login';

            return view('home.checkout', [
                'snapToken' => $snapToken,
                'tipe' => $tipe,
                'transaksi' => $transaksi
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'gagal melakukan pemesanan',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'gagal melakukan pemesanan',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function prosesPesanKeranjang(Request $request)
    {
        try {
            //request
            $request->validate([
                'keranjang' => 'required|array',
            ]);
            //mengambil user
            $user = User::isAuth()->first();

            //total harga
            $total = 0;

            //mengambil keranjang
            foreach ($request->keranjang as $id_keranjang) {

                //memverifikasi keranjang
                $keranjang = $user->keranjang()->where('keranjang.id', $id_keranjang)->status(1)->first();

                //jika keranjang tidak valid
                if ($keranjang == null) {
                    throw new \Exception('ada keranjang yang tidak valid');
                }

                //menambahkan total harga
                $total += $keranjang->jumlah * $keranjang->total_pembayaran;
            }

            //membuat order_id
            $order_id = OrderId::generate();

            //membuat transaksi
            $transaksi_db = Transaksi::create([
                'order_id' => $order_id,
                'nama_pemesan' => $user['name'],
                'email_pemesan' => $user['email'],
                'no_telp_pemesan' => $user['phone'],
                'user_id' => $user['id'],
                'status' => '0',
                'total_pembayaran' => $total,
                'jenis_pembayaran_id' => null
            ]);

            //menambahkan keranjang ke transaksi
            foreach ($request->keranjang as $id_keranjang) {
                $keranjang = Keranjang::where('id', $id_keranjang)->status(1)->first();
                $transaksi_db->keranjang()->attach($keranjang->id);
                $keranjang->update(['status_id' => 2]);
            }

            //membuat keranjangs untuk metadata transaksi
            $array_keranjang = [];

            //untuk midtrans' item details
            $midtrans_items = [];

            foreach ($transaksi_db->keranjang()->get() as $ker) {

                //mengambil tipe keranjang
                $tipe = $ker->tipe;
                if ($tipe == 'paket') {
                    //jika tipe keranjang adalah paket

                    //untuk menyimpan item untuk keranjangs
                    $item = [];

                    //mengambil id paket destinasi dari keranjang
                    $paket_id = $ker->paketWahana()->first() != null ? $ker->paketWahana()->first()->pivot->paket_destinasi_id : $ker->destinasi()->first()->pivot->paket_destinasi_id;

                    //mengambil paket destinasi
                    $paket = Paket::id($paket_id)->isDestinasi()->aktif()->first();

                    //menambahkan paket ke item details
                    $midtrans_items[] = [
                        'id'        => $paket->id,
                        'price'     => $paket->harga_paket,
                        'quantity'  => $ker->jumlah,
                        'name'      => $paket->nama_paket,
                        'brand'     => 'paket',
                        'category'  => '-'
                    ];

                    //setiap destinasi didalam paket
                    foreach ($paket->destinasi()->get() as $destinasi) {

                        //default paket yang dipilih adalah null
                        $arr_paket_wahana_id = null;

                        foreach ($ker->paketWahana()->wherePivot('index', 1)->get() as $paket_wahana) {
                            //jika destinasi_id dari paket wahana sama dengan destinasi_id dari destinasi
                            if ($paket_wahana->pivot->destinasi_id == $destinasi->id) {
                                //menambahkan paket wahana ke item details
                                $midtrans_items[] = [
                                    'id'        => $paket_wahana->id,
                                    'price'     => $paket_wahana->harga_paket,
                                    'quantity'  => $ker->jumlah,
                                    'name'      => $paket_wahana->nama_paket,
                                    'brand'     => 'wahana',
                                    'category'  => '-'
                                ];

                                //menambahkan id paket wahana ke array
                                $arr_paket_wahana_id[] = $paket_wahana->id;
                            }
                        }

                        $arr_paket_wahana_id =  ($arr_paket_wahana_id == null) ? 0 : $arr_paket_wahana_id;

                        //menambahkan destinasi ke item details
                        $item[] = [
                            'paket_id' => $paket->id,
                            'destinasi_id' => $destinasi->id,
                            'wahana' => $arr_paket_wahana_id
                        ];
                    }
                } else {
                    //jika tipe keranjang adalah destinasi
                    $destinasi_id = $ker->paketWahana()->first() != null ? $ker->paketWahana()->first()->pivot->destinasi_id : $ker->destinasi()->first()->pivot->destinasi_id;

                    //mengambil destinasi
                    $destinasi = Destinasi::id($destinasi_id)->aktif()->first();

                    //menambahkan destinasi ke item details
                    $midtrans_items[] = [
                        'id'        => $destinasi->id,
                        'price'     => $destinasi->htm_destinasi,
                        'quantity'  => $ker->jumlah,
                        'name'      => $destinasi->nama_destinasi,
                        'brand'     => 'destinasi',
                        'category'  => '-'
                    ];

                    //menambahkan paket wahana ke item details
                    foreach ($ker->paketWahana()->where('index', 1)->get() as $paket_wahana) {
                        $midtrans_items[] = [
                            'id'        => $paket_wahana->id,
                            'price'     => $paket_wahana->harga_paket,
                            'quantity'  => $ker->jumlah,
                            'name'      => $paket_wahana->nama_paket,
                            'brand'     => 'wahana',
                            'category'  => '-'
                        ];
                    }

                    //menambahkan item ke keranjangs ke metadata transaksi
                    $item = [
                        'destinasi_id' => $destinasi->id,
                        'wahana' => $ker->paketWahana()->first() == null ? 0 : $ker->paketWahana()->wherePivot('index', 1)->pluck('paket.id')->toArray()
                    ];
                }

                //menambahkan keranjang ke metadata transaksi
                $array_keranjang[] = [
                    'total' => $ker->total_pembayaran,
                    'tanggal' => $ker->tanggal_kunjungan,
                    'tipe' => $tipe,
                    'jumlah' => $ker->jumlah,
                    'item' => $item
                ];
            }

            //membuat metadata transaksi
            $transaksi = [
                'order_id' => $transaksi_db->order_id,
                'nama_pemesan' => $transaksi_db->nama_pemesan,
                'email_pemesan' => $transaksi_db->email_pemesan,
                'no_telp_pemesan' => $transaksi_db->no_telp_pemesan,
                'total_pembayaran' => $total,
                'auth' => 'login',
                'keranjang' => $array_keranjang
            ];

            //mengambil tipe pembayaran yang aktif untuk ditampilkan di midtrans
            $tipe_pembayaran = JenisPembayaran::enabledPayment()->aktif()->pluck('kode')->toArray();

            $response = Midtrans::http([
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $total //total harga (jumlah x harga keranjang + jumlah x harga keranjang + ...)                    ],
                ],
                'customer_details' => [
                    'first_name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone']
                ],
                'item_details' => $midtrans_items,
                'enabled_payments' => $tipe_pembayaran,
                'metadata' => [
                    'transaksi' => $transaksi
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 201) {
                $body = $response->getBody();
                $data = json_decode($body, true);
                $snapToken = $data['token'];
            } else {
                throw new \Exception('gagal meraih server');
            }

            $tipe = (auth()->check()) ? 'login' : 'non-login';

            return view('home.checkout', [
                'snapToken' => $snapToken,
                'tipe' => $tipe,
                'transaksi' => $transaksi
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'gagal melakukan pemesanan',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function callback(Request $request)
    {
        // write output.txt in public path/images
        // $myfile = fopen(public_path('images/output.txt'), "w") or die("Unable to open file!");
        // fwrite($myfile, $request->getContent());
        // fclose($myfile);

        // return response()->json([
        //      'status' => 'success'
        // ]);
        //

        // REQUEST :
        // {
        //     "masked_card": "40111111-1112",
        //     "approval_code": "1695198431726",
        //     "bank": "bni",
        //     "channel_response_code": "00",
        //     "channel_response_message": "Approved",
        //     "transaction_time": "2023-09-20 15:27:11",
        //     "gross_amount": "1.00",
        //     "currency": "IDR",
        //     "order_id": "A-0001",
        //     "payment_type": "credit_card",
        //     "signature_key": "a3e774ad720fc748780cb5764e8ca397527da1f8c851eb60e3ed564d71664319d0640d456feec1d9fba92a35302e80f38b40dd033cfeeb8ab829e99f447ef4bc",
        //     "status_code": "200",
        //     "transaction_id": "73bde5d6-60c6-4074-aa1e-4aac5b37d98a",
        //     "transaction_status": "settlement",
        //     "fraud_status": "accept",
        //     "settlement_time": "2023-09-21 17:08:56",
        //     "status_message": "Success, Credit Card transaction is successful",
        //     "merchant_id": "G574973595",
        //     "card_type": "debit"
        // }
        //
        // RUMUS SIGNATURE KEY : SHA512(order_id+status_code+gross_amount+ServerKey)
        $serverKey = config('midtrans.server_key');

        $our_key = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        //cek apakah signature key yang dikirim midtrans sama dengan signature key yang kita buat
        if ($our_key == $request->signature_key) {
            //Macam-macam transaction_status :
            // capture          : pembayaran telah berhasil dilakukan dan masuk
            // settlement       : pembayaran sudah berhasil sejak 1x24 jam yang lalu (tingkat lanjut dari capture)
            // pending          : pembayaran belum dibayar
            // deny             : kredensial pembayaran tidak valid
            // cancel           : pembayaran dibatalkan oleh penjual
            // expire           : pembayaran sudah kadaluarsa
            // failure          : pembayaran gagal dilakukan yang tidak terduga
            // refund           : pembayaran dikembalikan penjual
            // partial_refund   : pembayaran dikembalikan sebagian oleh penjual
            // authorize        : transaksi berhasil dan sedang dikonfirmasi penjual
            //

            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                // $transaksi = [
                //     'order_id' => $order_id,
                //     'nama_pemesan' => $request->nama_pemesan,
                //     'email_pemesan' => $request->email_pemesan,
                //     'no_telp_pemesan' => $request->no_telp_pemesan,
                //     'total_pembayaran' => $total,
                //     'auth' => 'login', //login|non-login
                //     'keranjang' => [
                //         [
                //             'total' => '',
                //             'tanggal' => '',
                //             'tipe' => 'destinasi',
                //             'jumlah' => '',
                //             'item' => [
                //                 'destinasi_id' => $destinasi->id,
                //                 'wahana' => [1,2,3]
                //             ]
                //         ],
                //         [
                //             'total' => '',
                //             'tanggal' => '',
                //             'tipe' => 'paket',
                //             'jumlah' => '',
                //             'item' => [
                //                 [
                //                     'paket_id' => $paket->id,
                //                     'destinasi_id' => $destinasi->id,
                //                     'wahana' => [1,2,3]
                //                 ],
                //                 [
                //                     'paket_id' => $paket->id,
                //                     'destinasi_id' => $destinasi->id,
                //                     'wahana' => [1,2,3]
                //                 ]
                //             ]
                //         ],
                //     ]
                // ];
                //membuat keranjang

                //mengambil transaksi
                $transaksi = $request->metadata['transaksi'];


                if ($transaksi['auth'] == "login" || is_null($transaksi)) {
                    //untuk yang login

                    //cari transaksi sesuai order_id
                    $transaksi_db = Transaksi::where('order_id', $request->order_id)->first();
                    if ($transaksi_db->status != '1') {
                        //update status dan pembayaran
                        $transaksi_db->update([
                            'status' => '1',
                            'jenis_pembayaran_id' => JenisPembayaran::identifikasiTransaksi()->kode($request->payment_type)->first()->id
                        ]);

                        //setiap keranjang yang ada ditransaksi tersebut
                        foreach ($transaksi_db->keranjang()->get() as $keranjang) {
                            $keranjang->update([
                                'status_id' => 3
                            ]);

                            //setiap jumlah keranjang yang aktif/selected
                            for ($i = 1; $i <= $keranjang->jumlah; $i++) {
                                //contoh: keranjang 1 pengguna 1

                                // Buat array asosiatif untuk menyimpan kode tiket untuk setiap ID destinasi
                                $tiket_per_destinasi = [];

                                foreach ($keranjang->destinasi()->wherePivot('index', $i)->get() as $destinasi) {
                                    $id_destinasi = $destinasi->id;

                                    // Cek apakah kode tiket untuk ID destinasi ini sudah ada dalam array
                                    if (!isset($tiket_per_destinasi[$id_destinasi])) {
                                        $tiket = Tikets::create([
                                            'kode_tiket' => OrderId::tiket($request->order_id)
                                        ]);
                                        foreach ($keranjang->paketWahana()->wherePivot('index', $i)->wherePivot('destinasi_id', $id_destinasi)->get() as $paket_wahana) {
                                            foreach ($paket_wahana->wahana()->get() as $wahana) {
                                                $tiket->wahana()->attach($wahana->id);
                                            }
                                        }
                                        $tiket_per_destinasi[$id_destinasi] = $tiket->id;
                                    }

                                    //kode dimasukkan ke destinasi a di keranjang 1 pengguna 1
                                    $destinasi->pivot->where('index', $i)->where('destinasi_id', $id_destinasi)->where('keranjang_id', $keranjang->id)->update([
                                        'tikets_id' => $tiket_per_destinasi[$id_destinasi]
                                    ]);
                                    sleep(1);
                                }
                            }
                        }

                        $invoice = SadewaPDF::Invoice($transaksi_db->order_id)->Output('S', 'Surat transaksi ' . $transaksi_db->order_id . '.pdf');
                        $tiket_id = [];
                        $attachment = [
                            [
                                "name" => "Invoice " . $transaksi_db->order_id . ".pdf",
                                "data" => $invoice,
                                "mime" => "application/pdf"
                            ]
                        ];

                        foreach ($transaksi_db->keranjang()->get() as $keranjang) {
                            foreach ($keranjang->tikets()->get() as $tiket) {
                                $tiket_id[] = $tiket->id;
                            }
                        }

                        foreach ($tiket_id as $id) {
                            $tiket = Tikets::id($id)->first();
                            $tiket_pdf = SadewaPDF::Tiket($tiket->id)->Output('S', 'Tiket ' . $tiket->kode_tiket . '.pdf');
                            $attachment[] = [
                                "name" => "Tiket " . $tiket->kode_tiket . ".pdf",
                                "data" => $tiket_pdf,
                                "mime" => "application/pdf"
                            ];
                        }

                        Mail::to($transaksi_db->email_pemesan)->send(new baseMail(
                            [
                                "view" => "emails.pemesanan",
                                "from" => [
                                    "address" => "sadewa.no-reply@paling.kencang.id",
                                    "name" => "Notifikasi SADEWA"
                                ],
                                "tags" => ["notifikasi", "pemesanan", "sadewa", "notifikasi"],
                                "subject" => "Notifikasi Pemesanan " . $transaksi_db->order_id,
                                "content" => [
                                    "nama_user" => $transaksi_db->nama_pemesan,
                                    "judul" => "Notifikasi Pemesanan",
                                    "transaksi" => $transaksi_db
                                ],
                                "attachments" => $attachment
                            ]
                        ));
                    }
                } else {
                    //untuk yang non-login

                    //cek bila transaksi sudah ada
                    $transaksi_db = Transaksi::where('order_id', $request->order_id)->first();

                    if ($transaksi_db === null) {
                        //membuat transaksi
                        $transaksi_db = Transaksi::create([
                            'order_id' => $request->order_id,
                            'nama_pemesan' => $transaksi['nama_pemesan'],
                            'email_pemesan' => $transaksi['email_pemesan'],
                            'no_telp_pemesan' => $transaksi['no_telp_pemesan'],
                            'user_id' => null,
                            'status' => '1',
                            'total_pembayaran' => $transaksi['total_pembayaran'],
                            'jenis_pembayaran_id' => JenisPembayaran::identifikasiTransaksi()->kode($request->payment_type)->first()->id
                        ]);

                        //setiap keranjang yang ada di metadata transaksi
                        foreach ($transaksi['keranjang'] as $keranjang) {

                            //membuat keranjang
                            $keranjang_db = Keranjang::create([
                                'user_id' => null,
                                'tipe' => $keranjang['tipe'],
                                'jumlah' => $keranjang['jumlah'],
                                'total_pembayaran' => $keranjang['total'],
                                'tanggal_kunjungan' => $keranjang['tanggal'],
                                'status_id' => 3
                            ]);

                            if ($keranjang_db->tipe == 'paket') {
                                //bila tipe keranjang adalah paket
                                for ($i = 1; $i <= $keranjang['jumlah']; $i++) {

                                    foreach ($keranjang['item'] as $item) {
                                        //membuat tiket per orang per destinasi/item
                                        $tiket = Tikets::create([
                                            'kode_tiket' => OrderId::tiket($request->order_id)
                                        ]);
                                        if ($item['wahana'] != 0) {
                                            foreach ($item['wahana'] as $paket_wahana_id) {

                                                //verifikasi paket wahana
                                                $paket_wahana = Paket::id($paket_wahana_id)->isWahana()->aktif()->first();

                                                //memasukkan paket wahana ke keranjang
                                                $keranjang_db->paketWahana()->attach($paket_wahana->id, [
                                                    'index' => $i,
                                                    'tikets_id' => $tiket->id,
                                                    'destinasi_id' => $item['destinasi_id'],
                                                    'paket_destinasi_id' => $item['paket_id']
                                                ]);

                                                //mengambil wahana dari paket wahana
                                                $wahana = $paket_wahana->wahana()->get();

                                                //menambahkan wahana ke tiket
                                                foreach ($wahana as $wah) {
                                                    $tiket->wahana()->attach($wah->id);
                                                }
                                            }
                                        } else {
                                            $destinasi = Destinasi::id($item['destinasi_id'])->aktif()->first();
                                            //verifikasi destinasi
                                            $keranjang_db->destinasi()->attach($destinasi->id, [
                                                'index' => $i,
                                                'tikets_id' => $tiket->id,
                                                'paket_destinasi_id' => $item['paket_id']
                                            ]);
                                        }
                                        sleep(1);
                                    }
                                }
                            } else if ($keranjang_db->tipe == 'destinasi') {
                                //bila tipe keranjang adalah destinasi

                                for ($i = 1; $i <= $keranjang['jumlah']; $i++) {
                                    //done untuk sekarang

                                    //membuat tiket per orang
                                    $tiket = Tikets::create([
                                        'kode_tiket' => OrderId::tiket($request->order_id)
                                    ]);
                                    if ($keranjang['item']['wahana'] != 0) {
                                        foreach ($keranjang['item']['wahana'] as $paket_wahana_id) {
                                            //verifikasi paket wahana
                                            $paket_wahana = Paket::id($paket_wahana_id)->isWahana()->aktif()->first();

                                            //memasukkan paket wahana ke keranjang
                                            $keranjang_db->paketWahana()->attach($paket_wahana_id, [
                                                'index' => $i,
                                                'tikets_id' => $tiket->id,
                                                'destinasi_id' => $keranjang['item']['destinasi_id']
                                            ]);

                                            //mengambil wahana dari paket wahana
                                            $wahana = $paket_wahana->wahana()->get();

                                            //menambahkan wahana ke tiket
                                            foreach ($wahana as $wah) {
                                                $tiket->wahana()->attach($wah->id);
                                            }
                                        }
                                    } else {
                                        $keranjang_db->destinasi()->attach($keranjang['item']['destinasi_id'], [
                                            'index' => $i,
                                            'tikets_id' => $tiket->id
                                        ]);
                                    }
                                    sleep(1);
                                }
                            }

                            //menambahkan keranjang ke transaksi
                            $transaksi_db->keranjang()->attach($keranjang_db->id);
                        }


                        $invoice = SadewaPDF::Invoice($transaksi_db->order_id)->Output('S', 'Surat transaksi ' . $transaksi_db->order_id . '.pdf');
                        $tiket_id = [];
                        $attachment = [
                            [
                                "name" => "Invoice " . $transaksi_db->order_id . ".pdf",
                                "data" => $invoice,
                                "mime" => "application/pdf"
                            ]
                        ];
                        foreach ($transaksi_db->keranjang()->get() as $keranjang) {
                            foreach ($keranjang->tikets()->get() as $tiket) {
                                $tiket_id[] = $tiket->id;
                            }
                        }

                        foreach ($tiket_id as $id) {
                            $tiket = Tikets::id($id)->first();
                            $tiket_pdf = SadewaPDF::Tiket($tiket->id)->Output('S', 'Tiket ' . $tiket->kode_tiket . '.pdf');
                            $attachment[] = [
                                "name" => "Tiket " . $tiket->kode_tiket . ".pdf",
                                "data" => $tiket_pdf,
                                "mime" => "application/pdf"
                            ];
                        }

                        Mail::to($transaksi_db->email_pemesan)->send(new baseMail(
                            [
                                "view" => "emails.pemesanan",
                                "from" => [
                                    "address" => "sadewa.no-reply@paling.kencang.id",
                                    "name" => "Notifikasi SADEWA"
                                ],
                                "tags" => ["notifikasi", "pemesanan", "sadewa", "notifikasi"],
                                "subject" => "Notifikasi Pemesanan " . $transaksi_db->order_id,
                                "content" => [
                                    "nama_user" => $transaksi_db->nama_pemesan,
                                    "judul" => "Notifikasi Pemesanan",
                                    "transaksi" => $transaksi_db
                                ],
                                "attachments" => $attachment
                            ]
                        ));
                    }
                }
            }
        }
    }

    public function invoice($order_id)
    {
        $transaksi = Transaksi::where('order_id', $order_id)->with([
            'keranjang' => function ($query) {
                $query->with([
                    'destinasi' => function ($query) {
                        $query->wherePivot('index', 1);
                    },
                    'paketWahana'
                ]);
            },
            'jenisPembayaran'
        ])->first();

        $qrCode = QrCode::format('svg')->size(500)->generate(config('app.url') . "/tiket/detail/" . $transaksi->order_id);

        return view('home.invoice', [
            'transaksi' => $transaksi,
            'qrCode' => $qrCode
        ]);
    }

    public function daftarPemesanan()
    {
        //cek apakah user sudah login
        $user = User::isAuth()->first();

        //transaksi dari user
        $transaksi = $user->transaksi()->with('keranjang')->latest()->paginate(10);

        //mengambil aduan
        $aduan = Reschedule::where('user_id', $user->id)->with('keranjang', 'jenis_aduan', 'reply_aduan')->latest()->paginate(10);
        // dd($aduan);

        return view('home.daftarPemesanan', [
            'transaksi' => $transaksi,
            'aduan' => $aduan
        ]);
    }

    public function refreshPemesanan($id)
    {
        $transaksi = Transaksi::where('order_id', $id)->first();
        $transaksi_keranjang = $transaksi->keranjang()->get();
        $keranjang = [];
        foreach ($transaksi_keranjang as $ker) {
            $ker->update([
                'status_id' => 1
            ]);
            $keranjang[] = $ker->id;
        }
        $transaksi->update([
            'status' => '0',
        ]);
        //detach all keranjang from transaksi
        $transaksi->keranjang()->detach();
        return redirect('/keranjang/checkout?' . http_build_query(['keranjang' => $keranjang]))->with('success', 'Pemesanan berhasil diperbarui');
    }

    //deceased, hanya sebagai referensi
    public function downloadTiket($id)
    {
        $tiket = Transaksi::where('id', $id)->first();

        $user = User::where('id', $tiket->user_id)->first();

        if ($tiket->paket_id === null) {
            $paket = null;
            $destinasi = Destinasi::where('id', $tiket->destinasi_id)->first();
        } else {
            $paket = Paket::where('id', $tiket->paket_id)->first();
            $destinasi = null;
        }

        $qrCodePath = public_path('qrcode/' . $tiket['id'] . '.png');
        $qrCode = QrCode::format('png')->size(200)->generate('id_tiket = ' . $tiket['id'] . ', nama = ' . $tiket['nama_pemesan'] . ', user_id = ' . $tiket['user_id'] . ', status = ' . $tiket['konfirmasi'], $qrCodePath);
        $qrCodeData = base64_encode(file_get_contents($qrCodePath));
        $dataQrCode = [
            'qrCodeData' => $qrCodeData
        ];

        // Simpan QR code ke storage (opsional)
        $qrCodeStoragePath = 'public/qrcode/' . $tiket['id'] . '.png';
        Storage::put($qrCodeStoragePath, file_get_contents($qrCodePath));

        // Mengambil path absolut ke gambar
        $imagePath = public_path('assets/img/logotulis.png');

        // Mengubah gambar menjadi base64
        $imageData = base64_encode(file_get_contents($imagePath));

        // Menyiapkan data untuk ditampilkan dalam view PDF
        $data = [
            'imageData' => $imageData
        ];

        $pdf = Pdf::loadView('home.pdf', ['tiket' => $tiket, 'user' => $user, 'destinasi' => $destinasi, 'paket' => $paket, 'data' => $data, 'dataQrCode' => $dataQrCode]);

        return $pdf->download($id . '.pdf');
    }

    public function map()
    {
        return view('home.tutorialMap');
    }

    public function formAduan($id)
    {
        $tiket = Transaksi::where('id', $id)->first();
        $keranjang = $tiket->keranjang()->get();

        $jenisAduan = JenisAduan::where('status', true)->get();

        return view('home.formAduan', [
            'tiket' => $tiket,
            'jenisAduan' => $jenisAduan,
            'keranjang' => $keranjang
        ]);
    }

    public function aduan(Request $request, $id)
    {
        $request->validate([
            'noTransaksi' => 'required',
            'jenisAduan' => 'required',
            'keranjang' => 'required',
            'detailAduan' => 'required',
            'lampiran' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Pisahkan data "keranjang" dan "tanggalAwal"
        $data = explode("|", $request->keranjang);

        // Ambil nilai masing-masing variabel
        $keranjang_id = $data[0];
        $tanggalAwal = $data[1];

        // lampiran
        if ($request->hasfile('lampiran')) {
            $gambar = $request->file('lampiran');
            $namaGambar = time() . '.' . $gambar->extension();
            $gambar->move(public_path('lampiran'), $namaGambar);

            if ($request->jenisAduan == '1') {
                $request->validate([
                    'tanggalBaru' => 'required',
                ]);

                Reschedule::create([
                    'jenis_aduan_id' => $request->jenisAduan,
                    'order_id' => $request->noTransaksi,
                    'user_id' => Auth::user()->id,
                    'detail' => $request->detailAduan,
                    'keranjang_id' => $keranjang_id,
                    'tanggalAwal' => $tanggalAwal,
                    'tanggalBaru' => $request->tanggalBaru,
                    'lampiran' => $namaGambar,
                    'status' => 'pending'
                ]);

                return redirect('daftar-pemesanan')->with('success', 'Aduan berhasil dikirim');
            } elseif ($request->jenisAduan == '2') { // refund (BELUM)
                $request->validate([
                    'tindakLanjut' => 'required',
                ]);
                return redirect()->route('home.daftarPemesanan')->with('success', 'Aduan berhasil dikirim');
            }
        } else {
            if ($request->jenisAduan == '1') {
                $request->validate([
                    'tanggalBaru' => 'required',
                ]);

                Reschedule::create([
                    'jenis_aduan_id' => $request->jenisAduan,
                    'order_id' => $request->noTransaksi,
                    'user_id' => Auth::user()->id,
                    'detail' => $request->detailAduan,
                    'keranjang_id' => $keranjang_id,
                    'tanggalAwal' => $tanggalAwal,
                    'tanggalBaru' => $request->tanggalBaru,
                    'status' => 'pending'
                ]);

                return redirect('daftar-pemesanan')->with('success', 'Aduan berhasil dikirim');
            } elseif ($request->jenisAduan == '2') { // refund (BELUM)
                $request->validate([
                    'tindakLanjut' => 'required',
                ]);
                return redirect()->route('home.daftarPemesanan')->with('success', 'Aduan berhasil dikirim');
            }
        }
    }

    public function keranjang()
    {
        $user = User::isAuth()->first();
        $keranjang = $user->keranjang()->status(1)->latest()->get();

        return view('home.keranjang', [
            'keranjang' => $keranjang
        ]);
    }

    public function editKeranjang($id)
    {
        $keranjang = Keranjang::where('id', $id)->with([
            'paketWahana' => function ($query) {
                $query->isWahana()->aktif()->wherePivot('index', 1);
            },
        ])->first();

        if ($keranjang->tipe == "destinasi") {
            $destinasi = $keranjang->destinasi()->aktif()->with([
                'paketWahana' => function ($query) {
                    $query->isWahana()->aktif()->with('wahana:nama_wahana');
                },
                'wahana' => function ($query) {
                    $query->aktif();
                },
            ])->first();
            return view('home.editKeranjangDestinasi', [
                'keranjang' => $keranjang,
                'destinasi' => $destinasi
            ]);
        } else if ($keranjang->tipe == "paket") {
            $paket = $keranjang->paketDestinasi()->first();
            return view('home.editKeranjangPaket', [
                'keranjang' => $keranjang,
                'paket' => $paket,
            ]);
        }
        return redirect()->back()->with('error', 'Keranjang tidak ditemukan');
    }

    public function updateKeranjangDes(Request $request, $id)
    {
        try {
            $request->validate([
                'tanggal' => 'required|date|after_or_equal:today',
                'destinasi' => 'required|integer',
                'jumlah' => 'required|integer|min:1',
                'wahana' => 'required|array',
            ]);
            $keranjang = Keranjang::where('id', $id)->first();
            $destinasi = Destinasi::id($request->destinasi)->aktif()->first();

            $harga_total_wahana = 0;

            foreach ($request->wahana as $wahana) {
                if ($wahana != "0") {
                    //memverifikasi paket wahana
                    $paket = $destinasi->paketWahana()->aktif()->id($wahana)->isWahana()->first();

                    //jika paket wahana tidak valid
                    if ($paket == null) {
                        throw new \Exception('ada paket wahana yang tidak valid');
                    }

                    //menambahkan harga total
                    $harga_total_wahana += $paket->harga_paket;
                }
            }

            //menghitung total harga di keranjang
            $total_keranjang = $destinasi['htm_destinasi'] + $harga_total_wahana;

            $keranjang_up = $keranjang->update([
                'jumlah' => $request->jumlah,
                'total_pembayaran' => $total_keranjang,
                'tanggal_kunjungan' => $request->tanggal,
            ]);

            if ($keranjang_up) {
                $keranjang->paketDestinasi()->detach();
                $keranjang->destinasi()->detach();
                $keranjang->paketWahana()->detach();

                //menambahkan paket wahana ke keranjang
                for ($i = 1; $i <= $request->jumlah; $i++) {
                    foreach ($request->wahana as $wahana) {
                        if ($wahana != "0") {
                            $keranjang->paketWahana()->attach($wahana, [
                                'index' => $i,
                                'destinasi_id' => $destinasi->id
                            ]);
                        } else {
                            $keranjang->destinasi()->attach($destinasi->id, [
                                'index' => $i
                            ]);
                        }
                    }
                }
            } else {
                throw new \Exception('gagal mengupdate keranjang');
            }

            return redirect()->to('/keranjang')->with('success', 'Berhasil menambahkan ke keranjang');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'gagal melakukan pemesanan',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'gagal melakukan pemesanan',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function updateKeranjangPaket(Request $request, $id)
    {
        try {
            $request->validate([
                'tanggal' => 'required|date|after_or_equal:today',
                'paket' => 'required|integer',
                'jumlah' => 'required|integer|min:1',
                'wahana' => 'required|array',
            ]);
            $keranjang = Keranjang::where('id', $id)->first();
            $paket = Paket::id($request->paket)->isDestinasi()->aktif()->first();

            //harga total wahana
            $harga_total_wahana = 0;

            foreach ($request->wahana as $destinasi_id => $wahana_id) {

                //memverifikasi destinasi
                $destinasi = $paket->destinasi()->where('aktif', true)->where('destinasi.id', $destinasi_id)->first();

                if ($destinasi == null) {
                    throw new \Exception('ada destinasi yang tidak valid');
                }
                //setiap id didalam array wahana_id
                foreach ($wahana_id as $id_wahana) {

                    //jika id wahana tidak 0
                    if ($id_wahana != 0) {

                        //memverifikasi paket wahana
                        $paket_wahana = $destinasi->paketWahana()->where('aktif', true)->where('id', $id_wahana)->first();
                        if ($paket_wahana == null) {
                            throw new \Exception('ada paket wahana yang tidak valid');
                        }

                        //menambahkan harga total
                        $harga_total_wahana += $paket_wahana->harga_paket;
                    }
                }
            }

            //menghitung total harga dan membuat order_id
            $total_keranjang = $paket['harga_paket'] + $harga_total_wahana;

            $keranjang_up = $keranjang->update([
                'jumlah' => $request->jumlah,
                'total_pembayaran' => $total_keranjang,
                'tanggal_kunjungan' => $request->tanggal,
            ]);

            if ($keranjang_up) {
                $keranjang->paketDestinasi()->detach();
                $keranjang->destinasi()->detach();
                $keranjang->paketWahana()->detach();
                //menambahkan paket wahana ke keranjang
                for ($i = 1; $i <= $request->jumlah; $i++) {
                    foreach ($request->wahana as $destinasi_id => $wah_id) {
                        foreach ($wah_id as $id_wah) {
                            if ($id_wah != 0) {
                                $keranjang->paketWahana()->attach($id_wah, [
                                    'index' => $i,
                                    'destinasi_id' => $destinasi_id,
                                    'paket_destinasi_id' => $paket->id
                                ]);
                            } else {
                                $keranjang->destinasi()->attach($destinasi_id, [
                                    'index' => $i,
                                    'paket_destinasi_id' => $paket->id
                                ]);
                            }
                        }
                    }
                }
            } else {
                throw new \Exception('gagal mengupdate keranjang');
            }

            return redirect()->to('/keranjang')->with('success', 'Berhasil menambahkan ke keranjang');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $pop = [
                'head' => 'gagal melakukan pemesanan',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $e->validator->errors()->all()) . '</li></ul>',
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        } catch (\Exception $e) {
            $pop = [
                'head' => 'gagal melakukan pemesanan',
                'body' => $e->getMessage(),
                'status' => 'error'
            ];
            return redirect()->back()->with('pop-up', $pop);
        }
    }

    public function hapusKeranjang($id)
    {
        $keranjang = Keranjang::where('id', $id)->first();
        //delete all keranjang's relation trough keranjangItem pivot table
        $keranjang->paketDestinasi()->detach();
        $keranjang->destinasi()->detach();
        $keranjang->paketWahana()->detach();
        $keranjang->delete();

        return redirect()->back()->with('success', 'Keranjang berhasil dihapus');
    }

    public function wallet()
    {
        return view('home.wallet');
    }

    public function newDownloadTiket($order_id)
    {
        $transaksi = Transaksi::where('order_id', $order_id)->where('status', '1')->first();
        SadewaPDF::Invoice($transaksi->order_id)->Output('I', 'Surat transaksi ' . $transaksi->order_id . '.pdf');
    }

    public function detailTiket($order_id)
    {
        $transaksi = Transaksi::where('order_id', $order_id)->first();
        $user = $transaksi->user;
        $keranjang = $transaksi->keranjang()->with([
            'tikets',
            'destinasi' => function ($query) {
                $query->wherePivot('index', 1);
            },
            'paketWahana'
        ])->get();

        $kodeTiketUnik = [];

        foreach ($keranjang as $item) {
            foreach ($item->tikets as $tiket) {
                $kodeTiket = $tiket->kode_tiket;
                // Periksa apakah kode tiket sudah ada dalam array $kodeTiketUnik
                if (!in_array($kodeTiket, $kodeTiketUnik)) {
                    // Jika belum, tambahkan ke array
                    $kodeTiketUnik[] = $kodeTiket;
                }
            }
        }

        $tikets = Tikets::whereIn('kode_tiket', $kodeTiketUnik)->with('wahana')->get();

        // return response()->json([
        //     'user' => $user,
        //     'transaksi' => $transaksi->with('jenisPembayaran')->first(),
        //     'keranjang' => $keranjang,
        //     'tikets' => $tikets
        // ]);
        return view('home.detailTiket', [
            'user' => $user,
            'transaksi' => $transaksi->with('jenisPembayaran')->first(),
            'keranjang' => $keranjang,
            'tikets' => $tikets
        ]);
    }

    //testing
    public function testingEmail()
    {
        Mail::to("fauzi.ardiantama@gmail.com")->send(new baseMail(
            [
                "view" => "emails.base",
                "from" => [
                    "address" => "sadewa.no-reply@paling.kencang.id",
                    "name" => "Notifikasi SADEWA"
                ],
                "tags" => ["test", "sadewa", "notifikasi"],
                "subject" => "Base design",
                "content" => "Hello World!"
            ]
        ));
        return response()->json([
            'status' => 'ok'
        ]);
    }

    //testing
    public function testHelper()
    {
        // $transaksi = Transaksi::where('id',8)->first();
        // $keranjang_first = $transaksi->keranjang()->first();
        // $tiket_first = $keranjang_first->tikets()->first();

        // $output = SadewaPDF::Invoice($transaksi->order_id)->Output('S', 'Surat transaksi ' . $transaksi->order_id . '.pdf');
        // Mail::to("fauzi.ardiantama@gmail.com")->send(new baseMail(
        //     [
        //         "view" => "emails.base",
        //         "from" => [
        //             "address" => "sadewa.no-reply@paling.kencang.id",
        //             "name" => "Notifikasi SADEWA"
        //         ],
        //         "tags" => [ "test", "sadewa", "notifikasi" ],
        //         "subject" => "Base design",
        //         "content" => "Hello World!",
        //         "attachments" => [
        //             [
        //                 "name" => "tiket.pdf",
        //                 "data" => $output,
        //                 "mime" => "application/pdf"
        //             ]
        //         ]
        //     ]
        // ));
        SadewaPDF::Tiket(1)->Output('I', 'Surat transaksi A-0001.pdf');
        //return SadewaPDF::Tiket(1);
    }


    public function storeReview(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'destinasi_id' => 'required|exists:destinasi,id',
                'rating' => 'required|numeric|between:1,5',
                'review_text' => 'required|string|max:1000',
            ]);

            // Cek apakah pengguna sudah pernah menulis review untuk destinasi ini (opsional)
            $existingReview = \App\Models\Review::where('destinasi_id', $validated['destinasi_id'])
                ->where('reviewer_id', auth()->id())
                ->exists();

            if ($existingReview) {
                return redirect()->back()->with('pop-up', [
                    'head' => 'Gagal menyimpan review',
                    'body' => 'Anda sudah menulis review untuk destinasi ini.',
                    'status' => 'error'
                ]);
            }

            // Simpan review ke database
            \App\Models\Review::create([
                'destinasi_id' => $validated['destinasi_id'],
                'reviewer_id' => auth()->id(),
                'rating' => $validated['rating'],
                'review_text' => $validated['review_text'],
                'tanggal' => now(),
                'jempol' => 0, // default jika belum ada mekanisme like
                'status' => 'aktif', // atau null / pending, tergantung kebutuhan
            ]);

            return redirect()->back()->with('pop-up', [
                'head' => 'Berhasil menyimpan review',
                'body' => 'Review Anda telah berhasil dikirim.',
                'status' => 'success'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = collect($e->errors())->flatten()->toArray();
            return redirect()->back()->with('pop-up', [
                'head' => 'Gagal menyimpan review',
                'body' => '<ul class="text-justify"><li>' . implode('</li><li>', $errors) . '</li></ul>',
                'status' => 'error'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('pop-up', [
                'head' => 'Gagal menyimpan review',
                'body' => $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    public function store_new(Request $request)
    {

        $kategori = is_array($request->kategori) ? $request->kategori : [$request->kategori];

        $review = new Review();
        $review->destinasi_id = $request->destinasi_id;
        $review->reviewer_id = auth()->id();
        $review->review_text = $request->review_text . " - " . implode(' ', $kategori);
        $review->rating = $request->rating;
        $review->status = 'pending';
        $review->jempol = 0;
        $review->rating = 0;
        $review->save();

        // Redirect ke halaman home dengan pesan sukses
        return redirect()->route('home')->with('success', 'Terima kasih atas preferensi Anda!');
    }
}
