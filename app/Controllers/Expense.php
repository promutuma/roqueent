<?php

namespace App\Controllers;

use App\Models\ExpenseModel;

class Expense extends BaseController
{
    private string $errorText = 'Error: ';

    public function index()
    {
        $data['title'] = "Expenses";
        $expense = new ExpenseModel();
        $data['allexpense'] = $expense->orderBy('expense_ID', 'DESC')->findAll();

        return view('expense/expenselist', $data);
    }

    public function addExpense()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        try {
            $expense = new ExpenseModel();

            $sys = new Sys();
            $getTime = $sys->getTime();

            $expenseId =  $getTime['ts'];
            $expenseDate =  $getTime['date'];
            $expenseTime =  $getTime['time'];
            $expenseDesc = $this->request->getVar('txtDesc');
            $expenseAmount = $this->request->getVar('txtAmount');
            $remarks = $this->request->getVar('txtRemarks');
            $expenseData = [
                'expense_ID' => $expenseId,
                'expense_description' => $expenseDesc,
                'date' => $expenseDate,
                'time' => $expenseTime,
                'expense_amount' => $expenseAmount,
                'remarks' => $remarks,
                'createdBy' => session()->get('user_id'),
            ];

            $expense->addExpense($expenseData);

            $data['status'] = 1;
            $data['message'] = "Expense Added Successfully";
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Expense::addExpense', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }

    public function expenseGet($action, $expenseId)
    {
        $data = [
            'status' => 0,
            'message' => '',
            'data' => [],
        ];

        try {
            $getexpense = new ExpenseModel();
            $expense = $getexpense->where('expense_ID', $expenseId)->first();
            $res_data['expense'] = $expense;

            if (empty($expense)) {
                $data['message'] = "Expense not found";
            } else {
                $data['status'] = 1;
                $data['message'] = "Do you want to " . $action . " this Expense";
                $data['data'] = $res_data;
            }
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Expense::expenseGet', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }


    public function removeExpense($expenseId)
    {
        try {
            $sys = new Sys();
            $getTime = $sys->getTime();

            $date =  $getTime['date'];
            $time =  $getTime['time'];

            $session = session();

            $logDesc = "User " . $session->get('user_name') . " tried to delete expense (" . $expenseId . ") data on " . $date . " " . $time;
            $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Delete", $logDesc);

            // $e = new ExpenseModel();
            // $e->deleteExpense($expenseId);

            throw new \Exception('Expenses cannot be removed, Please edit the expense');
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Expense::removeExpense', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }


    public function editExpense()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        try {
            $expenseId = $this->request->getVar('txtExpID');
            $expenseDesc = $this->request->getVar('txtDesc');
            $expenseAmount = $this->request->getVar('txtAmount');
            $sys = new Sys();
            $getTime = $sys->getTime();

            $date =  $getTime['date'];
            $time =  $getTime['time'];
            $remarks = $this->request->getVar('txtRemarks') . "(Edited on " . $date . " at " . $time . ")";
            $expenseData = [
                'expense_description' => $expenseDesc,
                'expense_amount' => $expenseAmount,
                'remarks' => $remarks
            ];

            $e = new ExpenseModel();
            $e->updateExpense($expenseId, $expenseData);

            $data['status'] = 1;
            $data['message'] = "Expense Updated Successfully";
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Expense::removeExpense', $th->getMessage());
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
