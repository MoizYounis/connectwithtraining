<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Business;
use App\Model\Business_meta;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
    
class BusinessController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_business')->only(['create', 'store']);
        $this->middleware('view_business')->only('index');
        $this->middleware('update_business')->only(['edit', 'update']);
        $this->middleware('delete_business')->only('destroy');
        $this->Permission = $permission;
    }

    //sub category list
    public function index() {
        $business_list = Business::all();
        $getPermission = $this->Permission->getPermission();
        return view('admin.business.list', compact('business_list', 'getPermission'));
    }

    public function create() {
        $getPermission = $this->Permission->getPermission();
        return view('admin.business.add', compact('getPermission'));
    }

    public function store(Request $request, Business $business) {
        $request->validate([
            'business_name' => 'required',
            'business_category' => 'required',
            'business_details' => 'required',
            'business_address' => 'required',
            'business_email' => 'required|unique:business',
            'business_phone' => 'required|unique:business'
        ]);
        $data = $request->all();

        if($data['business_meta_key'][0] != '' or $data['business_meta_value'][0] != ''){
            $metakey = implode(',', $data['business_meta_key']);
            $metaValue = implode(',', $data['business_meta_value']);
            $meta = array('business_meta_key' => $metakey, 'business_meta_value' => $metaValue);
        }
        
        unset($data['business_meta_key']);
        unset($data['business_meta_value']);

        if ($request->get('business_status')) {
            $data['business_status'] = "Publish";
        }
        else {
            $data += ["business_status" => "Unpublished"];
        }

        $business_id = $business->create($data)->id;
        if(isset($meta)){
            $meta += ['business_id' => $business_id];
            Business_meta::create($meta);
        }
        
        return back()->withSuccess('Business created successfully');
    }

    //edit subcategory
    public function edit($business_id){
        $business_edit = Business::where('business.id', $business_id)
        ->leftjoin('business_meta', 'business_meta.business_id', '=', 'business.id')
        ->select('business.*', 'business_meta.business_meta_key', 'business_meta.business_meta_value')->first();
        $getPermission = $this->Permission->getPermission();
        return view('admin.business.edit', compact('business_edit', 'getPermission'));
    }

    //update
    public function update(Request $request, $business_id){
        $request->validate([
            'business_name' => 'required',
            'business_category' => 'required',
            'business_details' => 'required',
            'business_address' => 'required',
            'business_email' => ['required', Rule::unique('business')->ignore($business_id), 'email'],
            'business_phone' => ['required', Rule::unique('business')->ignore($business_id)],
        ]);

        $business = Business::find($business_id);
        $data = $request->all();
        
        if($data['business_meta_key'][0] != '' or $data['business_meta_value'][0] != ''){
            $metakey = implode(',', $data['business_meta_key']);
            $metaValue = implode(',', $data['business_meta_value']);
            $meta_data = array('business_meta_key' => $metakey, 'business_meta_value' => $metaValue);
        }
                
        unset($data['business_meta_key']);
        unset($data['business_meta_value']);

        if ($request->get('business_status')) {
            $data['business_status'] = "Publish";
        }
        else {
            $data += ["business_status" => "Unpublished"];
        }

        $business->update($data);

        if(isset($meta_data)){
            $meta = Business_meta::where('business_id', $business_id)->first();
            if($meta){
                $meta->update($meta_data);
            }
            else{
                $meta_data += ['business_id' => $business_id];
                Business_meta::create($meta_data);
            }
        }
        return redirect()->route('business.index')->withSuccess("Business updated successfully");
    }

    //delete
    public function destroy($business_id)
    {
        $business = Business::find($business_id);        
        $business->delete();
        return redirect()->back()->withSuccess("Business deleted successfully");
    }
}
