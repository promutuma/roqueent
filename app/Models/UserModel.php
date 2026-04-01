<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'status',
        'status_message',
        'active',
        'last_active',
        'user_id',
        'user_email',
        'user_fname',
        'user_oname',
        'user_type',
        'user_status',
        'error_times',
        'phone_number',
        'createdBy'
    ];

    // function to create a new user profile
    public function createCustomUser($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (\Throwable $th) {
            $this->logError('createNewUser', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }

    // Update a user data
    public function updateUser($id, $data)
    {
        try {
            $this->where('user_id', $id)
                ->set($data)
                ->update();
            return true;
        } catch (\Throwable $e) {
            // Log the error
            $this->logError('updateUser', $e->getMessage());

            // Re-throw the exception
            throw $e;
        }
    }

    // function to find user by id
    public function findUserById($id)
    {
        try {
            return $this->asArray()->where('user_id', $id)->first();
        } catch (\Throwable $th) {
            $this->logError('findUserById', $th->getMessage());
            return false;
        }
    }


    // function to find user by email
    public function findUserByEmail($email)
    {
        try {
            return $this->asArray()->where('user_email', $email)->first();
        } catch (\Throwable $th) {
            $this->logError('findUserByEmail', $th->getMessage());

            // Re-throw the exception
            throw $th;
        }
    }

    // Log errors
    private function logError($method, $message)
    {
        $logMessage = "Error in $method method: $message";
        log_message('error', $logMessage);
    }
}
