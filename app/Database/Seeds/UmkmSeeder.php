<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UmkmSeeder extends Seeder
{
    public function run()
    {
        // Optional tapi sangat disarankan
        $this->db->table('umkm')->emptyTable();

        $data = [
            [
                'nama_umkm'       => 'Warung Bu Tini',
                'slug'            => 'warung-bu-tini',
                'pemilik'         => 'Ibu Tini',
                'kategori'        => 'kuliner',
                'produk'          => 'Nasi Pecel, Soto Ayam',
                'deskripsi'       => 'Warung makan dengan menu khas desa yang lezat',
                'harga_mulai'     => 15000,
                'foto'            => 'warung-tini.jpg',
                'galeri'          => null,
                'alamat'          => 'Jl. Desa Utama No. 45',
                'kontak'          => '081234567894',
                'whatsapp'        => '6281234567894',
                'instagram'       => '@warungbutini',
                'jam_operasional' => '06:00 - 20:00 WIB',
                'status'          => 'aktif',
                'views'           => 45,
                'created_by'      => 1,
                'created_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'nama_umkm'       => 'Kerajinan Bambu Pak Hadi',
                'slug'            => 'kerajinan-bambu-pak-hadi',
                'pemilik'         => 'Pak Hadi',
                'kategori'        => 'kerajinan',
                'produk'          => 'Anyaman bambu, Tas bambu',
                'deskripsi'       => 'Kerajinan tangan dari bambu berkualitas',
                'harga_mulai'     => 50000,
                'foto'            => 'kerajinan-bambu.jpg',
                'galeri'          => null,
                'alamat'          => 'Jl. Kerajinan No. 12',
                'kontak'          => '081234567895',
                'whatsapp'        => '6281234567895',
                'instagram'       => null, // ⬅️ WAJIB ADA
                'jam_operasional' => '08:00 - 17:00 WIB',
                'status'          => 'aktif',
                'views'           => 32,
                'created_by'      => 1,
                'created_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('umkm')->insertBatch($data);
    }
}
