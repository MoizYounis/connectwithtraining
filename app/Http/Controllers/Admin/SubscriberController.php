<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Model\Permission;
use App\Model\General_setting;
use Auth;
use Validator;
use DB;
use Session;
    
class SubscriberController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->Permission = $permission;
    }

    //admin contact list
    public function index() {
        $subscribe = DB::table('subscribers')->get()->sortByDesc('id');
        $getPermission = $this->Permission->getPermission();
        return view('admin.subscribe.subscribe', compact('subscribe', 'getPermission'));
    }
    
    //admin contact destroy
    public function destroy($id)
    {
        $deleted = DB::delete('delete from subscribers where id = ?',[$id]);
        return redirect()->back()->with('success','Email Deleted');
    }
    
    public function update_discount(Request $req){
        $data = $req->all();
        $gs = General_setting::first();
        $gs->update($data);
        return redirect()->back()->with('success','Data Updated!');
    }
    
}
