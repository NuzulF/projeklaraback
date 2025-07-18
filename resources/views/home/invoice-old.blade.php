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

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        .tes {
            outline: 1px dashed red;
        }
    </style>
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

                            <div style="top:0;" class="collapse navbar-collapse position-relative main-menu-item justify-content-between"
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
                                                        <form id="logout-form" action="{{ url('logout') }}" class="d-none">
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
                                                    <button class="btn_cart pl-4 bg-transparent text-white" type="button" style="">
                                                        <i class="fas fa-shopping-cart"></i><span class="small pl-2">Keranjang</span>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-8 p-0">
                                                <div class="dropdown w-100">
                                                    <button class="btn_1 w-100 pl-4 text-justify rounded-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-user"></i> <span class="pl-2">{{ auth()->user()->name }}</span>
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
                                                        <li><a class="dropdown-item" href="{{ url('daftar-pemesanan') }}">
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
                                                        <form id="logout-form" action="{{ url('logout') }}" class="d-none">
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
    <section  class="mx-auto row  justify-content-center pb-2" style="margin-top: 100px">
        <div class="col-12 col-md-9" style="margin-top: 0">
            <div class="row">
                <div class="col-9 d-flex align-items-center">
                    <p class="text-center font-italic">bukti pembayaran</p>
                </div>
                <div class="col-3 text-right">
                    <a href="{{url('/pdf', $tiket['id'])}}" class="btn btn-success downloadTiket">Unduh Tiket</a>
                </div>
            </div>
        </div>
    </section>
    <section  class="mx-auto row">
        <div id="pesanTiket" class="blog unduhTiket col-12 col-md-9" style="margin-top: 0">
            <div class="container" data-aos="fade-up">
                    <div class="lanjutUnduh">
                        <div class="row justify-content-between border-bottom">
                            <div class="col-6 col-md-6 text-left">
                                <h2>Invoice</h2>
                            </div>
                            <div class="col-6 col-md-6 text-right">
                                <img src="{{ url('assets/img/Logo GoTripJava.png') }}" alt="logo" />
                            </div>
                        </div>
                        <div class="row justify-content-between pt-2">
                            <div class="col-12 col-md-6 pt-3 pb-3">
                                <div class="text-center">{!! $qrCode !!}</div>
                                <div class="text-center">
                                    <small>{{ $tiket->order_id }}</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <p class="col-5">Nama Pemesan</p>
                                    <p class="col-7">: {{ $tiket->nama_pemesan }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-5">No. telp</p>
                                    <p class="col-7">: {{ $tiket->no_telp_pemesan }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-5">Email</p>
                                    <p class="col-7">: {{ $tiket->email_pemesan }}</p>
                                </div>
                                <div class="row">
                                    <p class="col-5">No. Pemesanan</p>
                                    <p class="col-7">: {{ $tiket->order_id }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row table pt-5">
                            <h5 class="font-weight-bold">Pesanan Destinasi</h5>
                            <table class="table-sm table text-center mb-5">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:16%">Nama destinasi</th>
                                        <th scope="col" style="width:16%">Kategori</th>
                                        <th scope="col" style="width:16%">Alamat</th>
                                        <th scope="col" style="width:16%">Harga</th>
                                        <th scope="col" style="width:16%">Jumlah tiket</th>
                                        <th scope="col" style="width:16%">Tanggal Kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tiket->destinasi()->get() as $dest)
                                        <tr>
                                            <td class="text-justify">{{ $dest->nama_destinasi }}</td>
                                            <td >{{ $dest->kategori->nama_kategori }}</td>
                                            <td class="text-justify">{{ $dest->alamat_destinasi }}</td>
                                            <td>{{ $dest->htm_destinasi }}</td>
                                            <td>{{ $dest->pivot->jumlah_tiket }}</td>
                                            <td>{{ $dest->pivot->tanggal_kunjungan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-secondary">Tidak ada pesanan destinasi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <h5 class="font-weight-bold">Pesanan Wahana</h5>
                            <table class="table-sm table text-center mb-5">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:16%">Nama wahana</th>
                                        <th scope="col" style="width:32%">Destinasi</th>
                                        <th scope="col" style="width:16%">Harga</th>
                                        <th scope="col" style="width:16%">Jumlah tiket</th>
                                        <th scope="col" style="width:16%">Tanggal Kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tiket->wahana()->get() as $wah)
                                        <tr>
                                            <td class="text-justify">{{ $wah->nama_wahana }}</td>
                                            <td>{{ $wah->destinasi->nama_destinasi }}</td>
                                            <td>{{ $wah->htm_wahana }}</td>
                                            <td>{{ $wah->pivot->jumlah_tiket }}</td>
                                            <td>{{ $wah->pivot->tanggal_kunjungan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-secondary">Tidak ada pesanan wahana</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <h5 class="font-weight-bold">Pesanan Paket</h5>
                            <table class="table-sm table text-center mb-5">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:16%">Nama paket</th>
                                        <th scope="col" style="width:32%">Isi paket</th>
                                        <th scope="col" style="width:16%">Harga</th>
                                        <th scope="col" style="width:16%">Jumlah tiket</th>
                                        <th scope="col" style="width:16%">Tanggal Kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tiket->paket()->get() as $pak)
                                        <tr>
                                            <td class="text-justify">{{ $pak->nama_paket }}</td>
                                            <td class="text-justify">{{ !$pak->wahana()->get()->isEmpty() ? $pak->wahana()->first()->destinasi->nama_destinasi." : ".implode(' + ', optional($pak->wahana)->pluck('nama_wahana')->toArray()) : "" }}{{ implode(' + ', optional($pak->destinasi)->pluck('nama_destinasi')->toArray()) }}</td>
                                            <td>{{ $pak->harga_paket }}</td>
                                            <td>{{ $pak->pivot->jumlah_tiket }}</td>
                                            <td>{{ $pak->pivot->tanggal_kunjungan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-secondary">Tidak ada pesanan paket</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 p-0">
                                <h5 class="font-weight-bold">Detail lainnya</h5>
                                <div class="row">
                                    <p class="col-5 p-0">Tipe pembayaran</p>
                                    <p class="col-7">: {{ $midtrans['payment_type'] }}</p>
                                    <p class="col-5 p-0">Waktu transaksi</p>
                                    <p class="col-7">: {{ $midtrans['transaction_time'] }}</p>
                                    <p class="col-5 p-0">Bank</p>
                                    <p class="col-7">: {{ $midtrans['bank'] }}</p>
                                    <p class="col-5 p-0">Status transaksi</p>
                                    <p class="col-7">: {{ $midtrans['transaction_status'] == "capture" ? "diproses" : ($midtrans['transaction_status'] == "deny" ? "gagal" : "tidak diketahui") }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6 col-12 text-md-left text-center p-0">
                                <small>Terima kasih telah melakukan pemesanan tiket di GoTripJava.</small>
                            </div>
                            <div class="col-md-6 col-12 text-md-right text-center p-0">
                                <small>Copyright © 2023 All rights reserved | kontak : kontak@d3ti.vokasi.uns.ac.id</small>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>


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
