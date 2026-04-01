<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitSchema extends Migration
{
    public function up()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

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

        // 4. Table: user
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'user_email' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'user_fname' => ['type' => 'VARCHAR', 'constraint' => 255],
            'user_oname' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone_number' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'user_type' => ['type' => 'VARCHAR', 'constraint' => 255],
            'user_status' => ['type' => 'VARCHAR', 'constraint' => 255],
            'user_password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'error_times' => ['type' => 'INT', 'null' => true, 'default' => 0],
            'added_on' => ['type' => 'DATETIME', 'null' => true],
            'createdBy' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user', true);

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

        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        $this->forge->dropTable('sale_item', true);
        $this->forge->dropTable('payment', true);
        $this->forge->dropTable('sale', true);
        $this->forge->dropTable('product', true);
        $this->forge->dropTable('session', true);
        $this->forge->dropTable('user', true);
        $this->forge->dropTable('log', true);
        $this->forge->dropTable('expense', true);
        $this->forge->dropTable('category', true);
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
}
