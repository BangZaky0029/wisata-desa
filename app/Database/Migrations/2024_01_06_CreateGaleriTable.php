<?php
// ===========================================
// FILE: app/Database/Migrations/2024_01_06_CreateGaleriTable.php
// ===========================================

class CreateGaleriTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'foto' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'tipe' => ['type' => 'ENUM', 'constraint' => ['foto', 'video'], 'default' => 'foto'],
            'kategori' => ['type' => 'ENUM', 'constraint' => ['wisata', 'event', 'umkm', 'kegiatan', 'lainnya'], 'default' => 'wisata'],
            'video_url' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'tags' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['aktif', 'nonaktif'], 'default' => 'aktif'],
            'views' => ['type' => 'INT', 'default' => 0],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('galeri');
    }

    public function down()
    {
        $this->forge->dropTable('galeri');
    }
}