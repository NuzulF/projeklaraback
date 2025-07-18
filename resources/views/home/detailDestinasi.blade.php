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
    @include('components.css-pop-up')
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

    {{-- @foreach ($destinasi as $destinasi) --}}
    <section class="detailHeadDesa section_padding">
        <div class="head_tittle">
            <h2>{{ $destinasi->nama_destinasi }}</h2>
            <p>{{ $destinasi->alamat_destinasi }}</p>
        </div>
    </section>

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <article class="blog-details">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($arrayGambar as $key => $image)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                @if ($key == 0) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($arrayGambar as $key => $image)
                            <div class="carousel-item @if ($key == 0) active @endif">
                                <img src="{{ asset('images/' . $image) }}" class="d-block w-100"
                                    style="object-fit: cover; height:50vw; max-height:500px"
                                    alt="Image {{ $key }}">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                        data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                        data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="col-sm-12">
                                <h3>{{ $destinasi->nama_destinasi }} <img src="{{ url('assets/img/star.png') }}"
                                        width="20" height="20"> {{ $averageRating }} </h3>
                                <p class="text-justify">{!! $destinasi->deskripsi_destinasi !!}</p>
                                <!-- Awal blok ulasan -->
                                <div class="col-sm-12 mt-5">
                                    <h4 class="mb-3">Ulasan Pengunjung</h4>

                                    <div id="review-container">
                                        @foreach ($reviews as $index => $review)
                                            <div class="card mb-3 review-item" data-index="{{ $index }}">
                                                <div class="card-body p-3">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center mb-2">
                                                        <strong>
                                                            Rating:
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <img src="{{ url('assets/img/star.png') }}"
                                                                    width="16" height="16"
                                                                    style="opacity: {{ $i <= $review->rating ? '1' : '0.2' }};">
                                                            @endfor
                                                            ({{ number_format($review->rating, 1) }})
                                                        </strong>
                                                        <small
                                                            class="text-muted">{{ \Carbon\Carbon::parse($review->tanggal)->format('d M Y') }}</small>
                                                    </div>

                                                    @if ($review->reviewer)
                                                        <div class="mb-2 text-muted" style="font-size: 14px;">
                                                            <i class="fas fa-user"></i> {{ $review->reviewer->name }}
                                                            <span
                                                                class="ms-2">({{ $review->reviewer->asal ?? 'Indonesia' }})</span>

                                                        </div>
                                                    @endif

                                                    <p class="mb-0 text-justify">{{ $review->review_text }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Tombol pagination -->
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="changePage(-1)">Sebelumnya</button>
                                        <span id="page-indicator" class="fw-semibold"></span>
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="changePage(1)">Berikutnya</button>
                                    </div>
                                </div>
                                <!-- Akhir blok ulasan -->


                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-12 row">
                                <div class="col-sm-7 col-lg-12">
                                    <h3>Kategori</h3>
                                    <p style="margin-top: 8px;">{{ $destinasi->kategori->nama_kategori }}</p>
                                    <h3>HTM</h3>
                                    <p style="font-size: 20px;">@currency($destinasi->htm_destinasi ?? 0)</p>
                                </div>
                                <div class="col-sm-5 col-lg-12">
                                    <a href="{{ url('pesan/destinasi', $destinasi->id) }}"
                                        class="btn_5 btn-info">Pesan Tiket</a>
                                    <!-- Tombol untuk membuka modal review -->
                                    @auth
                                        <button type="button" class="btn_5 btn-primary mt-2" data-toggle="modal"
                                            data-target="#reviewModal">
                                            Tulis Review
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn_5 btn-primary mt-2">Login untuk Tulis
                                            Review</a>
                                    @endauth
                                </div>
                            </div>
                            {{-- modal review --}}
                            <div class="modal fade" id="reviewModal" tabindex="-1"
                                aria-labelledby="reviewModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reviewModalLabel">Tulis Review untuk
                                                {{ $destinasi->nama_destinasi }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="reviewForm" action="{{ route('reviews.store') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="destinasi_id"
                                                    value="{{ $destinasi->id }}">

                                                <!-- Rating -->
                                                <div class="mb-3">
                                                    <label for="rating" class="form-label">Rating</label>
                                                    <div class="d-flex">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <input type="radio" name="rating"
                                                                id="rating{{ $i }}"
                                                                value="{{ $i }}" required class="d-none">
                                                            <label for="rating{{ $i }}" class="me-2"
                                                                aria-label="Rating {{ $i }} bintang">
                                                                <i class="fas fa-star text-muted"
                                                                    style="cursor: pointer;"
                                                                    onmouseover="this.className='fas fa-star text-warning'"
                                                                    onmouseout="this.className='fas fa-star text-muted'"
                                                                    onclick="setRating({{ $i }})"></i>
                                                            </label>
                                                        @endfor
                                                    </div>
                                                    @error('rating')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Teks Review -->
                                                <div class="mb-3">
                                                    <label for="review_text" class="form-label">Ulasan Anda</label>
                                                    <textarea name="review_text" id="review_text" class="form-control" rows="5" required
                                                        placeholder="Tulis pengalaman Anda..."></textarea>
                                                    @error('review_text')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <button type="submit" class="btn btn-primary">Kirim Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End post content -->

                <div class="lokDestinasi">
                    <div class="col-sm-12">
                        <iframe width="100%" height="450" frameborder="0" scrolling="no" marginheight="0"
                            marginwidth="0"
                            src="https://maps.google.com/maps?hl=id&q={{ $destinasi->maps_destinasi }}&z={{ $destinasi->maps_zoom }}&ie=UTF8&output=embed">
                        </iframe>
                    </div>
                </div>

            </article><!-- End blog post -->

            <div class="wahanaDestinasi align-items-center">
                <div>
                    <h4>Wahana Destinasi</h4>
                    <div class="row">
                        @forelse ($wahana as $w)
                            <div class="col-md-6">
                                <div class="detailWahana">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div id="carouselExampleSlidesOnly" class="carousel slide post-img"
                                                data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach (explode('|', $w['foto_wahana']) as $key => $image)
                                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                            <img src="{{ asset('images/' . $image) }}"
                                                                class="d-block w-100">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>{{ $w->nama_wahana }}</h4>
                                            <p>{!! $w->deskripsi_wahana !!}</p>
                                            <h4>HTM</h4>
                                            @if ($w->htm_wahana == 0)
                                                <p>Gratis</p>
                                            @else
                                                <p>@currency($w->htm_wahana)</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center mt-5 mb-5">
                                Belum tersedia Wahana
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $wahana->links() }}
                    </div>
                </div>
            </div>
            <!-- End post author -->

            <div class="paketDestinasi">
                <h4>Paket Wahana Destinasi</h4>
                <div class="row">
                    @forelse ($paket as $pak)
                        <div class="col-lg-6">
                            <div class="detailPaketDesti">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h2>{{ $pak->nama_paket }}</h2>
                                    </div>
                                    <div class="col-sm-4">
                                        <a
                                            href="{{ url('pesan/destinasi', $destinasi->id) }}"><button>Pesan</button></a>
                                    </div>
                                </div>
                                <div class="deskripsiPaketDesti" style="width:auto;min-height:190px;height:auto;">
                                    <h3>{{ implode(' + ', $pak->wahana->pluck('nama_wahana')->toArray()) }}</h3>
                                    <p style="text-decoration: line-through white;">@currency(array_sum($pak->wahana->pluck('htm_wahana')->toArray()))
                                    </p>
                                    <p style="font-size: 25px;">@currency($pak->harga_paket)</p>
                                    <span>Limited</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-5 mb-5">
                            Belum tersedia paket
                        </div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center">
                    {{ $paket->links() }}
                </div>
            </div>
        </div>
    </section><!-- End Blog Details Section -->
    {{-- @endforeach --}}

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const itemsPerPage = 5;
        let currentPage = 1;
        const items = document.querySelectorAll('.review-item');
        const totalPages = Math.ceil(items.length / itemsPerPage);
        const indicator = document.getElementById('page-indicator');

        function showPage(page) {
            currentPage = page;
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            items.forEach((item, index) => {
                item.style.display = (index >= start && index < end) ? 'block' : 'none';
            });

            indicator.innerText = `Halaman ${page} dari ${totalPages}`;
        }

        function changePage(direction) {
            const newPage = currentPage + direction;
            if (newPage >= 1 && newPage <= totalPages) {
                showPage(newPage);
            }
        }

        let currentRating = 0;

        function setRating(rating) {
            currentRating = rating;

            // Set radio input checked
            document.getElementById('rating' + rating).checked = true;

            // Ubah warna semua bintang
            for (let i = 1; i <= 5; i++) {
                const star = document.querySelector(`label[for="rating${i}"] i`);
                if (i <= rating) {
                    star.classList.remove('text-muted');
                    star.classList.add('text-warning');
                } else {
                    star.classList.remove('text-warning');
                    star.classList.add('text-muted');
                }
            }
        }


        // Tangani notifikasi pop-up
        @session('pop-up')
        Swal.fire({
            title: '{{ session('pop-up.head') }}',
            html: '{{ session('pop-up.body') }}',
            icon: '{{ session('pop-up.status') }}'
        });
        @endsession
    </script>

    <script>
        let currentRating = 0;

        function setRating(rating) {
            currentRating = rating;
            document.getElementById('rating' + rating).checked = true;
            updateStars(rating);
        }

        function updateStars(rating) {
            for (let i = 1; i <= 5; i++) {
                const star = document.querySelector(`label[for="rating${i}"] i`);
                if (i <= rating) {
                    star.classList.add('text-warning');
                    star.classList.remove('text-muted');
                } else {
                    star.classList.add('text-muted');
                    star.classList.remove('text-warning');
                }
            }
        }

        document.querySelectorAll('[id^="rating"]').forEach((input, index) => {
            const star = document.querySelector(`label[for="${input.id}"] i`);
            star.addEventListener('mouseover', () => updateStars(index + 1));
            star.addEventListener('mouseout', () => updateStars(currentRating));
        });
    </script>


</body>

</html>
