<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Log;
use App\Models\Admin;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TranReq;
use App\Models\PaymentMethod;
use File;
use Datetime;
use App\Http\Controllers\AdminController;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    function recharges()
    {
        $mytime = Carbon::now();
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        if($admin->admin_type=="1")
        {
            $transactions = DB::table('transaction_requests')
            ->join('accounts', 'transaction_requests.account_id', '=', 'accounts.account_id')
            ->join('payment_methods', 'transaction_requests.pm_id', '=', 'payment_methods.pm_id')
            ->where('transaction_requests.request_status', '=', 'Pre-Approval')
            ->where('transaction_requests.request_type', '=', 'Recharge')
            ->select('transaction_requests.*', 'accounts.account_name', 'payment_methods.pm_name')
            ->paginate(15);
        }
        else
        {
            $transactions = DB::table('transaction_requests')
            ->join('accounts', 'transaction_requests.account_id', '=', 'accounts.account_id')
            ->join('payment_methods', 'transaction_requests.pm_id', '=', 'payment_methods.pm_id')
            ->join('refers', 'refers.account_id', '=', 'transaction_requests.account_id')
            ->where('transaction_requests.request_status', '=', 'Pre-Approval')
            ->where('transaction_requests.request_type', '=', 'Recharge')
            ->select('transaction_requests.*', 'accounts.account_name', 'payment_methods.pm_name')
            ->paginate(15);
        }
        
        return view('admin.recharges')->with('admin', $admin)->with('transactions', $transactions);
    }
    function withdraws()
    {
        $mytime = Carbon::now();
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        if($admin->admin_type=="1")
        {
            $transactions = DB::table('transaction_requests')
            ->join('accounts', 'transaction_requests.account_id', '=', 'accounts.account_id')
            ->join('payment_methods', 'transaction_requests.pm_id', '=', 'payment_methods.pm_id')
            ->where('transaction_requests.request_status', '=', 'Pre-Approval')
            ->where('transaction_requests.request_type', '=', 'Withdraw')
            ->select('transaction_requests.*', 'accounts.account_name', 'payment_methods.pm_name')
            ->paginate(15);
        }
        else
        {
            $transactions = DB::table('transaction_requests')
            ->join('accounts', 'transaction_requests.account_id', '=', 'accounts.account_id')
            ->join('payment_methods', 'transaction_requests.pm_id', '=', 'payment_methods.pm_id')
            ->join('refers', 'refers.account_id', '=', 'transaction_requests.account_id')
            ->where('transaction_requests.request_status', '=', 'Pre-Approval')
            ->where('transaction_requests.request_type', '=', 'Withdraw')
            ->select('transaction_requests.*', 'accounts.account_name', 'payment_methods.pm_name')
            ->paginate(15);
        }
        
        return view('admin.withdraws')->with('admin', $admin)->with('transactions', $transactions);
    }
    function approveTransaction(Request $req)
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $mytime = Carbon::now();
        $transaction_request = TranReq::where('tr_id', $req->tr_id)->first();
        $method = PaymentMethod::where('pm_id', $transaction_request->pm_id)->first();
        
        
        if($transaction_request->request_type=="Recharge")
        {
            $unique_id = "QR".Str::random(4).time();
        }
        else
        {
            $unique_id = "QW".Str::random(4).time();
        }
        $process_transaction = $this->transaction($transaction_request->account_id, $transaction_request->request_amount, $transaction_request->request_type, $unique_id, $admin, $method->pm_name);
        //dd($process_transaction);
        if($process_transaction=="Success")
        {   $transaction_request->request_status = "Success";
            $transaction_request->save();
            Alert::success('Successfull', 'The requested transaction was approved');
            return back();
        }
        else
        {
            $transaction_request->request_status = "Failed";
            $transaction_request->save();
            Alert::error('Failed', $process_transaction);
            return back();
        }
        

    }
    function transaction($account_id, $amount, $type, $unique_id, $admin, $method)
    {
        $mytime = Carbon::now();
        try
        {
            DB::beginTransaction();
            $transaction = new Transaction;
            $transaction->account_id = $account_id;
            if($type=="Buy" || $type == "Withdraw")
            {
                $transaction->transaction_debit_amount = $amount;
            }
            else
            {
                $transaction->transaction_credit_amount = $amount;
            }           
            $transaction->transaction_type = $type;
            $transaction->transaction_payment_method = $method;
            
            //$transaction->transaction_ip_address = $ip_address;
            $transaction->transaction_unique_id = $unique_id;
            $transaction->created_at = new Datetime();
            
            
            if($type=="Recharge" || $type = "Sell")
            {
                $add_balance = $this->addBalance($account_id,$amount);
                if($add_balance=="Success")
                {
                    $transaction->transaction_status = "Success";
                    $transaction->save();
                    DB::commit();
                    \Log::channel('transactions')->info('Transaction Successful with Account ID : ' . $account_id . " " . 
                                                                            "Total Amount: "        .$amount . " " . 
                                                                            "Tran Type: "           .$type . " " .
                                                                            "Unique Tran Id: "      .$unique_id);
                    $log_string = "Transaction Approved By: ".$admin->admin_name ." - Transaction ID: ".$transaction->transaction_id. " - Amount: ".$amount. " - Type: ".$type." - Time: ".$mytime->toDateTimeString();
                    $log = new AdminController();
                    $log->createLog("Transaction",$log_string);
                    return "Success";
                }
                else
                {
                    $transaction->transaction_status = "Failed";
                    $transaction->save();
                    return "Failed";
                }
            }
            else
            {
                $deduct_balance = $this->deductBalance($account_id,$amount);
                if($deduct_balance=="Success")
                {
                    $transaction->transaction_status = "Success";
                    $transaction->save();
                    DB::commit();
                    \Log::channel('transactions')->info('Transaction Successful with Account ID : ' . $account_id . " " . 
                                                                            "Total Amount: "        .$amount . " " . 
                                                                            "Tran Type: "           .$type . " " .
                                                                            "Unique Tran Id: "      .$unique_id);
                    $log_string = "Transaction Approved By: ".$admin->admin_name ." - Transaction ID: ".$transaction->transaction_id. " - Amount: ".$amount. " - Type: ".$type." - Time: ".$mytime->toDateTimeString();
                    $log = new AdminController();
                    $log->createLog("Transaction",$log_string);
                    return "Success";
                }
                else
                {
                    $transaction->transaction_status = "Failed";
                    $transaction->save();
                    return "Insufficient Balance";
                }
            }
            
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return "Server Error";
        }
    }
    function addBalance($account_id, $amount)
    {
        try
        {
            DB::beginTransaction();
            $account = Account::where("account_id", $account_id)->first();
            $account_balance = $account->account_balance;
            $account_balance = $account_balance + $amount;
            $account->account_balance = $account_balance;
            $account->updated_at = new Datetime();
            $account->save();
            DB::commit();
            return "Success";
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return "Failed";
        }
    }

    function deductBalance($account_id, $amount)
    {
        try
        {
            
            $account = Account::where("account_id", $account_id)->first();
            $balanceCheck = $this->balanceCheck($account_id);
            if($balanceCheck>=$amount)
            {   
                DB::beginTransaction();
                $account_balance = $account->account_balance;
                $account_balance = $account_balance - $amount;
                $account->account_balance = $account_balance;
                $account->updated_at = new Datetime();
                $account->save();
                DB::commit();
                return "Success";
            }
            else
            {
                return "Failed";
            }
            
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return "Failed";
        }
    }
    function transactionHistory()
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        if($admin->admin_type=="1")
        {
            $transactions = DB::table('transactions')
                ->join('accounts', 'transactions.account_id', '=', 'accounts.account_id')
                ->select('transactions.*', 'accounts.account_name')
                ->paginate(15);
        }
        else
        {
            $transactions = DB::table('transactions')
                ->join('accounts', 'transactions.account_id', '=', 'accounts.account_id')
                ->join('refers', 'accounts.account_id', '=', 'refers.account_id')
                ->select('transactions.*', 'accounts.account_name')
                ->where('refers.admin_id', $admin->admin_id)
                ->paginate(15);
        }
        return view('admin.transactions')->with('admin', $admin)->with('transactions', $transactions);
        
    }
    function balanceCheck($account_id)
    {
        $account = Account::where("account_id", $account_id)->first();
        $balanceCheck = ($account->account_balance > 0) ? $account->account_balance : 0;
        return $balanceCheck;
    }
    function rejectTransaction(Request $req)
    {
        $mytime = Carbon::now();
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $transaction_request = TranReq::where('tr_id', $req->tr_id)->first();
        $transaction_request->request_status = 'Rejected';
        $transaction_request->save();
        $log_string = "Transaction Rejected By: ".$admin->admin_name ." - Transaction Request ID: ".$transaction_request->tr_id. " - Amount: ".$transaction_request->request_amount. " - Type: ".$transaction_request->request_type." - Time: ".$mytime->toDateTimeString();
        $log = new AdminController();
        $log->createLog("Transaction",$log_string);
        Alert::success('Successfull', 'The requested transaction was rejected');
        return back();

    }
}
