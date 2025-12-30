<?php
// ===========================================
// FILE: app/Database/Migrations/2024_01_07_CreateBeritaTable.php
// ===========================================

class CreateBeritaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'slug' => ['type' => 'VARCHAR', 'constraint' => '255', 'unique' => true],
            'konten' => ['type' => 'LONGTEXT'],
            'excerpt' => ['type' => 'TEXT', 'null' => true],
            'thumbnail' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'kategori' => ['type' => 'ENUM', 'constraint' => ['info', 'pengumuman', 'prestasi', 'kegiatan'], 'default' => 'info'],
            'tags' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['draft', 'publish'], 'default' => 'draft'],
            'views' => ['type' => 'INT', 'default' => 0],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'published_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('berita');
    }

    public function down()
    {
        $this->forge->dropTable('berita');
    }
}