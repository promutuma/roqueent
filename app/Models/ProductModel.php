<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model{
    protected $table = 'product';
    protected $primarykey = 'product_sku';
    protected $allowedFields = ['product_sku','product_name','regular_price','sale_price','stock','category','createdBy'];


}