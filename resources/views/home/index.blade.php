{{-- 'banner', 'kategori', 'regency', 'destinasi', 'kabupaten', 'desa', 'village' --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GoTripJava</title>
    <link href="{{ url('/assets/img/Logo.png') }}" rel="icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/bootstrap.min.css') }}" />

    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/animate.css') }}" />

    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}" />

    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/themify-icons.css') }}" />

    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/flaticon.css') }}" />

    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('/assets/fontawesome/css/all.min.css') }}" />

    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ url('/assets/css/gijgo.min.css') }}" />

    <!-- nice select CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/nice-select.css') }}" />

    <!-- slick CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/slick.css') }}" />

    <!-- style CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/style.css') }}" />
    @include('components.css-pop-up')
    <style>
        .nc_select+.nice-select .list {
            max-height: 500px;
            /* Set a fixed height for the dropdown */
            overflow-y: auto;
            /* Add a vertical scrollbar if needed */
        }

        select.nc_select+div {
            height: 54px !important;
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

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (!$pernahReview)
        <!-- Modal untuk review pertama -->
        <div class="modal fade" id="firstReviewModal" tabindex="-1" aria-labelledby="firstReviewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="firstReviewModalLabel">Tulis Preferensi Wisatamu!</h5>
                            <!-- Tombol Tutup modal -->
                            <button type="button" class="btn-close" data-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Pilihan Kategori Wisata -->
                            <div class="mb-3">
                                <div id="kategoriContainer" class="d-flex flex-wrap">
                                    <!-- Render kategori dari backend -->
                                    @foreach ($kategoriList as $kat)
                                        <button type="button" class="btn btn-outline-primary m-1 category-btn"
                                            data-category="{{ $kat }}">
                                            {{ $kat }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Textarea untuk review -->
                            <div class="mb-3">
                                <label for="review_text" class="form-label">Preferensi Wisata</label>
                                <textarea name="review_text" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Tombol Kirim Review -->
                            <button type="submit" class="btn btn-primary">Kirim Review</button>
                            <!-- Tombol Batal untuk menutup modal tanpa mengirim -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endif

    <div id="carouselExampleIndicators" class="banner_part carousel slide" data-ride="carousel"
        style="max-height: 350px;height:auto;">
        <ol class="carousel-indicators">
            @foreach ($banner as $key => $image)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                    @if ($key == 0) class="active" @endif></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($banner as $key => $image)
                <div class="carousel-item @if ($key == 0) active @endif">
                    <img src="{{ asset('images/' . $image) }}" class="d-block w-100" style="max-height: 350px;"
                        alt="Image {{ $key }}">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!--::Search Bar Start::-->
    <section class="booking_part" style="margin-top: -20px;">
        <div class="container">
            <div class="col-lg-12">
                <div class="booking_menu">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="hotel-tab" data-toggle="tab" href="#hotel"
                                role="tab" aria-controls="hotel" aria-selected="true">Destinasi</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="booking_content">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="hotel" role="tabpanel"
                            aria-labelledby="hotel-tab">
                            <div class="booking_form">
                                <form action="/destinasi">
                                    <div class="form-row">
                                        <div class="form_colum mr-lg-1">
                                            <select class="nc_select wide" name="kabupaten">
                                                @foreach ($regency as $kab)
                                                    <option value="{{ $kab['name'] }}">
                                                        {{ $kab['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form_colum mr-lg-1">
                                            <select class="nc_select wide" name="kategori">
                                                @foreach ($kategori as $kat)
                                                    <option value="{{ $kat['nama_kategori'] }}">
                                                        {{ $kat['nama_kategori'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form_btn m-auto">
                                            <button type="submit" style="height:54px" class="btn_2">search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::Search Bar End::-->
    <br /><br />

    <!--::Destinasi Wisata Start -->
    <section class="recent-posts section_padding">
        <div class="container" data-aos="fade-up">
            <div class="section_tittle text-center">
                <h2>Destinasi Wisata</h2>
                <p>Jelajahi berbagai destinasi menarik</p>
            </div>
            <div class="row gy-4">
                @forelse ($destinasi as $dest)
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ url('destinasi', $dest['id']) }}">
                            <article>
                                <div id="carouselExampleSlidesOnly" class="carousel slide post-img"
                                    data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach (explode('|', $dest['foto_destinasi']) as $key => $image)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('images/' . $image) }}" class="d-block w-100"
                                                    alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @foreach ($kategori as $kat)
                                    @if ($dest['kategori_id'] == $kat->id)
                                        <p class="post-category">Wisata {{ $kat->nama_kategori }}</p>
                                    @endif
                                @endforeach
                                <h2 class="title">{{ $dest['nama_destinasi'] }}</h2>
                                <div class="d-flex align-items-center">
                                    <div class="post-meta">
                                        @foreach ($kabupaten as $reg)
                                            @if ($dest['regency_id'] == $reg->regency_id)
                                                <p class="post-author"><i class="fas fa-location-arrow"
                                                        style="margin-right: 5px;"></i>{{ $reg->nama_kabupaten }}
                                                </p>
                                            @endif
                                        @endforeach
                                        <p class="post-date">@currency($dest['htm_destinasi'])</p>
                                    </div>
                                </div>
                            </article>
                        </a>
                    </div><!-- End post list item -->
                @empty
                    <div class="col-lg-12 col-md-12 mb-5 text-center">
                        <p>Tidak ada destinasi</p>
                    </div>
                @endforelse
            </div><!-- End recent posts list -->
        </div>
    </section>
    <!--::Destinasi Wisata End -->

    <!--::Kategori Start::-->
    <section id="kategori" class="kategori">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="section_tittle text-center">
                        <h2>Kategori</h2>
                    </div>
                </div>
            </div>

            <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
                @forelse ($kategori as $kate)
                    <div class="col-lg-4 col-md-6 mb-30">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="{{ $kate['icon'] }}"></i>
                            </div>
                            <h3>{{ $kate['nama_kategori'] }}</h3>
                            <p>
                                {!! $kate['deskripsi'] !!}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Tidak ada kategori</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!--::Kategori End::-->

    <section class="client_review section_padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="section_tittle">
                        <h2>Explore Kabupaten</h2>
                        <p>Temukan Desa Wisata menarik di beberapa Kabupaten Wisata</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="client_review_slider owl-carousel">
                        @foreach ($regency as $kab)
                            <a href="{{ url('kabupaten/' . $kab->id) }}">
                                <div class="single_review_slider">
                                    <div class="place_review">
                                        <img src="{{ asset('images/' . optional($kab->profilKabupaten)->foto_kabupaten ?? 'kabupaten_default.jpg') }}"
                                            alt="" />
                                        <h4>{{ $kab->name }}</h4>
                                        {{-- dapat village dari distrik dari kabupaten yang memiliki destinasi lalu di hitung --}}
                                        <span>{{ $kab->profildesa_count ?? 0 }}
                                            Desa Wisata</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="{{ url('kabupaten') }}" class="btn_1 text-cnter">Discover more</a>
        </div>
    </section>
    <!--::Kabupaten End::-->

    <!--::Desa Wisata Start::-->
    {{-- <section class="top_place section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="section_tittle text-center">
                        <h2>Desa Wisata</h2>
                        <p>Jelajahi berbagai Desa Wisata yang memiliki beranekaragam destinasi di dalamnya</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($village as $des)
                    @php
                        $p_desa = $des->profilDesa;
                        $foto_desa = explode('|', $p_desa->foto_desa ?? 'kabupaten_default.jpg');
                    @endphp
                    <div class="col-lg-6 col-md-6">
                        <div class="single_place">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($foto_desa as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('images/' . $image) }}" class="d-block w-100"
                                                alt="...">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="hover_Text d-flex align-items-end justify-content-between">
                                <div class="hover_text_iner">
                                    <a href="{{ url('desa', $des['id']) }}" class="place_btn">Kunjungi</a>
                                    <h3>{{ $p_desa->nama_desa }}</h3>
                                    <p>{{ $p_desa->alamat_desa }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 col-md-12 mb-5 text-center">
                        <p>Tidak ada desa</p>
                    </div>
                @endforelse
                <a href="{{ url('desa') }}" class="btn_1 text-cnter">Discover more</a>
            </div>
        </div>
    </section> --}}
    <!--::Desa Wisata End::-->



    <footer class="footer-area" style="">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-7">
                    <div class="single-footer-widget">
                        <h4 id="JudulFooter">GoTripJava</h4>
                        <p>
                            GoTripJava merupakan layanan promosi desa wisata yang akan membantu calon wisatawan
                            untuk
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
    <script src="{{ url('/assets/js/jquery-1.12.1.min.js') }}"></script>

    <!-- popper js -->
    <script src="{{ url('/assets/js/popper.min.js') }}"></script>

    <!-- bootstrap js -->
    <script src="{{ url('/assets/js/bootstrap.min.js') }}"></script>

    <!-- magnific js -->
    <script src="{{ url('/assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ url('/assets/js/owl.carousel.min.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('/assets/js/masonry.pkgd.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ url('/assets/js/gijgo.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ url('/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ url('/assets/js/jquery.form.js') }}"></script>
    <script src="{{ url('/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('/assets/js/mail-script.js') }}"></script>
    <script src="{{ url('/assets/js/contact.js') }}"></script>

    <!-- custom js -->
    <script src="{{ url('/assets/js/custom.js') }}"></script>
    @include('components.pop-up')

    @if (!$pernahReview)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var firstReviewModal = new bootstrap.Modal(document.getElementById('firstReviewModal'));
                firstReviewModal.show();
            });

            document.addEventListener('DOMContentLoaded', function() {
                const kategoriButtons = document.querySelectorAll('.category-btn');
                const form = document.querySelector('#firstReviewModal form');
                const kategoriContainer = document.getElementById('kategoriContainer');

                let selectedCategories = [];

                kategoriButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const category = this.getAttribute('data-category');

                        if (selectedCategories.includes(category)) {
                            // Unselect
                            selectedCategories = selectedCategories.filter(item => item !== category);
                            this.classList.remove('active');
                        } else {
                            // Select
                            selectedCategories.push(category);
                            this.classList.add('active');
                        }
                    });
                });

                // Saat form disubmit, tambahkan input hidden untuk semua kategori terpilih
                form.addEventListener('submit', function() {
                    // Hapus input sebelumnya jika ada
                    document.querySelectorAll('input[name="kategori[]"]').forEach(e => e.remove());

                    selectedCategories.forEach(kategori => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'kategori[]';
                        input.value = kategori;
                        form.appendChild(input);
                    });
                });
            });
        </script>
    @endif

</body>

</html>
