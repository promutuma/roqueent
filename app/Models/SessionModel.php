<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table = 'session';
    protected $primarykey = 'session_id';
    protected $allowedFields = [
        'session_iddata',
        'user_id',
        'ip_address',
        'device',
        'user_agent',
        'browser',
        'browser_version',
        'os_platform',
        'pattern',
        'date_time'
    ];

    // function to create a new user
    public function createNewSession($data)
    {
        try {
            $this->insert($data);
            return true;
        } catch (\Throwable $th) {
            $this->logError('createNewSession', $th->getMessage());

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
