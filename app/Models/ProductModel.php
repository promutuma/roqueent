<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primarykey = 'product_sku';
    protected $allowedFields = [
        'product_sku',
        'product_name',
        'regular_price',
        'sale_price',
        'stock',
        'category',
        'createdBy'
    ];

    // add new product
    public function addProduct($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (\Throwable $th) {
            $this->logError('addProduct', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }

    // public function to update products
    public function updateProduct($sku, $setdata)
    {
        try {
            $this->where('product_sku', $sku)->set($setdata)->update();
            return true;
        } catch (\Throwable $th) {
            $this->logError('updateProduct', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }


    // get all categories
    public function getAllProducts()
    {
        try {
            return $this->findAll();
        } catch (\Throwable $th) {
            $this->logError('getAllCategories', $th->getMessage());

            return [];
        }
    }

    // get product by SKU
    public function getProductBySKU($sku)
    {
        try {
            return $this->where('product_sku', $sku)->first();
        } catch (\Throwable $th) {
            $this->logError('getProductBySKU', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }

    // delete product
    public function deleteProduct($sku)
    {
        try {
            $this->where('product_sku', $sku)->delete();

            return true;
        } catch (\Throwable $th) {
            $this->logError('deleteProduct', $th->getMessage());

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
