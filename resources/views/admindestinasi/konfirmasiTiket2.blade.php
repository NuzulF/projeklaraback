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
                                    <div class="table table-responsive">
                                        <table class="table-sm table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">E-mail</th>
                                                    <th scope="col">No. Telp</th>
                                                    <th scope="col">Total bayar</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Detail</th>
                                                    <th scope="col">Konfirmasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($transaksi as $trans)
                                                    <tr>
                                                        <th scope="row">{{ $trans->order_id }}</th>
                                                        <td>{{ $trans->nama_pemesan }}</td>
                                                        <td>{{ $trans->email_pemesan }}</td>
                                                        <td>{{ $trans->no_telp_pemesan }}</td>
                                                        <td>{{ $trans->total_pembayaran }}</td>
                                                        <td>{{ $trans->status }}</td>
                                                        <td>
                                                            <a class="edit-kategori btn btn-info btn-action mr-1"
                                                                title="Edit" data-toggle="modal"
                                                                data-target="#detail-{{ $trans->id }}"
                                                                data-id="{{ $trans->id }}">
                                                                <i class="fas fa-info"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">belum ada data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{ $transaksi->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            @foreach ($transaksi as $trans)
                <div class="modal fade" id="detail-{{ $trans->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="detail-{{ $trans->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h4 class="modal-title">Detail transaksi {{ $trans->order_id }}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <div class="table table-responsive">
                                    <h6>Isi Keranjang</h6>
                                    <table class="table-sm table">
                                        <thead>
                                            <tr>
                                                <th scope="col" rowspan="2">No.</th>
                                                <th scope="col" rowspan="2">Jenis</th>
                                                <th scope="col" class="text-center" colspan="2">Keterangan</th>
                                                <th scope="col" rowspan="2">Harga</th>
                                                <th scope="col" rowspan="2">Harga</th>
                                                <th scope="col" rowspan="2">Jumlah</th>
                                                <th scope="col" rowspan="2">Subtotal</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($trans->keranjang()->get() as $ker)
                                            @php
                                                $tinggi = $ker->paketWahana()->wherePivot('index',1)->count()+1;
                                            @endphp
                                                <tr>
                                                    <th rowspan="{{ $tinggi }}">{{ $loop->iteration }}</th>
                                                    <td rowspan="{{ $tinggi }}">{{ $ker->tipe }}</td>
                                                    @if($ker->tipe == "paket")
                                                        @php
                                                            $first = $ker->paketDestinasi()->wherePivot('index',1)->first();
                                                        @endphp
                                                        <td>{{ $first->nama_paket }}</td>
                                                        <td>{{ $first->harga_paket }}</td>
                                                    @else
                                                        @php
                                                            $first = $ker->destinasi()->wherePivot('index',1)->first();
                                                        @endphp
                                                        <td>{{ $first->nama_destinasi }}</td>
                                                        <td>{{ $first->htm_destinasi }}</td>
                                                    @endif
                                                    <td rowspan="{{ $tinggi }}">{{ $ker->total_pembayaran }}</td>
                                                    <td rowspan="{{ $tinggi }}">{{ $ker->jumlah }}</td>
                                                    <td rowspan="{{ $tinggi }}">{{ $ker->total_pembayaran*$ker->jumlah }}</td>
                                                    <td rowspan="{{ $tinggi }}">{{ $ker->pivot->jumlah_tiket }}</td>
                                                    <td rowspan="{{ $tinggi }}">{{ $ker->pivot->tanggal_kunjungan }}</td>
                                                </tr>
                                                @foreach($ker->paketWahana()->wherePivot('index',1)->get() as $paket)
                                                <tr>
                                                    <td>{{ $paket->nama_paket }}</td>
                                                    <td>{{ $paket->harga_paket }}</td>
                                                </tr>
                                                @endforeach
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada pesanan
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <h6>Detail lainnya</h6>
                                    <table class="table-sm table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Order ID</th>
                                                <td>{{ $trans->order_id }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nama pemesan</th>
                                                <td>{{ $trans->nama_pemesan }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email pemesan</th>
                                                <td>{{ $trans->email_pemesan }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">No telp</th>
                                                <td>{{ $trans->no_telp_pemesan }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total bayar</th>
                                                <td>{{ $trans->total_pembayaran }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jenis pembayaran</th>
                                                <td>{{ $trans->jenisPembayaran()->first()->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Status Pembayaran</th>
                                                <td>{{ $trans->status }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


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

</body>

</html>
