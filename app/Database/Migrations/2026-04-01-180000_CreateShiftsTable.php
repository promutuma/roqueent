<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShiftsTable extends Migration
{
    public function up()
    {
        if ($this->db->DBDriver === 'MySQLi') {
            if ($this->db->DBDriver === 'MySQLi') { $this->db->query('SET FOREIGN_KEY_CHECKS=0'); } elseif ($this->db->DBDriver === 'SQLite3') { $this->db->query('PRAGMA foreign_keys = OFF'); }
        } elseif ($this->db->DBDriver === 'SQLite3') {
            $this->db->query('PRAGMA foreign_keys = OFF');
        }

        // Create Shifts table
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'opening_date' => [
                'type' => 'DATE'
            ],
            'opening_time' => [
                'type' => 'TIME'
            ],
            'closing_date' => [
                'type' => 'DATE',
                'null' => true
            ],
            'closing_time' => [
                'type' => 'TIME',
                'null' => true
            ],
            'opening_float' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => '0.00'
            ],
            'closing_cash_actual' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true
            ],
            'closing_cash_expected' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Open', 'Closed'],
                'default' => 'Open'
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('shifts', true);

        // Update Payment table to include shift_id
        $this->forge->addColumn('payment', [
            'shift_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => true,
                'after' => 'id'
            ]
        ]);
        $this->forge->addForeignKey('shift_id', 'shifts', 'id', 'SET NULL', 'CASCADE');

        if ($this->db->DBDriver === 'MySQLi') {
            if ($this->db->DBDriver === 'MySQLi') { $this->db->query('SET FOREIGN_KEY_CHECKS=1'); } elseif ($this->db->DBDriver === 'SQLite3') { $this->db->query('PRAGMA foreign_keys = ON'); }
        } elseif ($this->db->DBDriver === 'SQLite3') {
            $this->db->query('PRAGMA foreign_keys = ON');
        }
    }

    public function down()
    {
        if ($this->db->DBDriver === 'MySQLi') {
            if ($this->db->DBDriver === 'MySQLi') { $this->db->query('SET FOREIGN_KEY_CHECKS=0'); } elseif ($this->db->DBDriver === 'SQLite3') { $this->db->query('PRAGMA foreign_keys = OFF'); }
        } elseif ($this->db->DBDriver === 'SQLite3') {
            $this->db->query('PRAGMA foreign_keys = OFF');
        }
        $this->forge->dropForeignKey('payment', 'payment_shift_id_foreign');
        $this->forge->dropColumn('payment', 'shift_id');
        $this->forge->dropTable('shifts', true);
        if ($this->db->DBDriver === 'MySQLi') { $this->db->query('SET FOREIGN_KEY_CHECKS=1'); } elseif ($this->db->DBDriver === 'SQLite3') { $this->db->query('PRAGMA foreign_keys = ON'); }
    }
}
