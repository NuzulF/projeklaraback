<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Tipe Pembayaran</title>
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
                        <a href="{{ url('superadmin') }}">
                            <span class="brand-text">GoTripJava</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="{{ url('superadmin') }}"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ url('superadmin/daftar-admin') }}"><i class="fas fa-user"></i>
                                <span>Daftar Admin</span></a>
                        </li>
                        <li>
                            <a href="{{ url('superadmin/kategori') }}" class="nav-link"><i class="fas fa-bolt"></i>
                                <span>Kategori</span></a>
                        </li>
                        <li class="active">
                            <a href="{{ url('superadmin/pembayaran') }}" class="nav-link"><i
                                    class="fas fa-hand-pointer"></i>
                                <span>Pembayaran</span></a>
                        </li>
                        <li>
                            <a href="{{ url('superadmin/aduan') }}" class="nav-link"><i
                                    class="fas fa-hand-holding-heart"></i>
                                <span>Aduan</span></a>
                        </li>
                        <li>
                            <a href="{{ url('superadmin/riwayat-edit') }}" class="nav-link"><i
                                    class="fas fa-clock-rotate-left"></i>
                                <span>Riwayat Edit</span></a>
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
                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List Tipe pembayaran</h4>
                                <div class="card-header-action">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table table-responsive">
                                    <table class="table-sm table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Kode</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Tool</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($tipe_pembayaran as $pem)
                                                <tr>
                                                    <td>{{ $pem['nama'] }}</td>
                                                    <td>{{ $pem['kode'] }}</td>
                                                    <td>{{ $pem['status']? "Tersedia" : "Tidak tersedia"}}</td>
                                                    <td>
                                                        @if ($pem['status'])
                                                            <a class="btn btn-danger btn-action"
                                                                href="{{ url('superadmin/pembayaran/' . $pem['id'].'/nonaktif') }}">
                                                                Nonaktifkan</a>
                                                        @else
                                                            <a class="btn btn-primary btn-action"
                                                                href="{{ url('superadmin/pembayaran/' . $pem['id'].'/aktif') }}">
                                                                Aktifkan</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">belum ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $tipe_pembayaran->links() }}
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

    <script src="{{ asset('stisla/js/page/bootstrap-modal.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    @include('components.pop-up')

</body>

</html>
