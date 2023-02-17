<?php

namespace App\Controllers;

class Expense extends BaseController
{
    public function index()
    {
        echo view('maintemp/header');
        echo view('expense/expenselist');
        echo view('maintemp/footer');
    }

    public function formView()
    {
        echo view('maintemp/header');
        echo view('expense/expenseadd');
        echo view('maintemp/footer');
    }
    
}
