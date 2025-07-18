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
                                    <div class="w-50">
                                        <form class="row g-3" action="" method="GET">
                                            <div class="col-8">
                                                <input type="text" name="order_id" @if(isset($transaksi)) value="{{ $transaksi->order_id }}" @endif class="input form-control w-100" id="kode" placeholder="Masukkan kode tiket">
                                            </div>
                                            <div class="col-4">
                                                    <button class="btn btn-primary" id="btnCetak">Cari</button>
                                                    <button id="qr" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                        <i class="fas fa-qrcode"></i>
                                                    </button>
                                            </div>
                                        </form>
                                    </div>
                                    @if(isset($gagal) && $gagal == true)
                                        <p class="text-danger mt-5">Transaksi tidak ditemukan</p>
                                    @endif
                                    @if(isset($transaksi))
                                        <div class="mt-5">
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
                                                                    {{ $index }} ({{ implode(',', $item["paket_wahana"]) }}) [{{ $item["kode_tiket"] }}]
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
                                            <button class="btn btn-success" id="cetak">Cetak</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">QR Scanner</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div style="
                            width: 100%;
                            max-width: 500px;
                            max-height: 500px;" id="reader"></div>
                    </div>
                  </div>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script type="text/javascript" src="{{ url('js/qz-tray.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.1/canvg.min.js" integrity="sha512-IqDpl6qmu6Tc4K1q6v/98X61sOBLurjwtOxA9K5eFJaEmX9fCeCiBq8PYer1QzAGQED25S2LEeSFOINo8O4S0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('components.pop-up')
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
                        const config = qz.configs.create(printer);

                        const data = [{
                            type: 'pixel',
                            format: 'image',
                            flavor: 'base64',
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

                        //create barcode as jpeg
                        let barcode = document.createElement('canvas');
                        JsBarcode(barcode, e.value);
                        var barcodeJpeg = barcode.toDataURL("image/jpeg");

                        //display image on screen
                        //document.getElementById('barcode').innerHTML = '<img src="' + barcodeJpeg + '">';
                        printWithWebsocket(barcodeJpeg);
                    });
                });
            });
        </script>
    @endif
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
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
                    icon: "success",
                    title: "Qr Code berhasil discan",
                    showConfirmButton: false,
                    timer: 1500
                });
                window.location.href = "{{ url('qr/admin/scan') }}?order_id=" + code;
            }
        }
        $("#qr").click(function() {
            html5Qrcode.start(
                { facingMode: "environment" }, // constraints
                { aspectRatio: 1, fps: 2, qrbox: 325 }, // config
                qrCodeSuccessCallback
            ).then(ignore => {
                if (html5Qrcode.getState() != 1) {
                    $("#rreader").addClass("d-none");
                }
            }).catch(err => {
                // Start failed, handle it.
            });
        });

        function handleDisplayChange(mutationsList) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                    if ($('#exampleModal').is(':visible')) {
                        console.log(html5Qrcode.getState());
                    } else {
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
                    }
                }
            }
        }

        // Membuat MutationObserver
        const observer = new MutationObserver(handleDisplayChange);
        // Mengamati elemen dengan ID myElement
        observer.observe(document.getElementById('exampleModal'), { attributes: true });

    </script>
</body>

</html>
