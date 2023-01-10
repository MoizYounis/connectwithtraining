<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Model\Payment;
use Auth;
use Validator;
use DB;
use Session;
    
class PayController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //admin job list
    public function index() {
        $pay_list = DB::table('payments as p')
        ->join('users', 'users.id', '=', 'p.user_id')
        ->select('p.*', 'users.first_name', 'users.last_name')
        ->get();
        return view('admin.payment.pay_list', compact('pay_list'));
    }

    //admin job destroy
    public function destroy($pay_id)
    {
        $pay = Payment::find($pay_id);
        $pay->delete();
        return back()->withSuccess('Payment delete successfully');
    }
}
