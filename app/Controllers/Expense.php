<?php

namespace App\Controllers;

use App\Models\ExpenseModel;

class Expense extends BaseController
{
    public function index()
    {
        $data['title'] = "Expenses";
        $expense = new ExpenseModel();
        $data['allexpense'] = $expense->orderBy('expense_ID', 'DESC')->findAll();

        return view('expense/expenselist', $data);
    }

    public function addExpense()
    {
        $session = session();
        $Addexpense = new ExpenseModel();
        $Sys = new Sys();
        $getTime = $Sys->getTime();

        $ExpenseId =  $getTime['ts'];
        $ExpenseDate =  $getTime['date'];
        $ExpenseTime =  $getTime['time'];
        $expenseDesc = $this->request->getVar('txtDesc');
        $expenseAmount = $this->request->getVar('txtAmount');
        $remarks = $this->request->getVar('txtRemarks');
        $expenseData = [
            'expense_ID' => $ExpenseId,
            'expense_description' => $expenseDesc,
            'date' => $ExpenseDate,
            'time' => $ExpenseTime,
            'expense_amount' => $expenseAmount,
            'remarks' => $remarks,
            'createdBy' => $session->get('user_id'),
        ];
        $Addexpense->save($expenseData);
        if ($Addexpense == false) {
            echo json_encode(array("status" => 0, 'data' => 'Error occured when trying to add Expense. Please do not re-add the item'));
        } else {
            $logDesc = "Expense " . $ExpenseId . " of Ksh " . $expenseAmount . "  added to by " . $session->get('user_name') . " on " . $ExpenseDate . " " . $ExpenseTime;
            $Sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Create", $logDesc);
            echo json_encode(array("status" => 1, 'data' => 'Expense with ID:' . $expenseData['expense_ID'] . ' added to the System Successfully at ' . $ExpenseDate . ' ' . $ExpenseTime . ', Please note that this information is editable for only 30 minutes.'));
        }
    }

    public function expenseGet($action, $expenseId)
    {
        $getexpense = new ExpenseModel();
        $expense = $getexpense->where('expense_ID', $expenseId)->first();
        $data['expense'] = $expense;

        if (empty($expense)) {
            # code...
            $status = 0;
            $data['message'] = "Expense not found";
        } else {
            # code...
            $status = 1;
            $data['message'] = "Do you want to " . $action . " this Expense";
        }
        echo json_encode(array("status" => $status, 'data' => $data));
    }

    public function removeExpense($expenseId)
    {
        $Sys = new Sys();
        $getTime = $Sys->getTime();

        $Date =  $getTime['date'];
        $Time =  $getTime['time'];

        $session = session();
        $status = 0;
        $data['message'] = "Expenses cannot be removed, Please edit the expense";
        $logDesc = "User " . $session->get('user_name') . " tried to delete expense (" . $expenseId . ") data on " . $Date . " " . $Time;
        $Sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Delete", $logDesc);
        echo json_encode(array("status" => $status, 'data' => $data));
    }
    public function editExpense()
    {
        $session = session();
        $expenseID = $this->request->getVar('txtExpID');
        $expenseDesc = $this->request->getVar('txtDesc');
        $expenseAmount = $this->request->getVar('txtAmount');
        $Sys = new Sys();
        $getTime = $Sys->getTime();

        $Date =  $getTime['date'];
        $Time =  $getTime['time'];
        $remarks = $this->request->getVar('txtRemarks') . "(Edited on " . $Date . " at " . $Time . ")";
        $expenseData = [
            'expense_description' => $expenseDesc,
            'expense_amount' => $expenseAmount,
            'remarks' => $remarks
        ];

        $updateExpense = new ExpenseModel();
        $updateExpense->where('expense_ID', $expenseID);
        $updateExpense->set($expenseData);
        $updateExpense->update();

        if ($updateExpense == false) {
            # code...
            $status = 0;
            $data['message'] = "Update failed to save to database";
        } else {
            # code...
            $status = 1;
            $data['message'] = "Update Successful. The page will reload now.";
            $logDesc = "User " . $session->get('user_name') . " updated expense " . $expenseID . " data on " . $Date . " " . $Time;
            $Sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Update", $logDesc);
        }
        echo json_encode(array("status" => $status, 'data' => $data));
    }
}
