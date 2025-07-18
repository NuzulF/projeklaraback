<?php

namespace Database\Seeders;

use App\Models\ProfilDesa as ModelsProfilDesa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilDesa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nama_desa' => 'Desa Kare',
                'admin_id' => '6',
                'foto_desa' => 'pexels1.jpg',
                'deskripsi_desa' => 'Desa Kare Kecamatan Kare Kabupaten Madiun Terletak paling tenggara Kabupaten Madiun. Merupakan Daerah berbatasan dengan Kabupaten Lain yaitu Ponorogo,Trenggalek, Tulungagung, Nganjuk dan Kediri. Merupakan Daerah Pegunungan Wilis yang terdiri dari berbagai bukit dan gunung. Banyak Potensi Wisata yang bersifat alam dan buatan. Untuk itu perlu kebersamaan dalam pengelolaan alam yang ada di Kare melalui berbagai bidang dan inovasi yang terus menerus untuk melestarikan wisata alam tersebut guna kesejahteraan masyarakat Desa Kare.',
                'alamat_desa' => 'Jl. Raya Kandangan, Gondosuli, Kare, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060003',
            ],
            [
                'nama_desa' => 'Desa Bodag',
                'admin_id' => '7',
                'foto_desa' => 'pexels2.jpg',
                'deskripsi_desa' => 'Desa Bodag Kecamatan Kare Kabupaten Madiun merupakan desa di lereng gunung wilis, wilayahnya berbatasan dengan hutan. Penduduknya bermata pencaharian bertani berkebun dan beternak Tingkat pendidikan yg masih rendah serta mkjp yg renda serta wilayah yg berada di pinggiran membuat dusun butuh desa bodag masuk sebagai kampung KB.',
                'alamat_desa' => '7J9W+QQ4, Area Kebun/Hutan, Bodag, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060001',
            ],
            [
                'nama_desa' => 'Desa Curug Madu',
                'admin_id' => '8',
                'foto_desa' => 'pexels3.jpg',
                'deskripsi_desa' => 'Desa Wisata Curug Madu terletak di Kabupaten Pekalongan, Jawa Tengah, Indonesia. Desa ini terkenal karena keindahan alamnya yang masih asri dan alami. Di desa ini, terdapat sebuah air terjun yang indah yang bernama Curug Madu. Air terjun ini memiliki ketinggian sekitar 35 meter dan airnya jernih dan segar. Selain air terjun, di desa ini juga terdapat banyak objek wisata lainnya seperti perkebunan teh, kebun stroberi, dan juga banyak warung makan yang menjual makanan khas daerah Pekalongan. Selain itu, Desa Wisata Curug Madu juga dikenal sebagai pusat kerajinan bambu di Pekalongan. Para pengunjung bisa menyaksikan dan membeli berbagai macam produk kerajinan bambu yang dibuat oleh masyarakat setempat. Desa ini menjadi destinasi wisata yang populer di Pekalongan dan sering dikunjungi oleh wisatawan baik dari dalam maupun luar negeri.',
                'alamat_desa' => 'Lemahbang Lor, Lemah Abang, Kec. Doro, Kabupaten Pekalongan, Jawa Tengah 17438',
                'province_id' => '32',
                'regency_id' => '3326',
                'district_id' => '3326060',
                'village_id' => '3326060003',
            ],
            [
                'nama_desa' => 'Desa Kepel',
                'admin_id' => '9',
                'foto_desa' => 'pexels1.jpg',
                'deskripsi_desa' => 'Desa Wisata Kepel adalah sebuah destinasi wisata yang terletak di Kabupaten Magelang, Jawa Tengah, Indonesia. Desa ini terkenal karena keindahan alamnya yang menawarkan pemandangan yang memukau serta suasana yang tenang dan nyaman.',
                'alamat_desa' => 'Kepel, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060004',
            ],
            [
                'nama_desa' => 'Desa Brumbun',
                'admin_id' => '10',
                'foto_desa' => 'pexels1.jpg',
                'deskripsi_desa' => 'Desa wisata Brumbun terletak di lereng gunung wilis,tepatnya di kab.Madiun,Jawa timur,dekat dengan kota Madiun,hanya 20 menit saja,kegiatan tubing/kelen adalah kegiatan awal,kemudian sekarang berkembang untuk kegiatan wisata edukasi,kegiatan dikelola oleh Pokdarwis Taruna Utama Brumbun.berdiri sejak tahun 2016.',
                'alamat_desa' => 'Kepel, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519050',
                'village_id' => '3519050001',
            ],
            [
                'nama_desa' => 'Desa Kayupuring',
                'admin_id' => '11',
                'foto_desa' => 'pexels1.jpg',
                'deskripsi_desa' => 'Desa Wisata Kayupuring adalah sebuah destinasi wisata yang terletak di Kabupaten Madiun, Jawa Timur, Indonesia. Desa ini dikenal karena keindahan alamnya yang memukau serta kearifan lokal yang kental. Desa Wisata Kayupuring menawarkan suasana yang tenang dan harmoni dengan alam, menjadikannya tempat yang ideal untuk berlibur dan bersantai.',
                'alamat_desa' => 'Kepel, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'province_id' => '33',
                'regency_id' => '3326',
                'district_id' => '3326040',
                'village_id' => '3326040009',
            ],
            [
                'nama_desa' => 'Desa Lolong',
                'admin_id' => '12',
                'foto_desa' => 'pexels1.jpg',
                'deskripsi_desa' => 'Desa Wisata Kayupuring adalah sebuah destinasi wisata yang terletak di Kabupaten Madiun, Jawa Timur, Indonesia. Desa ini dikenal karena keindahan alamnya yang memukau serta kearifan lokal yang kental. Desa Wisata Kayupuring menawarkan suasana yang tenang dan harmoni dengan alam, menjadikannya tempat yang ideal untuk berlibur dan bersantai.',
                'alamat_desa' => 'Kepel, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'province_id' => '33',
                'regency_id' => '3326',
                'district_id' => '3326070',
                'village_id' => '3326070004',
            ],
            [
                'nama_desa' => 'Desa Pakumbulan',
                'admin_id' => '13',
                'foto_desa' => 'pexels1.jpg',
                'deskripsi_desa' => 'Desa Wisata Kayupuring adalah sebuah destinasi wisata yang terletak di Kabupaten Madiun, Jawa Timur, Indonesia. Desa ini dikenal karena keindahan alamnya yang memukau serta kearifan lokal yang kental. Desa Wisata Kayupuring menawarkan suasana yang tenang dan harmoni dengan alam, menjadikannya tempat yang ideal untuk berlibur dan bersantai.',
                'alamat_desa' => 'Kepel, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'province_id' => '33',
                'regency_id' => '3326',
                'district_id' => '3326140',
                'village_id' => '3326140005',
            ],
            [
                'nama_desa' => 'Desa Wates',
                'admin_id' => '14',
                'foto_desa' => 'pexels1.jpg',
                'deskripsi_desa' => 'Desa Wisata Kayupuring adalah sebuah destinasi wisata yang terletak di Kabupaten Madiun, Jawa Timur, Indonesia. Desa ini dikenal karena keindahan alamnya yang memukau serta kearifan lokal yang kental. Desa Wisata Kayupuring menawarkan suasana yang tenang dan harmoni dengan alam, menjadikannya tempat yang ideal untuk berlibur dan bersantai.',
                'alamat_desa' => 'Kepel, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'province_id' => '33',
                'regency_id' => '3322',
                'district_id' => '3322010',
                'village_id' => '3322010010',
            ],
            [
                'nama_desa' => 'Desa Bejales',
                'admin_id' => '15',
                'foto_desa' => 'pexels1.jpg',
                'deskripsi_desa' => 'Desa Wisata Kayupuring adalah sebuah destinasi wisata yang terletak di Kabupaten Madiun, Jawa Timur, Indonesia. Desa ini dikenal karena keindahan alamnya yang memukau serta kearifan lokal yang kental. Desa Wisata Kayupuring menawarkan suasana yang tenang dan harmoni dengan alam, menjadikannya tempat yang ideal untuk berlibur dan bersantai.',
                'alamat_desa' => 'Kepel, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'province_id' => '33',
                'regency_id' => '3322',
                'district_id' => '3322100',
                'village_id' => '3322100003',
            ],
        ];

        foreach ($user as $key => $value) {
            ModelsProfilDesa::create($value);
        }
    }
}
