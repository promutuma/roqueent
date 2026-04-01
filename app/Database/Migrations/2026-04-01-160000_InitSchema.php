<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitSchema extends Migration
{
    public function up()
    {
        if ($this->db->DBDriver === 'MySQLi') {
            $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        } elseif ($this->db->DBDriver === 'SQLite3') {
            $this->db->query('PRAGMA foreign_keys = OFF');
        }

        // 1. Table: category
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'category_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'createdBy' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('category', true);

        // 2. Table: expense
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'expense_description' => ['type' => 'VARCHAR', 'constraint' => 255],
            'date' => ['type' => 'DATE', 'null' => true],
            'time' => ['type' => 'TIME', 'null' => true],
            'expense_amount' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'remarks' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'createdBy' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('expense', true);

        // 3. Table: log
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'session_id' => ['type' => 'VARCHAR', 'constraint' => 255],
            'user_id' => ['type' => 'VARCHAR', 'constraint' => 255],
            'log_type' => ['type' => 'VARCHAR', 'constraint' => 255],
            'log_desc' => ['type' => 'VARCHAR', 'constraint' => 255],
            'log_date' => ['type' => 'DATE', 'null' => true],
            'log_time' => ['type' => 'TIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('log', true);

        // 4. Table: users
        $this->forge->addField([
            'id'             => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username'       => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'status'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status_message' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'active'         => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'last_active'    => ['type' => 'datetime', 'null' => true],
            'created_at'     => ['type' => 'datetime', 'null' => true],
            'updated_at'     => ['type' => 'datetime', 'null' => true],
            'deleted_at'     => ['type' => 'datetime', 'null' => true],
            // Custom fields from original user table
            'user_id' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'user_email' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true, 'null' => true],
            'user_fname' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'user_oname' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone_number' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'user_type' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'user_status' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'error_times' => ['type' => 'INT', 'null' => true, 'default' => 0],
            'createdBy' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('users', true);

        // 5. Table: session
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'session_iddata' => ['type' => 'VARCHAR', 'constraint' => 255],
            'user_id' => ['type' => 'VARCHAR', 'constraint' => 255],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 255],
            'device' => ['type' => 'VARCHAR', 'constraint' => 255],
            'user_agent' => ['type' => 'VARCHAR', 'constraint' => 255],
            'browser' => ['type' => 'VARCHAR', 'constraint' => 255],
            'browser_version' => ['type' => 'VARCHAR', 'constraint' => 255],
            'os_platform' => ['type' => 'VARCHAR', 'constraint' => 255],
            'pattern' => ['type' => 'VARCHAR', 'constraint' => 255],
            'date_time' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('session', true);

        // 6. Table: product
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'product_sku' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'product_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'regular_price' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'sale_price' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'stock' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'category' => ['type' => 'VARCHAR', 'constraint' => 255],
            'createdBy' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('product', true);

        // 7. Table: sale
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'sale_reference' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'unique' => true],
            'sale_date' => ['type' => 'DATE', 'null' => true],
            'sale_time' => ['type' => 'TIME', 'null' => true],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'paid_amount' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'pay_method' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sale_status' => ['type' => 'VARCHAR', 'constraint' => 255],
            'createdBy' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sale', true);

        // 8. Table: sale_item
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'sale_id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true],
            'product_id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => true],
            'product_sku' => ['type' => 'VARCHAR', 'constraint' => 255],
            'product_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'quantity' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'price_per_unit' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'total_price' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'total_buying_price' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'total_profit' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sale_id', 'sale', 'id', 'CASCADE', 'CASCADE');
        // If product id is null, the item is kept for historical record even if product is deleted.
        $this->forge->addForeignKey('product_id', 'product', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('sale_item', true);

        // 9. Table: payment
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'sale_id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true],
            'payment_reference' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'payment_type' => ['type' => 'VARCHAR', 'constraint' => 255],
            'payment_date' => ['type' => 'DATE', 'null' => true],
            'payment_time' => ['type' => 'TIME', 'null' => true],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'total_price' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'remarks' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'balanceNotPaid' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => '0.00'],
            'createdBy' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sale_id', 'sale', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payment', true);

        // 10. Table: settings
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'class' => ['type' => 'VARCHAR', 'constraint' => 255],
            'key' => ['type' => 'VARCHAR', 'constraint' => 255],
            'value' => ['type' => 'TEXT', 'null' => true],
            'type' => ['type' => 'VARCHAR', 'constraint' => 31, 'default' => 'string'],
            'context' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => false],
            'updated_at' => ['type' => 'DATETIME', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('settings', true);

        // 11. Table: auth_identities
        $this->forge->addField([
            'id'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'type'         => ['type' => 'varchar', 'constraint' => 255],
            'name'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'secret'       => ['type' => 'varchar', 'constraint' => 255],
            'secret2'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'expires'      => ['type' => 'datetime', 'null' => true],
            'extra'        => ['type' => 'text', 'null' => true],
            'force_reset'  => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
            'last_used_at' => ['type' => 'datetime', 'null' => true],
            'created_at'   => ['type' => 'datetime', 'null' => true],
            'updated_at'   => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['type', 'secret']);
        $this->forge->addKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_identities', true);

        // 12. Table: auth_logins
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255],
            'user_agent' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'id_type'    => ['type' => 'varchar', 'constraint' => 255],
            'identifier' => ['type' => 'varchar', 'constraint' => 255],
            'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'date'       => ['type' => 'datetime'],
            'success'    => ['type' => 'tinyint', 'constraint' => 1],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey(['id_type', 'identifier']);
        $this->forge->addKey('user_id');
        $this->forge->createTable('auth_logins', true);

        // 13. Table: auth_token_logins
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255],
            'user_agent' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'id_type'    => ['type' => 'varchar', 'constraint' => 255],
            'identifier' => ['type' => 'varchar', 'constraint' => 255],
            'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'date'       => ['type' => 'datetime'],
            'success'    => ['type' => 'tinyint', 'constraint' => 1],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey(['id_type', 'identifier']);
        $this->forge->addKey('user_id');
        $this->forge->createTable('auth_token_logins', true);

        // 14. Table: auth_remember_tokens
        $this->forge->addField([
            'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'selector'        => ['type' => 'varchar', 'constraint' => 255],
            'hashedValidator' => ['type' => 'varchar', 'constraint' => 255],
            'user_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'expires'         => ['type' => 'datetime'],
            'created_at'      => ['type' => 'datetime', 'null' => false],
            'updated_at'      => ['type' => 'datetime', 'null' => false],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('selector');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_remember_tokens', true);

        // 15. Table: auth_groups_users
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'group'      => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_groups_users', true);

        // 16. Table: auth_permissions_users
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'permission' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_permissions_users', true);

        if ($this->db->DBDriver === 'MySQLi') {
            $this->db->query('SET FOREIGN_KEY_CHECKS=1');
        } elseif ($this->db->DBDriver === 'SQLite3') {
            $this->db->query('PRAGMA foreign_keys = ON');
        }
    }

    public function down()
    {
        if ($this->db->DBDriver === 'MySQLi') {
            $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        } elseif ($this->db->DBDriver === 'SQLite3') {
            $this->db->query('PRAGMA foreign_keys = OFF');
        }
        $this->forge->dropTable('auth_permissions_users', true);
        $this->forge->dropTable('auth_groups_users', true);
        $this->forge->dropTable('auth_remember_tokens', true);
        $this->forge->dropTable('auth_token_logins', true);
        $this->forge->dropTable('auth_logins', true);
        $this->forge->dropTable('auth_identities', true);
        $this->forge->dropTable('settings', true);
        $this->forge->dropTable('sale_item', true);
        $this->forge->dropTable('payment', true);
        $this->forge->dropTable('sale', true);
        $this->forge->dropTable('product', true);
        $this->forge->dropTable('session', true);
        $this->forge->dropTable('users', true);
        $this->forge->dropTable('log', true);
        $this->forge->dropTable('expense', true);
        $this->forge->dropTable('category', true);
        if ($this->db->DBDriver === 'MySQLi') {
            $this->db->query('SET FOREIGN_KEY_CHECKS=1');
        } elseif ($this->db->DBDriver === 'SQLite3') {
            $this->db->query('PRAGMA foreign_keys = ON');
        }
    }
}
