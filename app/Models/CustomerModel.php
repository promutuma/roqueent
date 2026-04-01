<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'customer_name',
        'customer_email',
        'phone_number',
        'loyalty_points',
        'credit_balance',
        'added_on',
        'createdBy'
    ];

    public function getCustomers()
    {
        return $this->findAll();
    }

    public function getCustomerById($id)
    {
        return $this->where('id', $id)->first();
    }
}
