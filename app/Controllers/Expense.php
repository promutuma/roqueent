<?php

namespace App\Controllers;
use App\Models\ExpenseModel;

class Expense extends BaseController
{
    public function index()
    {
        $expense = new ExpenseModel();
        $data['allexpense']=$expense->findAll();
        echo view('maintemp/header');
        echo view('expense/expenselist',$data);
        echo view('maintemp/footer');
    }
    
    public function addExpense(){
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
            'expense_ID'=>$ExpenseId,
            'expense_description'=>$expenseDesc,
            'date'=>$ExpenseDate,
            'time'=>$ExpenseTime,
            'expense_amount'=>$expenseAmount,
            'remarks'=>$remarks,
        ];
        $Addexpense->save($expenseData);
        if($Addexpense == false){
            echo json_encode(array("status" => 0 , 'data' => 'Error occured when trying to add Expense. Please do not re-add the item'));
        }else{
            echo json_encode(array("status" => 1 , 'data' => 'Expense with ID:' .$expenseData['expense_ID'].' added to the System Successfully at '.$ExpenseDate .' '.$ExpenseTime.', Please note that this information is editable for only 30 minutes.'));
        }
    }
}
