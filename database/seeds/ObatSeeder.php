<?php

use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //   
        DB::table('obat')->insert([
            ['obat' => 'Woods Peppermint Expectorant', 'deskripsi' => 'Woods Peppermint Expectorant merupakan sirup obat batuk yang dapat membantu meredakan batuk batuk berdahak dan mengobati gangguan saluran pernapasan', 'stok' => 100, 'harga' => 35000, 'foto' => 'woods.jpeg'],
            ['obat' => 'Vicks Formula 44', 'deskripsi' => 'Vicks Formula 44 Sirup Obat Batuk merupakan produk obat batuk yang diformulasikan khusus untuk membantu meringankan batuk tidak berdahak yang disertai bersin-bersin / alergi akibat masuk angin, infeksi saluran pernapasan, pilek / flu, dan sakit tenggorokan.', 'stok' => 100, 'harga' => 30000, 'foto' => 'vicks44.jpg'],
            ['obat' => 'BISOLVON EXTRA SIRUP 60 ML', 'deskripsi' => 'BISOLVON EXTRA SIRUP mengandung Bromhexine HCl dan Guaifenesin. Obat ini digunakan untuk mengatasi batuk berdahak yang bekerja sebagai sekretolitik (mukolitik) dan ekspektoran untuk meredakan batuk berdahak dan mempermudah pengeluaran dahak pada saat batuk. Obat ini akan membantu dengan 3 langkah kerja, yaitu: dengan Melepaskan, Mengencerkan, serta Mengeluarkan dahak, sehingga dahak dapat mudah dikeluarkan.', 'stok' => 100, 'harga' => 45000, 'foto' => 'bisolvon-extra-60ml.jpeg'],
            ['obat' => 'DETTOL ANTISEPTIK CAIR 245 ML', 'deskripsi' => 'DETTOL ANTISEPTIK CAIR merupakan antiseptik cair yang digunakan sebagai perlindungan dari penyakit yang disebabkan kuman. Cairan ini juga dapat digunakan untuk mempercepat penyembuhan luka, lecet, gigitan, sengatan serangga, membunuh kuman pada pakaian kotor dan sebagai disinfektan pada peralatan rumah tangga.<br><br>Aturan Pakai : <br>Pertolongan pertama pada luka, gigitan dan sengatan serangga : Larutkan 1 tutup penuh Dettol dengan 420 ml air. Tuangkan larutan Dettol pada kapas kemudian usapkan pada luka. Membunuh kuman pada seluruh tubuh: Larutkan 1 tutup penuh Dettol dalam bak mandi. Untuk bunuh kuman pada popok dan pakaian : Larutkan 1 tutup penuh Dettol dengan 840 ml air. *1 Tutup penuh = 21 ml', 'stok' => 100, 'harga' => 45000, 'foto' => 'DETTOL ANTISEPTIK CAIR 245 ML.jpg'],
            ['obat' => 'DETTOL ANTISEPTIK CAIR 245 ML', 'deskripsi' => 'MBOOST FORCE EXTRA STRENGTH TABLET merupakan suplemen dengan kandungan Echinacea purpurea herb dry extract, Blackelderberry fruit dry extract, Zn Piccolinate dalam bentuk kaplet salut selaput. Suplemen ini digunakan untuk membantu meningkatkan serta memelihara daya tahan tubuh sehingga mencegah dari sakit dan mempercepat penyembuhan. Imboost extra strength bekerja cepat mengaktifkan sistem daya tahan tubuh secara langsung di sistem pertahanan tubuh kita dengan memperbanyak antibodi sehingga daya tahan tubuh lebih kuat melawan serangan virus. 
                Dosis 
                Dewasa: Sehari: 1 kali 1 kaplet. 
                Aturan Pakai : Dikonsumsi sesudah makan', 
                'stok' => 100, 'harga' => 80000, 'foto' => 'IMBOOST FORCE EXTRA STRENGTH.jpeg'],
        ]);
    }
}
