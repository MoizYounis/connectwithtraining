<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\User_address;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // return view('front.user.dashboard');
        return $this->user_profile();
    }

    public function deleteAccount()
    {
        // return view('front.user.dashboard');
        $address = DB::table('user_addresses')->where('user_id', Auth::user()->id)->first();
        return view('front.user.delete_account', compact('address'));
    }

    public function changePassword()
    {
        // return view('front.user.dashboard');
        $address = DB::table('user_addresses')->where('user_id', Auth::user()->id)->first();
        return view('front.user.change_password', compact('address'));
    }

    public function change_password(Request $request)
    {
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
            return redirect()->back()->withInput()->withErrors($errors);
        } else {
            //bcrypt passwrod
            $profile->password = bcrypt(Input::get('newword'));
            unset($profile->userType);
            $profile->save();
            return back()->withSuccess('Password updated successfully');
        }
    }

    public function user_profile()
    {
        $address = DB::table('user_addresses')->where('user_id', Auth::user()->id)->first();
        return view('front.user.profile', compact('address'));
    }

    //update profile
    public function update_user_profile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:10',
            'last_name' => 'required|max:10',
            'city' => 'required|max:10',
            'state' => 'required|max:10',
            'pincode' => 'required|digits:6',
            'email' => ['required',
                Rule::unique('users')->ignore(Auth::user()->id), 'email',
            ],
            'image' => 'image|mimes:jpeg,png,jpg|max:5120',
            'phone' => 'required', 'numeric', 'digits:10',
            'address' => 'required|max:200',
        ]);

        $profile = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/user/');
            $image->move($image_path, $imageName);
            $profile->image = $imageName;
        }

        $profile->first_name = $request->get('first_name');
        $profile->last_name = $request->get('last_name');
        $profile->email = $request->get('email');
        $profile->phone = $request->get('phone');

        $userAddr = User_address::where('user_id', Auth::user()->id)->first();
        $user_address = array(
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'pincode' => $request->get('pincode'),
            'address' => $request->get('address'),
        );
        if ($userAddr) {
            $userAddr->update($user_address);
        } else {
            $user_address += ['user_id' => Auth::user()->id];
            DB::table('user_addresses')->insert($user_address);
        }

        unset($profile->city);
        unset($profile->state);
        unset($profile->pincode);
        unset($profile->address);
        unset($profile->userType);
        $profile->save();

        return back()->withSuccess('Profile updated successfully');
    }

    //update profile-pic
    public function update_profile_pic(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $profile = Auth::user();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/user/');
            if ($image->move($image_path, $imageName)) {
                $old_image = $profile->image;
                $profile->image = $imageName;
                unset($profile->userType);
                $profile->save();

                //delete old image
                if (file_exists(public_path('/assets/front/img/user/') . $old_image)) {
                    unlink(public_path('/assets/front/img/user/') . $old_image);
                }

                echo asset('public/assets/front/img/user') . '/' . $profile->image;
            } else {
                echo 'error';
            }
        }
    }

    //delete profile
    public function delete_account(Request $request)
    {
        $request->validate([
            'password' => 'required|max:10',
        ]);

        $profile = Auth::user();
        if (Hash::check(Input::get('password'), $profile->password)) {
            $profile->status = 'Inactive';
            unset($profile->userType);
            $profile->save();
            Auth::logout();
            return redirect()->route('login')->withSuccess('Your Acount Deleted successfully!');
        } else {
            return back()->withError('Currernt password incorrect');
        }
    }

    public function addPaymentInfo()
    {
        return view('front.user.add_payment_info');
    }

    public function updatePaymentInfo()
    {
        return view('front.user.update_payment_info');
    }

    public function savePaymentInfo(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->update([
            'card_name' => $request->card_name ? $request->card_name : $user->card_name,
            'card_number' => $request->card_number ? $request->card_number : $user->card_number,
            'expiry_month' => $request->expiry_month ? $request->expiry_month : $user->expiry_month,
            'expiry_year' => $request->expiry_year ? $request->expiry_year : $user->expiry_year,
        ]);
        return redirect()->route('add.payment.info')->withSuccess('Your Account Info Updated successfully!');
    }
}
