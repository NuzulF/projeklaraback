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
    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    @include('components.css-pop-up')
    <style>

        .nc_select+.nice-select .list {
            max-height: 500px;
            /* Set a fixed height for the dropdown */
            overflow-y: auto;
            /* Add a vertical scrollbar if needed */
        }
        select.nc_select + div {
            height:54px !important;
        }
        .simple-keyboard.hg-layout-default .hg-button.hg-dark {
            background: rgba(0, 0, 0, 0.8);
            color: white;
        }
        .simple-keyboard.hg-layout-default .hg-button.hg-primary {
            background: #007bff;
            color: white;
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
                                <div class="navbar-nav ms-auto">
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="recent-posts section_padding">
        <div class="container" data-aos="fade-up">
            <div class="section_tittle text-center">
                <h2>Informasi Transaksi</h2>
            </div>
            <div class="container-fluid">
                <div class="col-md-8 w-100" style="max-width:none">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Order ID</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $transaksi->order_id }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Nama Pemesan</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $transaksi->nama_pemesan }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">Email Pemesan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              {{ $transaksi->email_pemesan }}
                            </div>
                          </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">No. Telp</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $transaksi->no_telp_pemesan }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Total pembayaran</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            @currency($transaksi->total_pembayaran)
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Jenis Pembayaran</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $transaksi->jenisPembayaran->nama }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Status Pembayaran</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $transaksi->status  }}
                          </div>
                        </div>
                        <hr>
                      </div>
                    </div>
                </div>

                <!-- Bottom Section (Cards and List) -->
                <div class="row">
                  <!-- Left Section (Cards) -->
                  <div class="col-md-4">
                    <div class="section">
                      <h2>Keranjang</h2>
                      <!-- Add your cards here -->
                      <div class="col-md-12">
                        @foreach ($keranjang as $item)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->tipe }} ({{ $item->jumlah }}x)</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $item->tanggal_kunjungan }}</h6>

                                    <div class="card-content">
                                      @if($item->tipe == "paket")
                                        @foreach($item->destinasi as $des)
                                          <p class="card-text">{{ $des->nama_destinasi }}</p>
                                          <ul class="list-group">
                                            @foreach($item->paketWahana as $paket)
                                              @if($paket->pivot->index == 1 && $paket->pivot->destinasi_id == $des->id)
                                              <li class="list-group-item">{{ $paket->nama_paket }}</li>
                                              @endif
                                            @endforeach
                                          </ul>
                                        @endforeach
                                      @elseif($item->tipe == "destinasi")
                                        <p class="card-text">{{ $item->destinasi[0]->nama_destinasi }}</p>
                                        <ul class="list-group">
                                          @foreach($item->paketWahana as $paket)
                                            @if($paket->pivot->index == 1)
                                              <li class="list-group-item">{{ $paket->nama_paket }}</li>
                                            @endif
                                          @endforeach
                                        </ul>
                                      @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                      </div>
                      <!-- Add more cards as needed -->
                    </div>
                  </div>

                  <!-- Right Section (List) -->
                  <div class="col-md-8">
                    <div class="section">
                      <h2>Tiket</h2>
                      <!-- Add your list here -->
                      <ul class="list-group">
                        <li class="list-group-item">
                            @foreach($tikets as $tiket)
                            <div class="card-content mb-5 mt-2">
                                <p class="card-text">Tiket {{ $tiket->kode_tiket }} (destinasi 1)</p>

                                <ul class="list-group">
                                    @foreach($tiket->wahana as $wahana)
                                    <li class="list-group-item">
                                      <div class="row">
                                        <div class="col-8">{{ $wahana->nama_wahana }}</div>
                                        <div class="col-4 text-right">
                                          <span class="badge badge-success badge-pill pt-1 pb-1 pr-2 pl-2">{{ $wahana->pivot->status_tiket == 0 ? "Belum digunakan" : "Sudah digunakan" }}</span>
                                        </div>
                                      </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!--::Destinasi Wisata End -->

    <footer class="footer-area" style="">
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
    <script src="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/index.js"></script>
    @include('components.pop-up')
</body>

</html>
