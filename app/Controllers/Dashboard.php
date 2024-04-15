<?php

namespace App\Controllers;

use App\Models\SessionModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ExpenseModel;
use App\Models\SaleModel;
use App\Models\LogModel;
use App\Models\ItemModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $Sys = new Sys();
        $getTime = $Sys->getTime();

        $data['currentTime'] =  $getTime['ts'];

        $date = date_create($getTime['date'] . " " . $getTime['time']);

        $currentMonth = date_format($date, "n");
        $currentWeek = date_format($date, "W");

        $product = new ProductModel();
        $data['stock'] = $product->orderBy('stock', 'ASD')->findAll(3);


        $expense = new ExpenseModel();
        $expense->join('user as user', 'user.user_id=expense.createdBy');
        $data['expense'] = $expense->orderBy('expense_ID', 'DESC')->findAll(20);
        $totalExpenseThisMonth = $expense->WHERE('MONTH(date)', $currentMonth)->select('sum(expense_amount) as TotalAmount')->first();
        if (empty($totalExpenseThisMonth)) {
            # code...
            $data['expenseThisMonth'] = 0;
        } else {
            # code...
            $data['expenseThisMonth'] = $totalExpenseThisMonth['TotalAmount'];
        }

        $totalExpenseThisWeek = $expense->WHERE('WEEK(date)', $currentWeek)->select('sum(expense_amount) as TotalAmount')->first();
        if (empty($totalExpenseThisWeek)) {
            # code...
            $data['expenseThisWeek'] = 0;
        } else {
            # code...
            $data['expenseThisWeek'] = $totalExpenseThisWeek['TotalAmount'];
        }

        $totalExpenseToday = $expense->WHERE('date', $getTime['date'])->select('sum(expense_amount) as TotalAmount')->first();
        if (empty($totalExpenseThisWeek)) {
            # code...
            $data['expenseToday'] = 0;
        } else {
            # code...
            $data['expenseToday'] = $totalExpenseToday['TotalAmount'];
        }

        $totalExpense = $expense->select('sum(expense_amount) as TotalAmount')->first();
        if (empty($totalExpense)) {
            # code...
            $data['expenseTotal'] = 0;
        } else {
            # code...
            $data['expenseTotal'] = $totalExpense['TotalAmount'];
        }


        $sale = new SaleModel();
        $sale->join('user as user', 'user.user_id=sale.createdBy');
        $data['sales'] = $sale->orderBy('sale_id', 'DESC')->findAll(20);

        # Sales
        $totalASalesthisMonth = $sale->WHERE('MONTH(sale_date)', $currentMonth)->select('sum(amount) as TotalAmount')->first();
        if (empty($totalASalesthisMonth)) {
            # code...
            $data['salesThisMonth'] = 0;
        } else {
            # code...
            $data['salesThisMonth'] = $totalASalesthisMonth['TotalAmount'];
        }
        $totalASalesthisWeek = $sale->WHERE('WEEK(sale_date)', $currentWeek)->select('sum(amount) as TotalAmount')->first();
        if (empty($totalASalesthisWeek)) {
            # code...
            $data['salesThisWeek'] = 0;
        } else {
            # code...
            $data['salesThisWeek'] = $totalASalesthisWeek['TotalAmount'];
        }
        $totalASalesToday = $sale->WHERE('sale_date', $getTime['date'])->select('sum(amount) as TotalAmount')->first();
        if (empty($totalASalesToday)) {
            # code...
            $data['salesThisToday'] = "0";
        } else {
            # code...
            $data['salesThisToday'] = $totalASalesToday['TotalAmount'];
        }
        $totalASales = $sale->select('sum(amount) as TotalAmount')->first();

        if (empty($totalASales)) {
            # code...
            $data['salesToday'] = "0";
        } else {
            # code...
            $data['salesToday'] = $totalASales['TotalAmount'];
        }


        # Profit
        $profit = new ItemModel();
        $totalProfit = $profit->select('sum(total_profit) as TotalAmount')->first();

        if (empty($totalProfit)) {
            # code...
            $data['totalProfit'] = 0;
        } else {
            # code...
            $data['totalProfit'] = $totalProfit['TotalAmount'];
        }

        #Logs
        $getLog = new LogModel();
        $getLog->join('user as user', 'user.user_id=log.user_id');
        $data['logs'] = $getLog->orderBy('log_id', 'DESC')->findAll(10);




        return view('home/dashboard', $data);
    }


    public function myAccount()
    {
        $data['title'] = "Personal Information";

        return view('home/myaccount', $data);
    }


    public function myAccountNotification()
    {
        $data['title'] = "Notification Settings";

        echo view('home/myAccountNotification', $data);
    }


    public function myAccountSettings()
    {
        $data['title'] = "Security Settings";


        return view('home/myaccountsettings', $data);
    }

    public function myAccountActivity()
    {
        $data['title'] = "Login Activity";
        $activity = new SessionModel();
        $data['logs'] = $activity->where('user_id', $_SESSION['user_id'])->orderBy('session_iddata', 'DESC')->findAll();

        return view('home/myaccountactivity', $data);
    }


    public function myAccountSocial()
    {
        $data['title'] = "Connected with Social Account";


        return view('home/myaccountsocial', $data);
    }
}
