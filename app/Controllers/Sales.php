<?php

namespace App\Controllers;

class Sales extends BaseController
{
    public function index()
    {
        echo view('maintemp/header');
        echo view('sales/saleslist');
        echo view('maintemp/footer');
    }

    public function newSale()
    {
        echo view('maintemp/header');
        echo view('sales/sales_new');
        echo view('maintemp/footer');
    }
    
}
