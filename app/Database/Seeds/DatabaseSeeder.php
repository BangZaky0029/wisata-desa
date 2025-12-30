<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('WisataSeeder');
        $this->call('EventSeeder');
        $this->call('PaketWisataSeeder');
        $this->call('UmkmSeeder');
        $this->call('SettingsSeeder');
    }
}