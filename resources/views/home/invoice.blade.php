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
    @include('components.css-pop-up')

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        .tes {
            outline: 1px dashed red;
        }
        .qr-code svg {
            width: 200px;
            height: 200px;
        }
        /* .qr-code {
            position: fixed;
            z-index: 9999;
            right: 0;
            left: 0;
            top: 0;
            bottom: 0;
            padding-top: 20%;
            background: rgba(255,255,255);
        } */

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

    <section class="detailHeadDesa section_padding">
        <div class="head_tittle">
            <h2>ID : {{ $transaksi->order_id}}</h2>
        </div>
    </section>

    <!-- ======= Blog Details Section ======= -->
    <section id="invoiceDetail" class="blog invoiceDetail">
            <div class="row w-100 m-auto justify-content-around">
                <div class="col-12 col-md-7 container p-0 m-2" data-aos="fade-up">
                    <div class="invoiceTukar mt-0">
                        <div class="row justify-content-between border-bottom">
                            <div class="col-12 text-left">
                                <h3>Paket yang dipesan</h3>
                            </div>
                        </div>
                        <div class="row justify-content-between pt-2">
                            <div class="col-12">
                                @foreach($transaksi->keranjang as $keranjang)
                                    <div class="row">
                                        <h5 class="col-12">Keranjang {{ $loop->index+1 }} ({{ $keranjang->tipe }}) x{{ $keranjang->jumlah }}</h5>
                                    </div>
                                    <div class="row">
                                        @if ($keranjang->tipe == "destinasi")
                                            @forelse($keranjang->paketWahana as $pak_wahana)
                                                @if($pak_wahana->pivot->index == 1)
                                                <div class="col-12 row">
                                                    <p class="col-12">{{ $pak_wahana->nama_paket }}</p>
                                                </div>
                                                @endif
                                            @empty
                                                <div class="col-12 row">
                                                    <p class="col-12">Tidak ada paket yang dipesan</p>
                                                </div>
                                            @endforelse
                                        @else
                                            @forelse($keranjang->destinasi as $destinasi)
                                                @if($destinasi->pivot->paket_wahana_id != null)
                                                    <div class="col-12 row">
                                                        @foreach($keranjang->paketWahana as $pak_wahana)
                                                            @if($pak_wahana != null && $pak_wahana->id == $destinasi->pivot->paket_wahana_id)
                                                                <p class="col-12">{{ $pak_wahana->nama_paket }} ({{ $destinasi->nama_destinasi }})</p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="col-12 row">
                                                        <p class="col-12">{{ $destinasi->nama_destinasi }}</p>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="col-12 row">
                                                    <p class="col-12">Tidak ada paket yang dipesan</p>
                                                </div>
                                            @endforelse
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="invoiceCara mt-5">
                        <div class="row justify-content-between border-bottom">
                            <div class="col-12 text-left">
                                <h3 class="text-white">Cara menukarkan tiket</h3>
                            </div>
                        </div>
                        <div class="row justify-content-between pt-2">
                            <div class="col-12">
                                <p class="text-white">
                                    1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit dolor veniam voluptate neque laboriosam voluptatibus sint dignissimos, sed soluta iure cum cumque? Sed debitis molestiae expedita vero vel placeat distinctio. <br>
                                    2. Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis porro corporis, vel harum laudantium hic, ut aut aliquid laborum delectus aperiam nemo aspernatur architecto, ducimus explicabo tempore nulla consequatur impedit!<br>
                                    3. Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate voluptate ipsum sequi labore rem blanditiis sunt, quia ratione commodi dolor repudiandae, totam praesentium iure mollitia. Perspiciatis earum aperiam ullam labore!<br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 container p-0 m-2" data-aos="fade-up">
                    <div class="invoiceTukar mt-0" style="width:auto;">
                        <div class="row justify-content-between border-bottom">
                            <div class="col-12 text-left">
                                <h3>Detail pemesanan</h3>
                            </div>
                        </div>
                        <div class="row justify-content-between pt-2">
                            <div class="col-12">
                                <div class="row mb-1">
                                    <div class="col-6">
                                        Nama
                                    </div>
                                    <div class="col-6">
                                        {{ $transaksi->nama_pemesan }}
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-6">
                                        Email
                                    </div>
                                    <div class="col-6">
                                        {{ $transaksi->email_pemesan }}
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-6">
                                        No telp
                                    </div>
                                    <div class="col-6">
                                        {{ $transaksi->no_telp_pemesan }}
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-6">
                                        Tipe pembayaran
                                    </div>
                                    <div class="col-6">
                                        {{ $transaksi->jenisPembayaran->nama ?? "belum ada" }}
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-6">
                                        Total pembayaran
                                    </div>
                                    <div class="col-6">
                                        @currency($transaksi->total_pembayaran)
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-6">
                                        Status pembayaran
                                    </div>
                                    <div class="col-6">
                                        {{ $transaksi->status == '1'? 'Sudah dibayar' : 'Belum dibayar' }}
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <a href="{{url('/pdf', $transaksi->order_id)}}" class="btn btn-success w-100">Unduh Bukti Pembayaran</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-auto w-auto d-flex justify-content-center pt-5">
                            <div class="text-center qr-code">
                                {!! $qrCode !!}
                                <div class="text-center pt-2">
                                    <h2 class="text-dark"><strong>{{ $transaksi->order_id }}</strong></h2>
                                </div>
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
    @include('components.pop-up')

</body>

</html>
