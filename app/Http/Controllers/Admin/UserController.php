<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\User_address;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->Permission = $permission;
    }

    public function add_user(){
        $user_types = DB::table('user_types')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.user.add_user', compact('user_types', 'getPermission'));
    }
    
    public function index() {
        $user_iist = DB::table('users')
        ->join('user_types', 'user_types.id', '=', 'users.user_type_id')
        ->select('users.*', 'user_types.type_name')
        ->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.user.user_list', compact('user_iist', 'getPermission'));
    }
    
    public function create_user(Request $request, User $user) {

        $request->validate([
            'user_type_id'=> 'required',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'phone' => 'unique:users',
        ]);

        $data = $request->all();
        
        if(!empty($data['city']) or !empty($data['state']) or !empty($data['pincode']) or !empty($data['address']))
        {
            $user_address = array(
                'city' => $data['city'],
                'state' => $data['state'],
                'pincode' => $data['pincode'],
                'address' => $data['address']
            );
        }
        unset($data['city']);
        unset($data['state']);
        unset($data['pincode']);
        unset($data['address']);

        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }

        //password hash make
        $data['password'] = Hash::make($request->get('password'));

        $user_id = $user->create($data)->id;
        if(isset($user_address)){
            $user_address += ['user_id' => $user_id];
            User_address::create($user_address);
        }
        return back()->withSuccess('User created successfully');
    }

    //edit_technician
    public function edit_user($id){
        $user_edit = DB::table("users")
        ->leftjoin('user_addresses as ua', 'ua.user_id', '=', 'users.id')
        ->where('users.id', '=', $id)
        ->selectRaw('users.*, ua.city, ua.state, ua.pincode, ua.address')->first();
        $user_types = DB::table('user_types')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.user.edit_user', compact('user_edit', 'user_types', 'getPermission'));
    }

    public function update_user(Request $request, User $user, $id){
        $request->validate([
            'user_type_id'=> 'required',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => ['required', Rule::unique('users')->ignore($id), 'email'],
            'phone' => ['required', Rule::unique('users')->ignore($id)],
        ]);

        $user = User::find($id);
        $data = $request->all();

        if(!empty($data['city']) or !empty($data['state']) or !empty($data['pincode']) or !empty($data['address']))
        {
            $user_address = array(
                'city' => $data['city'],
                'state' => $data['state'],
                'pincode' => $data['pincode'],
                'address' => $data['address']
            );
        }
        
        unset($data['city']);
        unset($data['state']);
        unset($data['pincode']);
        unset($data['address']);
        
        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }
        
        $user->update($data);
        

        if(isset($user_address)){
            $userAddr = User_address::where('user_id', $id)->first();
            if($userAddr){
                $userAddr->update($user_address);
            }
            else{
                $user_address += ['user_id' => $id];
                User_address::create($user_address);
            }
        }      

        return redirect('admin/user_list')->withSuccess("User updated successfully");
    }


    //delete technician
    public function destroy($id)
    {
        $user_destroy = User::find($id);
        $user_destroy->delete();
        return redirect()->back()->withSuccess("User deleted successfully");
    }

    public function status_update($id, $value)
    {
        $user = User::find($id);
        $user->status = $value;
        $user->save();
        return redirect('admin/user_list')->withSuccess("User status updated successfully");
    }

    public function upload_image(Request $request){        
        $data = $request->all();
        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/user/');
            $image->move($image_path, $imageName);
            $data['file'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/user').'/'.$data["file"].'" style="width:100px; height:100px; object-fit:contain;" />
                <input type="hidden" name="image" id="image" value="'.$data["file"].'" />';  
        }
    }
    
}
