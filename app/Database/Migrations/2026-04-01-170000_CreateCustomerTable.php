<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerTable extends Migration
{
    public function up()
    {
        if ($this->db->DBDriver === 'MySQLi') { $this->db->query('SET FOREIGN_KEY_CHECKS=0'); } elseif ($this->db->DBDriver === 'SQLite3') { $this->db->query('PRAGMA foreign_keys = OFF'); }

        // Create Customers table
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'customer_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'customer_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'loyalty_points' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'credit_balance' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => '0.00'
            ],
            'added_on' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'createdBy' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('customers', true);

        // Update Sale table to include customer_id
        $this->forge->addColumn('sale', [
            'customer_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => true,
                'after' => 'id'
            ]
        ]);
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'SET NULL', 'CASCADE');

        if ($this->db->DBDriver === 'MySQLi') { $this->db->query('SET FOREIGN_KEY_CHECKS=1'); } elseif ($this->db->DBDriver === 'SQLite3') { $this->db->query('PRAGMA foreign_keys = ON'); }
    }

    public function down()
    {
        if ($this->db->DBDriver === 'MySQLi') { $this->db->query('SET FOREIGN_KEY_CHECKS=0'); } elseif ($this->db->DBDriver === 'SQLite3') { $this->db->query('PRAGMA foreign_keys = OFF'); }
        $this->forge->dropForeignKey('sale', 'sale_customer_id_foreign');
        $this->forge->dropColumn('sale', 'customer_id');
        $this->forge->dropTable('customers', true);
        if ($this->db->DBDriver === 'MySQLi') { $this->db->query('SET FOREIGN_KEY_CHECKS=1'); } elseif ($this->db->DBDriver === 'SQLite3') { $this->db->query('PRAGMA foreign_keys = ON'); }
    }
}
