<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        echo view('maintemp/header');
        echo view('user/userlist');
        echo view('maintemp/footer');
    }
    
}
