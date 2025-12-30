<?php
// ===========================================
// FILE: app/Database/Migrations/2024_01_03_CreateEventTable.php
// ===========================================

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEventTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_event' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'slug' => ['type' => 'VARCHAR', 'constraint' => '255', 'unique' => true],
            'deskripsi' => ['type' => 'TEXT'],
            'tanggal_mulai' => ['type' => 'DATE'],
            'tanggal_selesai' => ['type' => 'DATE', 'null' => true],
            'waktu' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'lokasi' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'penyelenggara' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'poster' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'harga_tiket' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'kuota_peserta' => ['type' => 'INT', 'null' => true],
            'kontak' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'kategori' => ['type' => 'ENUM', 'constraint' => ['festival', 'lomba', 'pameran', 'pelatihan', 'lainnya'], 'default' => 'festival'],
            'status' => ['type' => 'ENUM', 'constraint' => ['aktif', 'nonaktif', 'selesai'], 'default' => 'aktif'],
            'views' => ['type' => 'INT', 'default' => 0],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('event');
    }

    public function down()
    {
        $this->forge->dropTable('event');
    }
}
