<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoTripJava</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}" />

    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }}" />

    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}" />

    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/themify-icons.css') }}" />

    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/flaticon.css') }}" />

    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('assets/fontawesome/css/all.min.css') }}" />

    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/gijgo.min.css') }}" />

    <!-- nice select CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/nice-select.css') }}" />

    <!-- slick CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/slick.css') }}" />

    <!-- style CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    @include('components.css-pop-up')
</head>

<body>
    <header class="main_menu">
        <div class="main_menu_iner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ url('assets/img/Logo GoTripJava.png') }}" alt="logo" />
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse main-menu-item justify-content-center"
                                id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('kabupaten') }}">Kabupaten</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link is-active" href="{{ url('desa') }}">Desa Wisata</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="navbar-nav ms-auto d-none d-lg-block">
                                @guest
                                    <a href="{{ url('login') }}" class="btn_1 text-center">Login</a>
                                @else
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="{{ url('keranjang') }}">
                                                <button class="btn_cart d-none d-lg-block" type="button">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="dropdown">
                                                <button class="btn_1 d-none d-lg-block dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-user"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{ url('wallet') }}">
                                                            <div class="row">
                                                                <div class="col-8">
                                                                    Wallet
                                                                </div>
                                                                <div class="col-4">
                                                                    <i class="fas fa-wallet"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="{{ url('daftar-pemesanan') }}">
                                                            <div class="row">
                                                                <div class="col-8">
                                                                    Pesanan
                                                                </div>
                                                                <div class="col-4">
                                                                    <i class="fas fa-shopping-bag"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="{{ url('logout') }}"
                                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                            <div class="row">
                                                                <div class="col-8">
                                                                    Logout
                                                                </div>
                                                                <div class="col-4">
                                                                    <i class="fas fa-sign-out-alt"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <form id="logout-form" action="{{ url('logout') }}" class="d-none">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endguest
                            </div>
                            <div class="navbar-nav ms-auto d-block d-lg-none">
                                @guest
                                    <a href="{{ url('login') }}" class="btn_1 text-center">Login</a>
                                @else
                                    <div class="row">
                                        <div class="col-12 col-lg-4 p-0" style="background: #092742;">
                                            <a href="{{ url('keranjang') }}" class="d-block w-100">
                                                <button class="btn_cart pl-4 bg-transparent text-white" type="button"
                                                    style="">
                                                    <i class="fas fa-shopping-cart"></i><span
                                                        class="small pl-2">Keranjang</span>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-12 col-lg-8 p-0">
                                            <div class="dropdown w-100">
                                                <button class="btn_1 w-100 pl-4 text-justify rounded-0" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-user"></i> <span
                                                        class="pl-2">{{ auth()->user()->name }}</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{ url('wallet') }}">
                                                            <div class="row">
                                                                <div class="col-8 text-left">
                                                                    Wallet
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <i class="fas fa-wallet"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="{{ url('daftar-pemesanan') }}">
                                                            <div class="row">
                                                                <div class="col-8 text-left">
                                                                    Pesanan
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <i class="fas fa-shopping-bag"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="{{ url('logout') }}"
                                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                            <div class="row">
                                                                <div class="col-8 text-left">
                                                                    Logout
                                                                </div>
                                                                <div class="col-4 text-right">
                                                                    <i class="fas fa-sign-out-alt"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <form id="logout-form" action="{{ url('logout') }}" class="d-none">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endguest
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="formAduan" class="blog formAduan">
        <div class="container" data-aos="fade-up">
            <div class="inputAduan">
                <h4>Formulir Aduan</h4>
                <form action="{{ url('aduan/' . $tiket->order_id) }}" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label for="inputNoTransaksi" class="form-label">Nomor Transaksi</label>
                        <input type="text" class="form-control" id="inputNoTransaksi" name="noTransaksi"
                            value="{{ $tiket->order_id }}" readonly>
                    </div>
                    <div class="col-12">
                        <label for="inputDestinasi" class="form-label">Jenis Aduan</label>
                        <select id="jenisAduan" name="jenisAduan" class="form-select"
                            aria-label="Default select example">
                            @foreach ($jenisAduan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Keranjang</label>
                        <select id="keranjang" name="keranjang" class="form-select"
                            aria-label="Default select example">
                            @foreach ($keranjang as $cart)
                                <option value="{{ $cart->id }}|{{$cart->tanggal_kunjungan}}" data-tanggal="{{ $cart->tanggal_kunjungan }}">
                                    ID{{ $cart->id }} {{ $cart->tanggal_kunjungan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="inputDetailAduan" class="form-label">Detail Aduan*</label>
                        <textarea type="text" class="form-control" id="inputDetailAduan" name="detailAduan"></textarea>
                    </div>
                    {{-- RESCHEDULE --}}
                    <div id="input1" style="display: none;" class="col-12">
                        <div>
                            <label for="tanggalBaru" class="form-label">Tanggal Kunjungan Baru*</label>
                            <input type="date" class="form-control" id="tanggalBaru" name="tanggalBaru"
                                required />
                        </div>
                    </div>
                    {{-- END RESCHEDULE --}}
                    <div class="col-12">
                        <label for="inputFile" class="form-label">Lampiran (Opsional)</label>
                        <input type="file" class="form-control" id="inputFile" name="lampiran"
                            accept="image/*"></input>
                    </div>
                    <div class="col-12">
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
                    </div>
                    <button type="submit" id="buttonAduan">Kirim</button>
                </form>
            </div>
        </div>
    </section>

    <footer class="footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-7">
                    <div class="single-footer-widget">
                        <h4 id="JudulFooter">GoTripJava</h4>
                        <p>
                            GoTripJava merupakan layanan promosi desa wisata yang akan membantu calon wisatawan untuk
                            memesan dan memperoleh informasi yang dibutuhkan dengan cara cepat dan mudah. <br><br>
                            Cari dan pesan tiket wisatamu sekarang hanya di GoTripJava!
                        </p>
                        <img src="{{ url('assets/img/logo/Logo UNS (1).png') }}" alt="UNS">
                        <img src="{{ url('assets/img/logo/LogoTypeSV-01.png') }}" alt="SV">
                        <img src="{{ url('assets/img/logo/LOGO PRODI UNS.png') }}" alt="D3TI">
                        <img src="{{ url('assets/img/logo/OASE Tanpa BG.jpg') }}" alt="OASE">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_icon">
                        <h4>Contact Us</h4>
                        <p>
                            Kampus Mesen UNS, Jl. Jend. Urip Sumoharjo No.116,
                            Purwodiningratan, Kec. Jebres, Kota Surakarta, Jawa Tengah 57129
                            <br />(0271) 663450
                        </p>
                        <span>kontak@d3ti.vokasi.uns.ac.id</span>
                        <div class="social-icons">
                            <a href="https://web.facebook.com/d3tiuns" target="_blank"><i
                                    class="ti-facebook"></i></a>
                            <a href="https://d3ti.vokasi.uns.ac.id/" target="_blank"><i class="ti-world"></i></a>
                            <a href="https://www.youtube.com/@teknikinformatikauns" target="_blank"><i
                                    class="ti-youtube"></i></a>
                            <a href="https://www.instagram.com/d3tiuns/?igshid=MzRlODBiNWFlZA%3D%3D"
                                target="_blank"><i class="ti-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="copyright_part_text text-center">
                        <p class="footer-text m-0">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->


    <!-- jquery plugins here-->
    <script src="{{ url('assets/js/jquery-1.12.1.min.js') }}"></script>

    <!-- popper js -->
    <script src="{{ url('assets/js/popper.min.js') }}"></script>

    <!-- bootstrap js -->
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

    <!-- magnific js -->
    <script src="{{ url('assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('assets/js/masonry.pkgd.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ url('assets/js/gijgo.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ url('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.form.js') }}"></script>
    <script src="{{ url('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('assets/js/mail-script.js') }}"></script>
    <script src="{{ url('assets/js/contact.js') }}"></script>

    <!-- custom js -->
    <script src="{{ url('assets/js/custom.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    @include('components.pop-up')
    <script>
        // Mendapatkan elemen select dan inputan yang ingin Anda kendalikan
        var jenisAduanSelect = document.getElementById('jenisAduan');
        var input1 = document.getElementById('input1');
        var input2 = document.getElementById('input2');

        // Inisialisasi tampilkan inputan berdasarkan nilai yang sudah terpilih
        if (jenisAduanSelect.value == '1') {
            input1.style.display = 'block';
            input2.style.display = 'none';
        } else {
            input1.style.display = 'none';
            input2.style.display = 'none';
        }

        // Menambahkan event listener untuk mengawasi perubahan dalam select
        jenisAduanSelect.addEventListener('change', function() {
            var selectedValue = jenisAduanSelect.value;

            // Tampilkan atau sembunyikan inputan sesuai dengan nilai yang dipilih
            if (selectedValue == '1') {
                input1.style.display = 'block';
                input2.style.display = 'none';
            } else {
                input1.style.display = 'none';
                input2.style.display = 'none';
            }
        });

        // tanggal (BELUM BISA)
        document.addEventListener('DOMContentLoaded', function() {
            var selectKeranjang = document.getElementById('keranjang');
            var inputTanggalBaru = document.getElementById('tanggalBaru');

            selectKeranjang.addEventListener('change', function() {
                var selectedOption = selectKeranjang.options[selectKeranjang.selectedIndex];
                var tanggalKunjungan = new Date(selectedOption.getAttribute('data-tanggal'));

                // Set batas tanggal pada input tanggalBaru
                inputTanggalBaru.setAttribute('min', formatDate(tanggalKunjungan));
            });

            // Format tanggal ke format yang sesuai untuk atribut "min"
            function formatDate(date) {
                var year = date.getFullYear();
                var month = String(date.getMonth() + 1).padStart(2, '0');
                var day = String(date.getDate()).padStart(2, '0');
                return year + '-' + month + '-' + day;
            }
        });
        // end tanggal
    </script>
    <script>
        $(document).ready(function () {
            const input = $('#inputFile'); // Use jQuery to select the element
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
        });
    </script>
</body>

</html>
