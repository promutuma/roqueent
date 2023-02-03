<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('auth/#/header');
        echo view('auth/login');
        echo view('auth/#/footer');
    }
    public function resetPasscode()
    {
        echo view('auth/#/header');
        echo view('auth/reset_password');
        echo view('auth/#/footer');
    }
    public function changePasscode()
    {
        echo view('auth/#/header');
        echo view('auth/change_password');
        echo view('auth/#/footer');
    }
}
