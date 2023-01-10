<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Email_template;
use App\Model\Permission;
use Auth;
use Validator;
use DB;
use Session;

class EmailTemplateController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_email_template')->only(['create', 'store']);
        $this->middleware('view_email_template')->only('index');
        $this->middleware('update_email_template')->only(['edit', 'update']);
        $this->middleware('delete_email_template')->only('destroy');
        $this->Permission = $permission;
    }

    public function index()
    {
        $getPermission = $this->Permission->getPermission();
        $templates = Email_template::join('users as u', 'u.id', '=', 'email_templates.user_id')
                    ->select('u.first_name', 'u.last_name', 'email_templates.*')->get();
        return view('admin.emailTemplate.list', compact('templates', 'getPermission'));
    }

    public function create(){
        $getPermission = $this->Permission->getPermission();
        $user_list = DB::table('users')->orderBy('first_name')->get();
        return view('admin.emailTemplate.add', compact('user_list', 'getPermission'));
    }

    public function store(Request $request, Email_template $et) {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'user_id' => 'required'
        ]);
        $data = $request->all();

        unset($data['files']);

        $et->create($data);
        return back()->withSuccess('Template created successfully');
    }

    public function edit($id){
        $user_list = DB::table('users')->orderBy('first_name')->get();
        $getPermission = $this->Permission->getPermission();
        $et_edit = Email_template::find($id);
        
        return view('admin.emailTemplate.edit', compact('et_edit', 'user_list', 'getPermission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'user_id' => 'required'
        ]);

        $et = Email_template::find($id);
        $data = $request->all();
        unset($data['files']);
        $et->update($data);
        return redirect()->route('emailTemplate.index')->withSuccess("Template updated successfully");        
    }

    public function destroy($id)
    {
        $et = Email_template::find($id);        
        $et->delete();
        return redirect()->back()->withSuccess("Template deleted successfully");
    }
}
