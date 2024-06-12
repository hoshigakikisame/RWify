<?php

namespace Database\Seeders;

use App\Models\PengumumanModel;
use Illuminate\Database\Seeder;

use App\Models\UserModel;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengumumanModel::truncate();
        $data = [
            [
                'judul' => 'Pengumuman 1',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718199021/ddmfsscue00zzbyvk1hf.jpg',
                'konten' => 'Penyakit demam berdarah dengue (DBD)yang mewabah di sejumlah daerah, termasuk serius Dinas Kesehatan Kab.Malang. Berbagai kegiatan sosialisasi dan penyuluhan tentang bahaya penyakit akibat gigitan nyamuk aedes aegypti tersebut gencar dilakukan.

Di sejumlah Desa di Landungsari, yakni Desa Landungsari virus aedes aegypti sudah mewabah dikarenakan warga desanya sering bepergian ke daerah yang suhunya lebih hangat,jadi nyamuk penyebar virus aedes aegypti yang menggigitnya ikut menyebar pada saat warga tersebut pulang kerumahnya. Padahal secara teori nyamuk aedes aegypti.tidak bisa berkembang di daerah yang suhunya dingin seperti di Landungsari. Oleh karena itu Dinas Kesehatan melalui Puskesmas melakukan sosialisasi misalnya, sosialisasi dilakukan dengan cara menempelkan poster tentang penyakit demam berdarah. Selain itu, penyuluhan juga diisi dengan mengasapi lingkungan desa oleh petugas.

Mencegah menyebarnya DBD sebenarnya tidaklah terlalu sulit. Intinya jangan biarkan nyamuk-nyamuk penyebar virus mematikan ini bebas bersarang di rumah ataupun di lingkungan warga. Gerakan 3 M dipercaya dapat mencegah penyebaran DBD. M pertama yakni menguras tempat penampungan air dengan rutin sehingga tak ada jentik nyamuk. Selain itu jangan lupa membersihkan pula tempat-tempat yang digenangi air. Antara lain bak pembuangan air, lemari es, dan pot bunga.

Sedangkan M kedua adalah menutup tempat penampungan air untuk menghindari nyamuk aedes aegypti berkembang biak. Ketiga adalah mengubur barang-barang bekas. Ini diperlukan buat memberantas sarang nyamuk yang menjadi perantara penularan demam berdarah.

Satu lagi yang tak kalah penting adalah pengenalan mengenai gejala penyakit tersebut. Ini untuk membantu penangananan medis lebih awal. Gejala DBD seringkali rancu dengan gejala flu biasa. Antara lain demam tinggi naik dan turun selama dua hingga tujuh hari, pusing, sakit pada persendian, serta lesu dan nafsu makan berkurang. ',
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'judul' => 'Normalisasi Saluran Air Menjelang Musim Hujan',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718197844/n6xisuwljwdvejrjqzim.jpg',
                'konten' => 'Normalisasi saluran air di lingkungan RW 01 telah dilaksanakan sejak awal bulan November 2023. Kegiatan ini meliputi pengerukan endapan lumpur dan pencabutan akar tanaman pada saluran air untuk memastikan aliran air lancar dan tidak tersumbat. Hal ini dilakukan menjelang datangnya musim penghujan pada akhir tahun 2023 atau awal tahun 2024 sesuai dengan prakiraan musim hujan oleh BMKG.

Kegiatan normalisasi saluran air tersebut dilakukan oleh staf kebersihan yang bekerjasama dengan staf keamanan. Kegiatan ini akan terus dilakukan setiap harinya di wilayah RW 01 hingga selesai di akhir Desember 2023',
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'judul' => 'Kegiatan Senam Rutin oleh Ibu-Ibu RW 01',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718197677/s27zyvbefijywpbu0zta.jpg',
                'konten' => 'Dalam rangka mencapai SDG ke-3, yaitu kesehatan yang baik dan kesejahteraan, Desa Landungsari mengadakan kegiayan senam rutin oleh kelompok ibu-ibu PKK yang terdapat di masing-masing RW/RT. Kegiatan ini diharapkan mampu meningkatkan tingkat kesehatan masyarakat Landungsari lewat pengecekan kesehatan berkala, utamanya wanita dewasa dan lansia. Kegiatan ini terlaksana sekali seminggu atau 2 kali seminggu yang diikuti masyarakat sekitar RW/RT masing-masing secara antusias. Kegiatan ini biasanya dilaksanakan bersamaan dengan pelaksanaan posyandu. Peserta awalnya akan menyepakati waktu pelaksanaan dan kemudian diakhiri dengan makan bersama.',
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'judul' => 'Pengajian Rutin Dusun Rambaan Landungsari',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198438/ctp9qpp6jqlsfxiavtxt.jpg',
                'konten' => 'Kelurahan Landungsari seperti biasa melaksanakan Pengajian Rutin Bulanan yang dilaksanakan di Aula Kelurahan Landungsari yang dihadiri seluruh warga Landungsari khusunya ibu-ibu jamaah, Ketua RT dan RW, pengajian rutin bulanan Bapak Lurah Landungsari memberi sambutan kepada seluruh jamaah " bahwa pengajian ini mudah-mudahan bisa terus dan terus dilaksanakan karena betapa pentingnya pengajian ini selain kita bisa menimba ilmu juga dapat meningkatkan tali silaturahmi antar warga."

Pelaksanaan pengajian rutin ini di isi oleh penceramah lokal yang berasal dari Kelurahan Landungsari sendiri yaitu Ustad Saefudin, tawasulan dipimpin oleh Ustad Alamsyah serta pembacaan ayat suci Al-Quran dibawakan oleh Ustad Lala. ',
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'judul' => 'Pelantikan Ketua RW dan RT Desa Landungsari',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718198274/tvczvxsjttp5r9rdivem.jpg',
                'konten' => '10 Januari 2024. Pemerintah Desa Landungsari mengukuhkan Ketua Rukun Warga (RW) dan Ketua Rukun Tetangga (RT) Desa Landungsari sejumlah 33 Orang bertempat di Aula Balai Desa Landungsari Kecamatan Dau Kabupaten Malang. Rabu (10/01/2024).

Kegiatan Pengukuhan ini berdasarkan Surat Keputusan Kepala Desa Landungsari nomor : 141.1 / KPTS.3-PEM / 2024 Tentang Pengesahan Pengangkatan Ketua Rukun Warga (RW) dan Ketua Rukun Tetangga (RT) Desa Landungsari Kecamatan Dau Kabupaten Malang.

Dalam kegiatan tersebut dihadiri Kepala Desa beserta Lembaga Desa Ketua BPD Landungsari dan Ketua LPM Desa Landungsari . serta dihadiri oleh Tokoh Masyarakat dan Tokoh Agama.

Desa Landungsari Kecamatan Dau terdiri dari 5 Dusun dengan Komposisi pengurus 5 Orang Ketua RW dan 28 Orang Ketua RT.

"Ketua RW dan RT adalah ujung tombak pemerintahan ditingkat bawah dan harus mampu bekerjasama dengan baik, mengabdi dan melayani warganya dengan penuh rasa tanggung jawab dan jiwa sosial yang tinggi serta bisa menjadi contoh yang baik untuk warganya dalam pergaulan dan kebersamaan membina kerukunan hidup bertetangga di Wilayah Desa Landungsari." terangnya.

Pada acara pengukuhan ini dilakukan penandatanganan Surat Keputusan oleh Kepala Desa serta Perwakilan Ketua RW dan Ketua RT, acara dilanjutkan dengan pembagian Salinan Keputusan Kepala Desa kepada masing-masing Ketua RW dan Ketua RT.

Acara diakhiri dengan pembacaan Doa dan Foto bersama. Dari awal hingga akhir acara pengukuhan ini, berjalan dengan baik dan tidak ada kendala teknis maupun non teknis.',
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ],
            [
                'judul' => 'Cegah Difteri Dengan Imunisasi Lengkap',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1718197313/qxyjfabcanl5zjcsuxao.jpg',
                'konten' => 'Menurut dr. Dita Ramadonna, MSc, faktor utama yang menyebabkan banyaknya kasus penyakit difteri adalah karena banyak anak tidak mendapat imunisasi difteri secara lengkap.

“Sesuai program imunisasi gratis dari pemerintah, setiap anak seharusnya mendapatkan imunisasi difteri sebanyak empat kali di bawah usia dua tahun, dan tiga kali ketika SD,” kata Health Officer, UNICEF Aceh Field Office ini.

Penelitian menunjukkan, kata dr. Dita, bahwa kekebalan yang didapatkan setelah imunisasi difteri lengkap adalah seumur hidup.

Dokter lulusan Fakultas Kedokteran USU ini mengatakan, biasanya Jika terjadi kasus dilteri petugas kesehatan akan melakukan pemeriksaan lebih lanjut, termasuk "contact tracing", dengan cara interview kontak dan pemeriksaan sampel swab tenggorokan.

Nah, menurut Dita, banyak masyarakat yang masih enggan melakukan "contact tracing" sehingga bisa saja ada banyak carrier" (orang yang terinfeksi, tapi tidak bergejala) yang merasa sehat. Namun sebenarnya, ia dapat menularkan kuman diteri dan menyebabkan sakit bahkan kematian pada orang lain.

Selain itu, jika ada kasus difteri maka harus segera dilakukan outbreak response immunization (ORI), yaitu memberikan imunisasi difteri secara massal pada wilayah terdampak, tergantung dari luasnya penyebaran kasus difteri.

“Ini juga menjadi hambatan dalam penanggulangan difteri karena banyak masyarakat (orang tua) yang menolak imunisasi, sehingga kasus difteri menjadi semakin tidak terbendung,” kata Dita.

Lalu, apakah tingkat kesadaran masyarakat Aceh pada umumnya tinggi untuk mendorong imunisasi dasar bagi bayinya?

“Jika Kita lihat angka cakupan imunisasi di Aceh, sebenarnya ada sedikit peningkatan pada tahun 2022 ini. Artinya, ada perbaikan dalam kesadaran orang tua untuk memberikan imunisasi. Namun,iru masih perlu ditingkatkan karena masih ada sekitar 5095 dari bayi di Aceh yang tidak mendapat imunisasi sama sekali (zero-dose children). Mereka ini rentan terkena penyakit yang dapat dicegah dengan imunisasi (PD3I) dan komplikasinya,” terang Dita.

Seharusnya, lanjut Dita, edukasi imunisasi diberikan sejak calon pasangan orang tua masih menjadi calon pengantin, lalu saat hamil, dan saat setelah mempunyai anak.

Lebih jauh dari itu, edukasi mengenai prinsip kekebalan juga perlu diajarkan dalam program pendidikan di sekolah.

Dita mengatakan, pencegahan yang utama tentunya dengan memberikan imunisasi difteri secara lengkap. Empat kali semasa baduta dan tiga kali semasa SD. Untuk anak di bawah 5 tahun, jika ada anak yang belum lengkap imunisasinya, masih bisa dilengkapi.

“Lebih baik terlambat daripada tidak ada imunisasi sama sekali,” jelas dr. Dita.

Untuk anak SD, lanjutnya, imunisasi difteri diberikan di kelas 1, 2, dan 5 SD. Jika belum mendapatkan, bisa mendatangi puskesmas untuk diimunisasi.

Imunisasi yang diberikan gratis dan diproduksi di dalam negeri, yakni di PT Biofarma, yang juga mengekspor vaksin difteri ke seluruh dunia.

“Jadi, jika anak-anak di negara lain memakai vaksin difteri buatan Indonesia, mengapa kita di dalam negeri harus ragu dengan kualitasnya”, tukas Dita.

Selain itu, Perilaku Hidup Bersih dan Sehat (PHBS) seperti sering cuci tangan pakai sabun, dan tidak pergi sekolah ketika anak sakit, menjadi cara-cara tambahan untuk mencegah penyebaran difteri.

Pengobatan difteri harus segera dilakukan di rumah sakit. Semakin cepat diobati semakin baik karena racun yang dikeluarkan kuman difteri sangat cepat menyebabkan perburukan bahkan kematian.

Di Aceh sendiri, kata Dita, terjadi kematian akibat diften dalam beberapa tahun terakhir. Oleh karena itu, sangatlah penting untuk mencegah ditteri dengan memberikan imunisasi secara lengkap kepada buah hati kita daripada kita harus mengobati ketika penyakit itu timbul penyakit dengan segala komplikasinya.',
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ]
        ];
    }
}
