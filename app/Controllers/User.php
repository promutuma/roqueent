<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $checkUser= new UserModel();
        $data['user'] = $checkUser->findAll();
        echo view('maintemp/header');
        echo view('user/userlist',$data);
        echo view('maintemp/footer');
    }
    public function addUser(){
        $session = session();
        $userID=$this->request->getVar('txtID');
        $email=$this->request->getVar('txtEmail');

        $checkUser= new UserModel();
        $userId = $checkUser->where('user_id',$userID)->first();
        $userEmail = $checkUser->where('user_email',$email)->first();

        if ($userId>0) {
            # code...
            $status = 0;
            $data['message']="Failed Duplicate entry for user ID ".$userID."  Please try again with different ID";
        } else {
            # code...
            if ($userEmail>0) {
                # code...
                $status = 0;
                $data['message']="Failed Duplicate entry for user email ".$email."  Please try again with different email";
            } else {
                # code...
                $Sys = new Sys();
        $getTime = $Sys->getTime();

        $ustatus=1;
        
        $dateTime=$getTime['date']." ".$getTime['time'];
        $userData = [
            'user_id'=>$userID,
            'user_email'=>$email,
            'user_fname'=>$this->request->getVar('txtFname'),
            'user_oname'=>$this->request->getVar('txtOname'),
            'user_type'=>$this->request->getVar('txtUT'),
            'user_status'=>$ustatus,
            'added_on'=>$dateTime,
            'phone_number'=>$this->request->getVar('txtPN'),
            'createdBy'=> $session->get('user_id'),
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
            $logDesc = "User ".$this->request->getVar('txtFname')." added as ".$this->request->getVar('txtUT')." by ".$session->get('user_name')." on ".$dateTime;
            $Sys->addLog($session->get('session_iddata'),$session->get('user_id'),"Create",$logDesc);
        }
            }
            
        }
 
        echo json_encode(array("status" => $status , 'data' => $data));
    }
}
