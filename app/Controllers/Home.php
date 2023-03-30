<?php

namespace App\Controllers;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $sessionId = "0";
        $userId = "GUEST";
        $logType = "Access";
        $logDesc = "Accessed Login Page";
        $Sys = new Sys();
        $getTime = $Sys->addLog($sessionId,$userId,$logType,$logDesc);
        echo view('auth/#/header');
        echo view('auth/login');
        echo view('auth/#/footer');
    }
    public function login(){
        $id=$this->request->getVar('txtEmail');
        $password=$this->request->getVar('txtPassword');
    }


    public function resetPasscode()
    {
        $id=$this->request->getVar('txtEmail');

        $checkUser= new UserModel();
        $userId = $checkUser->where('user_id',$id)->first();
        $userEmail = $checkUser->where('user_email',$id)->first();
        $logType = "Request";

        $Sys = new Sys();
        $getTime = $Sys->getTime();
        $resetId =  $getTime['ts'];
        $Date =  $getTime['date'];
        $Time =  $getTime['time'];

        $link = base_url()."/html/pages/auths/auth-check-password-reset-v2.html/".$resetId;
        $subject = "Password Reset Code";
         
        $getBrowser = $Sys->getBrowser();
        $getIP = $Sys->getIPAddress();


        $message1 = "You requested password reset using ip address ".$getIP." on ".$getBrowser['browser']." browser for ".$getBrowser['device']." machine running ".$getBrowser['os_platform']." operating system. Requested on ".$Time." on ".$Date.". Please follow the link below to reset your password. LINK: ".$link;

        $logDesc = "Password reset request using Email or ID number: ".$id. " on ".$Date.$Time;

        if ($userId>0) {
            # code...
            $Id = $userId['user_id'];
            $username = $userId['user_fname'];
            $email = $userId['user_email'];
            $message = "Hello, ".$username." ".$message1;
            $userData=[
                'user_status'=>$resetId,
            ];
            $updateUser= new UserModel();
            $updateUser->where('user_id',$Id);
            $updateUser->set($userData);
            $updateUser->update();
            $Sys->addLog(1,$Id,$logType,$logDesc);
            $Sys->sendEmail($email,$subject,$message);
            $status=1;
            $data['message']="Email sent to registered email. Please check your Email inbox or spam folder";
            
        } else {
            # code...
            if ($userEmail>0) {
                # code...
                $Id = $userEmail['user_id'];
                $username = $userEmail['user_fname'];
                $email = $id;
                $message = "Hello, ".$username." ".$message1;
                $userData=[
                    'user_status'=>$resetId,
                ];
                $updateUser= new UserModel();
                $updateUser->where('user_id',$Id);
                $updateUser->set($userData);
                $updateUser->update();
                $Sys->addLog(1,$Id,$logType,$logDesc);
                $Sys->sendEmail($email,$subject,$message);
                $status=1;
                $data['message']="Email sent to registered email. Please check your Email inbox or spam folder";
            } else {
                # code...
                $status=0;
                $data['message']="User not found";
            }
        }
        

        echo json_encode(array("status" => $status , 'data' => $data));
    }
    public function changePasscode($resetCode)
    {
        $data['resetCode'] = $resetCode;
        echo view('auth/#/header');
        echo view('auth/reset_password',$data);
        echo view('auth/#/footer');
    }
}
