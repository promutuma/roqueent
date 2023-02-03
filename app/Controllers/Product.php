<?php

namespace App\Controllers;

class Product extends BaseController
{
    public function index()
    {
        echo view('maintemp/header');
        echo view('product/productlist');
        echo view('maintemp/footer');
    }
    
}
