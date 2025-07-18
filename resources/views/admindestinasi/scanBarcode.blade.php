<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Pembelian Tiket</title>
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
                        <li class="active">
                            <a class="nav-link" href="{{ url('admin-destinasi/konfirmasi-tiket') }}"><i
                                    class="fas fa-ticket"></i>
                                <span>Pembelian Tiket</span></a>
                        </li>
                        <li>
                            <a href="{{ url('admin-destinasi/wahana') }}" class="nav-link"><i
                                    class="fas fa-map-marker"></i>
                                <span>Wahana</span></a>
                        </li>
                        <li>
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
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Pembelian Tiket</h4>
                                    <div>
                                        <a href="{{ url('/qr/scan') }}"
                                            class="btn btn-primary btn-action mr-1" title="Kembali">
                                            Scan QR user</a>
                                    </div>
                                    <div>
                                        <a href="{{ url('/qr/admin/scan') }}"
                                            class="btn btn-primary btn-action mr-1" title="Kembali">
                                            Scan QR admin</a>
                                    </div>
                                    <div>
                                        <a href="{{ url('/barcode/scan') }}"
                                            class="btn btn-success btn-action mr-1" title="Kembali">
                                            Scan Barcode</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <form class="row g-3" action="" method="POST">
                                            @csrf
                                            <div class="col-12">
                                                <label for="id_wahana" class="form-label">Wahana</label>
                                            </div>
                                            <div class="col-12">
                                                <select id="id_wahana" name="id_wahana" class="form-control">
                                                    <option value="">Pilih Wahana</option>
                                                    @foreach($wahana as $w)
                                                        <option value="{{ $w->id }}">{{ $w->nama_wahana }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="kode" class="form-label">Kode Tiket</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="kode" class="input form-control w-100" id="kode" placeholder="Masukkan kode tiket">
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-primary" type="submit">Check</button>
                                            </div>
                                        </form>
                                    </div>
                                    @if(isset($gagal))
                                        <p class="text-danger mt-5"></p>
                                    @endif
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

    @include('components.pop-up')
    <script>
        $(document).ready(function() {
            // Check if there is a localStorage item "wahana_selected"
            if (localStorage.getItem('wahana_selected')) {
                // Get the selected wahana ID from localStorage
                const selectedWahanaID = parseInt(localStorage.getItem('wahana_selected'));
                // Update the selected option in the dropdown menu
                if (!isNaN(selectedWahanaID)) {
                    console.log(selectedWahanaID);
                    $('#id_wahana').val(selectedWahanaID);
                }
            }

            // Add an event listener to the select dropdown to update localStorage whenever the selection changes
            $('#id_wahana').change(function() {
                const selectedWahanaID = parseInt($(this).val());
                localStorage.setItem('wahana_selected', selectedWahanaID);
            });

        });
    </script>
</body>

</html>
