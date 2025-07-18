<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar Admin</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                        <li>
                            <a class="nav-link" href="{{ url('superadmin') }}"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li class="active">
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
                {{-- TAMBAH ADMIN --}}
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Admin</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <form id="tambah-admin" action="{{ url('/superadmin/daftar-admin/proses-tambah') }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <div>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid mb-0 @enderror"
                                                id="name" name="name" value="{{ old('name') }}"
                                                placeholder="Masukkan Nama" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role_id">Role</label>
                                        <div>
                                            <select class="form-control" name="role_id" id="role_id"
                                                required="required">
                                                <option value="">Pilih Role</option>
                                                <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>
                                                    Admin Kabupaten
                                                </option>
                                                <option value="3" {{ old('role_id') == 3 ? 'selected' : '' }}>
                                                    Admin Desa</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- OPSI ADMIN KABUPATEN --}}
                                    <div data-parent="2" style="display: none;">
                                        <div class="form-group">
                                            <label for="province">Provinsi</label>
                                            <div>
                                                <select
                                                    class="form-control @error('province_id') is-invalid mb-0 @enderror"
                                                    name="province_id" id="province_2">
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach ($province as $item)
                                                        <option value="{{ $item['id'] }}"
                                                            {{ old('province_id') == $item['id'] ? 'selected' : '' }}>
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="regency">Kabupaten</label>
                                            <div>
                                                <select class="form-control" name="regency_id" id="regency_2">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- OPSI ADMIN DESA --}}
                                    <div data-parent="3" style="display: none;">
                                        <div class="form-group">
                                            <label for="province">Provinsi</label>
                                            <div>
                                                <select
                                                    class="form-control @error('province_id') is-invalid mb-0 @enderror"
                                                    name="province_id" id="province_3">
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach ($province as $item)
                                                        <option value="{{ $item['id'] }}"
                                                            {{ old('province_id') == $item['id'] ? 'selected' : '' }}>
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="regency">Kabupaten</label>
                                            <div>
                                                <select class="form-control" name="regency_id" id="regency_3">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="district">Kecamatan</label>
                                            <div>
                                                <select class="form-control" name="district_id" id="district_3">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="village">Desa</label>
                                            <div>
                                                <select class="form-control" name="village_id" id="village_3">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- OPSI ADMIN WISATA --}}
                                    <div data-parent="4" style="display: none;">
                                        <div class="form-group">
                                            <label for="province">Provinsi</label>
                                            <div>
                                                <select class="form-control" name="province_id" id="province_4">
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach ($province as $item)
                                                        <option value="{{ $item['id'] }}"
                                                            {{ old('province_id') == $item['id'] ? 'selected' : '' }}>
                                                            {{ $item['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="regency">Kabupaten</label>
                                            <div>
                                                <select class="form-control" name="regency_id" id="regency_4">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="district">Kecamatan</label>
                                            <div>
                                                <select class="form-control" name="district_id" id="district_4">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="village">Desa</label>
                                            <div>
                                                <select class="form-control" name="village_id" id="village_4">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}" placeholder="example@mail.com">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div>
                                            <input type="password" class="form-control" id="password"
                                                name="password" placeholder="Masukkan Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <div>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" placeholder="Konfirmasi Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Nomor Handphone</label>
                                        <div>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone') }}" placeholder="Nomor Handphone">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Tambah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>List Admin</h4>
                                    <div class="card-header-action">
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Admin</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table table-responsive">
                                        <table class="table-sm table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Admin</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Nomor Telepon</th>
                                                    <th scope="col">Tambah Admin Desa</th>
                                                    <th scope="col">Approve Destinasi</th>
                                                    <th scope="col">Tambah Admin Destinasi</th>
                                                    <th scope="col">Mengajukan Destinasi</th>
                                                    <th scope="col">Konfirmasi Tiket</th>
                                                    <th scope="col">Tools</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($admin as $item)
                                                            <tr>
                                                                <td>{{ $item->name}}</td>
                                                                <td>{{ $item->role()->first()->nama_role }}</td>
                                                                <td>{{ $item->email }}</td>
                                                                <td>{{ $item->phone }}</td>
                                                                @if ($item->edit_admin_desa == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-edit-admin-desa/' . $item->id) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-edit-admin-desa/' . $item->id) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                @if ($item->approve_wisata == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-approve-wisata/' . $item->id) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-approve-wisata/' . $item->id) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                @if ($item->tambah_edit_admin_destinasi == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-tambah-edit-admin-destinasi/' . $item->id) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-tambah-edit-admin-destinasi/' . $item->id) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                @if ($item->mengajukan_destinasi == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-mengajukan-destinasi/' . $item->id) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-mengajukan-destinasi/' . $item->id) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                @if ($item->konfirmasi_tiket == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-konfirmasi-tiket/' . $item->id) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-konfirmasi-tiket/' . $item->id) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                <td>
                                                                    <a class="btn btn-danger btn-action"
                                                                        href="{{ url('superadmin/daftar-admin/hapus/' . $item->id) }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center">belum ada data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{ $admin->links() }}
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

    <script src="{{ asset('stisla/js/page/bootstrap-modal.js') }}"></script>

    {{-- AJAX DROPDOWN --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(function() {
            $("select").on("change", function() {
                if ($(this).val() === "") {
                    $("[data-parent]").hide();
                } else {
                    var selected = $(this).val();

                    //show input
                    var selectedparent = $("div[data-parent='" + selected + "']");
                    selectedparent.show().siblings("[data-parent]").hide();

                    //remove disabled to every input in selectedparent
                    selectedparent.find("select").removeAttr("disabled");
                    selectedparent.find("select").attr("required", true);
                    //disabled input other input that not in selectedparent
                    selectedparent.siblings("[data-parent]").find("select").attr("disabled", "disabled");
                    selectedparent.siblings("[data-parent]").find("select").removeAttr("required");

                    //Ajax
                    $('#province_' + selected).on('change', function() {
                        var province_id = $('#province_' + selected).val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('getRegency') }}",
                            data: {
                                province_id: province_id
                            },
                            success: function(msg) {
                                $('#regency_' + selected).html(msg);
                                $('#district_' + selected).html('');
                                $('#village_' + selected).html('');
                            },
                            error: function(data) {
                                console.log('error', data)
                            },
                        })
                    })
                    $('#regency_' + selected).on('change', function() {
                        var regency_id = $('#regency_' + selected).val();

                        $.ajax({
                            type: "POST",
                            url: "{{ route('getDistrict') }}",
                            data: {
                                regency_id: regency_id
                            },
                            success: function(msg) {
                                $('#district_' + selected).html(msg);
                                $('#village_' + selected).html('');
                            },
                            error: function(data) {
                                console.log('error', data)
                            },
                        })
                    })
                    $('#district_' + selected).on('change', function() {
                        var district_id = $('#district_' + selected).val();

                        $.ajax({
                            type: "POST",
                            url: "{{ route('getVillage') }}",
                            data: {
                                district_id: district_id
                            },
                            success: function(msg) {
                                $('#village_' + selected).html(msg);
                            },
                            error: function(data) {
                                console.log('error', data)
                            },
                        })
                    })
                }
            })
        });
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    @include('components.pop-up')
    <script>
        $(document).ready(function() {

            $.validator.addMethod("regex", function(value, element) {
                return this.optional(element) ||
                    /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/.test(value);
            }, "password harus sesuai regex");

            $.validator.addMethod("phoneRegex", function(value, element) {
                return this.optional(element) || /^(\+\d{1,})?\d+$/.test(value);
            }, "Format nomor telepon tidak valid");

            $('#tambah-admin').validate({
                rules: {
                    name: {
                        required: true
                    },
                    role_id: {
                        required: true
                    },
                    province_2: {
                        required: true
                    },
                    regency_2: {
                        required: true
                    },
                    province_3: {
                        required: true
                    },
                    regency_3: {
                        required: true
                    },
                    district_3: {
                        required: true
                    },
                    village_3: {
                        required: true
                    },
                    province_4: {
                        required: true
                    },
                    regency_4: {
                        required: true
                    },
                    district_4: {
                        required: true
                    },
                    village_4: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        regex: true
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        regex: true,
                        equalTo: "#password"
                    },
                    phone: {
                        phoneRegex: true
                    }
                },
                messages: {
                    name: {
                        required: "<strong>nama wajib diisi.</strong>",
                    },
                    role_id: {
                        required: "<strong>peran wajib diisi.</strong>"
                    },
                    province_2: {
                        required: "<strong>provinsi wajib diisi.</strong>"
                    },
                    regency_2: {
                        required: "<strong>kabupaten/kota wajib diisi.</strong>"
                    },
                    province_3: {
                        required: "<strong>provinsi wajib diisi.</strong>"
                    },
                    regency_3: {
                        required: "<strong>kabupaten/kota wajib diisi.</strong>"
                    },
                    district_3: {
                        required: "<strong>kecamatan wajib diisi.</strong>"
                    },
                    village_3: {
                        required: "<strong>desa wajib diisi.</strong>"
                    },
                    province_4: {
                        required: "<strong>provinsi wajib diisi.</strong>"
                    },
                    regency_4: {
                        required: "<strong>kabupaten/kota wajib diisi.</strong>"
                    },
                    district_4: {
                        required: "<strong>kecamatan wajib diisi.</strong>"
                    },
                    village_4: {
                        required: "<strong>desa wajib diisi.</strong>"
                    },
                    email: {
                        required: "<strong>email wajib diisi.</strong>",
                        email: "<strong>email harus berupa alamat surel yang valid.</strong>"
                    },
                    password: {
                        required: "<strong>password wajib diisi.</strong>",
                        minlength: "<strong>password minimal berisi 6 karakter.</strong>",
                        regex: "<strong>password wajib menggunakan karakter: A-Z,a-z,0-9, dan non-alphanumberic (contoh: !, $, #, atau %).</strong>"
                    },
                    password_confirmation: {
                        required: "<strong>password wajib diisi.</strong>",
                        minlength: "<strong>password minimal berisi 6 karakter.</strong>",
                        regex: "<strong>password wajib menggunakan karakter: A-Z,a-z,0-9, dan non-alphanumberic (contoh: !, $, #, atau %).</strong>",
                        equalTo: "<strong>konfirmasi password tidak cocok.</strong>"
                    },
                    phone: {
                        phoneRegex: "<strong>format nomor telepon tidak valid.</strong>"
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
