<?php namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model{
    protected $table = 'expense';
    protected $primarykey = 'expense_ID';
    protected $allowedFields = ['expense_ID', 'expense_description', 'date', 'time', 'expense_amount', 'remarks','createdBy'];


}