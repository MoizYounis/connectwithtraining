<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\General_setting;
use Auth;
use Validator;
use DB;
use Session;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function basic_setting_page()
    {
        $settings = General_setting::first();
        return view('admin.settings.basic_setting')->with('settings', $settings);
    }

    public function update_basic_setting(Request $request, $id)
    {
        $this->validate($request, ['title' => 'required']);

        $setting = General_setting::find($id);
        $setting->title = ucwords($request->get('title'));
        $setting->color_code = $request->get('color_code');
        $setting->base_currency = $request->get('base_currency');
        $setting->base_currency_symbol = $request->get('base_currency_symbol');

          // print_r($request->get('sms_verification'));exit;

        if($request->get('email_verification') == 'on'){
            $setting->email_verification = '1';
        }
        else{
            $setting->email_verification = '0';
        }

        if($request->get('sms_verification') == 'on'){
            $setting->sms_verification = '1';
        }
        else{
            $setting->sms_verification = '0';
        }

        if($setting->save()){
            return redirect()->route('basic_setting')->with('success', 'Settings Updated');
        }
        else{
            return redirect()->route('basic_setting')->with('errors', 'Settings Not Updated');
        }
    }

    public function sms_setting_page()
    {
        $settings = General_setting::first();
        return view('admin.settings.sms_setting')->with('settings', $settings);
    }

    public function update_sms_setting(Request $request, $id)
    {
        $setting->sms_api = $request->get('sms_api');
        $setting = General_setting::find($id);
        if($setting->save()){
            return redirect()->route('sms_setting')->with('success', 'Settings Updated');
        }
        else{
            return redirect()->route('sms_setting')->with('errors', 'Settings Not Updated');
        }
    }

    public function email_setting_page()
    {
        $settings = General_setting::first();
        return view('admin.settings.email_setting')->with('settings', $settings);
    }

    public function update_email_setting(Request $request, $id)
    {
        $this->validate($request, ['email_sent_from' => 'required|email']);

        $setting = General_setting::find($id);
        $setting->email_sent_from = $request->get('email_sent_from');
        $setting->email_template = $request->get('email_template');

        if($setting->save()){
            return redirect()->route('email_setting')->with('success', 'Settings Updated');
        }
        else{
            return redirect()->route('email_setting')->with('errors', 'Settings Not Updated');
        }
    }
}
