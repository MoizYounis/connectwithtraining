<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Model\General_setting;
use App\Model\Pricing;
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

    public function howItWorks(){
        return view('front.getmore.how-it-works');
    }
    
    public function interview_question(){
        return view('front.getmore.interview_question');
    }
    
    public function extensive_interview_plans(){
        $single_1 = Pricing::where('pricing_type', 'single_1')->first();
        $single_2 = Pricing::where('pricing_type', 'single_2')->first();
        $corporate = Pricing::where('pricing_type', 'corporate')->first();
        $enterprise = Pricing::where('pricing_type', 'enterprise')->first();
        $single_3 = Pricing::where('pricing_type', 'single_3')->first();
        return view('front.getmore.extensive_interview_plans', compact('single_1', 'single_2', 'corporate', 'enterprise', 'single_3'));
    }
    
    public function resume_building(){
        return view('front.getmore.resume_building');
    }
}
