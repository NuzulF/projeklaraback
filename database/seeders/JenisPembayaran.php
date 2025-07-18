<?php

namespace Database\Seeders;

use App\Models\JenisPembayaran as ModelsJenisPembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPembayaran extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisPembayaran = [
            [
                'nama' => 'Bank Transfer',
                'kode' => 'bank_transfer',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true,
            ],
            [
                'nama' => 'Virtual Account',
                'kode' => 'permata_va',
                'enabled_payment' => true,
                'identifikasi_transaksi' => false,
                'id_parent_jenis_pembayaran' => 1,
                'status' => true,
            ],
            [
                'nama' => 'BNI VA',
                'kode' => 'bni_va',
                'enabled_payment' => true,
                'identifikasi_transaksi' => false,
                'id_parent_jenis_pembayaran' => 1,
                'status' => true,
            ],
            [
                'nama' => 'BRI VA',
                'kode' => 'bri_va',
                'enabled_payment' => true,
                'identifikasi_transaksi' => false,
                'id_parent_jenis_pembayaran' => 1,
                'status' => true,
            ],
            [
                'nama' => 'Other VA',
                'kode' => 'other_va',
                'enabled_payment' => true,
                'identifikasi_transaksi' => false,
                'id_parent_jenis_pembayaran' => 1,
                'status' => true,
            ],
            [
                'nama' => 'Danamon Online',
                'kode' => 'danamon_online',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true,
            ],
            [
                'nama' => 'CIMB Clicks',
                'kode' => 'cimb_clicks',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true
            ],
            [
                'nama' => 'BCA Klikpay',
                'kode' => 'bca_klikpay',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true
            ],
            [
                'nama' => 'BRI Epay',
                'kode' => 'bri_epay',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true
            ],
            [
                'nama' => 'CS Store',
                'kode' => 'cstore',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true
            ],
            [
                'nama' => 'Indomaret',
                'kode' => 'indomaret',
                'enabled_payment' => true,
                'identifikasi_transaksi' => false,
                'id_parent_jenis_pembayaran' => 10,
                'status' => true
            ],
            [
                'nama' => 'Alfamart',
                'kode' => 'alfamart',
                'enabled_payment' => true,
                'identifikasi_transaksi' => false,
                'id_parent_jenis_pembayaran' => 10,
                'status' => true
            ],
            [
                'nama' => 'Credit Card',
                'kode' => 'credit_card',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true
            ],
            [
                'nama' => 'QRIS',
                'kode' => 'qris',
                'enabled_payment' => false,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true
            ],
            [
                'nama' => 'Other QRIS',
                'kode' => 'other_qris',
                'enabled_payment' => true,
                'identifikasi_transaksi' => false,
                'id_parent_jenis_pembayaran' => 14,
                'status' => true,
            ],
            [
                'nama' => 'Gopay',
                'kode' => 'gopay',
                'enabled_payment' => true,
                'identifikasi_transaksi' => false,
                'id_parent_jenis_pembayaran' => 14,
                'status' => true,
            ],
            [
                'nama' => 'Shopeepay',
                'kode' => 'shopeepay',
                'enabled_payment' => true,
                'identifikasi_transaksi' => false,
                'id_parent_jenis_pembayaran' => 14,
                'status' => true,
            ],
            [
                'nama' => 'EChannel',
                'kode' => 'echannel',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true,
            ],
            [
                'nama' => 'Akulaku',
                'kode' => 'akulaku',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true,
            ],
            [
                'nama' => 'Kredivo',
                'kode' => 'kredivo',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true,
            ],
            [
                'nama' => 'UOB EZPay',
                'kode' => 'uob_ezpay',
                'enabled_payment' => true,
                'identifikasi_transaksi' => true,
                'id_parent_jenis_pembayaran' => null,
                'status' => true
            ]
        ];

        foreach ($jenisPembayaran as $key => $value) {
            ModelsJenisPembayaran::create($value);
        }
    }
}