<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Log;
use App\Models\Admin;
use App\Models\Product;
use App\Models\MyProduct;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TranReq;
use App\Models\TradeRequest;
use App\Models\PaymentMethod;
use App\Http\Controllers\TransactionController;
use File;
use Datetime;
use App\Http\Controllers\AdminController;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TradeController extends Controller
{
    function sells()
    {
        $mytime = Carbon::now();
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        if($admin->admin_type=='1')
        {
           $trades = DB::table('requests')
                    ->join('accounts', 'requests.account_id', '=', 'accounts.account_id')
                    ->join('products', 'requests.product_id', '=', 'products.product_id')
                    ->join('my_products', 'my_products.product_id', '=', 'products.product_id')
                    ->select(
                        'requests.*',
                        'accounts.account_name',
                        'products.product_name',
                        'my_products.my_product_amount_per_quantity as buying_price'
    )
                    ->where('requests.request_status', '=', 'Pre-Approval')
                    ->where('requests.request_type', '=', 'Sell')
                    ->paginate(15);
        }
        else
        {
            $trades = DB::table('requests')
                    ->join('accounts', 'requests.account_id', '=', 'accounts.account_id')
                    ->join('products', 'requests.product_id', '=', 'products.product_id')
                    ->join('refers', 'refers.account_id', '=', 'accounts.account_id')
                    ->join('my_products', 'my_products.product_id', '=', 'products.product_id')
                    ->select(
                        'requests.*',
                        'accounts.account_name',
                        'products.product_name',
                        'my_products.my_product_amount_per_quantity as buying_price'
                    )
                    ->where('requests.request_status', '=', 'Pre-Approval')
                    ->where('requests.request_type', '=', 'Sell')
                    ->where('refers.admin_id', $admin->admin_id)
                    ->paginate(15);
        }
        return view('admin.sells')->with('admin',$admin)->with('trades',$trades);

    }
    function approveTrade(Request $req)
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $mytime = Carbon::now();
        $request = TradeRequest::where('request_id', $req->request_id)->first();
        $product = Product::where('product_id', $request->product_id)->first();
        $my_product = MyProduct::where('product_id', $request->product_id)->first();
        $unique_id = "QS".Str::random(4).time();
        $process_transaction = (new TransactionController)->transaction($request->account_id, $request->request_amount_total, $request->request_type, $unique_id, $admin, "Quirky Internal Points");
        //dd($process_transaction);
        if($process_transaction=="Success")
        {   
            $product->product_stock = $product->product_stock + $request->request_quantity;
            $product->save();
            $my_product->my_product_quantity = $my_product->my_product_quantity - $request->request_quantity;
            $my_product->save();
            $request->request_status = "Success";
            $request->save();
            Alert::success('Successfull', 'The requested transaction was approved');
            return back();
        }
        else
        {
            $request->request_status = "Failed";
            $request->save();
            Alert::error('Failed', $process_transaction);
            return back();
        }
        

    }
    function rejectTrade(Request $req)
    {
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        $mytime = Carbon::now();
        $request = TradeRequest::where('request_id', $req->request_id)->first();
        $request->request_status = 'Rejected';
        $request->save();
        $log_string = "Transaction Rejected By: ".$admin->admin_name ." - Trade Request ID: ".$request->request_id. " - Amount: ".$request->request_amount_total. " - Type: ".$request->request_type." - Time: ".$mytime->toDateTimeString();
        $log = new AdminController();
        $log->createLog("Transaction/Trade",$log_string);
        Alert::success('Successfull', 'The requested transaction was rejected');
        return back();
    }
    function buys()
    {
        $mytime = Carbon::now();
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        if($admin->admin_type=='1')
        {
           $trades = DB::table('requests')
                    ->join('accounts', 'requests.account_id', '=', 'accounts.account_id')
                    ->join('products', 'requests.product_id', '=', 'products.product_id')
                    ->join('my_products', 'my_products.product_id', '=', 'products.product_id')
                    ->select(
                        'requests.*',
                        'accounts.account_name',
                        'products.product_name',
                        'my_products.my_product_amount_per_quantity as buying_price'
    )
                    ->where('requests.request_status', '=', 'Success')
                    ->where('requests.request_type', '=', 'Buy')
                    ->paginate(15);
        }
        else
        {
            $trades = DB::table('requests')
                    ->join('accounts', 'requests.account_id', '=', 'accounts.account_id')
                    ->join('products', 'requests.product_id', '=', 'products.product_id')
                    ->join('refers', 'refers.account_id', '=', 'accounts.account_id')
                    ->join('my_products', 'my_products.product_id', '=', 'products.product_id')
                    ->select(
                        'requests.*',
                        'accounts.account_name',
                        'products.product_name',
                        'my_products.my_product_amount_per_quantity as buying_price'
                    )
                    ->where('requests.request_status', '=', 'Success')
                    ->where('requests.request_type', '=', 'Buy')
                    ->where('refers.admin_id', $admin->admin_id)
                    ->paginate(15);
        }
        return view('admin.buys')->with('admin',$admin)->with('trades',$trades);

    }
    function trades()
    {
        $mytime = Carbon::now();
        $admin = Admin::where('admin_phone',session()->get('logged'))->first();
        if($admin->admin_type=='1')
        {
           $trades = DB::table('requests')
                    ->join('accounts', 'requests.account_id', '=', 'accounts.account_id')
                    ->join('products', 'requests.product_id', '=', 'products.product_id')
                    ->join('my_products', 'my_products.product_id', '=', 'products.product_id')
                    ->select(
                        'requests.*',
                        'accounts.account_name',
                        'products.product_name',
                        'my_products.my_product_amount_per_quantity as buying_price'
                            )
                    ->paginate(15);
        }
        else
        {
            $trades = DB::table('requests')
                    ->join('accounts', 'requests.account_id', '=', 'accounts.account_id')
                    ->join('products', 'requests.product_id', '=', 'products.product_id')
                    ->join('refers', 'refers.account_id', '=', 'accounts.account_id')
                    ->join('my_products', 'my_products.product_id', '=', 'products.product_id')
                    ->select(
                        'requests.*',
                        'accounts.account_name',
                        'products.product_name',
                        'my_products.my_product_amount_per_quantity as buying_price'
                            )
                    ->where('refers.admin_id', $admin->admin_id)
                    ->paginate(15);
        }
        return view('admin.trades')->with('admin',$admin)->with('trades',$trades);

    }
    
}
