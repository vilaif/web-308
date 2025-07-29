<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParentIdToCategory extends Migration
{
    public function up()
    {
        $this->forge->addColumn('categories', [
            'parent_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,  // Harus sama dengan id
                'null'       => true,
                'default'    => NULL,
                'after'      => 'category_name'
            ]
        ]);

        // Tambahkan Foreign Key dengan UNSIGNED
        $this->db->query("ALTER TABLE categories ADD CONSTRAINT fk_parent FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE categories DROP FOREIGN KEY fk_parent");
        $this->forge->dropColumn('categories', 'parent_id');
    }
}