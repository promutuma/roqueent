<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primarykey = 'user_id';
    protected $allowedFields = [
        'user_id',
        'user_email',
        'user_fname',
        'user_oname',
        'user_type',
        'user_status',
        'user_password',
        'error_times',
        'added_on',
        'phone_number',
        'createdBy'
    ];

    // function to create a new user
    public function createNewUser($data)
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
            return $this->where('user_id', $id)->first();
        } catch (\Throwable $th) {
            $this->logError('findUserById', $th->getMessage());
            return false;
        }
    }


    // function to find user by email
    public function findUserByEmail($id)
    {
        try {
            return $this->where('user_email', $id)->first();
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
