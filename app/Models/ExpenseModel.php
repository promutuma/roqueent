<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table = 'expense';
    protected $primarykey = 'expense_ID';
    protected $allowedFields = [
        'expense_ID',
        'expense_description',
        'date',
        'time',
        'expense_amount',
        'remarks',
        'createdBy'
    ];


    // add new Expense
    public function addExpense($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (\Throwable $th) {
            $this->logError('addExpense', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }

    // public function to update products
    public function updateExpense($id, $setdata)
    {
        try {
            $this->where('expense_ID', $id)->set($setdata)->update();
            return true;
        } catch (\Throwable $th) {
            $this->logError('updateExpense', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }


    public function getExpenseByID($id)
    {
        try {
            return $this->where('expense_ID', $id)->first();
        } catch (\Throwable $th) {
            $this->logError('getExpenseByID', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }


    // delete Expense
    public function deleteExpense($sku)
    {
        try {
            $this->where('expense_ID', $sku)->delete();

            return true;
        } catch (\Throwable $th) {
            $this->logError('deleteExpense', $th->getMessage());

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
