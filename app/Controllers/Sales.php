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
    
}
