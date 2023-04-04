<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'user';
    protected $primarykey = 'user_id';
    protected $allowedFields = ['user_id', 'user_email', 'user_fname', 'user_oname', 'user_type', 'user_status', 'user_password', 'error_times', 'added_on','phone_number','createdBy'];


}