<!DOCTYPE html>
<html>

<head>
    <title>GoTripJava</title>
</head>

<body>
    <style>
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -7.5px;
            margin-left: -7.5px;
        }

        .col-md-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
            position: relative;
            width: 100%;
            padding-right: 7.5px;
            padding-left: 7.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid black;
        }
    </style>
    <img src="data:image/png;base64,{{ $data['imageData'] }}" alt="Gambar" style="max-height: 100px" />
    <div class="row">
        <div class="col-md-6">
            <p>Nama : {{ $tiket->nama_pemesan }}</p>
            <p>Email : {{ $user->email }}</p>
            <p>Telp : {{ $user->phone }}</p>
        </div>
        <div class="col-md-6">
            <img src="data:image/png;base64,{{ $dataQrCode['qrCodeData'] }}" alt="Gambar" style="max-height: 100px" />
        </div>
    </div>
    <br>
    <p>Tanggal Kunjungan : {{ $tiket->tanggal_kunjungan }}</p>
    <table>
        <thead>
            <tr>
                <th>Nama Wisata</th>
                <th>Jumlah Tiket</th>
                <th>Harga Tiket</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @if ($paket !== null)
                    @if ($paket->wahana != null)
                        <td>{{ $paket->nama_paket }}({{ $paket->destinasi }}+({{ str_replace('|', ' + ', $paket->wahana) }}))
                        </td>
                    @else
                        <td>{{ $paket->nama_paket }}({{ str_replace('|', ' + ', $paket->destinasi) }})</td>
                    @endif
                @else
                    <td> {{ $destinasi->nama_destinasi }}</td>
                @endif
                <td>{{ $tiket->jumlah_tiket }}</td>
                @if ($paket !== null)
                    <td>Rp.{{ $paket->harga_paket }}</td>
                @else
                    <td> Rp.{{ $destinasi->htm_destinasi }}</td>
                @endif
                @if ($paket !== null)
                    <td>Rp.{{ $paket->harga_paket * $tiket->jumlah_tiket }}</td>
                @else
                    <td> Rp.{{ $destinasi->htm_destinasi * $tiket->jumlah_tiket }}</td>
                @endif
            </tr>
        </tbody>
    </table>
    <h2 style="text-align: center">ITEM YANG SUDAH DIBELI, UANG TIDAK DAPAT DIKEMBALIKAN .</h2>
</body>

</html>

{{-- KURANG

    - PDF logo GoTripJava (sudah)
    - PDF qrcode (sudah)
    - footer (sudah)
    - cek + ganti logo GoTripJava seluruh web (sudah)

--}}
