<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SessionModel;
use App\Libraries\EmailLibrary;
use App\Libraries\SystemLibrary;
use PhpParser\Node\Stmt\TryCatch;

class Home extends BaseController
{
    public $email;
    public $system;

    public function __construct()
    {
        $this->system = new SystemLibrary();
        $this->email = new EmailLibrary();
    }



    public function index()
    {
        $sessionId = "0";
        $userId = "GUEST";
        $logType = "Access";
        $logDesc = "Accessed Login Page";
        $sys = new Sys();
        $sys->addLog($sessionId, $userId, $logType, $logDesc);


        return view('auth/login');
    }


    public function changePasscode($resetCode)
    {
        $selectUser = new UserModel();
        $userData = $selectUser->where('user_status', $resetCode)->first();
        if (empty($userData)) {
            # code...

            return view('auth/login');
        } else {
            # code...
            $data['userId'] = $userData['user_id'];

            return view('auth/reset_password', $data);
        }
    }

    public function login()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        try {
            $email = $this->request->getPost('txtEmailinput');

            $credentials = [
                'email'    => $email,
                'password' => $this->request->getPost('txtPassword')
            ];

            $loginAttempt = auth()->attempt($credentials);

            if (!$loginAttempt->isOK()) {
                throw new \Exception('Invalid login credentials');
            } else {
                $us = new UserModel();
                $userData = $us->findUserByEmail($email);
                $this->setSession($userData);


                $data['message'] = "User Verified Successfully";
                $data['status'] = 1;
            }
        } catch (\Throwable $th) {
            $data['message'] = 'Error: ' . $th->getMessage();
            $this->logError('Home::login', $th->getMessage());
        }


        // Return JSON response
        return $this->response->setJSON($data);
    }

    public function resetPasscode()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        $sys = new Sys();
        $getTime = $sys->getTime();
        $resetId =  $getTime['ts'];

        $checkUser = new UserModel();
        $id = $this->request->getVar('txtEmail');

        try {
            $userId = $checkUser->findUserById($id);
            $userEmail = $checkUser->findUserByEmail($id);

            // check if there is data
            if (!empty($userId)) {
                $userData = $userId;
            } elseif (!empty($userEmail)) {
                $userData = $userEmail;
            } else {
                throw new \Exception('User Not Found');
            }

            // set new user data
            $newUserData = [
                'user_status' => $resetId,
            ];



            // update user data
            $checkUser->updateUser($userData['user_id'], $newUserData);

            // create a function to send emails
            log_message('info', $resetId);

            $link = base_url() . "/html/pages/auths/auth-check-password-reset-v2.html/" . $resetId;

            $agent_data = $this->system->getAgentData($this->request->getUserAgent());

            $message = "Hello,<b>" . $userData['user_fname'] . "</b>,<br><br>"
                . "You requested password reset using ip address "
                . $this->request->getIPAddress() . " on "
                . $agent_data['browser'] . " - "
                . $agent_data['browser_Version'] . " browser for "
                . $agent_data['Device'] . " machine running "
                . $agent_data['platform']
                . " operating system. <br><br> Requested on "
                . $this->system->getCurrentDateTime()
                . ". <br> Please follow the link below to reset your password. LINK: "
                . $link
                . "<br><br> Full Agent Info: " . $agent_data['agentString'];

            $this->email->sendEmail($userData['user_email'], 'Password Change Request', $message);

            // response
            $data['status'] = 1;
            $data['message'] = "Email sent to registered email. Please check your Email inbox or spam folder";
        } catch (\Throwable $th) {
            $data['message'] = 'Error: "' . $th->getMessage();
            $this->logError('Home::resetPasscode', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }


    public function setPasscode()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        $checkUser = new UserModel();

        try {
            $userId = $this->request->getVar('txtResetcode');
            $password = $this->request->getVar('txtPassword');

            $userData = [
                'user_password' => password_hash($password, PASSWORD_DEFAULT),
                'user_status' => 1
            ];

            // update user data
            $checkUser->updateUser($userId, $userData);
            $userData = $checkUser->findUserById($userId);

            $this->email->sendEmail($userData['user_email'], 'Password Updated', 'Hello ' . $userData['user_fname'] . ', <br><br>You have successfully updated your password at ' . $this->system->getCurrentDateTime());


            $data['status'] = 1;
            $data['message'] = "Password updated successfully";
        } catch (\Throwable $th) {
            $data['message'] = 'Error: ' . $th->getMessage();
            $this->logError('Home::setPasscode', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }



    public function logOut()
    {
        $sys = new Sys();
        $getTime = $sys->getTime();

        $date =  $getTime['date'];
        $time =  $getTime['time'];
        $session = session();
        $logDesc = "" . $session->get('user_name') . " logged out successfully on " . $date . " " . $time;
        $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Logout", $logDesc);
        $session->destroy();

        return redirect()->to('/');
    }



    // private functions ahead
    // set session
    private function setSession($user)
    {
        $sys = new Sys();

        $getTime = $sys->getTime();
        $sessionId =  $getTime['ts'];
        $date =  $getTime['date'];
        $time =  $getTime['time'];

        $getBrowser = $sys->getBrowser();

        $sessionData = [
            'session_iddata' => $sessionId,
            'user_id' => $user['user_id'],
            'user_name' => $user['user_fname'] . " " . $user['user_oname'],
            'ip_address' => $sys->getIPAddress(),
            'device' => $getBrowser['device'],
            'user_agent' => $getBrowser['user_agent'],
            'browser' => $getBrowser['browser'],
            'browser_version' => $getBrowser['browser_version'],
            'os_platform' => $getBrowser['os_platform'],
            'pattern' => $getBrowser['pattern'],
            'date_time' => $date . " " . $time,
            'usertype' => $user['user_type'],
            'userEmail' => $user['user_email'],
            'isLoggedIn' => true,
            'fname' => $user['user_fname'],
            'oname' => $user['user_oname'],
            'pnumber' => $user['phone_number']
        ];

        try {
            $logDesc = $user['user_fname'] . " Logged in at " . $date . " " . $time;
            $session = session();
            $session->set($sessionData);

            $sys->addLog($sessionId, $user['user_id'], "Login", $logDesc);

            $savesession = new SessionModel();
            $savesession->createNewSession($sessionData);
            return true;
        } catch (\Throwable $th) {
            $this->logError('setSession', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }


    // logs all throwables and exeptions in this class
    private function logError($method, $message)
    {
        $logMessage = "Error in $method method: $message";
        log_message('error', $logMessage);
    }
}
