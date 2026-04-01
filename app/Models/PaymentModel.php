<?php namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model{
    protected $table = 'payment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sale_id', 'shift_id', 'payment_reference', 'payment_type', 'payment_date','payment_time', 'amount','total_price', 'remarks', 'balanceNotPaid','createdBy'];


}