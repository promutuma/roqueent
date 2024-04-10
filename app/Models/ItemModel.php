<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'sale_item';
    protected $primarykey = 'sale_id';
    protected $allowedFields = [
        'item_sale_id',
        'product_sku',
        'product_name',
        'sale_id',
        'quantity',
        'price_per_unit',
        'total_price',
        'total_buying_price',
        'total_profit'
    ];


    // add new Item
    public function addItem($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (\Throwable $th) {
            $this->logError('addItem', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }


    // Log errors
    private function logError($method, $message)
    {
        $logMessage = "Error in $method method: $message";
        log_message('error', $logMessage);
    }
}
