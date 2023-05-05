<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    private $tableName = "users";

    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'unique'         => true,
                'null'           => false,
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                'null'           => false,
            ],
            'user_role' => [
                'type'           => 'VARCHAR',
                'default'        => '',
                'null'           => false,
            ]
        ]);

        $this->forge->addKey('id', true);
        // $this->forge->addUniqueKey(['email']);
        $this->forge->createTable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}
