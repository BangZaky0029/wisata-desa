// ===========================================
// FILE: app/Database/Migrations/2024_01_05_CreateUmkmTable.php
// ===========================================
<?php
class CreateUmkmTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_umkm' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'slug' => ['type' => 'VARCHAR', 'constraint' => '255', 'unique' => true],
            'pemilik' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'kategori' => ['type' => 'ENUM', 'constraint' => ['kuliner', 'kerajinan', 'fashion', 'pertanian', 'jasa'], 'default' => 'kuliner'],
            'produk' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'harga_mulai' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'foto' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'galeri' => ['type' => 'TEXT', 'null' => true],
            'alamat' => ['type' => 'TEXT', 'null' => true],
            'kontak' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'whatsapp' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
            'instagram' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'jam_operasional' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['aktif', 'nonaktif'], 'default' => 'aktif'],
            'views' => ['type' => 'INT', 'default' => 0],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('umkm');
    }

    public function down()
    {
        $this->forge->dropTable('umkm');
    }
}