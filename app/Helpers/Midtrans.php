<?php
// app/Helpers/Midtrans.php

namespace App\Helpers;

use GuzzleHttp\Client;

class Midtrans
{
    //hasil response (berisi snap token dan url untuk redirect user ke halaman pembayaran)
    public static function http($json)
    {
        if (config('app.env') == 'production') {
            $url = 'https://app.midtrans.com/snap/v1/transactions';
        } else {
            $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';
        }

        //membuat client untuk koneksi ke midtrans
        $client = new Client([
            'verify' => public_path('images/cacert.pem'), // Specify the path to the downloaded cacert.pem file
        ]);

        //mengirim request ke midtrans
        $response = $client->request('POST', $url, [
            'auth' => [config('midtrans.server_key'),''], //mengambil server key dari config
            'json' => $json
        ]);

        //menerima response dari midtrans
        return $response;
    }

    //hasil snap token saja
    public static function library($json)
    {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = $json;

            $snapTokenDestinasi = \Midtrans\Snap::getSnapToken($params);

            return $snapTokenDestinasi;
    }
}