<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Paket Wahana</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('stisla/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
    @include('components.css-pop-up')

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a class="nav-link nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('stisla/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::getUser()->name }}</div>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('admin-destinasi') }}">
                            <span class="brand-text">GoTripJava</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="{{ url('admin-destinasi') }}"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ url('admin-destinasi/konfirmasi-tiket') }}"><i
                                    class="fas fa-ticket"></i>
                                <span>Pembelian Tiket</span></a>
                        </li>
                        <li>
                            <a href="{{ url('admin-destinasi/wahana') }}" class="nav-link"><i
                                    class="fas fa-map-marker"></i>
                                <span>Wahana</span></a>
                        </li>
                        <li class="active">
                            <a href="{{ url('admin-destinasi/paket-wahana') }}" class="nav-link"><i
                                    class="fas fa-box"></i>
                                <span>Paket</span></a>
                        </li>
                        <li>
                            <a href="{{ url('admin-destinasi/aduan') }}" class="nav-link"><i
                                    class="fas fa-hand-holding-heart"></i>
                                <span>Aduan</span></a>
                        </li>
                        <div class="dropdown-divider"></div>
                        <li>
                            <a href="{{ url('logout') }}" class="nav-link has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>

                    <div class="hide-sidebar-mini mt-4 mb-4 p-3">
                        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-rocket"></i> Documentation
                        </a>
                    </div>
                </aside>
            </div>

            <!-- Content -->
            <div class="main-content">
                {{-- TAMBAH --}}
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog" style="max-width: 1000px">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Paket</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <form id="paket" action="{{ url('/admin-destinasi/tambah-paket') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_paket" class="col-form-label">Nama *</label>
                                        <div>
                                            <input type="text" class="form-control" name="nama_paket"
                                                placeholder="Masukkan Nama">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="destinasi" class="col-form-label">Destinasi</label>
                                        <div>
                                            <input type="text" class="form-control" name="destinasi"
                                                placeholder="Masukkan Nama" value="{{ $destinasi['nama_destinasi'] }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Wahana *</label>
                                        @foreach ($wahana as $wah)
                                            <div>
                                                <input type="checkbox" id="checkbox{{ $wah['id'] }}"
                                                    name="checkbox[]" value="{{ $wah['id'] }}"
                                                    data-price="{{ $wah['htm_wahana'] }}">
                                                {{ $wah['nama_wahana'] }} (Rp.{{ number_format($wah['htm_wahana'], 0, ',', '.') }})
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_normal" class="col-form-label">Harga Normal</label>
                                        <div>
                                            <input type="number" class="form-control" name="harga_normal"
                                                id="total-price" placeholder="0" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_paket" class="col-form-label">Harga (sudah termasuk
                                            tiket masuk) *</label>
                                        <div>
                                            <input type="number" class="form-control" name="harga_paket" min="0"
                                                id="harga_paket" placeholder="Gratis isi 0(nol)">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END TAMBAH --}}
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Paket Wahana</h4>
                                    <div class="card-header-action">
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah
                                            Paket</a>
                                    </div>
                                </div>
                                <section id="blog" class="blog">
                                    <div class="container" data-aos="fade-up">
                                        <div class="wahanaDestinasi align-items-center">
                                            <div class="row">
                                                @forelse ($paket as $pak)
                                                    <div class="col-sm-6">
                                                        <div class="detailPaketDesti">
                                                            <div class="row">
                                                                <div class="col-sm-10">
                                                                    <h2>{{ $pak['nama_paket'] }}</h2>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <a class="btn btn-danger btn-action"
                                                                        href="{{ url('admin-destinasi/hapus-paket/' . $pak['id']) }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="deskripsiPaketDesti">
                                                                <h3>{{ Auth::user()->destinasi->nama_destinasi }}
                                                                    ({{ implode(' + ', $pak->wahana->pluck('nama_wahana')->toArray()) }})
                                                                </h3>
                                                                <p style="text-decoration: line-through white;">
                                                                    Rp{{ array_sum($pak->wahana->pluck('htm_wahana')->toArray()) }}
                                                                </p>
                                                                <p style="font-size: 25px;">
                                                                    Rp{{ $pak['harga_paket'] }}
                                                                </p>
                                                                <span>Limited</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12 text-center mt-5 mb-5">
                                                        <p>Tidak ada data</p>
                                                    </div>
                                                @endforelse
                                                <!-- End detail paket destinasi -->
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="d-flex justify-content-center">
                                    {{ $paket->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Footer -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>

        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('stisla/library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('stisla/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('stisla/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('stisla/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('stisla/js/stisla.js') }}"></script>

    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ asset('stisla/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/js/custom.js') }}"></script>

    <script>
        // Mengambil elemen checkbox
        var checkboxes = document.querySelectorAll('input[name="checkbox[]"]');
        var ticketPrice = {{ $destinasi['htm_destinasi'] }}; // Harga tiket masuk (ganti dengan harga yang sesuai)

        // Menambahkan event listener pada setiap checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                calculateTotalPrice();
            });
        });

        // Fungsi untuk menghitung total harga dan menampilkan hasilnya
        function calculateTotalPrice() {
            var totalPrice = 0;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var price = parseFloat(checkbox.getAttribute('data-price'));
                    totalPrice += price;
                }
            });

            // Menambahkan harga tiket masuk ke total harga
            totalPrice += ticketPrice;

            // Menampilkan total harga
            document.getElementById('total-price').value = totalPrice;

            // Mendapatkan elemen input dengan ID 'harga_paket'
            var numberInput = document.getElementById('harga_paket');

            // Mengatur atribut max pada elemen input dengan nilai totalPrice
            numberInput.setAttribute('max', totalPrice - 1);

            // Mencetak nilai atribut max pada konsol
            console.log(numberInput.getAttribute('max'));
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    @include('components.pop-up')

    <script>
        $(document).ready(function() {
                $('#paket').validate({
                    rules: {
                        nama_paket: {
                            required: true
                        },
                        harga_paket: {
                            required: true,
                            digits: true
                        }
                    },
                    messages: {
                        nama_paket: {
                            required: "<strong>nama paket wajib diisi.</strong>"
                        },
                        harga_paket: {
                            required: "<strong>harga paket wajib diisi.</strong>",
                            digits: "<strong>harga harus berupa angka.</strong>",
                            min: "<strong>harga minimal bernilai 0</strong>"
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
