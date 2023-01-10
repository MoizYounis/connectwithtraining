<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User_type;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
    
class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }
    
    // public function index() {        
    //     $type_list = User_type::all();
    //     return view('admin.permission.index', compact('type_list'));
    // }

    // public function create() {
    //     return $this->index();
    // }

    // public function store(Request $request, User_type $ut) {
    //     $request->validate([
    //         'type_name' => 'required|regex:/^[a-zA-Z0-9\pL\s]+$/u|unique:user_types',
    //     ]);
    //     $data = $request->all();
    //     $ut->create($data);
    //     return back()->withSuccess('Role created successfully');
    // }

    // public function edit(){
    //     return $this->index();
    // }

    // //update
    // public function update(Request $request, $role_id){
    //     $request->validate([
    //         'type_name' => ['required', 'regex:/^[a-zA-Z0-9\pL\s]+$/u', Rule::unique('user_types')->ignore($role_id)],
    //     ]);

    //     $ut = User_type::find($role_id);
    //     $data = $request->all();
    //     $ut->update($data);
    //     return redirect()->back()->withSuccess("Role updated successfully");
    // }

    // //delete
    // public function destroy($role_id)
    // {
    //     $ut = User_type::find($role_id);
    //     $ut->delete();
    //     return redirect()->back()->withSuccess('Role deleted successfully');
    // }
}
