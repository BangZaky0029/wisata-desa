<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key'         => 'site_name',
                'value'       => 'Desa Wisata Nusantara',
                'description' => 'Nama Website',
            ],
            [
                'key'         => 'site_description',
                'value'       => 'Portal Informasi Destinasi Wisata Desa',
                'description' => 'Deskripsi Website',
            ],
            [
                'key'         => 'site_email',
                'value'       => 'info@wisatadesa.com',
                'description' => 'Email Kontak',
            ],
            [
                'key'         => 'site_phone',
                'value'       => '081234567890',
                'description' => 'Nomor Telepon',
            ],
            [
                'key'         => 'site_address',
                'value'       => 'Jl. Desa Wisata No. 123, Indonesia',
                'description' => 'Alamat',
            ],
        ];

        foreach ($settings as $item) {
            $exists = $this->db->table('settings')
                ->where('key', $item['key'])
                ->get()
                ->getRow();

            if ($exists) {
                $this->db->table('settings')
                    ->where('key', $item['key'])
                    ->update([
                        'value'       => $item['value'],
                        'description' => $item['description'],
                    ]);
            } else {
                $this->db->table('settings')->insert($item);
            }
        }
    }
}
