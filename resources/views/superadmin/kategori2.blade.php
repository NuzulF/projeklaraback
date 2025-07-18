<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Kategori</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.css" integrity="sha512-9yS+ck0i78HGDRkAdx+DR+7htzTZJliEsxQOoslJyrDoyHvtoHmEv/Tbq8bEdvws7s1AVeCjCMOIwgZTGPhySw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <li class="active">
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
                {{-- EDIT --}}
                @foreach ($kategori as $kate2)
                    <div class="modal fade" id="myEdit{{ $kate2->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myEditLabel{{ $kate2->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Body Modal -->
                                <div class="modal-body">
                                    <form id="edit-kategori{{ $kate2->id }}"
                                        action="{{ url('/superadmin/edit-kategori', $kate2->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label>Nama *</label>
                                            <input type="text" class="form-control"
                                                id="nama_kategori{{ $kate2->id }}" name="nama_kategori"
                                                placeholder="Masukkan Nama Kategori"
                                                value="{{ $kate2->nama_kategori }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Icon Fontawesome</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="icon{{ $kate2->id }}" name="icon"
                                                value="{{ $kate2->icon }}" placeholder="example: fas fa-tree" required>
                                                <div class="input-group-append" style="
                                                    background-color: #efefef;
                                                    border: 1px solid #e4e6fc;
                                                ">
                                                    <div class="btn-group">
                                                        <button data-selected="{{ $string ?? "download" }}" type="button" id="editpicker{{ $kate2->id }}" class="icp btn btn-default dropdown-toggle iconpicker-component" data-toggle="dropdown">
                                                        <i class="{{ $kate2->icon }}"></i>
                                                        </button>
                                                        <div class="dropdown-menu"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" id="kateDeskripsi{{ $kate2->id }}" rows="3"
                                                placeholder="Masukkan Deskripsi">{{ $kate2->deskripsi }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- END EDIT --}}

                {{-- TAMBAH --}}
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <form id="tambah-kategori" action="{{ url('/superadmin/tambah-kategori') }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama *</label>
                                        <input type="text" class="form-control" id="nama_kategori"
                                            name="nama_kategori" value="{{ old('nama_kategori') }}"
                                            placeholder="Masukkan Nama Kategori" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Icon Fontawesome</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="icon" name="icon"
                                            value="{{ old('icon') }}" placeholder="example: fas fa-tree" required>
                                            <div class="input-group-append" style="
                                                background-color: #efefef;
                                                border: 1px solid #e4e6fc;
                                            ">
                                                <div class="btn-group">
                                                    <button data-selected="{{ $string ?? "download" }}" type="button" id="tambahpicker" class="icp btn btn-default dropdown-toggle iconpicker-component" data-toggle="dropdown">
                                                    <i class="{{ old('icon') ?? "fas fa-tree" }}"></i>
                                                    </button>
                                                    <div class="dropdown-menu"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Masukkan Deskripsi">{{ old('deskripsi') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END TAMBAH --}}

                <section class="section">
                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List Kategori</h4>
                                <div class="card-header-action">
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah
                                        Kategori</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table table-responsive">
                                    <table class="table-sm table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Icon</th>
                                                <th scope="col">Deskripsi</th>
                                                <th scope="col">Tool</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($kategori as $kate)
                                                <tr>
                                                    <td>{{ $kate->nama_kategori }}</td>
                                                    <td>
                                                        <i class="{{ $kate->icon }}"></i>
                                                    </td>
                                                    <td>{!! Str::limit($kate->deskripsi, 50, '...') !!}</td>
                                                    <td>
                                                        <a class="edit-kategori btn btn-primary btn-action mr-1"
                                                            title="Edit" data-toggle="modal"
                                                            data-target="#myEdit{{ $kate->id }}"
                                                            data-id="{{ $kate->id }}">
                                                            <i class="fas fa-pencil-alt"></i></a>
                                                        <a class="btn btn-danger btn-action"
                                                            href="{{ url('superadmin/kategori/proses-hapus/' . $kate->id) }}">
                                                            <i class="fas fa-trash"></i></a>
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
                                {{ $kategori->links() }}
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

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
            CKEDITOR.replace('deskripsi')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
        $(function() {
            @foreach ($kategori as $kate)
                CKEDITOR.replace('kateDeskripsi' + {{ $kate['id'] }})
                //bootstrap WYSIHTML5 - text editor
            @endforeach
            $('.textarea').wysihtml5()
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js" integrity="sha512-7dlzSK4Ulfm85ypS8/ya0xLf3NpXiML3s6HTLu4qDq7WiJWtLLyrXb9putdP3/1umwTmzIvhuu9EW7gHYSVtCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#tambahpicker').iconpicker();
            $('#tambahpicker').on('iconpickerSelected', function(event){
                $('#icon').val(event.iconpickerValue);
            });

            @foreach ($kategori as $kate2)
                $('#editpicker{{ $kate2->id }}').iconpicker();
                $('#editpicker{{ $kate2->id }}').on('iconpickerSelected', function(event){
                    $('#icon{{ $kate2->id }}').val(event.iconpickerValue);
                });
            @endforeach
        });
    </script>
    @include('components.pop-up')
    <script>
        $(document).ready(function() {
            $('#tambah-kategori').validate({
                rules: {
                    nama_kategori: {
                        required: true
                    },
                    icon: {
                        required: true
                    }
                },
                messages: {
                    nama_kategori: {
                        required: "<strong>nama kategori wajib diisi.</strong>"
                    },
                    icon: {
                        required: "<strong>icon wajib diisi.</strong>"
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

            @foreach ($kategori as $kate3)
                $('#edit-kategori{{ $kate3->id }}').validate({
                    rules: {
                        nama_kategori{{ $kate3->id }}: {
                            required: true
                        },
                        icon{{ $kate3->id }}: {
                            required: true
                        }
                    },
                    messages: {
                        nama_kategori{{ $kate3->id }}: {
                            required: "<strong>nama kategori wajib diisi.</strong>"
                        },
                        icon{{ $kate3->id }}: {
                            required: "<strong>icon wajib diisi.</strong>"
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
            @endforeach
        });
    </script>

</body>

</html>
