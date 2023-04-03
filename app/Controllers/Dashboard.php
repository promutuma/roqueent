<?php

namespace App\Controllers;
use App\Models\SessionModel;

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
        $activity = new SessionModel();
        $data['logs'] = $activity->where('user_id',$_SESSION['user_id'])->orderBy('session_iddata', 'DESC')->findAll();
        echo view('maintemp/header');
        echo view('home/myaccountactivity',$data);
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
