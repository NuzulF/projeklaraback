<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar Destinasi</title>
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
                        <a href="{{ url('admin-desa') }}">
                            <span class="brand-text">GoTripJava</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="{{ url('admin-desa') }}"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ url('admin-desa/daftar-admin') }}"><i class="fas fa-user"></i>
                                <span>Daftar Admin</span></a>
                        </li>
                        <li class="active">
                            <a href="{{ url('admin-desa/destinasi') }}" class="nav-link"><i
                                    class="fas fa-map-marker-alt"></i>
                                <span>Destinasi</span></a>
                        </li>
                        <li>
                            <a href="{{ url('admin-desa/paket-destinasi') }}" class="nav-link"><i
                                    class="fas fa-box"></i>
                                <span>Paket</span></a>
                        </li>
                        <li>
                            <a href="{{ url('admin-desa/riwayat-edit') }}" class="nav-link"><i
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
                {{-- TAMBAH --}}
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog" style="max-width: 1000px">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Destinasi</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <form id="add-destinasi" action="{{ url('/admin-desa/tambah-destinasi') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                                        <div class="col-6">
                                                <div class="row">
                                                    <div class="col-6 form-group">
                                                        <label for="name" class="col-form-label">Nama</label>
                                                        <div>
                                                            <input type="text" class="form-control" name="nama_destinasi" id="nama_destinasi" value="{{ old('nama_destinasi') }}"
                                                                placeholder="Masukkan Nama Destinasi">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <label for="kategori_id" class="col-form-label">Kategori</label>
                                                        <div>
                                                            <select class="form-control" name="kategori_id" id="kategori_id">
                                                                <option value="">Pilih Kategori</option>
                                                                @foreach ($kategori as $item)
                                                                    <option value="{{ $item['id'] }}">
                                                                        {{ $item['nama_kategori'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fotoDestinasi" class="col-form-label">Foto (gunakan
                                                        Ctrl)</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="fotoDestinasiCreate"
                                                                name="foto_destinasi[]" multiple>
                                                            <label class="custom-file-label" for="fotoDestinasi">Choose
                                                                multiple file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="carouselExampleControlsCreate" class="carousel slide p-1" data-ride="carousel" style="background-color: #4f4f4f">
                                                    <div class="carousel-inner">

                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleControlsCreate" role="button" data-slide="prev">
                                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                      <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleControlsCreate" role="button" data-slide="next">
                                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                      <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                                <div id="img-preview"></div>
                                                <div class="form-group">
                                                    <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                                    <div>
                                                        <textarea class="form-control" name="deskripsi_destinasi" id="deskripsi" rows="3"
                                                            placeholder="Masukkan Deskripsi">{{ old('deskripsi_destinasi') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="htm_destinasi" class="col-form-label">HTM</label>
                                                    <div>
                                                        <input type="number" class="form-control" name="htm_destinasi" min="0" value="{{ old('htm_destinasi') }}"
                                                            placeholder="Harga Tiket">
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-6">
                                                <div class="form-group">
                                                    <label for="alamat" class="col-form-label">Alamat</label>
                                                    <div>
                                                        {{-- <input type="text" class="form-control" name="alamat_destinasi" value="{{ old('alamat_destinasi') }}"
                                                            placeholder="Masukkan Alamat Lengkap"> --}}
                                                        <textarea class="form-control" name="alamat_destinasi" id="alamat_destinasi" rows="1" style="height:100%;"
                                                            placeholder="Masukkan Alamat Lengkap">{{ old('alamat_destinasi') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="map" style="
                                                    background-color: #eee;
                                                    padding: 10px;
                                                    outline: 1px solid #ccc;
                                                ">
                                                    <div class="form-group m-0">
                                                        <label for="" class="col-form-label">Preview Lokasi</label>
                                                        <div id="map-preview" style="
                                                            background-color: #eee;
                                                        ">
                                                            <iframe
                                                                width="100%"
                                                                height="300"
                                                                frameborder="0"
                                                                scrolling="no"
                                                                marginheight="0"
                                                                marginwidth="0"
                                                                src="https://maps.google.com/maps?hl=id&q=&z=2&ie=UTF8&output=embed"
                                                            >
                                                            </iframe>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="maps_destinasi" class="col-form-label">Detail Lokasi untuk Map <!--(<a
                                                                href="{ url('maps') }" target="_blank">tutorial</a>)--></label>
                                                        <div>
                                                            {{-- <input type="text" class="form-control" name="maps_destinasi"
                                                                placeholder="Lokasi Maps" value="{{ old('maps_destinasi') }}"> --}}
                                                            <textarea class="form-control" name="maps_destinasi" id="maps_destinasi" rows="1" style="height:100%;" placeholder="Lokasi Maps">{{ old('maps_destinasi') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-0">
                                                        <label for="maps_zoom" class="col-form-label">Zoom Maps</label>
                                                        <div class="row pl-3 pr-3">
                                                            <input type="range" class="col-11 form-control-range p-0" name="maps_zoom" id="maps_zoom" min="2" max="21" value="{{ old('maps_zoom') ? old('maps_zoom') : 14 }}"><span id="percentCreate" class="col-1">60%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END TAMBAH --}}

                {{-- EDIT --}}
                @foreach ($destinasi as $dest)
                    <div class="modal fade" id="myEdit{{ $dest['id'] }}" tabindex="-1" role="dialog"
                        aria-labelledby="myEditLabel{{ $dest['id'] }}" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 1000px">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Destinasi</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Body Modal -->
                                <div class="modal-body">
                                    <form id="add-destinasi{{ $dest['id'] }}" action="{{ url('/admin-desa/edit-destinasi', $dest['id']) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <div class="row">
                                            <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6 form-group">
                                                            <label for="name{{ $dest['id'] }}" class="col-form-label">Nama</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="nama_destinasi" id="nama_destinasi{{ $dest['id'] }}" value="{{ $dest['nama_destinasi'] }}"
                                                                    placeholder="Masukkan Nama Destinasi" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 form-group">
                                                            <label for="kategori_id{{ $dest['id'] }}" class="col-form-label">Kategori</label>
                                                            <div>
                                                                <select class="form-control" name="kategori_id" id="kategori_id{{ $dest['id'] }}" required>
                                                                    <option value="" req>Pilih Kategori</option>
                                                                    @foreach ($kategori as $item)
                                                                        <option value="{{ $item['id'] }}" {{ ($dest['kategori_id'] == $item['id']) ? "selected" : "" }}>{{ $item['nama_kategori'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fotoDestinasi{{ $dest['id'] }}" class="col-form-label">Foto (gunakan
                                                            Ctrl)</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="fotoDestinasi{{ $dest['id'] }}"
                                                                    name="foto_destinasi[]" multiple>
                                                                <label class="custom-file-label" for="fotoDestinasi{{ $dest['id'] }}">Choose
                                                                    multiple file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="carouselExampleControls{{ $dest['id'] }}" class="carousel slide p-1" data-ride="carousel" style="background-color: #4f4f4f">
                                                        <div class="carousel-inner">
                                                            @php
                                                                //dest['foto_destinasi'] = "foto1.jpg|foto2.jpg|foto3.jpg"
                                                                //cange it to 2d array with 2 files each group
                                                                $files = explode("|", $dest['foto_destinasi']);
                                                                $files = array_chunk($files, 2);
                                                            @endphp
                                                            @foreach ($files as $groupFile)
                                                                <div class="carousel-item {{ ($loop->first) ? "active" : "" }}">
                                                                    <div class="row">
                                                                        @foreach ($groupFile as $file)
                                                                            <div class="col" style="
                                                                                width: 250px;
                                                                                height: 100px;
                                                                                text-align: center;
                                                                            ">
                                                                                <img src="{{ url('images/'.$file) }}" alt="{{ $file }}" style="
                                                                                    max-width: 250px;
                                                                                    object-fit: contain;
                                                                                    height: 100px;
                                                                                ">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExampleControls{{ $dest['id'] }}" role="button" data-slide="prev">
                                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                          <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleControls{{ $dest['id'] }}" role="button" data-slide="next">
                                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                          <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                    <div id="img-preview"></div>
                                                    <div class="form-group">
                                                        <label for="deskripsiEdit{{ $dest['id'] }}" class="col-form-label">Deskripsi</label>
                                                        <div>
                                                            <textarea class="form-control deskripsi" name="deskripsi_destinasi" id="deskripsiEdit{{ $dest['id'] }}" rows="3"
                                                                placeholder="Masukkan Deskripsi" required>{{ $dest['deskripsi_destinasi'] }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="htm_destinasi{{ $dest['id'] }}" class="col-form-label">HTM</label>
                                                        <div>
                                                            <input type="number" class="form-control" name="htm_destinasi" id="htm_destinasi{{ $dest['id'] }}" min="0" value="{{ $dest['htm_destinasi'] }}"
                                                                placeholder="Harga Tiket">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="alamat{{ $dest['id'] }}" class="col-form-label">Alamat</label>
                                                        <div>
                                                            {{-- <input type="text" class="form-control" name="alamat_destinasi" value="{{ old('alamat_destinasi') }}"
                                                                placeholder="Masukkan Alamat Lengkap"> --}}
                                                            <textarea class="form-control" name="alamat_destinasi" id="alamat_destinasi{{ $dest['id'] }}" rows="1" style="height:100%;"
                                                                placeholder="Masukkan Alamat Lengkap" required>{{ $dest['alamat_destinasi'] }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="map" style="
                                                        background-color: #eee;
                                                        padding: 10px;
                                                        outline: 1px solid #ccc;
                                                    ">
                                                        <div class="form-group m-0">
                                                            <label for="" class="col-form-label">Preview Lokasi</label>
                                                            <div id="map-preview{{ $dest['id'] }}" style="
                                                                background-color: #eee;
                                                            ">
                                                                <iframe
                                                                    width="100%"
                                                                    height="300"
                                                                    frameborder="0"
                                                                    scrolling="no"
                                                                    marginheight="0"
                                                                    marginwidth="0"
                                                                    src="https://maps.google.com/maps?hl=id&q={{ $dest['maps_destinasi' ]}}&z={{ $dest['maps_zoom'] }}&ie=UTF8&output=embed"
                                                                >
                                                                </iframe>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-0">
                                                            <label for="maps_destinasi{{ $dest['id'] }}" class="col-form-label">Detail Lokasi untuk Map <!--(<a
                                                                    href="{ url('maps') }" target="_blank">tutorial</a>)--></label>
                                                            <div>
                                                                {{-- <input type="text" class="form-control" name="maps_destinasi"
                                                                    placeholder="Lokasi Maps" value="{{ old('maps_destinasi') }}"> --}}
                                                                <textarea class="form-control" name="maps_destinasi" id="maps_destinasi{{ $dest['id'] }}" rows="1" style="height:100%;" placeholder="Lokasi Maps">{{$dest['maps_destinasi']}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-0">
                                                            <label for="maps_zoom{{ $dest['id'] }}" class="col-form-label">Zoom Maps</label>
                                                            <div class="row pl-3 pr-3">
                                                                <input type="range" class="col-11 form-control-range p-0" name="maps_zoom" id="maps_zoom{{ $dest['id'] }}" min="2" max="21" value="{{ $dest['zoom_maps'] }}"><span id="percent{{ $dest['id'] }}" class="col-1">60%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- END EDIT --}}

                <section class="section">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>List Destinasi</h4>
                                    <div class="card-header-action">
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah
                                            Destinasi</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table table-responsive">
                                        <table class="table-sm table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Destinasi</th>
                                                    <th scope="col">Kategori</th>
                                                    <th scope="col">HTM</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tools</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($destinasi as $d)
                                                    @foreach ($kategori as $k)
                                                        @if ($d['kategori_id'] == $k['id'])
                                                            <tr>
                                                                <td>{{ $d['nama_destinasi'] }}
                                                                </td>
                                                                <td>{{ $k['nama_kategori'] }}
                                                                </td>
                                                                <td>{{ $d['htm_destinasi'] }}
                                                                </td>
                                                                <td>
                                                                    @if ($d['approve'] == '1')
                                                                        <div class="badge badge-success">Approved</div>
                                                                    @else
                                                                        <div class="badge badge-warning">Waiting</div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a class="edit-kategori btn btn-primary btn-action mr-1"
                                                                        title="Edit" data-toggle="modal"
                                                                        data-target="#myEdit{{ $d['id'] }}"
                                                                        data-id="{{ $d['id'] }}">
                                                                        <i class="fas fa-pencil-alt"></i></a>
                                                                    <a class="btn btn-danger btn-action"
                                                                        href="{{ url('admin-desa/hapus-destinasi/' . $d['id']) }}">
                                                                        <i class="fas fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">belum ada data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{ $destinasi->links() }}
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

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
            CKEDITOR.replace('deskripsi')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
        $(function() {
            @foreach ($destinasi as $dest)
                CKEDITOR.replace('deskripsiEdit' + {{ $dest['id'] }})
                //bootstrap WYSIHTML5 - text editor
            @endforeach
            $('.textarea').wysihtml5()
        })
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    @include('components.pop-up')
    <script>
        $(document).ready(function() {
                $('#add-destinasi').validate({
                    rules: {
                        nama_destinasi: {
                            required: true
                        },
                        kategori_id: {
                            required: true
                        },
                        fotoDestinasi: {
                            accept:"image/*"
                        },
                        maps_destinasi: {
                            required: true
                        },
                        alamat_destinasi: {
                            required: true
                        },
                        htm_destinasi: {
                            required: true,
                            digits: true
                        }
                    },
                    messages: {
                        nama_destinasi: {
                            required: "<strong>nama destinasi wajib diisi.</strong>"
                        },
                        kategori_id: {
                            required: "<strong>kategori wajib diisi.</strong>"
                        },
                        fotoDestinasi: {
                            accept: "<strong>file harus berupa gambar.</strong>",
                        },
                        maps_destinasi: {
                            required: "<strong>peta destinasi wajib diisi.</strong>"
                        },
                        alamat_destinasi: {
                            required: "<strong>alamat destinasi wajib diisi.</strong>"
                        },
                        htm_destinasi: {
                            required: "<strong>harga tiket wajib diisi.</strong>",
                            digits: "<strong>harga harus berupa angka.</strong>",
                            min: "<strong>harga minimal bernilai 0</strong>"
                        },
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
                @foreach ($destinasi as $dest)
                    $('#edit-destinasi{{ $dest["id"] }}').validate({
                        rules: {
                            nama_destinasi: {
                                required: true
                            },
                            kategori_id: {
                                required: true
                            },
                            fotoDestinasi: {
                                accept:"image/*"
                            },
                            maps_destinasi: {
                                required: true
                            },
                            alamat_destinasi: {
                                required: true
                            },
                            htm_destinasi: {
                                required: true,
                                digits: true
                            }
                        },
                        messages: {
                            nama_destinasi: {
                                required: "<strong>nama destinasi wajib diisi.</strong>"
                            },
                            kategori_id: {
                                required: "<strong>kategori wajib diisi.</strong>"
                            },
                            fotoDestinasi: {
                                accept: "<strong>file harus berupa gambar.</strong>",
                            },
                            maps_destinasi: {
                                required: "<strong>peta destinasi wajib diisi.</strong>"
                            },
                            alamat_destinasi: {
                                required: "<strong>alamat destinasi wajib diisi.</strong>"
                            },
                            htm_destinasi: {
                                required: "<strong>harga tiket wajib diisi.</strong>",
                                digits: "<strong>harga harus berupa angka.</strong>",
                                min: "<strong>harga minimal bernilai 0</strong>"
                            },
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

    <!-- Script Preview Logo JS -->
    <script>
        $(document).ready(function () {
            const input = $('#fotoDestinasiCreate'); // Use jQuery to select the element
            const carousel = $('#carouselExampleControlsCreate');
            carousel.hide();

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
                const carouselInner = $('#carouselExampleControlsCreate .carousel-inner');
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
                            width: 250px;
                            height: 100px;
                            text-align: center;
                        `;
                        const img = document.createElement('img');
                        img.alt = file.name;
                        img.style = `
                            max-width: 250px;
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

            @foreach ($destinasi as $dest)
            const input{{ $dest['id'] }} = $('#fotoDestinasi{{ $dest['id'] }}'); // Use jQuery to select the element
            const carousel{{ $dest['id'] }} = $('#carouselExampleControls{{ $dest['id'] }}');

            input{{ $dest['id'] }}.on('change', (event) => {
                carousel{{ $dest['id'] }}.hide();
                carousel{{ $dest['id'] }}.find('.carousel-inner').empty();
                //const files = Array.from(event.target.files);
                //make it 2d array with 2 files each
                const files = Array.from(event.target.files).reduce((acc, file, i) => {
                    const index = Math.floor(i / 2);
                    acc[index] = acc[index] || [];
                    acc[index].push(file);
                    return acc;
                }, []);
                const carouselInner = $('#carouselExampleControls{{ $dest['id'] }} .carousel-inner');
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
                            width: 250px;
                            height: 100px;
                            text-align: center;
                        `;
                        const img = document.createElement('img');
                        img.alt = file.name;
                        img.style = `
                            max-width: 250px;
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
                carousel{{ $dest['id'] }}.show();
            });
            @endforeach
        });
    </script>
    <script>
        $(document).ready(function () {
            const nameCreate = $('#nama_destinasi');
            const addressCreate = $('#alamat_destinasi');
            const mapsCreate = $('#maps_destinasi');
            const zoomCreate = $('#maps_zoom');
            const previewCreate = $('#map-preview iframe');

            nameCreate.on('input', (event) => {
                mapsCreate.val(nameCreate.val()+", "+addressCreate.val());
                updateMap(mapsCreate, zoomCreate, previewCreate);
            });
            addressCreate.on('input', (event) => {
                mapsCreate.val(nameCreate.val()+", "+addressCreate.val());
                updateMap(mapsCreate, zoomCreate, previewCreate);
            });
            mapsCreate.on('input', (event) => {
                updateMap(mapsCreate, zoomCreate, previewCreate);
            });
            zoomCreate.on('input', function(){
                let valCreate = $(this).val();
                console.log(valCreate);
                let percentCreate = (valCreate-2)*5;
                $('#percentCreate').text(percentCreate+"%");
                updateMap(mapsCreate, zoomCreate, previewCreate);
            });

            @foreach ($destinasi as $dest)
                const name{{ $dest['id'] }} = $('#nama_destinasi{{ $dest['id'] }}');
                const address{{ $dest['id'] }} = $('#alamat_destinasi{{ $dest['id'] }}');
                const maps{{ $dest['id'] }} = $('#maps_destinasi{{ $dest['id'] }}');
                const zoom{{ $dest['id'] }} = $('#maps_zoom{{ $dest['id'] }}');
                const preview{{ $dest['id'] }} = $('#map-preview{{ $dest['id'] }} iframe');

                name{{ $dest['id'] }}.on('input', (event) => {
                    maps{{ $dest['id'] }}.val(name{{ $dest['id'] }}.val()+", "+address{{ $dest['id'] }}.val());
                    updateMap(maps{{ $dest['id'] }}, zoom{{ $dest['id'] }}, preview{{ $dest['id'] }});
                });
                address{{ $dest['id'] }}.on('input', (event) => {
                    maps{{ $dest['id'] }}.val(name{{ $dest['id'] }}.val()+", "+address{{ $dest['id'] }}.val());
                    updateMap(maps{{ $dest['id'] }}, zoom{{ $dest['id'] }}, preview{{ $dest['id'] }});
                });
                maps{{ $dest['id'] }}.on('input', (event) => {
                    updateMap(maps{{ $dest['id'] }}, zoom{{ $dest['id'] }}, preview{{ $dest['id'] }});
                });
                zoom{{ $dest['id'] }}.on('input', function(){
                    let val{{ $dest['id'] }} = $(this).val();
                    let percent{{ $dest['id'] }} = (val{{ $dest['id'] }}-2)*5;
                    $('#percent{{ $dest['id'] }}').text(percent{{ $dest['id'] }}+"%");
                    updateMap(maps{{ $dest['id'] }}, zoom{{ $dest['id'] }}, preview{{ $dest['id'] }});
                });
            @endforeach

            function updateMap(maps, zoom, preview) {
                const mapsVal = encodeURIComponent(maps.val());
                const zoomVal = zoom.val();
                const newUrl = "https://maps.google.com/maps?hl=id&q="+mapsVal+"&z="+zoomVal+"&ie=UTF8&output=embed"
                preview.attr('src', newUrl);
            }
        });
    </script>
</body>

</html>
