<?php namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model{
    protected $table = 'log';
    protected $primarykey = 'log_id';
    protected $allowedFields = ['log_id', 'session_id', 'user_id', 'log_type', 'log_desc', 'log_date', 'log_time'];


}