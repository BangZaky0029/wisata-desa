<?php
namespace App\\Database\\Seeds;

use CodeIgniter\\Database\\Seeder;
// ===========================================
// FILE: app/Database/Seeds/PaketWisataSeeder.php
// ===========================================

class PaketWisataSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_paket'       => 'Paket Wisata Alam 2D1N',
                'slug'             => 'paket-wisata-alam-2d1n',
                'deskripsi'        => 'Paket wisata alam lengkap dengan penginapan dan makan',
                'harga'            => 450000,
                'durasi'           => '2 Hari 1 Malam',
                'minimal_peserta'  => 2,
                'maksimal_peserta' => 20,
                'include'          => json_encode(['Penginapan', 'Makan 3x', 'Tour Guide', 'Tiket Wisata', 'Dokumentasi']),
                'exclude'          => json_encode(['Transportasi ke lokasi', 'Pengeluaran pribadi']),
                'itinerary'        => json_encode([
                    'Hari 1' => ['Check-in', 'Makan siang', 'Wisata Air Terjun', 'Makan malam', 'Api unggun'],
                    'Hari 2' => ['Sarapan', 'Trekking pagi', 'Check-out', 'Wisata desa']
                ]),
                'thumbnail'        => 'paket-alam.jpg',
                'kontak'           => '081234567893',
                'status'           => 'aktif',
                'views'            => 67,
                'created_by'       => 1,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('paket_wisata')->insertBatch($data);
    }
}
