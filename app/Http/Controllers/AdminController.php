<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Log;
use App\Models\User;
use File;
use Illuminate\Support\Facades\DB;
use Cache;
use Datetime;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    function dashboard()
    {
        $user = User::where('email',session()->get('logged'))->first();
        return view('admin.dashboard')->with('user', $user);
    }
    function categories()
    {
        $user = User::where('email',session()->get('logged'))->first();
        $categories = Category::all();
        return view('admin.categories')->with('categories', $categories)->with('user', $user);
    }
    function addCategory(Request $req)
    {
        $req->validate(
        [
            'category_name'=> 'required',


        ], 
        [
            'category_name.required' =>'Category Name Is Required',
            
        ]);
        $user = User::where('email',session()->get('logged'))->first();
        $category = new Category();
        $category->category_name = $req->category_name;
        $category->save();
        //$log_string = "Created By: ".$admin->admin_name ." - Category ID: ".$category->category_id. " - Category Name: ".$category->category_name." - Time: ".$mytime->toDateTimeString();
        //$this->createLog("Category", $log_string);
        Alert::success('Successfull', 'New Category Added');
        return back();
    }
    // function createLog($log_module, $log_string)
    // {
    //     $log = new Log();
    //     $log->log_module = $log_module;
    //     $log->log_string = $log_string;
    //     $log->save();
    // }

    function purchases()
    {
        $user = User::where('email',session()->get('logged'))->first();
        $purchases = Purchase::paginate(10);
        return view('admin.purchases')->with('purchases', $purchases)->with('user', $user);

    }
    function changeStatus(Request $req)
    {
        $user = User::where('email',session()->get('logged'))->first();
        $purchase = Purchase::where('purchase_id', $req->purchase_id)->first();
        $purchase->purchase_status = $req->purchase_status;
        $purchase->save();
        //$log_string = "Created By: ".$admin->admin_name ." - Purchase ID: ".$purchase->purchase_id. " - Purchase Status: ".$purchase->purchase_status." - Time: ".$mytime->toDateTimeString();
        //$this->createLog("Purchase", $log_string);
        Alert::success('Successfull', 'Purchase Status Changed');
        return back();
    }
    function settings()
    {
        $user = User::where('email',session()->get('logged'))->first();
        $settings = Setting::where('setting_id', 1)->first();
        return view('admin.settings')->with('settings', $settings)->with('user', $user);
    }
    function updateSettings(Request $req)
    {
        $req->validate(
            [
                'logo'=> 'mimes:jpg,jpeg,png',
    
    
            ], 
            [
                'logo.mimes' =>'Invalid File Format',
                
            ]);
        if ($req->hasFile('logo')) 
        {
            $file_name = "setting". "-" . time().".".$req->file('logo')->getClientOriginalExtension();
                //$file_name = $url . "/" . $product_name_without_space. "-".$admin->admin_phone . "-" . time() . $image_count ."." . $file->getClientOriginalExtension();
                $req->file('logo')->move(public_path('setting_images'), $file_name);

        }
        $user = User::where('email',session()->get('logged'))->first();
        $settings = Setting::where('setting_id', 1)->first();
        $settings->logo = $file_name;
        $settings->name = $req->name;
        $settings->email = $req->email;
        $settings->bkash = $req->bkash;
        $settings->save();
        Alert::success('Successfull', 'Settings Updated');
        return back();
    }
}
