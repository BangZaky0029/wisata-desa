// ===========================================
// FILE: app/Database/Migrations/2024_01_04_CreatePaketWisataTable.php
// ===========================================
<?php
class CreatePaketWisataTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_paket' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'slug' => ['type' => 'VARCHAR', 'constraint' => '255', 'unique' => true],
            'deskripsi' => ['type' => 'TEXT'],
            'harga' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'durasi' => ['type' => 'VARCHAR', 'constraint' => '50'],
            'minimal_peserta' => ['type' => 'INT', 'default' => 1],
            'maksimal_peserta' => ['type' => 'INT', 'null' => true],
            'include' => ['type' => 'TEXT', 'null' => true],
            'exclude' => ['type' => 'TEXT', 'null' => true],
            'itinerary' => ['type' => 'TEXT', 'null' => true],
            'thumbnail' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'kontak' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['aktif', 'nonaktif'], 'default' => 'aktif'],
            'views' => ['type' => 'INT', 'default' => 0],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('paket_wisata');
    }

    public function down()
    {
        $this->forge->dropTable('paket_wisata');
    }
}