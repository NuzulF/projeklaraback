<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GoTripJava</title>
    <link href="{{ url('/assets/img/Logo.png') }}" rel="icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/bootstrap.min.css') }}" />

    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/animate.css') }}" />

    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}" />

    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/themify-icons.css') }}" />

    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/flaticon.css') }}" />

    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('/assets/fontawesome/css/all.min.css') }}" />

    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ url('/assets/css/gijgo.min.css') }}" />

    <!-- nice select CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/nice-select.css') }}" />

    <!-- slick CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/slick.css') }}" />

    <!-- style CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/css/index.css">
    @include('components.css-pop-up')
    <style>
        .nc_select+.nice-select .list {
            max-height: 500px;
            /* Set a fixed height for the dropdown */
            overflow-y: auto;
            /* Add a vertical scrollbar if needed */
        }
        select.nc_select + div {
            height:54px !important;
        }
        .simple-keyboard.hg-layout-default .hg-button.hg-dark {
            background: rgba(0, 0, 0, 0.8);
            color: white;
        }
        .simple-keyboard.hg-layout-default .hg-button.hg-primary {
            background: #007bff;
            color: white;
        }
    </style>
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
                            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div style="top:0;" class="collapse navbar-collapse position-relative main-menu-item justify-content-between"
                                id="navbarSupportedContent">
                                <div class="navbar-nav ms-auto">
                                    <p>Nama tempat</p>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="recent-posts section_padding">
        <div class="container" data-aos="fade-up">
            <div class="section_tittle text-center">
                <h2>Cetak tiket</h2>
                <div id="barcode"></div>
                @if(isset($gagal) && $gagal == true)
                    <p class="text-danger">Transaksi tidak ditemukan</p>
                @endif
            </div>
            <div class="row gy-4">
                <div class="col-lg-6 col-md-6 col-12 mb-5 text-center">
                        <div class="mb-5">
                            <form class="row g-3" action="" method="GET">
                                <div class="col-10">
                                    <input type="text" name="order_id" class="input form-control w-100" id="kode" placeholder="Masukkan kode tiket">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="btnCetak">Cetak</button>
                                </div>
                            </form>
                        </div>
                        <div class="row simple-keyboard">
                        </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mb-5">
                    <div class="row justify-content-center text-center">
                        <div clas="col-12" style="
                            width: 75%;
                            height:0;
                            max-width: 440px;
                            max-height: 440px;
                            padding-bottom: 75%;
                            background-color:rgba(0, 0, 0, 0.225);
                            border-radius: 25px;
                            border: 2px solid rgba(0, 0, 0, 0.25);
                        " id="rreader">
                            <div style="font-weight: 900; font-size: 30px;color: rgba(0, 0, 0, 0.5);" class="pt-3">ATAU</div>
                            <div class="d-flex align-items-center justify-content-center">
                                <div style="font-size:200px">
                                    <i class="fa fa-qrcode" style="
                                        color: rgba(0, 0, 0, 0.5);
                                        outline: 7px dashed rgba(0, 0, 0, 0.5);
                                        padding-left: 10px;
                                        padding-right: 10px;
                                    " aria-hidden="true"></i>
                                </div>
                            </div>
                            <div style="font-weight: 900; font-size: 20px;color: rgba(0, 0, 0, 0.5);" class="pt-3">KLIK UNTUK SCAN KODE QR</div>
                        </div>
                        <div style="
                            width: 75%;
                            max-width: 440px;
                            max-height: 440px;
                            border-radius: 25px;
                        " id="reader"></div>
                    </div>
                </div>
            </div><!-- End recent posts list -->
        </div>
    </section>
    <!--::Destinasi Wisata End -->

    @if(isset($transaksi))
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Cetak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        @php
                            $keranjang = $transaksi->keranjang()->with('destinasi')->get();
                        @endphp
                        @foreach($keranjang as $ker)
                        <div class="row">
                            <div class="col-12">
                                <h5>Keranjang (tanggal: {{ $ker->tanggal_kunjungan }}, tipe: {{ $ker->tipe }})</h5>
                            </div>
                            @php
                                $items = $ker->destinasi->where('id', $destinasi->id);
                                $groupItemWithSameIndex = [];
                                foreach($items as $item) {
                                    $tiket = $ker->tikets->where('id', $item->pivot->tikets_id)->first();
                                    $index = $item->pivot->index;
                                    if (!isset($groupItemWithSameIndex[$index])) {
                                        $groupItemWithSameIndex[$index] = [
                                            "kode_tiket" => $tiket->kode_tiket,
                                            "paket_wahana" => []
                                        ];
                                        echo "<script>console.log('".$tiket->kode_tiket."')</script>";
                                    }
                                    array_push($groupItemWithSameIndex[$index]["paket_wahana"], $item->pivot->paket_wahana_id);
                                }
                            @endphp
                            <div class="col-12">
                            @forelse($groupItemWithSameIndex as $index => $item)
                                <div class="row">
                                    <div class="col-12">
                                        <label>
                                            <input type="checkbox" name="tiket" value="{{ $item["kode_tiket"] }}">
                                            {{ $index }} ({{ implode(',', $item["paket_wahana"]) }})
                                        </label>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col-12">
                                        <label>
                                            tidak tercatat ada pesanan untuk destinasi {{ $destinasi->nama_destinasi }}
                                        </label>
                                    </div>
                                </div>
                            @endforelse
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="cetak" class="btn btn-primary">Cetak</button>
                    </div>
            </div>
            </div>
        </div>
    @endif

    <footer class="footer-area" style="">
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
    <script src="{{ url('/assets/js/jquery-1.12.1.min.js') }}"></script>

    <!-- popper js -->
    <script src="{{ url('/assets/js/popper.min.js') }}"></script>

    <!-- bootstrap js -->
    <script src="{{ url('/assets/js/bootstrap.min.js') }}"></script>

    <!-- magnific js -->
    <script src="{{ url('/assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ url('/assets/js/owl.carousel.min.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('/assets/js/masonry.pkgd.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ url('/assets/js/gijgo.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ url('/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ url('/assets/js/jquery.form.js') }}"></script>
    <script src="{{ url('/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('/assets/js/mail-script.js') }}"></script>
    <script src="{{ url('/assets/js/contact.js') }}"></script>

    <!-- custom js -->
    <script src="{{ url('/assets/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/index.js"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    @include('components.pop-up')
    <script>

        const Keyboard = window.SimpleKeyboard.default;

        const myKeyboard = new Keyboard({
            onChange: input => onChange(input),
            onKeyReleased: button => onKeyReleased(button),
            layout: {

                'default': [
                    '1 2 3 4 5 6 7 8 9 0 {bksp}',
                    'Q W E R T Y U I O P',
                    'A S D F G H J K L',
                    'Z X C V B N M {enter}',
                ],
                'shift': [
                    '{shift}'
                ]
            },
            mergeDisplay: true,
            display: {
                '{bksp}': 'Hapus',
                '{enter}': '⏎ Cetak',
                '{shift}': 'Kembali ke semula',
            },
            buttonTheme: [
                {
                    class: "hg-dark",
                    buttons: "1 2 3 4 5 6 7 8 9 0"
                },
                {
                    class: "hg-primary",
                    buttons: "{enter} {bksp}"
                }
            ],
            debug: false,

        });

        function onChange(input) {
            $('.input').val(input);
        }

        function onKeyReleased(button) {
            if (button == "{enter}") {
                $('#btnCetak').click();
            }
        }

        $('.input').on("input", function() {
            var newValue = $(this).val();
            myKeyboard.setInput(newValue);
        });
    </script>
    <script>
        // function onScanSuccess(decodedText, decodedResult) {
        //     // Handle on success condition with the decoded text or result.
        //     console.log(`Scan result: ${decodedText}`, decodedResult);
        // }

        // var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
        // html5QrcodeScanner.render(onScanSuccess);
        var html5Qrcode = new Html5Qrcode("reader");
        var lastResult = null;
        console.log(html5Qrcode.getState());
        function qrCodeSuccessCallback(decodedText, decodedResult) {
            //console.log(`Scan result: ${decodedText}`, decodedResult);
            var urlcode = new URL(decodedText);
            var pathname = urlcode.pathname;
            var code = pathname.split('/').pop();
            // Output the extracted code
            //console.log(code);
            if (lastResult !== code) {
                lastResult = code;
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Kode QR berhasil dipindai',
                    icon: 'success',
                    confirmButtonText: 'Cetak',
                    showCancelButton: true,
                    cancelButtonText: 'Tutup',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ url('tesprint') }}?order_id=" + code;
                    }
                    if (result.isDismissed) {
                        lastResult = null;
                    }
                })
            }
        }
        $("#rreader").click(function() {
            html5Qrcode.start(
                { facingMode: "environment" }, // constraints
                { aspectRatio: 1, fps: 2, qrbox: 325 }, // config
                qrCodeSuccessCallback
            ).then(ignore => {
                if (html5Qrcode.getState() != 1) {
                    $("#rreader").addClass("d-none");
                }
                if (html5Qrcode.getState() == 2) {
                    $("#reader").css("outline","2px solid rgba(0, 0, 0, 0.25)");
                   // Add border-radius to video and #qr-shaded-region
                    $("#reader video").css("border-radius", "25px");
                    //buat timer 500ms
                    setTimeout(function() {
                        $("#reader #qr-shaded-region").css("border-radius", "25px");
                    }, 200);
                    // Add a new div with "Hello World" text
                    var helloWorldDiv = $("<div>").attr("id", "helloWorldDiv").text("Klik lagi untuk menonaktifkan kamera").css({
                        "text-align": "center",
                        "margin-top": "10px",
                        "position"  : "absolute",
                        "bottom"    : "0",
                        "z-index"   : "1",
                        "color"     : "#fff",
                        "width"     : "100%",
                        "margin-bottom" : "20px"
                    });

                    // Append the new div to #reader
                    $("#reader").append(helloWorldDiv);
                }
            }).catch(err => {
                // Start failed, handle it.
            });
        });
        $("#reader").click(function() {
            html5Qrcode.stop().then(ignore => {
                // QR Code scanning is stopped.
                html5Qrcode.clear();
                if (html5Qrcode.getState() == 1) {
                    $("#rreader").removeClass("d-none");
                    $("#reader").css("outline","none");
                }
            }).catch(err => {
                // Stop failed, handle it.
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script type="text/javascript" src="{{ url('js/qz-tray.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.1/canvg.min.js" integrity="sha512-IqDpl6qmu6Tc4K1q6v/98X61sOBLurjwtOxA9K5eFJaEmX9fCeCiBq8PYer1QzAGQED25S2LEeSFOINo8O4S0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if(isset($transaksi))
        <script>
            $(document).ready(function() {
                $('#modal').modal('show');

                let websocketConnected = false;
                if (!websocketConnected) {
                    qz.websocket.connect().then(() => {
                        websocketConnected = true;
                        console.log("Connected!");
                    }).catch((err) => {
                        console.error(err);
                    });
                }

                async function printWithWebsocket(imaji) {
                    try {
                        // Connection
                        if (!websocketConnected) {
                            await qz.websocket.connect();
                            websocketConnected = true;
                        }

                        // Automatically discovers default printer
                        const printer = await qz.printers.getDefault();
                        console.log("Default Printer:", printer);

                        // Now that you have the printer information, you can proceed to qz.print
                        const config = qz.configs.create(printer,
                        {
                            size: {width: 58, height: 34},
                            units: 'mm',
                            orientation: 'portrait',
                        });

                        const data = [{
                            type: 'pixel',
                            format: 'pdf',
                            flavor: 'file',
                            data: imaji
                        }];
                        // Print Image
                        await qz.print(config, data);
                        console.log("Sent!");
                    } catch (err) {
                        console.error('Error:', err);
                    }
                }

                //check if button cetak is clicked
                $('#cetak').click(function(e) {
                    e.preventDefault();

                    //get every input with name 'tiket' which checked to an array
                    var checkboxes = document.querySelectorAll('input[name="tiket"]:checked');

                    //loop through the array
                    checkboxes.forEach(e => {
                        printWithWebsocket("http://127.0.0.1/pdf/tiket/Tiket "+e.value+".pdf");
                    });
                });


        });
        </script>
    @endif
</body>

</html>
