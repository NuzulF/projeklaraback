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
                        <li class="active">
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
                {{-- EDIT --}}
                <div class="modal fade" id="myEdit{{ Auth::user()->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="myEditLabel{{ Auth::user()->id }}" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 1000px">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Profil Destinasi</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <form id="edit-profil"
                                    action="{{ url('/admin-destinasi/edit-profil', $profil['id']) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="nama_destinasi" class="col-sm-2 col-form-label">Destinasi</label>
                                        <input type="text" class="form-control" name="nama_destinasi"
                                            id="nama_destinasi" placeholder="Nama Admin"
                                            value="{{ $profil['nama_destinasi'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_id" class="col-form-label">Kategori</label>
                                        <div>
                                            <select class="form-control" name="kategori_id" id="kategori_id">
                                                @foreach ($kategori as $item)
                                                    @if ($item['id'] == $profil['kategori_id'])
                                                        <option value="{{ $item['id'] }}" selected>
                                                            {{ $item['nama_kategori'] }}</option>
                                                    @else
                                                        <option value="{{ $item['id'] }}">
                                                            {{ $item['nama_kategori'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoDestinasi" class="col-form-label">Foto</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="fotoDestinasi"
                                                    name="foto_destinasi[]" multiple onchange="previewImage()">
                                                <label class="custom-file-label" for="fotoDestinasi">Choose multiple
                                                    file</label>
                                            </div>
                                        </div>
                                        <div id="carouselExampleControlsCreate" class="carousel slide p-1 mt-2"
                                            data-ride="carousel" style="background-color: #4f4f4f">
                                            <div class="carousel-inner">
                                                @php
                                                    $files = array_chunk($foto, 2);
                                                @endphp
                                                @foreach ($files as $groupFile)
                                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                        <div class="row">
                                                            @foreach ($groupFile as $file)
                                                                <div class="col"
                                                                    style="
                                                                    width: 250px;
                                                                    height: 200px;
                                                                    text-align: center;
                                                                ">
                                                                    <img src="{{ url('images/' . $file) }}"
                                                                        alt="{{ $file }}"
                                                                        style="
                                                                        max-width: 250px;
                                                                        object-fit: contain;
                                                                        height: 200px;
                                                                    ">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControlsCreate"
                                                role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControlsCreate"
                                                role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat_destinasi"
                                            id="alamat" placeholder="Nama Admin"
                                            value="{{ $profil['alamat_destinasi'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi_destinasi" id="deskripsi" rows="10"
                                            placeholder="Masukkan Deskripsi">{{ $profil['deskripsi_destinasi'] }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="htm_destinasi" class="col-form-label">HTM</label>
                                        <div>
                                            <input type="number" class="form-control" name="htm_destinasi"
                                                min="0" placeholder="Harga Tiket"
                                                value="{{ $profil['htm_destinasi'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="logo" class="col-form-label">Logo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="logo"
                                                    name="logo" onchange="previewLogo()">
                                                <label class="custom-file-label" for="logo">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="text-center" id="inputLogo">
                                            <img class="profile-user-img img-fluid img-square" alt="Logo"
                                                src="{{ asset('logo/' . $logo) }}" style="max-width: 250px; ">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END EDIT --}}

                <section class="section">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #fc544b">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total User</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $jumlahUser }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #47c636">
                                    <i class="fas fa-ticket"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Transaksi dilakukan</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $jumlahTransaksi }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #ffa426">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Wahana</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $jumlahWahana }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #19536e">
                                    <i class="fas fa-cube"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Paket</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $jumlahPaket }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Profil Destinasi</h4>
                                </div>
                                <div class="card-body">
                                    <h3 class="profile-username text-center"><b>Destinasi
                                            {{ $profil['nama_destinasi'] }}</b>
                                    </h3>
                                    @foreach ($kategori as $key => $kate)
                                        @if ($profil['kategori_id'] == $kate['id'])
                                            <p class="text-muted text-center">{{ $kate['nama_kategori'] }}</p>
                                        @endif
                                    @endforeach
                                    <div class="d-flex justify-content-center">
                                        <div id="carouselExampleIndicators" class="carousel slide"
                                            data-ride="carousel"
                                            style="height: 350px; width: 656.25px; position: relative; overflow: hidden; background-repeat: no-repeat; background-size: cover; background-position: center; z-index: 1;">
                                            <ol class="carousel-indicators">
                                                @foreach ($foto as $key => $image)
                                                    <li data-target="#carouselExampleIndicators"
                                                        data-slide-to="{{ $key }}"
                                                        @if ($key == 0) class="active" @endif></li>
                                                @endforeach
                                            </ol>
                                            <div class="carousel-inner">
                                                @foreach ($foto as $key => $image)
                                                    <div
                                                        class="carousel-item @if ($key == 0) active @endif">
                                                        <img src="{{ asset('images/' . $image) }}"
                                                            class="d-block w-100" alt="Image {{ $key }}">
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

                                    <h4 class="profile-username">Deskripsi</h4>
                                    <p class="text-muted">{!! $profil['deskripsi_destinasi'] !!}</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="profile-username">Alamat</h4>
                                            <p class="text-muted">{{ $profil['alamat_destinasi'] }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="profile-username">HTM</h4>
                                            <p class="text-muted">Rp.{{ $profil['htm_destinasi'] }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="profile-username">Logo</h4>
                                        {{-- <div class="text-center"> --}}
                                        <img class="profile-user-img img-fluid img-square" alt="Logo"
                                            src="{{ isset($logo) ? asset('logo/' . $logo) : asset('logo/default.png') }}"
                                            style="max-width: 250px; ">
                                    </div>
                                    <hr>
                                    <a class="btn btn-primary" data-toggle="modal"
                                        data-target="#myEdit{{ Auth::user()->id }}"><b>Edit</b></a>
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
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    @include('components.pop-up')
    <script>
        $(document).ready(function() {
            $('#edit-profil').validate({
                rules: {
                    nama_destinasi: {
                        required: true
                    },
                    kategori_id: {
                        required: true
                    },
                    fotoDestinasi: {
                        accept: "image/*"
                    },
                    alamat: {
                        required: true
                    },
                    htm_destinasi: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    nama_destinasi: {
                        required: "<strong>nama destinasi wajib diisi.</strong>",
                    },
                    kategori_id: {
                        required: "<strong>kategori wajib diisi.</strong>",
                    },
                    fotoDestinasi: {
                        accept: "<strong>file harus berupa gambar.</strong>",
                    },
                    alamat: {
                        required: "<strong>alamat wajib diisi.</strong>",
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
        });
    </script>

    <!-- Script Preview Logo JS -->
    <script>
        $(document).ready(function() {
            const input = $('#fotoDestinasi'); // Use jQuery to select the element
            const carousel = $('#carouselExampleControlsCreate');

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
                            height: 200px;
                            text-align: center;
                        `;
                        const img = document.createElement('img');
                        img.alt = file.name;
                        img.style = `
                            max-width: 250px;
                            object-fit: contain;
                            height: 200px;
                        `;
                        const reader = new FileReader();
                        reader.onload = function(oFREvent) {
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
    <script>
        function previewLogo() {
            var input = document.getElementById('logo');
            var previewContainer = document.getElementById('inputLogo');
            var previewImage = document.createElement('img');
            var previewText = document.createElement('div');

            // Mengecek apakah sudah ada gambar yang di-upload
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Menetapkan sumber gambar pratinjau
                    previewImage.src = e.target.result;

                    // Menetapkan atribut dan gaya gambar pratinjau
                    previewImage.classList.add('profile-user-img', 'img-fluid', 'img-square');
                    previewImage.alt = 'Logo';
                    previewImage.style.maxWidth = '250px';

                    // Menambahkan gambar pratinjau ke elemen pratinjau
                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(previewImage);
                };

                // Membaca berkas gambar sebagai URL data
                reader.readAsDataURL(input.files[0]);
            } else {
                // Menampilkan teks jika tidak ada berkas yang dipilih
                previewText.innerHTML = 'No file selected';
                previewContainer.innerHTML = '';
                previewContainer.appendChild(previewText);
            }
        }
    </script>

</body>

</html>
