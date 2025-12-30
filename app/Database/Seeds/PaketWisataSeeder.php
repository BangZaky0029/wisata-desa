<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaketWisataSeeder extends Seeder
{
    public function run()
    {
        // aman walau ada FK
        $this->db->table('paket_wisata')->emptyTable();

        $data = [
            [
                'nama_paket'       => 'Paket Wisata Hemat',
                'slug'             => 'paket-wisata-hemat',
                'deskripsi'        => 'Paket wisata hemat cocok untuk keluarga dan rombongan kecil.',
                'harga'            => 150000.00,
                'durasi'           => '1 Hari',
                'minimal_peserta'  => 1,
                'maksimal_peserta' => 10,
                'include'          => 'Transport, Guide, Tiket Masuk',
                'exclude'          => 'Makan siang, Penginapan',
                'itinerary'        => '08.00 Berangkat - 10.00 Wisata - 16.00 Pulang',
                'thumbnail'        => 'paket-hemat.jpg',
                'kontak'           => '081234567890',
                'status'           => 'aktif',
                'views'            => 0,
                'created_by'       => 1,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('paket_wisata')->insertBatch($data);
    }
}
