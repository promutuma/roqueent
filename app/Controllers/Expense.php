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
    
}
