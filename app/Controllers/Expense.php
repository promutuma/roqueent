<?php

namespace App\Controllers;
use App\Models\ExpenseModel;

class Expense extends BaseController
{
    public function index()
    {
        $expense = new ExpenseModel();
        $data['allexpense']=$expense->findAll();
        echo view('maintemp/header');
        echo view('expense/expenselist',$data);
        echo view('maintemp/footer');
    }
    
    public function addExpense(){}
}
