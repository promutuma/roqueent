<?php

namespace App\Models;

use CodeIgniter\Model;

class ShiftModel extends Model
{
    protected $table = 'shifts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'opening_date',
        'opening_time',
        'closing_date',
        'closing_time',
        'opening_float',
        'closing_cash_actual',
        'closing_cash_expected',
        'status',
        'notes'
    ];

    public function getActiveShift($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('status', 'Open')
                    ->first();
    }

    public function calculateExpectedCash($shiftId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('payment');
        $builder->selectSum('amount');
        $builder->where('shift_id', $shiftId);
        $builder->where('payment_type', 'Cash');
        $result = $builder->get()->getRowArray();
        
        $shift = $this->find($shiftId);
        $openingFloat = (float)($shift['opening_float'] ?? 0);
        $cashSales = (float)($result['amount'] ?? 0);
        
        return $openingFloat + $cashSales;
    }
}
