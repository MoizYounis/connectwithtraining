<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Contact;
use App\Model\General_setting;
use DB;
use Illuminate\Validation\Rule;
use Validator;
use Hash;
use Illuminate\Support\Facades\Input;
use Session;

class HomeController extends Controller
{
    public function home(){
        $category_data = DB::table('categories')
            ->where('category_status', 'Active')
            ->orderBy('category_name', 'asc')->get();

        $price = DB::table('courses')->selectRaw('MAX(course_price) as max_price')->first();
        return view('front.pages.index', compact('category_data', 'price'));
    }
    
    //save review
    public function review(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'location' => 'required',
            'comment' => 'required',
            'rating' => 'required',
        ]);
        $data = $request->all();
        Review::create($data);
        return redirect()->back()->with('sucess', 'Your review successfully submited, thankyou for supporting us.');
    }
    
    //set currency
    public function setCurrencyCookie(Request $request){
        $request->validate([
            'currencyCode' => 'required',
            'currencyValue' => 'required'
        ]);
        $data = $request->all();
        setcookie("custom_currency", $data['currencyCode'], time() + (86400 * 30), "/");
        setcookie("custom_currency_value", $data['currencyValue'], time() + (86400 * 30), "/");
        return json_encode(["error"=>"false", "msg"=>"success"]);
    }
    
    public function coupon(Request $req){
        $data = DB::table('coupons')->where('coupon_code',$req->get('coupon'))->get();
        if(count($data)>0){
            Session::put('coupon', $data[0]->amount);
            Session::put('coupon_id', $data[0]->coupon_id);
            return back()->with('success', 'Coupon is successfully applied. Amount '.$data[0]->amount);
        }
        else{
            Session::put('coupon', '0');
            return back()->with('error', 'Coupon is Invalid or expired.');
        }
    }
    
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'msg' => 'required',
            'subject' => 'required',
        ]);
        $data = $request->all();
        // $gs = General_setting::first();
        // $msg = "username - ".$data['username']."\n Email - ".$data['email']."\n Phone - ".$request->get('phone')."\n Message - ".$request->get('msg');
        // $subject = $data['username']." Wants To Contact You GiftsZone";
        // $headers =  'MIME-Version: 1.0' . "\r\n";
        // $headers .= 'From: '.$data['username'].' <'.$data['email'].'>' . "\r\n";
        // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // mail($gs->contact_email, $subject, $msg, $headers);
        if(Contact::create($data)){
            return redirect()->back()->with('success', 'Your query successfully submited!');    
        }
        else{
            return redirect()->back()->with('error', 'Please try after sometime!');
        }
    }
    
    public function subscribe(Request $request){
        $request->validate([
            'email' => 'required|email|unique:subscribers'
        ]);
        
        $data = $request->all();
        if(isset($data['status'])){
            $gs = General_setting::first();
            if(DB::table('subscribers')->insert(['email' => $request->get("email"), 'discount' => $gs->subscribe_discount])){
                echo json_encode(["error"=>"false", "msg"=>"Thankyou For Subscribe!"]);
            }
            else{
                echo json_encode(["error"=>"true", "msg"=>"Subscription Failed, Something Went Wrong!"]);
            }
        }
        else{
            if(DB::table('subscribers')->insert(['email' => $request->get("email")])){
                echo json_encode(["error"=>"false", "msg"=>"Thankyou For Subscribe!"]);
            }
            else{
                echo json_encode(["error"=>"true", "msg"=>"Subscription Failed, Something Went Wrong!"]);
            }
        }
    }
    
    public function callStaticPage(Request $req, $slug=''){
        if(!empty($slug)){
            $slug = trim($slug);
            $slug = htmlspecialchars($slug);
            $pageData = DB::table('static_pages')->where('page_name', $slug)->where('page_status', 'Publish')->first();
            if(!empty($pageData)){
                return view('front.pages.static_page', compact('pageData'));
            }
            else{
                return view('errors.404');
            }
        }
        else{
            $pageName = trim($req->segment(1));
            $pageData = DB::table('static_pages')->where('page_name', $pageName)->where('page_status', 'Publish')->first();
            if(!empty($pageData)){
                return view('front.pages.static_page', compact('pageData'));
            }
            else{
                return view('errors.404');
            }
        }
    }

    public function become_an_instructor(){
        return view('front.instructor.become_an_instructor');
    }
    
    public function aboutPage(){
        $pageData = DB::table('static_pages')->where('page_name', 'about')->first();
        return view('front.pages.about', compact('pageData'));
    }
    
    public function contactusPage(){
        return view('front.pages.contact');
    }
    
    public function chatWithInstructor(Request $request){
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
        ]);
        $data = $request->all();
        if(count($data) >0){
            // Mail::send('mail', $info, function ($message)
            // {
            //     $message->to('alex@example.com', 'w3schools')
            //         ->subject('Request For Call Back CWT');
            //     // $message->attach('D:\laravel_main\laravel\public\uploads\pic.jpg');
            //     // $message->attach('D:\laravel_main\laravel\public\uploads\message_mail.txt');
            //     $message->from($data['email'], 'Alex');
            // });
            // echo "Successfully sent the email";
            return json_encode(["error"=>"false", "msg"=>"Our career advisor will give you a call shortly."]);
        }
        else{
            return json_encode(["error"=>"true", "msg"=>"Try after sometime!"]);
        }
    }
    
}
