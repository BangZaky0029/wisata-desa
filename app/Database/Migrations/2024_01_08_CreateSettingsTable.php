// ===========================================
// FILE: app/Database/Migrations/2024_01_08_CreateSettingsTable.php
// ===========================================
<?php

class CreateSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'key' => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'value' => ['type' => 'TEXT', 'null' => true],
            'description' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}