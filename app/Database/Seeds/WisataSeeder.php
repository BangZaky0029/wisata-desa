<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WisataSeeder extends Seeder
{
    public function run()
    {
        // ✅ AMAN buat FK & InnoDB
        $this->db->table('wisata')->emptyTable();

        $data = [
            [
                'nama_wisata'        => 'Air Terjun Coban Rondo',
                'slug'               => 'air-terjun-coban-rondo',
                'deskripsi'          => 'Air terjun alami dengan pemandangan yang indah dan udara sejuk',
                'deskripsi_lengkap'  => 'Air Terjun Coban Rondo merupakan destinasi wisata alam yang menawarkan keindahan air terjun setinggi 84 meter.',
                'lokasi'             => 'Desa Pandesari, Kecamatan Pujon',
                'alamat_lengkap'     => 'Jl. Coban Rondo, Pandesari, Pujon, Malang',
                'koordinat'          => '-7.8234,112.5321',
                'harga_tiket'        => 25000,
                'jam_operasional'    => '07:00 - 17:00 WIB',
                'kategori'           => 'alam',
                'thumbnail'          => 'coban-rondo.jpg',
                'fasilitas'          => json_encode([
                    'Parkir',
                    'Toilet',
                    'Mushola',
                    'Warung Makan',
                    'Area Camping'
                ]),
                'kontak'             => '081234567890',
                'status'             => 'aktif',
                'views'              => 150,
                'rating'             => 4.5,
                'created_by'         => 1,
                'created_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'nama_wisata'        => 'Kampung Budaya Osing',
                'slug'               => 'kampung-budaya-osing',
                'deskripsi'          => 'Wisata budaya masyarakat Osing',
                'deskripsi_lengkap'  => 'Destinasi wisata budaya yang mempertahankan tradisi lokal.',
                'lokasi'             => 'Desa Kemiren, Banyuwangi',
                'alamat_lengkap'     => 'Jl. Kampung Osing, Kemiren',
                'koordinat'          => '-8.2193,114.3687',
                'harga_tiket'        => 15000,
                'jam_operasional'    => '08:00 - 16:00 WIB',
                'kategori'           => 'budaya',
                'thumbnail'          => 'kampung-osing.jpg',
                'fasilitas'          => json_encode([
                    'Parkir',
                    'Toilet',
                    'Museum',
                    'Galeri'
                ]),
                'kontak'             => '081234567891',
                'status'             => 'aktif',
                'views'              => 89,
                'rating'             => 4.2,
                'created_by'         => 1,
                'created_at'         => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('wisata')->insertBatch($data);
    }
}
