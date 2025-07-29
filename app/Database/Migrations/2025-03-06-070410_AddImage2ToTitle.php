<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImage2ToTitle extends Migration
{
    public function up()
    {
        $this->forge->addColumn('title', [
            'image2' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('title', 'image2');
    }
}