<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\EmailLibrary;
use App\Libraries\SystemLibrary;

class User extends BaseController
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
        $data['title'] = "Users";
        $checkUser = new UserModel();
        $data['user'] = $checkUser->findAll();


        return view('user/userlist', $data);
    }

    // create new user
    public function addUser()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        $sys = new Sys();
        $modelUser = new UserModel();

        $session = session();
        $userID = $this->request->getVar('txtID');
        $email = $this->request->getVar('txtEmail');


        try {
            $userIddata = $modelUser->findUserById($userID);
            $userEmail = $modelUser->findUserByEmail($email);

            if (!empty($userIddata)) {
                throw new \Exception("Failed Duplicate entry for user ID " . $userID . "  Please try again with different ID");
            } else {
                if (!empty($userEmail)) {
                    throw new \Exception("Failed Duplicate entry for user email " . $email . "  Please try again with different email");
                } else {

                    $userData = [
                        'user_id' => $userID,
                        'user_email' => $email,
                        'user_fname' => $this->request->getVar('txtFname'),
                        'user_oname' => $this->request->getVar('txtOname'),
                        'user_type' => $this->request->getVar('txtUT'),
                        'user_status' => 1,
                        'added_on' => $this->system->getCurrentDateTime(),
                        'phone_number' => $this->request->getVar('txtPN'),
                        'createdBy' => $session->get('user_id'),
                    ];


                    $password = $this->system->generateRandomPassword();

                    // Get the User Provider (UserModel by default)
                    $users = auth()->getProvider();

                    $userDatas = [
                        'username' => $userData['user_fname'] . $userID,
                        'email'    => $email,
                        'password' => $password,
                    ];

                    $users->save($userDatas);

                    $user = $users->findById($users->getInsertID());

                    $user->addGroup($this->request->getVar('txtUT'));

                    $user->fill([
                        'username' => $userData['user_fname'] . $userID,
                        'name' => $userData['user_fname'],
                        'email'    => $email,
                        'password' => $password,
                    ]);
                    $users->save($user);

                    $modelUser->createNewUser($userData);

                    $message = 'Hello ' . $this->request->getVar('txtFname')
                        . ',<br><br> A CAMERA20 POS account has been created using this email. Please login to ' . base_url() . ' and use the following password and username <br>'
                        . 'Username: <b>' . $email . '</b><br>'
                        . 'Password: <b>' . $password . '</b>';

                    $data['status'] = 1;
                    $data['message'] = "Success, User account created successfully and email sent to the new user with password";
                    $this->email->sendEmail($email, "Account Creation Successful", $message);
                    $logDesc = "User " . $this->request->getVar('txtFname') . " added as " . $this->request->getVar('txtUT') . " by " . $session->get('user_name') . " on " . $this->system->getCurrentDateTime();
                    $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Create", $logDesc);
                }
            }
        } catch (\Throwable $th) {
            $data['message'] = 'Error: "' . $th->getMessage();
            $this->logError('User::addUser', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }

    // logs all throwables and exeptions in this class
    private function logError($method, $message)
    {
        $logMessage = "Error in $method method: $message";
        log_message('error', $logMessage);
    }
}
