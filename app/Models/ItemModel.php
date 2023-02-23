<?php namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model{
    protected $table = 'sale_item';
    protected $primarykey = 'sale_id';
    protected $allowedFields = ['item_sale_id','product_sku','product_name','sale_id','quantity','price_per_unit','total_price','total_buying_price','total_profit'];


}