<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'sale';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'sale_reference',
        'sale_date',
        'sale_time',
        'customer_id',
        'amount',
        'discount_amount',
        'discount_type',
        'total_before_discount',
        'paid_amount',
        'pay_method',
        'sale_status',
        'is_voided',
        'void_reason',
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
            return $this->groupStart()
                ->where('id', $id)
                ->orWhere('sale_reference', $id)
                ->groupEnd()
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
