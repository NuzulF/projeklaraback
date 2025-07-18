<?php

namespace Database\Seeders;

use App\Models\Destinasi as ModelsDestinasi;
use Illuminate\Database\Seeder;

class Destinasi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinasi = [
            [
                'nama_destinasi' => 'Hutan Pinus Nongko Ijo',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060003',
                'deskripsi_destinasi' => 'Pohon Pinus ditanam mulai tahun 1981. Menurut pengelola hutan pinus, sejarah awal mula dinamakan "Nongko Ijo" berawal dari cerita dahulu pada awal ditanam pohon pinus terdapat pohon nongko hijau yang sangat besar yang tumbuh disekitar hutan. Hutan Pinus Nongko Ijo dikenal di masyarakat luas semenjak ada salah satu media masa (surat kabar) yang meliput keberadaan hutan pinus dengan isi berita menyebutkan nama hutan pinus nongko ijo. Hingga sekarang masyarakat mengenal hutan pinus tersebut dengan nama nongko ijo.',
                'maps_destinasi' => 'Hutan Pinus Nongko Ijo',
                'maps_zoom' => 14,
                'foto_destinasi' => 'pexels1.jpg|pexels3.jpg',
                'logo'=>'default.png',
                'alamat_destinasi' => 'Kare, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
                'logo' => 'hutan_pinus_nongko_ijo_1704827968.png'
            ],
            [
                'nama_destinasi' => 'Air Terjun Selampir',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060003',
                'deskripsi_destinasi' => 'Air terjun yang terletak di lereng gunung Wilis, tepatnya di Desa Kare. Destinasi ini masih satu wilayah dengan perkebunan kopi Kandangan di wilayah Kabupaten Madiun . Dengan ketinggian 400 m dpl serta luas sekitar 6 Ha, menjadikan tempat ini begitu sejuk dan nyaman untuk dinikmati . Dimanjakan dengan sumber mata air dari bawah gunung dan muncul di atas pepohonan yang rindang.',
                'maps_destinasi' => 'Air Terjun Selampir',
                'maps_zoom' => 14,
                'foto_destinasi' => 'alam.jpg|pexels1.jpg',
                'logo'=>'logo.png',
                'alamat_destinasi' => '7P33+29J, Branjang, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
                'logo' => 'default.png'
            ],
            [
                'nama_destinasi' => 'Agro Wisata Perkebunan Kopi Kandangan',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060003',
                'deskripsi_destinasi' => 'Bagi pecinta kopi, tempat ini tidak bisa kita abaikan. Robusta Wiis, begitulah para pecinta kopi menyebutnya. Kopi ini di tanam di area perkebunan yang luasnya kurang lebih 2.500 Ha. Destinasi ini memiliki sejarah panjang sejak masa kolonial Belanda. Konon, masa itu kopi Kandangan termasuk jajaran pabrik besar di Asia Tenggara dan pasarnya sampai ke Eropa. KIni, area ini sudah berkembang menjadi destinasi wisata unggulan di Kabupaten Madiun. Kita bisa mengenang masa kejayaan perkebunan kopi Kandangan, sambil menikmati hamparan hijau sejauh mata memandang. Jika kita pagi sekali datang kesini , akan disuguhi kabut tipis putih yang menyelimuti pucuk-pucuk pohon kopi.',
                'maps_destinasi' => 'Villa Perkebunan Kopi Kandangan',
                'maps_zoom' => 14,
                'foto_destinasi' => 'pexels2.jpg|pexels3.jpg|pexels1.jpg',
                'logo' => 'logo.png',
                'alamat_destinasi' => '6PR2+C86, Unnamed Road, Kempo, Kare, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
                'logo' => 'default.png'
            ],
            [
                'nama_destinasi' => 'Aswin Loka Seweru',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060003',
                'deskripsi_destinasi' => 'sarana wisata yang edukatif yang berada di Dusun Seweru Desa Kare Kare.Aswin Loka merupakan wahana belajar secara factual terhadap ekosistem lingkungan hidup yang memberikan warna dan nilai kemanusiaan.',
                'maps_destinasi' => 'Aswin Loka Seweru',
                'maps_zoom' => 14,
                'foto_destinasi' => 'pexels2.jpg|pexels1.jpg|pexels3.jpg',
                'logo' => 'logo.png',
                'alamat_destinasi' => '7P32+86V, Branjang, Kare, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
                'logo' => 'default.png'
            ],
            [
                'nama_destinasi' => 'Air Terjun Coban Kromo',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060001',
                'deskripsi_destinasi' => 'Air Terjun Coban Kromo mempunyai dua aliran air terjun yang konon ceritanya merupakan dua jenis yang berbeda yakni laki - laki dan perempuan . Sehingga karena mitos tersebut , air terjun yang terletak di desa Bodag itu dinamakan Coban Kromo yang artinya air terjun berjodoh .',
                'maps_destinasi' => 'Air Terjun Coban Kromo',
                'maps_zoom' => 14,
                'foto_destinasi' => 'alam.jpg|pexels2.jpg|pexels1.jpg',
                'logo' => 'logo.png',
                'alamat_destinasi' => 'RVQQ+JM7, Area Sawah, Pelem, Kec. Campurdarat, Kabupaten Tulungagung, Jawa Timur 66272',
                'htm_destinasi' => 5000,
                'approve' => '1',
                'logo' => 'default.png'
            ],
            [
                'nama_destinasi' => 'Wana Wisata Selo Gedong',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060001',
                'deskripsi_destinasi' => 'Selo yang berarti Batu, dan Gedong untuk Rumah Besar, itulah kiranya gambaran sekilas dari nama obyek wisata ini. Tatatan batu alam berukuran besar di puncak bukit, dengan panorama pemandangan yang eksotik, adalah daya tarik utama lokasi ini. Tidak hanya menawarkan sebuah pesona panorama alam, terdapat pula kedai-kedai gazebo yang siap mengobatilapar dan dahaga pengunjung. Ditemani rindang pohon pinus dengan kesegaran aromanya yang melapangkan dada, Selo Gedong menjadi tempat yang tidak akan membuat pengunjung jera untuk berkunjung kembali.',
                'maps_destinasi' => 'Wana Wisata Selo Gedong',
                'maps_zoom' => 14,
                'foto_destinasi' => 'pexels3.jpg|pexels1.jpg|pexels2.jpg',
                'logo' => 'logo.png',
                'alamat_destinasi' => 'Area Kebun/Hutan, Bodag, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
                'logo' => 'default.png'
            ],
        ];

        foreach ($destinasi as $key => $value) {
            ModelsDestinasi::create($value);
        }
    }
}
