<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FinalFeaturesSchema extends Migration
{
    public function up()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Update Sale table for Discounts
        $this->forge->addColumn('sale', [
            'discount_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => '0.00',
                'after' => 'amount'
            ],
            'discount_type' => [
                'type' => 'ENUM',
                'constraint' => ['Fixed', 'Percent'],
                'default' => 'Fixed',
                'after' => 'discount_amount'
            ],
            'total_before_discount' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => '0.00',
                'after' => 'discount_type'
            ],
            'is_voided' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'after' => 'sale_status'
            ],
            'void_reason' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'is_voided'
            ]
        ]);

        // Update Product table for Low Stock Alerts
        $this->forge->addColumn('product', [
            'low_stock_threshold' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => '5.00',
                'after' => 'stock'
            ]
        ]);

        // Create Refunds table
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'sale_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true
            ],
            'refund_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => '0.00'
            ],
            'reason' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'refund_date' => [
                'type' => 'DATE'
            ],
            'refund_time' => [
                'type' => 'TIME'
            ],
            'createdBy' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sale_id', 'sale', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('refunds', true);

        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        
        $this->forge->dropColumn('sale', ['discount_amount', 'discount_type', 'total_before_discount', 'is_voided', 'void_reason']);
        $this->forge->dropColumn('product', 'low_stock_threshold');
        $this->forge->dropTable('refunds', true);

        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
}
