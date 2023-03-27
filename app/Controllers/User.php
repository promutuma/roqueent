<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        echo view('maintemp/header');
        echo view('user/userlist');
        echo view('maintemp/footer');
    }
    public function addUser(){
        $Sys = new Sys();
        $getTime = $Sys->getTime();

        $ustatus=1;
        $userID=$this->request->getVar('txtID');
        $email=$this->request->getVar('txtEmail');
        $dateTime=$getTime['date']." ".$getTime['time'];
        $userData = [
            'user_id'=>$userID,
            'user_email'=>$email,
            'user_fname'=>$this->request->getVar('txtFname'),
            'user_oname'=>$this->request->getVar('txtOname'),
            'user_type'=>$this->request->getVar('txtUT'),
            'user_status'=>$ustatus,
            'added_on'=>$dateTime,
            'phone_number'=>$this->request->getVar('txtPN')
        ];

        $message='Hello '.$this->request->getVar('txtFname').', An account has been created using this email. Please login to '.base_url().' then reset password to set your password thanks.'; 

        $Sys = new Sys();
        

        $addUser = new UserModel();
        $addUser->save($userData);

        if ($addUser==false) {
            # code...
            $status = 0;
            $data['message']="Failed to add the user. Please try again after sometime";
        } else {
            # code...
            $status=1;
            $data['message']="Success, User account created successfully and email sent to the new user with password";
            $Sys->sendEmail($email,"Account Creation Successful",$message);
        }
        



        echo json_encode(array("status" => $status , 'data' => $data));
    }
}
