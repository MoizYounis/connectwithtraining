<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Model\General_setting;
use DB;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;

class GetMoreController extends Controller
{
    public function getmore(){
        return view('front.getmore.getmore');
    }
    
    public function interview_question(){
        return view('front.getmore.interview_question');
    }
    
    public function extensive_interview_plans(){
        return view('front.getmore.extensive_interview_plans');
    }
    
    public function resume_building(){
        return view('front.getmore.resume_building');
    }
}
