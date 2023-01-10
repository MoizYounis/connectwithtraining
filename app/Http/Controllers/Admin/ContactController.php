<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Contact;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class ContactController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        // $this->middleware('create_course')->only(['create', 'store']);
        // $this->middleware('view_course')->only('index');
        // $this->middleware('update_course')->only(['edit', 'update']);
        // $this->middleware('delete_course')->only('destroy');
        $this->Permission = $permission;
    }

    //admin contact list
    public function contact() {
        $getPermission = $this->Permission->getPermission();
        $contact = DB::table('contacts')->get()->sortByDesc('id');
        return view('admin.contact.contact', compact('contact', 'getPermission'));
    }
    
    //admin contact destroy
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contact');
    }   
    
}
