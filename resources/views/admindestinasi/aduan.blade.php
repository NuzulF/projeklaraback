<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Aduan {{ Auth::user()->name }}</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">

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
                        <li>
                            <a href="{{ url('admin-destinasi/paket-wahana') }}" class="nav-link"><i
                                    class="fas fa-box"></i>
                                <span>Paket</span></a>
                        </li>
                        <li class="active">
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
                {{-- KOMENTAR --}}
                @foreach ($aduan as $adu)
                    <div class="modal fade" id="komentar{{ $adu['id'] }}" tabindex="-1" role="dialog"
                        aria-labelledby="komentarLabel{{ $adu['id'] }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambahkan Komentar</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="formKomentar{{ $adu['id'] }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control" name="komentar" rows="5" placeholder="Masukkan Komentar"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-primary"
                                            onclick="saveComment({{ $adu['id'] }})">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- END KOMENTAR --}}
                <section class="section">
                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Aduan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table table-responsive">
                                    <table id="tabelAduan" class="table-sm table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Jenis</th>
                                                <th scope="col">Tujuan</th>
                                                <th scope="col">Tanggal Awal</th>
                                                <th scope="col">Tanggal Baru</th>
                                                <th scope="col">Detail</th>
                                                <th scope="col">Lampiran</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Add this script block within your Blade template -->
                                            @php
                                                $statusTransitions = [
                                                    'pending' => ['approve', 'reject'],
                                                    'approve' => [],
                                                    'reject' => [],
                                                ];
                                            @endphp

                                            @push('scripts')
                                                <script>
                                                    var statusTransitions = @json($statusTransitions);
                                                </script>
                                            @endpush
                                            @forelse ($aduan as $a)
                                                <tr>
                                                    <td>ID{{ $a->keranjang->id }} {{ $a->order_id }}</td>
                                                    <td>{{ $a->keranjang->user->name }}</td>
                                                    <td>{{ $a->jenis_aduan->nama }}</td>

                                                    @php
                                                        $uniqueDestinasiIds = $a->keranjang->keranjangItem->unique(['destinasi_id', 'keranjang_id']);
                                                    @endphp
                                                    @foreach ($uniqueDestinasiIds as $item)
                                                        <td>{{ $namaDestinasi = $item->destinasi->nama_destinasi }}
                                                        </td>
                                                    @endforeach

                                                    <td>{{ $a->tanggalAwal }}</td>
                                                    <td>{{ $a->tanggalBaru }}</td>
                                                    <td style="text-align: left;" class="popup"
                                                        data-popuptext="{{ $a->detail }}">
                                                        {{ substr($a->detail, 0, 60) . (strlen($a->detail) > 60 ? '...' : '') }}
                                                    </td>
                                                    <td>
                                                        @if ($a->lampiran)
                                                            <a href="{{ asset('lampiran/' . $a->lampiran) }}"
                                                                target="_blank">Lihat</a>
                                                        @else
                                                            <a href="#" onclick="showAlert()">Lihat</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form id="update-status{{ $a->id }}"
                                                            action="{{ url('/admin-destinasi/update-status', $a->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <select id="status" name="status"
                                                                onchange="showPopupAndSubmitForm({{ $a->id }})">
                                                                @foreach ($statuses as $status)
                                                                    <option value="{{ $status }}"
                                                                        {{ $a->status == $status ? 'selected' : '' }}>
                                                                        {{ ucfirst($status) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <textarea name="form-komentar" hidden></textarea>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <th colspan="5" class="text-center">belum ada data</th>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{-- {{ $riwayat->links() }} --}}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
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

        // lampiran kosong
        function showAlert() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gambar tidak tersedia!',
            });
        }

        function showPopupAndSubmitForm(aduanId) {
            $('#komentar' + aduanId).modal('show');
        }

        function saveComment(aduanId) {
            var komentarValue = $('#formKomentar' + aduanId + ' textarea[name="komentar"]').val();

            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to change the status?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Menggabungkan komentar ke dalam formulir
                    $('#update-status' + aduanId + ' textarea[name="form-komentar"]').val(komentarValue);

                    // Mengirim formulir status update
                    var form = document.getElementById('update-status' + aduanId);
                    form.submit();
                }
            });
        }
    </script>
    @if (session('pop-up'))
        @php
            $message = session('pop-up');
        @endphp
        <script>
            Swal.fire(
                '{{ $message['head'] }}',
                '{!! $message['body'] !!}',
                '{{ $message['status'] }}'
            )
        </script>
    @endif
</body>

</html>
