<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primarykey = 'category_name';
    protected $allowedFields = [
        'category_name',
        'createdBy'
    ];

    // create category
    public function createCategory($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (\Throwable $th) {
            $this->logError('createCategory', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }

    // get all categories
    public function getAllCategories()
    {
        try {
            return $this->findAll();
        } catch (\Throwable $th) {
            $this->logError('getAllCategories', $th->getMessage());

            return [];
        }
    }



    // Log errors
    private function logError($method, $message)
    {
        $logMessage = "Error in $method method: $message";
        log_message('error', $logMessage);
    }
}
