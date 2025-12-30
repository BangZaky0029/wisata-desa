<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWisataTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_wisata' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'deskripsi_lengkap' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat_lengkap' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'koordinat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'harga_tiket' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'jam_operasional' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'kategori' => [
                'type' => 'ENUM',
                'constraint' => ['alam', 'budaya', 'kuliner', 'edukasi', 'religi'],
                'default' => 'alam',
            ],
            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'galeri' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'fasilitas' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'kontak' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['aktif', 'nonaktif'],
                'default' => 'aktif',
            ],
            'views' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'rating' => [
                'type' => 'DECIMAL',
                'constraint' => '3,1',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('slug');
        $this->forge->addKey('kategori');
        $this->forge->addKey('status');
        $this->forge->createTable('wisata');
    }

    public function down()
    {
        $this->forge->dropTable('wisata');
    }
}
?>