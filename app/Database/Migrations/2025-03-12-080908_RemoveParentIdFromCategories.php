<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveParentIdFromCategories extends Migration
{
    public function up()
    {
        
        $this->forge->dropForeignKey('categories', 'fk_parent');


        $this->forge->dropColumn('categories', 'parent_id');
    }

    public function down()
    {
        $this->forge->addColumn('categories', [
            'parent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ]);
    }
}