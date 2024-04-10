<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'sale';
    protected $primarykey = 'sale_id';
    protected $allowedFields = [
        'sale_id',
        'sale_date',
        'sale_time',
        'amount',
        'paid_amount',
        'pay_method',
        'sale_status',
        'createdBy'
    ];

    // add new Sale
    public function addSale($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (\Throwable $th) {
            $this->logError('addSale', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }

    // add new Sale
    public function findSaleByID($id)
    {
        try {
            return $this->where('sale_id', $id)
                ->first();
        } catch (\Throwable $th) {
            $this->logError('findSaleByID', $th->getMessage());

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
