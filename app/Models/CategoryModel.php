<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model{
    protected $table = 'category';
    protected $primarykey = 'category_name';
    protected $allowedFields = ['category_name'];


}