<?php namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model{
    protected $table = 'sale';
    protected $primarykey = 'sale_id';
    protected $allowedFields = ['sale_id','sale_date','sale_time','amount','paid_amount','pay_method','sale_status'];


}