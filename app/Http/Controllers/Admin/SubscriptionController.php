<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Subscription;
use App\Model\Course;
use App\Model\Payment;
use App\Model\Permission;
use App\User;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
    
class SubscriptionController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_subscription')->only(['create', 'store']);
        $this->middleware('view_subscription')->only('index');
        $this->middleware('update_subscription')->only(['edit', 'update']);
        $this->middleware('delete_subscription')->only('destroy');
        $this->Permission = $permission;
    }

    //sub category list
    public function index() {
        $sub_list = DB::table("subscriptions as sub")
        ->join('courses', 'courses.id', '=', 'sub.course_id')
        ->join('users', 'users.id', '=', 'sub.user_id')
        ->join('payments as p', 'p.id', '=', 'sub.payment_id')
        ->selectRaw('sub.*, courses.course_name, courses.course_price, users.first_name, users.last_name, p.ORDERID, p.TXNID, p.PAYMENTMODE, p.STATUS, p.created_at as PAYTIME, p.TXNAMOUNT')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.subscription.list', compact('sub_list', 'getPermission'));
    }

    public function create() {
        $course_list = Course::orderBy('course_name')->get();
        $user_list = User::orderBy('first_name')->get();
        $pay_list = Payment::orderBy('TXNID')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.subscription.add', compact('course_list', 'user_list', 'pay_list', 'getPermission'));
    }

    public function store(Request $request, Subscription $sub) {
        $request->validate([
            'course_id' => 'required',
            'user_id' => 'required',
            'payment_id' => 'required',
            'subscribe_type' => 'required',
            'subscribe_expired_on' => 'required',
        ]);
        $data = $request->all();
        $sub->create($data);
        return back()->withSuccess('Subscription Created successfully');
    }

    //edit test
    public function edit($sub_id){
        $course_list = Course::orderBy('course_name')->get();
        $user_list = User::orderBy('first_name')->get();
        $pay_list = Payment::orderBy('TXNID')->get();
        $sub_edit = Subscription::find($sub_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.subscription.edit', compact('course_list', 'pay_list', 'sub_edit', 'user_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $sub_id){
        $request->validate([
            'course_id' => 'required',
            'user_id' => 'required',
            'payment_id' => 'required',
            'subscribe_type' => 'required',
            'subscribe_expired_on' => 'required',
        ]);

        $sub = Subscription::find($sub_id);
        $data = $request->all();
        $sub->update($data);
        return redirect()->route('subscription.index')->withSuccess("Subscription updated successfully");
    }

    //delete
    public function destroy($sub_id)
    {
        $sub = Subscription::find($sub_id);        
        $sub->delete();
        return redirect()->back()->withSuccess("Subscription deleted successfully");
    }
}
