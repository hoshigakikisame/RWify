<?php

namespace Database\Seeders;

use App\Models\UmkmModel;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UmkmModel::truncate();
        $data = [
            [
                'nama' => 'Warung Makan Bu Tini',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198503/zxl2ovfmknxe3mlgumlz.jpg',
                'nama_pemilik' => 'Warung Makan Bu Tini',
                'alamat' => 'Perumahan Landungsari Asri Blok F No 1 RT 1 RW 01 Desa Landungsari Kecamatan Dau ',
                'map_url' => 'https://maps.google.com/?q=Jl+Melati+No+10+Landungsari',
                'telepon' => '081234567890',
                'instagram_url' => 'warungmakanbutini',
                'deskripsi' => 'Warung Makan Bu Tini menyajikan berbagai masakan rumahan yang lezat dengan harga terjangkau. Menu andalan termasuk nasi pecel, soto ayam, dan ayam goreng. ',
                'dibuat_pada' => now()->toDateTime(),
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'nama' => 'Toko Kelontong Pak Budi',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198553/aahg1pxemi2mhtgtstmq.jpg',
                'nama_pemilik' => 'Pak Budi',
                'alamat' => 'Perumahan Landungsari Asri Blok A No 3 RT 2 RW 01 Desa Landungsari Kecamatan Dau',
                'map_url' => 'https://maps.google.com/?q=Jl+Mawar+No+5+Landungsari',
                'telepon' => '081298765432',
                'instagram_url' => 'tokopakbudi',
                'deskripsi' => 'Toko kelontong Pak Budi menyediakan berbagai kebutuhan sehari-hari mulai dari bahan makanan, minuman, hingga alat tulis dan peralatan rumah tangga.',
                'dibuat_pada' => now()->toDateTime(),
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'nama' => 'Salon Kecantikan Sari',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198447/wiaaldqpwlxduxhv6niy.jpg',
                'nama_pemilik' => 'Bu Sari',
                'alamat' => 'Perumahan Ladungsari Asri Blok D No 2 RT 1 RW 01 Desa Landungsari',
                'map_url' => 'https://maps.google.com/?q=Jl+Kenanga+No+3+Landungsari',
                'telepon' => '085678901234',
                'instagram_url' => 'salonsari',
                'deskripsi' => 'Salon Kecantikan Sari menawarkan berbagai layanan kecantikan seperti potong rambut, perawatan wajah, manikur, dan pedikur dengan harga terjangkau.',
                'dibuat_pada' => now()->toDateTime(),
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'nama' => 'Katering Mbak Ani',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198429/fhzdzv5jw1jnxqogor1k.jpg',
                'nama_pemilik' => 'Mbak Ani',
                'alamat' => 'Perumahan Landungsari Asri Blok J No 3 RT 2 RW 01 Desa Landungsari Kecamatan Dau ',
                'map_url' => 'https://maps.google.com/?q=Jl+Flamboyan+No+8+Landungsari',
                'telepon' => '085678901231',
                'instagram_url' => 'kateringmbakani',
                'deskripsi' => 'Katering Mbak Ani menyediakan layanan katering untuk berbagai acara seperti pernikahan, ulang tahun, dan rapat dengan menu-menu yang lezat dan beragam.',
                'dibuat_pada' => now()->toDateTime(),
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'nama' => 'Fotokopi dan ATK Pak Joko',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198406/vncr9gqwsnjhdde4dr8g.jpg',
                'nama_pemilik' => 'Pak Joko',
                'alamat' => 'Perumahan Landungsari Asri Blok G No 4 RT 1 RW 1 Desa Landungsari Kecamatan Dau',
                'map_url' => 'https://maps.google.com/?q=Jl+Dahlia+No+6+Landungsari',
                'telepon' => '089876543210',
                'instagram_url' => 'fotokopipakjoko',
                'deskripsi' => 'Fotokopi dan ATK Pak Joko menyediakan jasa fotokopi, print, serta menjual berbagai alat tulis kantor dengan harga bersaing.',
                'dibuat_pada' => now()->toDateTime(),
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'nama' => 'Laundry Bersih',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198406/vncr9gqwsnjhdde4dr8g.jpg',
                'nama_pemilik' => 'Pak Mloyo',
                'alamat' => 'Perumahan Landungsari Asri Blok I No 1 RT 2 RW 1 Desa Landungsari Kecamatan Dau',
                'map_url' => 'https://maps.google.com/?q=Jl+Dahlia+No+6+Landungsari',
                'telepon' => '082134567890',
                'instagram_url' => 'laundrybersih',
                'deskripsi' => 'Laundry Bersih menyediakan jasa cuci, setrika, dan antar jemput pakaian dengan pelayanan cepat dan hasil yang rapi.',
                'dibuat_pada' => now()->toDateTime(),
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'nama' => 'Keripik Singkong Renyah',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198406/vncr9gqwsnjhdde4dr8g.jpg',
                'nama_pemilik' => 'Pak Mloyo',
                'alamat' => 'Perumahan Landungsari Asri Blok B No 5 RT 2 RW 1 Desa Landungsari Kecamatan Dau',
                'map_url' => 'https://maps.google.com/?q=Jl+Melati+No+12+Landungsari',
                'telepon' => '085643210987',
                'instagram_url' => 'keripiksingkongrenyah',
                'deskripsi' => 'Keripik Singkong Renyah menawarkan keripik singkong dengan berbagai rasa yang gurih dan renyah.',
                'dibuat_pada' => now()->toDateTime(),
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'nama' => 'Gucci by Pak Yanto',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198406/vncr9gqwsnjhdde4dr8g.jpg',
                'nama_pemilik' => 'Pak Yanto',
                'alamat' => 'Gucci, 1000 I St NW Suite 102, Washington, DC 20001, United States',
                'map_url' => 'https://maps.google.com/?q=Jl+Melati+No+12+Landungsari',
                'telepon' => '08138237822',
                'instagram_url' => 'gucci',
                'deskripsi' => 'Jual barang branded YSL, Saint Laurent, dan yang Paling Utama GUCCI',
                'dibuat_pada' => now()->toDateTime(),
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
        ];

        UmkmModel::insert($data);
    }
}
