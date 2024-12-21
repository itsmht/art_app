<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ProductImage;
use App\Models\Setting;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\SMSController;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class PublicController extends Controller
{
    function home()
    {
        $setting = Setting::first();
        $categories = Category::all();
        $products = Product::with('product_images')->paginate(10);
        return view('public.home')->with('setting', $setting)->with('categories', $categories)->with('products', $products);
    }
    function productDetails(Request $req)
    {
        $setting = Setting::first();
        $categories = Category::all();
        $product = Product::where('product_id', $req->iden)->with('product_images')->first();
        return view('public.productDetails')->with('setting', $setting)->with('categories', $categories)->with('product', $product);
    }
    function purchaseSubmit(Request $req)
    {
        $ipAddress = $req->ip();
        $product_id = $req->product_id;
        $recentPurchase = Purchase::where('ip_address', $ipAddress)
        ->where('product_id', $product_id)
        ->where('purchase_phone', $req->purchase_phone)
        ->where('purchase_status', 'Requested')
        ->where('created_at', '>=', Carbon::now()->subDays(3))
        ->first();
        $product = Product::where('product_id', $product_id)->first();
        if($product->product_stock == 0)
        {
            Alert::error('Error', 'Product is out of stock!');
            return back();
        }
        else
        {
            if($recentPurchase)
        {
            Alert::error('Error', 'You have already requested for this product. Please wait for our call!');
            return back();
        }
        else
        {
            $purchase = new Purchase();
            $unique_id = "NNAB".Str::random(4).time();
            $purchase->product_id = $req->product_id;
            $purchase->purchase_unique_id = $unique_id;
            $purchase->purchase_name = $req->purchase_name;
            $purchase->purchase_phone = $req->purchase_phone;
            $purchase->purchase_address = $req->purchase_address;
            $purchase->purchase_bkash = $req->purchase_bkash;
            $purchase->purchase_status = "Requested";
            $purchase->ip_address = $ipAddress;
            $purchase->save();
            $product->product_stock = $product->product_stock - 1;
            $product->save();
            $sms = new SMSController();
            $message = "Your order ID is ".$unique_id.". Please store this ID for future reference.";
            $sms->sms_send($req->purchase_phone,$message);
            Alert::success('Successfull', 'Purchase Request Sent. Please Wait For Our Call!');
            return back();
        }
        }
        
        
    }
    function filter(Request $req)
    {
        $setting = Setting::first();
        $categories = Category::all();
        $category = Category::where('category_id', $req->iden)->first();
        $products = Product::where('category_id', $req->iden)->with('product_images')->paginate(10);
        return view('public.filter')->with('setting', $setting)->with('categories', $categories)->with('category', $category)->with('products', $products);
    }
    function about()
    {
        $setting = Setting::first();
        $categories = Category::all();
        return view('public.about')->with('setting', $setting)->with('categories', $categories);
    }
    function contact()
    {
        $setting = Setting::first();
        $categories = Category::all();
        return view('public.contact')->with('setting', $setting)->with('categories', $categories);
    }
    function contactSubmit(Request $req)
    {
        $setting = Setting::first();
        $categories = Category::all();
        $req->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $contact = new Contact();
        $contact->name = $req->name;
        $contact->phone = $req->phone;
        $contact->email = $req->email;
        $contact->subject = $req->subject;
        $contact->message = $req->message;
        $contact->save();
        Alert::success('Successfull', 'Message Sent Successfully!');
        return back();
    }
    public function trackOrder(Request $request)
    {
        $phone = $request->input('purchase_phone');
        $uniqueId = $request->input('purchase_unique_id');

        // Example: Find the order in the database using both phone and unique ID
        $order = Purchase::where('purchase_phone', $phone)->where('purchase_unique_id', $uniqueId)->first();

        if ($order) 
        {
            return response()->json([
                'success' => true,
                'status' => $order->purchase_status
            ]);
        } 
        else 
        {
                return response()->json([
                'success' => false,
                'message' => 'No order found with the provided details. Please check your inputs.'
            ]);
        }
    }
}
