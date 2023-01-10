<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Model\Permission;
use App\Model\City;
use App\Model\Product;
use App\Model\Payment;
use App\Model\Category;
use App\Model\Sub_category;
use App\Model\Location;
use App\Model\State;
use App\Model\Banner;
use App\Model\Contact;
use DB;
use Illuminate\Validation\Rule;
use Validator;
use Hash;
use Illuminate\Support\Facades\Input;
use Session;

class AdminController extends Controller
{  
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->Permission = $permission;
    }  

    public function index(){
        $getPermission = $this->Permission->getPermission();
     //    $location_count = Location::all()->count();
    	// $user_count = User::where('type', '=', 'User')->count();
    	// $city_count = City::where('city_status', '=', 'Active')->count();
    	// $state_count = State::where('state_status', '=', 'Active')->count();
     //    $banner_count = Banner::where('banner_status', '=', 'Active')->count();
     //    $product_count = Product::where('product_status', '=', 'InStock')->count();
     //    $category_count = Category::where('category_status', '=', 'Active')->count();
     //    $sub_count = Sub_category::where('sub_status', '=', 'Active')->count();
     //    $pay_count = Payment::where('STATUS', '=', 'TXN_SUCCESS')->get()->sum('TXNAMOUNT');
     //    $contact_count = Contact::all()->count();
        return view('admin.dashboard.dashboard', compact('getPermission'));
    }

    public function admin_profile() {
        $getPermission = $this->Permission->getPermission();
        return view('admin.profile.admin_profile', compact('getPermission'));
    }

    public function update_admin_profile(Request $request) {
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => ['required',
                Rule::unique('users')->ignore(Auth::user()->id), 'email'
            ],
            'image' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $profile = Auth::user();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/user/');
            $image->move($image_path, $imageName);
            $profile->image = $imageName;
        }

        $profile->first_name = $request->get('first_name');
        $profile->last_name = $request->get('last_name');
        $profile->email = $request->get('email');

        $profile->save();

        return back()->withSuccess('Profile updated successfully');
    }

    public function admin_password(){
        $getPermission = $this->Permission->getPermission();
        return view('admin.auth.admin_password', compact('getPermission'));
    }

    public function change_password(Request $request) {
        $niceName = [
            'oldword' => 'Current Password',
            'newword' => 'New Password',
            'newword_confirmation' => 'Re-type password',
        ];
        $rules = [
            'oldword' => 'required',
            'newword' => 'required|min:4|confirmed',
            'newword_confirmation' => 'required',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'min' => 'Password must be 4 char',
        ];
        $this->validate($request, $rules, $customMessages, $niceName);
        $errors = [];
        //checking current password incorrect or correct
        $profile = Auth::user();
        if (!Hash::check(Input::get('oldword'), $profile->password)) {
            $errors['oldword'] = "Currernt password incorrect";
        }
        //checking new password is same as old password
        if (Hash::check(Input::get('newword'), $profile->password)) {
            $errors['newword'] = "This password is already used before. Try with a different one";
        }
        //find erros & redirect back with error message
        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->withError('errorArray', 'Array Error Occured');
        } else {
            //bcrypt passwrod 
            $profile->password = bcrypt(Input::get('newword'));
            $profile->save();
            return back()->withSuccess('Password updated successfully');
        }
    }
}
