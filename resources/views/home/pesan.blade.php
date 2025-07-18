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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
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
    <section id="pesanTiket" class="blog pesanTiket">
        <div class="container" data-aos="fade-up">
            @if (isset($destinasi))
                <div class="inputTiket" style="max-width:1000px;width:auto;">
                    <h4>Pemesanan Tiket</h4>
                    <form id="pesan" action="{{ url('proses-pesan/destinasi/' . $destinasi->id) }}"
                        method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="inputDestinasi" class="form-label">Nama Destinasi</label>
                            <input type="text" class="form-control" id="inputDestinasi"
                                placeholder="{{ $destinasi->nama_destinasi }}" readonly />
                        </div>
                        @guest
                        <div class="col-12">
                            <label for="inputNamaPemesan" class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" id="inputNamaPemesan"
                                placeholder="Masukkan Nama Pemesan" value="{{ old('nama_pemesan') }}" name="nama_pemesan" required />
                        </div>
                        <div class="col-12">
                            <label for="inputEmailPemesan" class="form-label">Email Pemesan</label>
                            <input type="email" class="form-control" id="inputEmailPemesan"
                                placeholder="Masukkan Email Pemesan" value="{{ old('email_pemesan') }}" name="email_pemesan" required />
                        </div>
                        @else
                        <div class="col-12">
                            <label for="inputNamaPemesan" class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" id="inputNamaPemesan"
                                placeholder="{{ Auth::user()->name }}" readonly />
                        </div>
                        <div class="col-12">
                            <label for="inputEmailPemesan" class="form-label">Email Pemesan</label>
                            <input type="text" class="form-control" id="inputEmailPemesan"
                                placeholder="{{ Auth::user()->email }}" readonly />
                        </div>
                        @endguest
                        <div class="col-12">
                            <label for="tanggal" class="form-label">Tanggal Pemesanan</label>
                            <input type="date" class="form-control" id="tanggal" value="{{ old('tanggal') }}" name="tanggal" required />
                        </div>
                        <div class="col-md-6">
                            <label for="jumlah" class="form-label">Jumlah Tiket</label>
                            <input type="number" class="form-control" id="jumlah" value="{{ old('jumlah') }}" name="jumlah" min="1" required />
                        </div>
                        <div class="col-md-6">
                            <label for="harga" class="form-label">Harga Tiket</label>
                            <input type="text" class="form-control" id="harga" name="harga"
                                value="{{ $destinasi->htm_destinasi }}" readonly />
                        </div>
                        <div class="col-12">
                            <label for="total" class="form-label">Total</label>
                            <span class="form-control" id="total"></span>
                        </div>
                        <button type="submit" id="buttonLogin">Pesan</button>
                    </form>
                </div>
            @endif
            @if (isset($paket))
                <div class="inputTiket">
                    <h4>Pemesanan Paket</h4>
                    <form id="pesan" action="{{ url('proses-pesan/paket/'.$paket['id']) }}"
                        method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="inputPaket" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control" id="inputPaket"
                                placeholder="{{ $paket['nama_paket'] }}" readonly />
                        </div>
                        @guest
                        <div class="col-12">
                            <label for="inputNamaPemesan" class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" id="inputNamaPemesan"
                                placeholder="Masukkan Nama Pemesan" value="{{ old('nama_pemesan') }}" name="nama_pemesan" required />
                        </div>
                        <div class="col-12">
                            <label for="inputEmailPemesan" class="form-label">Email Pemesan</label>
                            <input type="email" class="form-control" id="inputEmailPemesan"
                                placeholder="Masukkan Email Pemesan" value="{{ old('email_pemesan') }}" name="email_pemesan" required />
                        </div>
                        @else
                        <div class="col-12">
                            <label for="inputNamaPemesan" class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" id="inputNamaPemesan"
                                placeholder="{{ Auth::user()->name }}" readonly />
                        </div>
                        <div class="col-12">
                            <label for="inputEmailPemesan" class="form-label">Email Pemesan</label>
                            <input type="text" class="form-control" id="inputEmailPemesan"
                                placeholder="{{ Auth::user()->email }}" readonly />
                        </div>
                        @endguest
                        <div class="col-12">
                            <label for="tanggal" class="form-label">Tanggal Pemesanan</label>
                            <input type="date" class="form-control" id="tanggal" value="{{ old('tanggal') }}" name="tanggal" required />
                        </div>
                        <div class="col-md-6">
                            <label for="jumlah" class="form-label">Jumlah Paket</label>
                            <input type="number" class="form-control" id="jumlah"  value="{{ old('jumlah') }}" name="jumlah" min="1" required />
                        </div>
                        <div class="col-md-6">
                            <label for="harga" class="form-label">Harga Paket</label>
                            <input type="text" class="form-control" id="harga" name="harga"
                                value="{{ $paket['harga_paket'] }}" readonly />
                        </div>
                        <div class="col-12">
                            <label for="total" class="form-label">Total</label>
                            <span class="form-control" id="total"></span>
                        </div>
                        <button type="submit" id="buttonLogin">Pesan</button>
                    </form>
                </div>
            @endif
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        // Ambil input field harga dan jumlah
        var harga = $('#harga');
        var jumlah = $('#jumlah');

        // Tambahkan event listener untuk input field
        harga.on('input', updateTotal);
        jumlah.on('input', updateTotal);

        // Fungsi untuk mengupdate total pembayaran
        function updateTotal() {
            var h = harga.val();
            var j = jumlah.val() > 0 ? jumlah.val() : 0;
            var total = h * j;
            $('#total').text(total);
        }

        const now = new Date();
        const formatter = new Intl.DateTimeFormat('id-ID', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            timeZone: 'Asia/Jakarta'
        });

        const [ { value: day }, , { value: month }, , { value: year } ] = formatter.formatToParts(now);
        const tanggalSekarang = `${year}-${month}-${day}`;

        console.log(tanggalSekarang);

        $('input[type="date"]#tanggal').attr("min",tanggalSekarang);
    </script>
    @if(session('pop-up'))
        @php
            $message = session('pop-up');
        @endphp
        <script>
            Swal.fire(
                '{{ $message["head"] }}',
                '{!! $message["body"] !!}',
                '{{ $message["status"] }}'
            )
        </script>
    @endif
    <script>
            $(document).ready(function() {

                $('#pesan').validate({
                    rules: {
                        tanggal: {
                            required: true,
                            date: true
                        },
                        jumlah: {
                            required: true,
                            digit: true
                        },
                        inputEmailPemesan: {
                            required: true,
                            email: true
                        },
                        inputNamaPemesan: {
                            required: true
                        }
                    },
                    messages: {
                        tanggal: {
                            required: "<strong>tanggal wajib diisi.</strong>",
                            date: "<strong>tanggal bukan tanggal yang valid.</strong>",
                            min: "<strong>tanggal harus berisi tanggal setelah atau sama dengan "+tanggalSekarang+"</strong>"
                        },
                        jumlah: {
                            required: "<strong>jumlah wajib diisi.</strong>",
                            digit: "<strong>jumlah harus berupa angka</strong>",
                            min: "<strong>jumlah minimal bernilai 1</strong>"
                        },
                        inputEmailPemesan: {
                            required: "<strong>email wajib diisi.</strong>",
                            email: "<strong>email harus berupa alamat surel yang valid.</strong>"
                        },
                        inputNamaPemesan: {
                            required: "<strong>nama wajib diisi.</strong>"
                        }
                    },
                    errorClass: "invalid-feedback text-left mb-3 ml-1",
                    errorElement: "div",
                    highlight: function(element) {
                        $(element).addClass('is-invalid mb-0');
                    },
                    unhighlight: function(element) {
                        $(element).removeClass('is-invalid mb-0');
                    },
                });
            });
    </script>
</body>

</html>
