<?php
namespace App\\Database\\Seeds;

use CodeIgniter\\Database\\Seeder;
// ===========================================
// FILE: app/Database/Seeds/EventSeeder.php
// ===========================================

class EventSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_event'       => 'Festival Budaya Desa 2024',
                'slug'             => 'festival-budaya-desa-2024',
                'deskripsi'        => 'Festival tahunan menampilkan kesenian dan budaya lokal',
                'tanggal_mulai'    => '2024-08-17',
                'tanggal_selesai'  => '2024-08-19',
                'waktu'            => '09:00 - 21:00 WIB',
                'lokasi'           => 'Lapangan Desa',
                'penyelenggara'    => 'Pemdes & Karang Taruna',
                'poster'           => 'festival-2024.jpg',
                'harga_tiket'      => 0,
                'kuota_peserta'    => 1000,
                'kontak'           => '081234567892',
                'kategori'         => 'festival',
                'status'           => 'aktif',
                'views'            => 234,
                'created_by'       => 1,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('event')->insertBatch($data);
    }
}

