<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Input;
use Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['pay', 'thankyou']);
    }
    
    public function payment_plan(){
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            $course = DB::table('cart')
            ->join('courses as c', 'c.id', '=', 'cart.course_id')
            ->join('categories as cat', 'c.category_id', '=', 'cat.id')
            ->join('authors as a', 'a.id', '=', 'c.author_id')->where('cart.user_id', Auth::user()->id)
            ->select('cart.id as cid', 'c.*', 'cat.category_name', 'a.author_name')->orderBy('cart.id', 'DESC')->get();
        }
        else{
            if (session()->exists('cart')) {
                $sessionCart = Session::get('cart');
                $i = 0;
                $ids = [];
                while($i < count($sessionCart)){
                    $ids[] = $sessionCart[$i]['id'];
                    $i++;
                }
                $course = DB::table('courses as c')
                ->join('categories as cat', 'c.category_id', '=', 'cat.id')
                ->join('authors as a', 'a.id', '=', 'c.author_id')
                ->whereIn('c.id', $ids)
                ->select('c.*', 'cat.category_name', 'a.author_name')->orderBy('c.id', 'DESC')->get();
            }
            else{
                $course = [];
            }
        }
        
        if(count($course) > 0){
            return view('front.payment.payment_plan', compact('course'));
        }
        else{
            return redirect('our-payment-plan');   
        }
    }
    
    public function pay(Request $request){
        $request->validate([
            'card_number' => 'required', 'numeric', 'digits:16',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required', 'numeric', 'digits:3',
        ]);
        $data = $request->all();
        return redirect('thankyou');
    }
    
    public function thankyou(){
        return view('front.payment.thankyou');
    }
    
}
