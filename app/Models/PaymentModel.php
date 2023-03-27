<?php namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model{
    protected $table = 'payment';
    protected $primarykey = 'payment_id';
    protected $allowedFields = ['payment_id', 'sale_id', 'payment_type', 'payment_date','payment_time', 'amount','total_price', 'remarks', 'balanceNotPaid'];


}