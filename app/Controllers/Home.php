<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\SessionModel;

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
        $status=0;
        $id=$this->request->getVar('txtEmail');
        $password=$this->request->getVar('txtPassword');

        $checkUser= new UserModel();
        $userId = $checkUser->where('user_id',$id)->first();
        $userEmail = $checkUser->where('user_email',$id)->first();

        if ($userId>0) {
            # code...
            $userData = $userId;
            if (password_verify($password,$userData['user_password'])) {
                # code...
                $status = 1;
                $this->setSession($userData);
                $data['message']="Password verified. PRESS OKAY TO LOG IN";
                
            } else {
                # code...
                $data['message']="Incorrect Password";
            }
            
        } else {
            # code...
            if ($userEmail>0) {
                # code...
                $userData = $userEmail;
                if (password_verify($password,$userData['user_password'])) {
                    # code...
                    $status = 1;
                    $this->setSession($userData);
                    $data['message']="Password verified. PRESS OKAY TO LOG IN";
                    
                } else {
                    # code...
                    $data['message']="Incorrect Password";
                }
                
            } else {
                # code...
                $status = 0;
                $data['message']="User not Found";
            }
            
        }

        
        echo json_encode(array("status" => $status , 'data' => $data));
    }

    private function setSession($user){
        $Sys = new Sys();

        $getTime = $Sys->getTime();
        $sessionId =  $getTime['ts'];
        $Date =  $getTime['date'];
        $Time =  $getTime['time'];

        $getBrowser = $Sys->getBrowser();

        $Sessiondata = [
            'session_iddata' => $sessionId ,
            'user_id' => $user['user_id'],
            'user_name'=> $user['user_fname']." ".$user['user_oname'],
            'ip_address' => $Sys->getIPAddress(),
            'device' => $getBrowser['device'],
            'user_agent' => $getBrowser['user_agent'],
            'browser' => $getBrowser['browser'],
            'browser_version' => $getBrowser['browser_version'],
            'os_platform' => $getBrowser['os_platform'],
            'pattern' => $getBrowser['pattern'],
            'date_time'=> $Date." ".$Time,
            'usertype' => $user['user_type'],
            'userEmail' => $user['user_email'],
            'isLoggedIn'=>true,
            'fname'=> $user['user_fname'],
            'oname'=> $user['user_oname'],
            'pnumber'=> $user['phone_number']
        ];
        $logDesc=$user['user_fname']." Logged in at ".$Date." ".$Time;
        $session = session();
        $session->set($Sessiondata);
        $Sys = new Sys();
        $Sys->addLog($sessionId,$user['user_id'],"Login",$logDesc);
        $savesession = new SessionModel();
        $savesession->save($Sessiondata);
        return true;
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
            $logDesc = "User with user Id: ".$Id." requested password reset using user National ID on ".$Date." ".$Time;
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
                $logDesc = "User with user Email: ".$Id." requested password reset using user Email on ".$Date." ".$Time;
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
        $selectUser = new UserModel();
        $userData = $selectUser->where('user_status',$resetCode)->first();
        if (empty($userData)) {
            # code...
            echo view('auth/#/header');
            echo view('auth/login');
            echo view('auth/#/footer');
        } else {
            # code...
            $data['userId'] = $userData['user_id'];
            echo view('auth/#/header');
            echo view('auth/reset_password',$data);
            echo view('auth/#/footer');
        }
    }

    public function setPasscode(){
        $status = 0;
        $userId=$this->request->getVar('txtResetcode');
        $password=$this->request->getVar('txtPassword');
        $Sys = new Sys();


        $Sys = new Sys();
        $getTime = $Sys->getTime();
        
        $Date =  $getTime['date'];
        $Time =  $getTime['time'];
        

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $updateUser = new UserModel();
        $userData = [
            'user_password'=>$passwordHash,
            'user_status' => 1
        ];

        $updateUser->where('user_id',$userId);
        $updateUser->set($userData);
        $updateUser->update();

        $logDesc = "User with user ID: ".$userId." updated password successfully on ".$Date." ".$Time;

        $status = 1;

        $Sys->addLog(1,$userId,"Update",$logDesc);

        $data['message']="Password updated successfully";

        echo json_encode(array("status" => $status , 'data' => $data));
    }

    public function logOut(){
        $Sys = new Sys();
        $getTime = $Sys->getTime();
        
        $Date =  $getTime['date'];
        $Time =  $getTime['time'];
        $session = session();
        $logDesc = "".$session->get('user_name')." logged out successfully on ".$Date." ".$Time;
        $Sys->addLog($session->get('session_iddata'),$session->get('user_id'),"Logout",$logDesc);
        $session->destroy();
        
        return redirect()->to('/');
    }
}
