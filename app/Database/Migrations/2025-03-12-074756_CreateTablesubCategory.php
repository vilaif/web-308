<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablesubCategory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ]
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE'); // Foreign Key

        $this->forge->createTable('sub_categories');
    }

    public function down()
    {
        $this->forge->dropTable('sub_categories');
    }
}