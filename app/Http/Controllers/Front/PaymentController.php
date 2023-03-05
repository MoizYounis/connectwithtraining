<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Model\Purchase;
use Stripe;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['pay', 'thankyou']);
    }

    public function payment_plan()
    {
        if (isset(Auth::user()->id) && Auth::user()->id != '') {
            $course = DB::table('cart')
                ->join('courses as c', 'c.id', '=', 'cart.course_id')
                ->join('categories as cat', 'c.category_id', '=', 'cat.id')
                ->join('authors as a', 'a.id', '=', 'c.author_id')->where('cart.user_id', Auth::user()->id)
                ->select('cart.id as cid', 'c.*', 'cat.category_name', 'a.author_name')->orderBy('cart.id', 'DESC')->get();

            $courses_id = DB::table('cart')
                ->join('courses as c', 'c.id', '=', 'cart.course_id')
                ->join('categories as cat', 'c.category_id', '=', 'cat.id')
                ->join('about_courses as ac', 'ac.course_id', '=', 'c.id')->where('cart.user_id', Auth::user()->id)
                ->pluck('cart.course_id')->toArray();
        } else {
            if (session()->exists('cart')) {
                $sessionCart = Session::get('cart');
                $i = 0;
                $ids = [];
                while ($i < count($sessionCart)) {
                    $ids[] = $sessionCart[$i]['id'];
                    $i++;
                }
                $course = DB::table('courses as c')
                    ->join('categories as cat', 'c.category_id', '=', 'cat.id')
                    ->join('authors as a', 'a.id', '=', 'c.author_id')
                    ->whereIn('c.id', $ids)
                    ->select('c.*', 'cat.category_name', 'a.author_name')->orderBy('c.id', 'DESC')->get();

                $courses_id = DB::table('cart')
                    ->join('courses as c', 'c.id', '=', 'cart.course_id')
                    ->join('categories as cat', 'c.category_id', '=', 'cat.id')
                    ->join('about_courses as ac', 'ac.course_id', '=', 'c.id')->where('cart.user_id', Auth::user()->id)
                    ->pluck('cart.course_id')->toArray();
            } else {
                $course = [];
            }
        }

        if (count($course) > 0) {
            return view('front.payment.payment_plan', compact('course', 'courses_id'));
        } else {
            return redirect('our-payment-plan');
        }
    }

    public function pay(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'card_number' => 'required', 'numeric', 'digits:16',
        //     'month' => 'required',
        //     'year' => 'required',
        //     'cvv' => 'required', 'numeric', 'digits:3',
        // ]);
        // $data = $request->all();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Stripe\Customer::create(array(

            "address" => [
                "line1" => $request->address,
                "postal_code" => $request->pincode,
                "city" => $request->city,
                "state" => $request->state,
                "country" => $request->country,
            ],
            "email" => $request->email,
            "name" => $request->fname . " " . $request->lname,
            "source" => $request->stripeToken,
        ));
        $user = auth()->user();
        $user->stripe_id = $customer->id;
        $user->save();
        
        $charge = Stripe\Charge::create([
            'amount' => (int) $request->total_amount * 100,
            'currency' => 'usd',
            'customer' => $customer->id,
            'description' => "Test Payment from connect with training Moiz",
        ]);
        
        $date = date('Y-m-d');
        for ($i=0; $i < (int)$request->number_of_installments; $i++) { 
            Purchase::create([
                'user_id' => auth()->user()->id,
                'course_id' => json_encode($request->courses_id),
                'price' => $request->total_amount,
                'due_date' => date('Y-m-d', strtotime($date. ' + '.$i.' months')),
                'total_courses_price' => $request->total_courses_price,
                'status' => $i == 0 ? 'PAID' : 'PENDING'
            ]);
        }
        dd(["SUccess", $charge]);
        return redirect('thankyou');
    }

    public function thankyou()
    {
        return view('front.payment.thankyou');
    }

}
