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
                                                <button class="btn_cart pl-4 bg-transparent text-white" type="button" style="">
                                                    <i class="fas fa-shopping-cart"></i><span class="small pl-2">Keranjang</span>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-12 col-lg-8 p-0">
                                            <div class="dropdown w-100">
                                                <button class="btn_1 w-100 pl-4 text-justify rounded-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-user"></i> <span class="pl-2">{{ auth()->user()->name }}</span>
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

    <section id="keranjang" class="keranjang">
        <div class="container" data-aos="fade-up">
            <div class="itemKeranjang">
                <h4>Keranjang Anda</h4>
                <form action="{{ url('/keranjang/checkout') }}" method="POST">
                    @csrf
                    @forelse($keranjang as $k)
                        <div class="detailItem">
                            <div class="row">
                                <div class="col-sm-1">
                                    <label class="custom-control overflow-checkbox">
                                        <input type="checkbox" class="overflow-control-input" value="{{ $k->id }}" name="keranjang[]">
                                        <span class="overflow-control-indicator"></span>
                                    </label>
                                </div>
                                <div class="col-sm-11">
                                    <div class="deskripsiItem">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>
                                                    @if($k->tipe == 'paket')
                                                        Paket destinasi {{ $k->paketDestinasi[0]->nama_paket }}
                                                    @else
                                                        Destinasi {{ $k->destinasi[0]->nama_destinasi }}
                                                    @endif
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p>
                                                            Tipe
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>
                                                            : {{ $k->tipe }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p>
                                                            Harga
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>
                                                            : @currency($k->total_pembayaran)
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <p>
                                                            Tanggal Kunjungan
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <p>
                                                            : {{ $k->tanggal_kunjungan }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <p>
                                                            Jumlah
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <p>
                                                            : {{ $k->jumlah }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6"></div>
                                                    <div class="col-sm-2">
                                                        <!-- bootstrap info button -->
                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $k->id }}">
                                                            <i class="fas fa-info-circle"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- bootstrap edit button -->
                                                        <a class="btn btn-warning" href="{{ url('keranjang/edit/'.$k->id) }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <!-- bootstrap delete button -->
                                                        <a type="button" class="btn btn-danger" href="{{ url('keranjang/delete/'.$k->id) }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <h4>
                                            @if($k->tipe == 'paket')
                                                {{ $k->paketWahana()->wherePivot('index',1)->pluck('nama_paket')->implode('+')}}
                                            @else
                                                {{ $k->paketWahana()->wherePivot('index',1)->pluck('nama_paket')->implode('+') }}
                                            @endif
                                            </h4>
                                            <h5>Rp {{ $k->total_pembayaran }}</h5> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="detailItem">
                            <div class="row">
                                <div class="col-sm-1">
                                    <label class="custom-control overflow-checkbox">
                                        <input type="checkbox" class="overflow-control-input" value="1">
                                        <span class="overflow-control-indicator"></span>
                                    </label>
                                </div>
                                <div class="col-sm-11">
                                    <div class="deskripsiItem">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <h2>Tiket Destinasi 1</h2>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="number" name="inputKeranjang" id="inputkeranjang"
                                                    min="1" value="1">
                                                <button class="btn_del" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <h4></h4>
                                        <p>Rp 8.000</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @empty
                        <div class="detailItem">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <p>Keranjang Kosong</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-sm-2">
                            <h4 class="text-right">Total : Rp. </h4>
                        </div>
                        <div class="col-sm-2 pl-0">
                            <h4 id="totalHarga" class="text-left">0</h4>
                        </div>
                    </div>
                    <button id="buttonCO" type="submit">Checkout</button>
                </form>
            </div>
        </div>
    </section>
    @foreach($keranjang as $item)
        <div class="modal fade" id="exampleModal{{ $item->id }}" style="z-index: 9999">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Header Modal -->
                    <div class="modal-header">
                        <h5 class="modal-title">Isi Keranjang</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Body Modal -->
                    <div class="modal-body">
                        @if($item->tipe == "paket")
                            <p class="card-text">Paket Destinasi {{ $item->paketDestinasi[0]->nama_paket }}
                                <span class="badge badge-primary badge-pill">@currency($item->paketDestinasi[0]->harga_paket)</span></p>
                                @php
                                    $destinasi = [];
                                @endphp
                                @foreach($item->destinasi as $des)
                                    @if($des->pivot->index == 1 && !in_array($des->id, $destinasi))
                                        @php
                                            array_push($destinasi, $des->id);
                                        @endphp
                                    <p class="card-text">Destinasi {{ $des->nama_destinasi }}</p>
                                    <ul class="list-group">
                                        @foreach($item->paketWahana as $paket)
                                            @if($paket->pivot->index == 1 && $paket->pivot->destinasi_id == $des->id)
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-9">
                                                            {{ $paket->nama_paket }}
                                                        </div>
                                                        <div class="col-3">
                                                            <!-- make a label -->
                                                            <span class="badge badge-primary badge-pill">@currency($paket->harga_paket)</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p class="card-text" style="font-size: 12px">
                                                                {{ implode(' + ', $paket->wahana->pluck('nama_wahana')->toArray()) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    @endif
                                @endforeach
                        @elseif($item->tipe == "destinasi")
                            <p class="card-text">Destinasi {{ $item->destinasi[0]->nama_destinasi }}
                                <span class="badge badge-primary badge-pill">@currency($item->destinasi[0]->htm_destinasi)</span>
                            </p>
                            <ul class="list-group">
                                @foreach($item->paketWahana as $paket)
                                    @if($paket->pivot->index == 1)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-9">
                                                    {{ $paket->nama_paket }}
                                                </div>
                                                <div class="col-3">
                                                    <!-- make a label -->
                                                    <span class="badge badge-primary badge-pill">@currency($paket->harga_paket)</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="card-text" style="font-size: 12px">
                                                        {{ implode(' + ', $paket->wahana->pluck('nama_wahana')->toArray()) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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
        $(document).ready(function() {
            const hargaKeranjang = [
                @foreach($keranjang as $k)
                    {
                        id: {{ $k->id }},
                        harga: {{ $k->total_pembayaran }},
                        jumlah: {{ $k->jumlah }}
                    },
                @endforeach
            ];

            let totalKeranjang = 0;

            //check if checkbox name "keranjang[]" is checked/unchecked
            $('input[name="keranjang[]"]').on('change', function() {
                //get the value of checkbox
                const id = $(this).val();
                //get the index of checkbox
                const index = hargaKeranjang.findIndex((item) => item.id == id);
                //check if checkbox is checked
                if ($(this).is(':checked')) {
                    //add the price to total price
                    totalKeranjang += hargaKeranjang[index].harga * hargaKeranjang[index].jumlah;
                } else {
                    //remove the price from total price
                    totalKeranjang -= hargaKeranjang[index].harga * hargaKeranjang[index].jumlah;
                }
                //set the total price
                $('#totalHarga').html(`${totalKeranjang}`);
            });
        });
    </script>
</body>

</html>
