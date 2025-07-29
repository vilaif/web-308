<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTitleTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'image'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'image2'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('title');
    }

    public function down()
    {
        $this->forge->dropTable('title');
    }
}