<?php
// ===========================================
// FILE: app/Database/Seeds/UserSeeder.php
// ===========================================

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'     => 'admin',
                'email'        => 'admin@wisatadesa.com',
                'password'     => password_hash('admin123', PASSWORD_BCRYPT),
                'role'         => 'admin',
                'nama_lengkap' => 'Administrator',
                'status'       => 'aktif',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'pengelola',
                'email'        => 'pengelola@wisatadesa.com',
                'password'     => password_hash('pengelola123', PASSWORD_BCRYPT),
                'role'         => 'pengelola',
                'nama_lengkap' => 'Pengelola Wisata',
                'status'       => 'aktif',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}