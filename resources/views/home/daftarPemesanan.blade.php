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

    <!-- ======= Blog Details Section ======= -->
    <section id="pesanan" class="pesanan">
        <div class="container" data-aos="fade-up">
            <div class="listPesanan">
                <h4>Pesanan Anda</h4>
                <table id="tablePesanan" class="table table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle">ID</th>
                            <th colspan="4" class="d-none d-md-table-cell text-center">Keranjang</th>
                            <th rowspan="2" class="align-middle">Total Harga</th>
                            <th rowspan="2" class="align-middle">Status</th>
                            <th rowspan="2" class="align-middle">Action</th>
                        </tr>
                        <tr>
                            <th class="d-none d-md-table-cell">Tipe</th>
                            <th class="d-none d-md-table-cell">Tanggal Kunjungan</th>
                            <th class="d-none d-md-table-cell">Jumlah Tiket</th>
                            <th class="d-none d-md-table-cell">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $trans)
                            @if (count($trans->keranjang) > 0)
                                @php
                                    $tinggi = count($trans->keranjang);
                                @endphp
                                <tr>
                                    <th rowspan="{{ $tinggi }}" scope="row">{{ $trans->order_id }}</th>
                                    <td class="d-none d-md-table-cell">{{ $trans->keranjang[0]->tipe }}</td>
                                    <td class="d-none d-md-table-cell">{{ $trans->keranjang[0]->tanggal_kunjungan }}
                                    </td>
                                    <td class="d-none d-md-table-cell">{{ $trans->keranjang[0]->jumlah }} Tiket</td>
                                    <td class="d-none d-md-table-cell">@currency($trans->keranjang[0]->total_pembayaran)</td>
                                    <td rowspan="{{ $tinggi }}">@currency($trans->total_pembayaran)</td>
                                    @if ($trans->status == 0)
                                        <th rowspan="{{ $tinggi }}"><i class="fas fa-plus-circle"
                                                style="rotate: 45deg; color: red;"></i></th>
                                    @else
                                        <th rowspan="{{ $tinggi }}"><i class="fas fa-check-circle"
                                                style="color: green;"></i></th>
                                    @endif
                                    <td rowspan="{{ $tinggi }}">
                                        @if ($trans->status == 1)
                                            <a href="{{ url('/invoice/tiket/' . $trans->order_id) }}"
                                                class="text-decoration-none mr-2 ml-2">
                                                <i class="fas fa-info"></i>
                                            </a>
                                            <a href="{{ url('/form-aduan', $trans->id) }}"
                                                class="text-decoration-none mr-2 ml-2"><i
                                                    class="fas fa-headset"></i></a>
                                        @elseif($trans->status == 0)
                                            <a href="{{ url('/daftar-pemesanan/refresh/' . $trans->order_id) }}"
                                                class="text-decoration-none mr-2 ml-2">
                                                <i class="fas fa-sync-alt"></i> Buat ulang transaksi
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @foreach ($trans->keranjang as $keranjang)
                                    @if ($keranjang != $trans->keranjang[0])
                                        <tr>
                                            <td class="d-none d-md-table-cell">{{ $keranjang->tipe }}</td>
                                            <td class="d-none d-md-table-cell">{{ $keranjang->tanggal_kunjungan }}
                                            </td>
                                            <td class="d-none d-md-table-cell">{{ $keranjang->jumlah }} Tiket</td>
                                            <td class="d-none d-md-table-cell">@currency($keranjang->total_pembayaran)</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @empty
                            <tr>
                                <th colspan="8" class="text-center">belum ada data</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="margin-top: 25px">
            {{ $transaksi->links() }}
        </div>
    </section>

    <section id="aduan" class="aduan">
        <div class="container" data-aos="fade-up">
            <div class="listAduan">
                <h4>Riwayat Aduan</h4>
                <table id="tableAduan" class="table table-striped fixed">
                    <thead>
                        <tr>
                            <th scope="col" width="147px">ID</th>
                            <th scope="col" width="147px">Aduan</th>
                            <th scope="col" width="225px">Tanggal</th>
                            <th scope="col" width="495px">Detail Aduan</th>
                            <th scope="col" width="137px">Status</th>
                            <th scope="col" width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aduan as $adu)
                            <tr>
                                <th scope="row">ID{{ $adu->keranjang->id }} {{ $adu->order_id }}</th>
                                <th scope="row">{{ $adu->jenis_aduan->nama }}</th>
                                <th>{{ \Carbon\Carbon::parse($adu->tanggalBaru)->format('d F Y') }}</th>
                                <th style="text-align: left;" class="popup" data-popuptext="{{ $adu->detail }}">
                                    {{ substr($adu->detail, 0, 60) . (strlen($adu->detail) > 60 ? '...' : '') }}
                                </th>
                                @if ($adu->status == 'pending')
                                    <th>Menunggu</th>
                                @elseif($adu->status == 'approve')
                                    <th>Diterima</th>
                                @else
                                    <th>Ditolak</th>
                                @endif
                                <th><i id="commentIcon_{{ $adu->id }}" class="fas fa-comment"></i></th>
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

    <script>
        // Deklarasikan fungsi html_entity_decode
        function html_entity_decode(str) {
            var doc = new DOMParser().parseFromString(str, 'text/html');
            return doc.documentElement.textContent;
        }

        // Loop melalui semua ikon komentar menggunakan id yang unik
        @foreach ($aduan as $adu)
            document.getElementById('commentIcon_{{ $adu->id }}').addEventListener('click', function() {
                // Dekode HTML entities dan parse JSON
                var komentarData = JSON.parse(html_entity_decode('{!! json_encode($adu->reply_aduan) !!}'));

                // Cek apakah Reschedule memiliki komentar
                if ('{{ $adu->status }}' == 'approve') {
                    // Tampilkan alert swal fire jika ada komentar
                    Swal.fire({
                        title: 'Komentar Admin',
                        text: komentarData.jawaban, // Gantilah dengan properti yang sesuai
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else if ('{{ $adu->status }}' == 'reject') {
                    Swal.fire({
                        title: 'Komentar Admin',
                        text: komentarData.jawaban, // Gantilah dengan properti yang sesuai
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Tampilkan alert "Menunggu persetujuan" jika tidak ada komentar
                    Swal.fire({
                        title: 'Menunggu Persetujuan',
                        text: 'Reschedule ini belum mendapatkan komentar dari admin.',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                }
            });
        @endforeach
    </script>
</body>

</html>
