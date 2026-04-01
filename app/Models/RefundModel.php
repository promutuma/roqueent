<?php

namespace App\Models;

use CodeIgniter\Model;

class RefundModel extends Model
{
    protected $table = 'refunds';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'sale_id',
        'refund_amount',
        'reason',
        'refund_date',
        'refund_time',
        'createdBy'
    ];

    public function getRefundsBySale($saleId)
    {
        return $this->where('sale_id', $saleId)->findAll();
    }
}
