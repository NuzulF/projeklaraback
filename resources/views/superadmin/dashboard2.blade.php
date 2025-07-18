<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard {{ Auth::user()->name }}</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('stisla/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

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
                        <li class="active">
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
                        <li>
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
                {{-- EDIT BANNER --}}
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title">Ganti Banner</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                    <form id="banner" action="{{ url('/superadmin/ganti-banner') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Gambar *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"name="gambar[]"
                                    accept="image/*" multiple>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div id="carouselExampleControls" class="carousel slide p-1" data-ride="carousel" style="background-color: #4f4f4f">
                            <div class="carousel-inner">
                                @php
                                    $files = array_chunk($banner, 2);
                                @endphp
                                @foreach ($files as $groupFile)
                                    <div class="carousel-item {{ ($loop->first) ? "active" : "" }}">
                                        <div class="row">
                                            @foreach ($groupFile as $file)
                                                <div class="col-6" style="
                                                    width: 236px;
                                                    height: 100px;
                                                    text-align: center;
                                                    max-width: none;
                                                ">
                                                    <img src="{{ asset('images/'.$file) }}" alt="{{ $file }}" style="
                                                        max-width: 230px;
                                                        object-fit: contain;
                                                        height: 100px;
                                                    ">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                          </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #fc544b">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Admin</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $admin }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #47c636">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Destinasi</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $destinasi }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #ffa426">
                                    <i class="fas fa-ticket"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Transaksi Berhasil</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $transaksiCount }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #19536e">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Users</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $user }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="d-inline">Banner</h4>
                                    <div class="card-header-action">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Ganti Banner</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"
                                        style="height: 280px; position: relative; overflow: hidden; background-repeat: no-repeat; background-size: cover; background-position: center; z-index: 1;">
                                        <ol class="carousel-indicators">
                                            @foreach ($banner as $key => $image)
                                                <li data-target="#carouselExampleIndicators"
                                                    data-slide-to="{{ $key }}"
                                                    @if ($key == 0) class="active" @endif></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach ($banner as $key => $image)
                                                <div
                                                    class="carousel-item @if ($key == 0) active @endif">
                                                    <img src="{{ asset('images/' . $image) }}" class="d-block w-100"
                                                        alt="Image {{ $key }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                            role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators"
                                            role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tiket Terjual</h4>
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

    <script src="{{ asset('stisla/js/page/bootstrap-modal.js') }}"></script>
    <script>
        //file input (menampilkan nama file setelah memilih file)
        $(document).ready(function() {
            $('.custom-file-input').change(function() {
                const input = $(this)[0];
                const label = $(this).next('.custom-file-label');
                let selectedFiles = [];
                if (input.files.length > 0) {
                    for (let i = 0; i < input.files.length; i++) {
                        selectedFiles.push(input.files[i].name);
                    }
                    label.text(selectedFiles.join(', '));
                } else {
                    label.text('Choose file');
                }
            });
        });
    </script>
    @include('components.pop-up')
    <script>
        $(document).ready(function () {
            const input = $('#customFile'); // Use jQuery to select the element
            const carousel = $('#carouselExampleControls');

            input.on('change', (event) => {
                carousel.hide();
                carousel.find('.carousel-inner').empty();
                //const files = Array.from(event.target.files);
                //make it 2d array with 2 files each
                const files = Array.from(event.target.files).reduce((acc, file, i) => {
                    const index = Math.floor(i / 2);
                    acc[index] = acc[index] || [];
                    acc[index].push(file);
                    return acc;
                }, []);
                const carouselInner = $('#carouselExampleControls .carousel-inner');
                //foreach files as groupFile, foreach groupFile as file, console log file name
                files.forEach((groupFile) => {
                    const carouselItem = document.createElement('div');
                    carouselItem.classList.add('carousel-item');

                    const divRow = document.createElement('div');
                    divRow.classList.add('row');

                    groupFile.forEach((file) => {
                        const divCol = document.createElement('div');
                        divCol.classList.add('col');
                        divCol.style = `
                            width: 236px;
                            height: 100px;
                            text-align: center;
                            max-width: none;
                        `;
                        const img = document.createElement('img');
                        img.alt = file.name;
                        img.style = `
                            max-width: 230px;
                            object-fit: contain;
                            height: 100px;
                        `;
                        const reader = new FileReader();
                        reader.onload = function (oFREvent) {
                            img.src = oFREvent.target.result;
                        };
                        reader.readAsDataURL(file);

                        divCol.appendChild(img);
                        divRow.appendChild(divCol);
                        console.log(file.name);
                    });
                    carouselItem.appendChild(divRow);
                    carouselInner[0].appendChild(carouselItem);
                });
                carouselInner[0].firstElementChild.classList.add('active');
                carousel.show();
            });
        });
    </script>
</body>

</html>
