<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoTripJava</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}" />

    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }}" />

    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}" />

    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/themify-icons.css') }}" />

    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/flaticon.css') }}" />

    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('assets/fontawesome/css/all.min.css') }}" />

    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/gijgo.min.css') }}" />

    <!-- nice select CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/nice-select.css') }}" />

    <!-- slick CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/slick.css') }}" />

    <!-- style CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <header class="main_menu">
        <div class="main_menu_iner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ url('assets/img/Logo GoTripJava.png') }}" alt="logo" />
                            </a>
                            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div style="top:0;"
                                class="collapse navbar-collapse position-relative main-menu-item justify-content-between"
                                id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link is-active" href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('kabupaten') }}">Kabupaten</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('destinasi') }}">Destinasi</a>
                                    </li>
                                </ul>
                                <div class="navbar-nav ms-auto d-none d-lg-block">
                                    @guest
                                        <a href="{{ url('login') }}" class="btn_1 text-center">Login</a>
                                    @else
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <a href="{{ url('keranjang') }}">
                                                    <button class="btn_cart d-none d-lg-block" type="button">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="dropdown">
                                                    <button class="btn_1 d-none d-lg-block dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-user"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ url('wallet') }}">
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        Wallet
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <i class="fas fa-wallet"></i>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="{{ url('daftar-pemesanan') }}">
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        Pesanan
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <i class="fas fa-shopping-bag"></i>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="{{ url('logout') }}"
                                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        Logout
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <i class="fas fa-sign-out-alt"></i>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <form id="logout-form" action="{{ url('logout') }}"
                                                            class="d-none">
                                                            @csrf
                                                        </form>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endguest
                                </div>
                                <div class="navbar-nav ms-auto d-block d-lg-none">
                                    @guest
                                        <a href="{{ url('login') }}" class="btn_1 text-center">Login</a>
                                    @else
                                        <div class="row">
                                            <div class="col-12 col-lg-4 p-0" style="background: #092742;">
                                                <a href="{{ url('keranjang') }}" class="d-block w-100">
                                                    <button class="btn_cart pl-4 bg-transparent text-white" type="button"
                                                        style="">
                                                        <i class="fas fa-shopping-cart"></i><span
                                                            class="small pl-2">Keranjang</span>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-8 p-0">
                                                <div class="dropdown w-100">
                                                    <button class="btn_1 w-100 pl-4 text-justify rounded-0" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-user"></i> <span
                                                            class="pl-2">{{ auth()->user()->name }}</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ url('wallet') }}">
                                                                <div class="row">
                                                                    <div class="col-8 text-left">
                                                                        Wallet
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="fas fa-wallet"></i>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ url('daftar-pemesanan') }}">
                                                                <div class="row">
                                                                    <div class="col-8 text-left">
                                                                        Pesanan
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="fas fa-shopping-bag"></i>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="{{ url('logout') }}"
                                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                                <div class="row">
                                                                    <div class="col-8 text-left">
                                                                        Logout
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="fas fa-sign-out-alt"></i>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <form id="logout-form" action="{{ url('logout') }}"
                                                            class="d-none">
                                                            @csrf
                                                        </form>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ======= Blog Details Section ======= -->
    <section id="pesanan" class="pesanan">
        <div class="container" data-aos="fade-up">
            <div class="listPesanan">
                <h4>Pesanan Anda</h4>
                <table id="tablePesanan" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Destinasi</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Total Harga</th>
                            <th>Jenis Pembayaran</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tiket as $tik)
                            <tr>
                                <th scope="row">{{ $tik->order_id }}</th>
                                <th>{{ $tik->destinasi->first()->nama_destinasi }}</th>
                                <th>{{ $tik->destinasi->first()->pivot->tanggal_kunjungan }}</th>
                                <th>Rp.{{ number_format($tik->total_pembayaran, 0, ',', '.') }}</th>
                                <th>{{ $tik->jenisPembayaran->nama }}</th>
                                @if ($tik->status == 0)
                                    <th><i class="fas fa-plus-circle" style="rotate: 45deg; color: red;"></i></th>
                                @else
                                    <th><i class="fas fa-check-circle" style="color: green;"></i></th>
                                @endif
                                <th>
                                    <a class="edit-kategori btn-info1 btn-action mr-1" title="Edit"
                                        data-toggle="modal" data-target="#detail-{{ $tik->id }}"
                                        data-id="{{ $tik->id }}">
                                        <i class="fas fa-info" style="background-color: unset; color: white"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ url('/pdf', $tik->id) }}"><i class="fas fa-download"></i></a>
                                    <a href="{{ url('/form-aduan', $tik->id) }}" target="_blank"
                                        class="text-decoration-none"><i class="fas fa-headset"></i></a>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="6" class="text-center">belum ada data</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="margin-top: 25px">
            {{ $tiket->links() }}
        </div>
    </section>

    <section id="aduan" class="aduan">
        <div class="container" data-aos="fade-up">
            <div class="listAduan">
                <h4>Riwayat Aduan</h4>
                <table id="tableAduan" class="table table-striped fixed">
                    <thead>
                        <tr>
                            <th scope="col" width="147px">Aduan</th>
                            <th scope="col" width="225px">Tanggal Adaun</th>
                            <th scope="col" width="495px">Detail Aduan</th>
                            <th scope="col" width="137px">Status</th>
                            <th scope="col" width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Reschedule</th>
                            <th>10 September 2023</th>
                            <th style="text-align: left;" class="popup"
                                data-popuptext="Saya memesan tiket ke destinasi Hutan Pinus pada tanggal 15
                            September 2023, tetapi ternyata pada hari tersebut saya berkendala karena ternyata ada acara memperingati 7 hari meninggalnya
                            keluarga saya">
                                Saya memesan tiket ke destinasi Hutan Pinus pada tanggal 15...</th>
                            <th>Diterima</th>
                            <th><i class="fas fa-download"></i></th>
                        </tr>
                        <tr>
                            <th scope="row">Refund</th>
                            <th>20 Oktober 2023</th>
                            <th style="text-align: left;" class="popup"
                                data-popuptext="Saya tidak jadi melaksanakan liburan, dan ingin mengajukan
                            refund terhadap dana yang sudah saya bayarkan karena ada kegiatan mandadak">
                                Saya tidak jadi
                                melaksanakan liburan, dan ingin mengajukan...</th>
                            <th>Menunggu</th>
                            <th><i class="fas fa-download"></i></th>
                        </tr>
                        <tr>
                            <th scope="row">Refund</th>
                            <th>18 November 2023</th>
                            <th style="text-align: left;" class="popup"
                                data-popuptext="Kami sekeluarga ingin melakukan refund terhadap tiket yang
                            sudah kami beli, karena kami memiliki kegiatan yang lebih penting daripada liburan">
                                Kami
                                sekeluarga ingin melakukan refund terhadap tiket yang..</th>
                            <th>Ditolak</th>
                            <th><i class="fas fa-download"></i></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @foreach ($tiket as $tik)
        <div class="modal fade" id="detail-{{ $tik->id }}" tabindex="-1" role="dialog"
            aria-labelledby="detail-{{ $tik->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Header Modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Detail transaksi {{ $tik->order_id }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Body Modal -->
                    <div class="modal-body">
                        <div class="table table-responsive">
                            <h6>Pesanan Destinasi</h6>
                            <table class="d-none d-md-block table-sm table">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Nama destinasi</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah tiket</th>
                                        <th scope="col">Tanggal Kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tik->destinasi()->get() as $dest)
                                        <tr>
                                            <th scope="row">{{ $dest->id }}</th>
                                            <td>{{ $dest->nama_destinasi }}</td>
                                            <td>{{ $dest->kategori->nama_kategori }}</td>
                                            <td>{{ $dest->alamat_destinasi }}</td>
                                            <td>{{ $dest->htm_destinasi }}</td>
                                            <td>{{ $dest->pivot->jumlah_tiket }}</td>
                                            <td>{{ $dest->pivot->tanggal_kunjungan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada pesanan destinasi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-md-none">
                                @forelse ($tik->destinasi()->get() as $dest)
                                    <div class="card mb-1">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-6">{{ $dest->nama_destinasi }}</div>
                                                <div class="col-6 text-right">ID : {{ $dest->id }}</div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <div class="row">
                                                    <p class="col-4">Kategori</p>
                                                    <p class="col-8">: {{ $dest->kategori->nama_kategori }}</p>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Alamat</p>
                                                    <p class="col-8">: {{ $dest->alamat_destinasi }}</p>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Harga</p>
                                                    <p class="col-8">: {{ $dest->htm_destinasi }}</p>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Jml tiket</p>
                                                    <p class="col-8">: {{ $dest->pivot->jumlah_tiket }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Tgl kunjungan</p>
                                                    <p class="col-8">: {{ $dest->pivot->tanggal_kunjungan }}
                                                    </p>
                                                </div>
                                            </blockquote>
                                        </div>
                                    </div>
                                @empty
                                    <div>
                                        <p class="text-left mb-2">Tidak ada pesanan destinasi</p>
                                    </div>
                                @endforelse
                            </div>
                            <h6>Pesanan Wahana</h6>
                            <table class="d-none d-md-block table-sm table">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Nama wahana</th>
                                        <th scope="col">Destinasi</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah tiket</th>
                                        <th scope="col">Tanggal Kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tik->wahana()->get() as $wah)
                                        <tr>
                                            <th scope="row">{{ $wah->id }}</th>
                                            <td>{{ $wah->nama_wahana }}</td>
                                            <td>{{ $wah->destinasi->nama_destinasi }}</td>
                                            <td>{{ $wah->htm_wahana }}</td>
                                            <td>{{ $wah->pivot->jumlah_tiket }}</td>
                                            <td>{{ $wah->pivot->tanggal_kunjungan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada pesanan wahana</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-md-none">
                                @forelse ($tik->wahana()->get() as $wah)
                                    <div class="card mb-1">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-6">{{ $wah->nama_wahana }}</div>
                                                <div class="col-6 text-right">ID : {{ $wah->id }}</div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <div class="row">
                                                    <p class="col-4">Destinasi</p>
                                                    <p class="col-8">: {{ $wah->destinasi->nama_destinasi }}</p>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Harga</p>
                                                    <p class="col-8">: {{ $wah->htm_wahana }}</p>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Jml tiket</p>
                                                    <p class="col-8">: {{ $wah->pivot->jumlah_tiket }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Tgl kunjungan</p>
                                                    <p class="col-8">: {{ $wah->pivot->tanggal_kunjungan }}
                                                    </p>
                                                </div>
                                            </blockquote>
                                        </div>
                                    </div>
                                @empty
                                    <div>
                                        <p class="text-left mb-2">Tidak ada pesanan wahana</p>
                                    </div>
                                @endforelse
                            </div>
                            <h6>Pesanan Paket</h6>
                            <table class="d-none d-md-block table-sm table">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Nama paket</th>
                                        <th scope="col">Isi paket</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah tiket</th>
                                        <th scope="col">Tanggal Kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tik->paket()->get() as $pak)
                                        <tr>
                                            <th scope="row">{{ $pak->id }}</th>
                                            <td>{{ $pak->nama_paket }}</td>
                                            <td>{{ !$pak->wahana()->get()->isEmpty()? $pak->wahana()->first()->destinasi->nama_destinasi .' : ' .implode(' + ',optional($pak->wahana)->pluck('nama_wahana')->toArray()): '' }}{{ implode(' + ',optional($pak->destinasi)->pluck('nama_destinasi')->toArray()) }}
                                            </td>
                                            <td>{{ $pak->harga_paket }}</td>
                                            <td>{{ $pak->pivot->jumlah_tiket }}</td>
                                            <td>{{ $pak->pivot->tanggal_kunjungan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada pesanan paket</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-md-none">
                                @forelse ($tik->paket()->get() as $pak)
                                    <div class="card mb-1">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-6">{{ $pak->nama_paket }}</div>
                                                <div class="col-6 text-right">ID : {{ $pak->id }}</div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <div class="row">
                                                    <p class="col-4">Isi</p>
                                                    <p class="col-8">:
                                                        {{ !$pak->wahana()->get()->isEmpty()? $pak->wahana()->first()->destinasi->nama_destinasi .' : ' .implode(' + ',optional($pak->wahana)->pluck('nama_wahana')->toArray()): '' }}{{ implode(' + ',optional($pak->destinasi)->pluck('nama_destinasi')->toArray()) }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Harga</p>
                                                    <p class="col-8">: {{ $pak->harga_paket }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Jml tiket</p>
                                                    <p class="col-8">: {{ $pak->pivot->jumlah_tiket }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-4">Tgl kunjungan</p>
                                                    <p class="col-8">: {{ $pak->pivot->tanggal_kunjungan }}
                                                    </p>
                                                </div>
                                            </blockquote>
                                        </div>
                                    </div>
                                @empty
                                    <div>
                                        <p class="text-left mb-2">Tidak ada pesanan paket</p>
                                    </div>
                                @endforelse
                            </div>
                            <h6>Detail lainnya</h6>
                            <table class="table-sm table" style="min-width:0;">
                                <tbody>
                                    <tr class="row m-0">
                                        <th class="col-6" scope="row">Order ID</th>
                                        <td class="col-6">{{ $tik->order_id }}</td>
                                    </tr>
                                    <tr class="row m-0">
                                        <th class="col-6" scope="row">Nama pemesan</th>
                                        <td class="col-6">{{ $tik->nama_pemesan }}</td>
                                    </tr>
                                    <tr class="row m-0">
                                        <th class="col-6" scope="row">No telp</th>
                                        <td class="col-6">{{ $tik->email_pemesan }}</td>
                                    </tr>
                                    <tr class="row m-0">
                                        <th class="col-6" scope="row">Total bayar</th>
                                        <td class="col-6">{{ $tik->total_pembayaran }}</td>
                                    </tr>
                                    <tr class="row m-0">
                                        <th class="col-6" scope="row">Jenis pembayaran</th>
                                        <td class="col-6">{{ $tik->jenisPembayaran->nama }}</td>
                                    </tr>
                                    <tr class="row m-0">
                                        <th class="col-6" scope="row">Status Pembayaran</th>
                                        <td clas="col-6">{{ $tik->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <footer class="footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-7">
                    <div class="single-footer-widget">
                        <h4 id="JudulFooter">GoTripJava</h4>
                        <p>
                            GoTripJava merupakan layanan promosi desa wisata yang akan membantu calon wisatawan untuk
                            memesan dan memperoleh informasi yang dibutuhkan dengan cara cepat dan mudah. <br><br>
                            Cari dan pesan tiket wisatamu sekarang hanya di GoTripJava!
                        </p>
                        <img src="{{ url('assets/img/logo/Logo UNS (1).png') }}" alt="UNS">
                        <img src="{{ url('assets/img/logo/LogoTypeSV-01.png') }}" alt="SV">
                        <img src="{{ url('assets/img/logo/LOGO PRODI UNS.png') }}" alt="D3TI">
                        <img src="{{ url('assets/img/logo/OASE Tanpa BG.jpg') }}" alt="OASE">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_icon">
                        <h4>Contact Us</h4>
                        <p>
                            Kampus Mesen UNS, Jl. Jend. Urip Sumoharjo No.116,
                            Purwodiningratan, Kec. Jebres, Kota Surakarta, Jawa Tengah 57129
                            <br />(0271) 663450
                        </p>
                        <span>kontak@d3ti.vokasi.uns.ac.id</span>
                        <div class="social-icons">
                            <a href="https://web.facebook.com/d3tiuns" target="_blank"><i
                                    class="ti-facebook"></i></a>
                            <a href="https://d3ti.vokasi.uns.ac.id/" target="_blank"><i class="ti-world"></i></a>
                            <a href="https://www.youtube.com/@teknikinformatikauns" target="_blank"><i
                                    class="ti-youtube"></i></a>
                            <a href="https://www.instagram.com/d3tiuns/?igshid=MzRlODBiNWFlZA%3D%3D"
                                target="_blank"><i class="ti-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="copyright_part_text text-center">
                        <p class="footer-text m-0">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->


    <!-- jquery plugins here-->
    <script src="{{ url('assets/js/jquery-1.12.1.min.js') }}"></script>

    <!-- popper js -->
    <script src="{{ url('assets/js/popper.min.js') }}"></script>

    <!-- bootstrap js -->
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

    <!-- magnific js -->
    <script src="{{ url('assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('assets/js/masonry.pkgd.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ url('assets/js/gijgo.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ url('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.form.js') }}"></script>
    <script src="{{ url('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('assets/js/mail-script.js') }}"></script>
    <script src="{{ url('assets/js/contact.js') }}"></script>

    <!-- custom js -->
    <script src="{{ url('assets/js/custom.js') }}"></script>
</body>

</html>
