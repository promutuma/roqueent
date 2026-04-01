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
        $data['stock'] = $product->orderBy('stock', 'ASC')->findAll(3);
        
        // Low Stock alerts
        try {
            $data['lowStockProducts'] = $product->where('stock <= low_stock_threshold', null, false)->findAll();
        } catch (\Throwable $th) {
            $data['lowStockProducts'] = [];
            $data['migration_needed'] = true;
        }


        $db = \Config\Database::connect();
        $expense = new ExpenseModel();
        $expense->join('users as user', 'user.user_id=expense.createdBy');
        $data['expense'] = $expense->orderBy('expense.id', 'DESC')->findAll(20);
        
        if ($db->DBDriver === 'SQLite3') {
            $totalExpenseMonth = $expense->where("strftime('%m', date) =", sprintf('%02d', $currentMonth))
                                         ->selectSum('expense_amount', 'TotalAmount')->first();
            $totalExpenseWeek = $expense->where("strftime('%W', date) =", sprintf('%02d', $currentWeek))
                                         ->selectSum('expense_amount', 'TotalAmount')->first();
        } else {
            $totalExpenseMonth = $expense->WHERE('MONTH(date)', $currentMonth)
                                         ->selectSum('expense_amount', 'TotalAmount')->first();
            $totalExpenseWeek = $expense->WHERE('WEEK(date)', $currentWeek)
                                         ->selectSum('expense_amount', 'TotalAmount')->first();
        }
        $data['expenseThisMonth'] = $totalExpenseMonth['TotalAmount'] ?? 0;
        $data['expenseThisWeek'] = $totalExpenseWeek['TotalAmount'] ?? 0;

        $totalExpenseToday = $expense->WHERE('date', $getTime['date'])
                                     ->selectSum('expense_amount', 'TotalAmount')->first();
        $data['expenseToday'] = $totalExpenseToday['TotalAmount'] ?? 0;

        $totalExpenseAll = $expense->selectSum('expense_amount', 'TotalAmount')->first();
        $data['expenseTotal'] = $totalExpenseAll['TotalAmount'] ?? 0;


        $sale = new SaleModel();
        $sale->join('users as user', 'user.user_id=sale.createdBy');
        $data['sales'] = $sale->orderBy('sale.id', 'DESC')->findAll(20);

        # Sales
        if ($db->DBDriver === 'SQLite3') {
            $totalSalesMonth = $sale->where("strftime('%m', sale_date) =", sprintf('%02d', $currentMonth))
                                     ->selectSum('amount', 'TotalAmount')->first();
            $totalSalesWeek = $sale->where("strftime('%W', sale_date) =", sprintf('%02d', $currentWeek))
                                    ->selectSum('amount', 'TotalAmount')->first();
        } else {
            $totalSalesMonth = $sale->WHERE('MONTH(sale_date)', $currentMonth)
                                     ->selectSum('amount', 'TotalAmount')->first();
            $totalSalesWeek = $sale->WHERE('WEEK(sale_date)', $currentWeek)
                                    ->selectSum('amount', 'TotalAmount')->first();
        }
        $data['salesThisMonth'] = $totalSalesMonth['TotalAmount'] ?? 0;
        $data['salesThisWeek'] = $totalSalesWeek['TotalAmount'] ?? 0;

        $totalSalesToday = $sale->WHERE('sale_date', $getTime['date'])
                                 ->selectSum('amount', 'TotalAmount')->first();
        $data['salesThisToday'] = $totalSalesToday['TotalAmount'] ?? 0;

        $totalSalesAll = $sale->selectSum('amount', 'TotalAmount')->first();
        $data['salesToday'] = $totalSalesAll['TotalAmount'] ?? 0;


        # Profit
        $profit = new ItemModel();
        $totalProfitData = $profit->selectSum('total_profit', 'TotalAmount')->first();
        $data['totalProfit'] = $totalProfitData['TotalAmount'] ?? 0;

        #Logs
        $getLog = new LogModel();
        $getLog->join('users as user', 'user.user_id=log.user_id');
        $data['logs'] = $getLog->orderBy('log.id', 'DESC')->findAll(10);




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
