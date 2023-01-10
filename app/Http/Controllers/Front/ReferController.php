<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use DB;
use App\Model\General_setting;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;

class ReferController extends Controller
{
    public function referpage(){
        return view('front.refer.refer_friend');
    }
    
    public function referSendMail(Request $request)
    {
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            $request->validate([
                'email' => 'required|email',
                'msg' => 'required',
                'subject' => 'required',
            ]);
            $data = $request->all();
            $gs = General_setting::first();
            $msg = "Your friend - ".Ucwords(Auth::user()->first_name)." Invite You on ".$gs->title."\n Link: <a href='".route('home')."'></a>";
        	$subject = "Invitation From ".$gs->title;
            $headers =  'MIME-Version: 1.0' . "\r\n";
            $headers .= 'From: '.$gs->title.' <'.$gs->contact_email.'>' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            if(mail($data['email'], $subject, $msg, $headers)){
                echo json_encode(['error'=>'false', 'msg'=>'Invitation Sent Successfuly.']); 
            }
            else{
                echo json_encode(['error'=>'true', 'msg'=>'Error.. Please Try Again Later.']);
            }
        }
        else{
            echo json_encode(['error'=>'true', 'msg'=>'You Are Not Loged in']);
        }
        
    }
    
    public function referprogram(){
        return view('front.refer.refer_program');
    }
}