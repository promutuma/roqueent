<?php namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model{
    protected $table = 'session';
    protected $primarykey = 'session_id';
    protected $allowedFields = ['session_id', 'user_id', 'ip_address', 'device', 'user_agent', 'browser', 'browser_version', 'os_platform', 'pattern','date_time'];


}