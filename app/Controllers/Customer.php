<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\SaleModel;

class Customer extends BaseController
{
    private string $errorText = 'Error: ';

    public function index()
    {
        $data['title'] = "Customer List";
        $customer = new CustomerModel();
        $data['allCustomers'] = $customer->getCustomers();

        return view('customer/customerlist', $data);
    }

    public function addCustomer()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        try {
            $customer = new CustomerModel();
            $sys = new Sys();
            $session = session();

            $customerData = [
                'customer_name' => $this->request->getVar('txtName'),
                'customer_email' => $this->request->getVar('txtEmail'),
                'phone_number' => $this->request->getVar('txtPhone'),
                'added_on' => $sys->getCurrentDateTime(),
                'createdBy' => $session->get('user_id'),
            ];

            if ($customer->insert($customerData)) {
                $data['status'] = 1;
                $data['message'] = "Success, Customer added successfully";
                
                $logDesc = "Customer " . $customerData['customer_name'] . " added by " . $session->get('user_name');
                $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Create", $logDesc);
            } else {
                throw new \Exception("Failed to add customer.");
            }
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            log_message('error', $data['message']);
        }

        return $this->response->setJSON($data);
    }

    public function updateCustomer()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        try {
            $customer = new CustomerModel();
            $sys = new Sys();
            $session = session();
            
            $id = $this->request->getVar('txtId');
            $customerData = [
                'customer_name' => $this->request->getVar('txtName'),
                'customer_email' => $this->request->getVar('txtEmail'),
                'phone_number' => $this->request->getVar('txtPhone'),
            ];

            if ($customer->update($id, $customerData)) {
                $data['status'] = 1;
                $data['message'] = "Success, Customer updated successfully";
                
                $logDesc = "Customer " . $customerData['customer_name'] . " updated by " . $session->get('user_name');
                $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Update", $logDesc);
            } else {
                throw new \Exception("Failed to update customer.");
            }
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            log_message('error', $data['message']);
        }

        return $this->response->setJSON($data);
    }

    public function deleteCustomer($id)
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
        ];

        try {
            $customer = new CustomerModel();
            $sys = new Sys();
            $session = session();
            
            $customerDetails = $customer->getCustomerById($id);
            if (!$customerDetails) {
                throw new \Exception("Customer not found.");
            }

            if ($customer->delete($id)) {
                $data['status'] = 1;
                $data['message'] = "Success, Customer deleted successfully";
                
                $logDesc = "Customer " . $customerDetails['customer_name'] . " deleted by " . $session->get('user_name');
                $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Delete", $logDesc);
            } else {
                throw new \Exception("Failed to delete customer.");
            }
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            log_message('error', $data['message']);
        }

        return $this->response->setJSON($data);
    }

    public function getCustomer($id)
    {
        $customer = new CustomerModel();
        $data = $customer->getCustomerById($id);
        return $this->response->setJSON(['status' => true, 'data' => $data]);
    }
}
