<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        echo view('maintemp/header');
        echo view('home/dashboard');
        echo view('maintemp/footer');
    }
    public function myAccount()
    {
        echo view('maintemp/header');
        echo view('home/myaccount');
        echo view('home/#/profilesidenav');
        echo view('maintemp/footer');
    }
    public function myAccountNotification()
    {
        echo view('maintemp/header');
        echo view('home/myAccountNotification');
        echo view('home/#/profilesidenav');
        echo view('maintemp/footer');
    }
    public function myAccountSettings()
    {
        echo view('maintemp/header');
        echo view('home/myaccountsettings');
        echo view('home/#/profilesidenav');
        echo view('maintemp/footer');
    }
    public function myAccountActivity()
    {
        echo view('maintemp/header');
        echo view('home/myaccountactivity');
        echo view('home/#/profilesidenav');
        echo view('maintemp/footer');
    }
    public function myAccountSocial()
    {
        echo view('maintemp/header');
        echo view('home/myaccountsocial');
        echo view('home/#/profilesidenav');
        echo view('maintemp/footer');
    }
}
