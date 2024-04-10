<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
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
                    $getTime = $sys->getTime();

                    $dateTime = $getTime['date'] . " " . $getTime['time'];

                    $userData = [
                        'user_id' => $userID,
                        'user_email' => $email,
                        'user_fname' => $this->request->getVar('txtFname'),
                        'user_oname' => $this->request->getVar('txtOname'),
                        'user_type' => $this->request->getVar('txtUT'),
                        'user_status' => 1,
                        'added_on' => $dateTime,
                        'phone_number' => $this->request->getVar('txtPN'),
                        'createdBy' => $session->get('user_id'),
                    ];

                    $message = 'Hello ' . $this->request->getVar('txtFname') . ', An account has been created using this email. Please login to ' . base_url() . ' then reset password to set your password thanks.';

                    $modelUser->createNewUser($userData);

                    $data['status'] = 1;
                    $data['message'] = "Success, User account created successfully and email sent to the new user with password";
                    $sys->sendEmail($email, "Account Creation Successful", $message);
                    $logDesc = "User " . $this->request->getVar('txtFname') . " added as " . $this->request->getVar('txtUT') . " by " . $session->get('user_name') . " on " . $dateTime;
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
