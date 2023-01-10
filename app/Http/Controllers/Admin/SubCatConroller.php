<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Sub_category;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class SubCatConroller extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_sub_category')->only(['create', 'store']);
        $this->middleware('view_sub_category')->only('index');
        $this->middleware('update_sub_category')->only(['edit', 'update']);
        $this->middleware('delete_sub_category')->only('destroy');
        $this->Permission = $permission;
    }

    //sub category list
    public function index() {
        $query = Sub_category::query();
        $query
        ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
        ->select('sub_categories.*', 'categories.category_name');
        if(Auth::user()->userType != "superadmin"){
            $query->where('sub_categories.user_id', Auth::user()->id);
        }
        $sub_category_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        
        return view('admin.sub_cat.sub_cat_list', compact('sub_category_list', 'getPermission'));
    }

    public function create() {
        $category_list = DB::table('categories')->where('category_status', '=', 'Active')->orderBy('category_name')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.sub_cat.add_sub', compact('category_list', 'getPermission'));
    }

    public function store(Request $request, Sub_category $sub_category) {
        $request->validate([
            'sub_name' => 'required|regex:/^[a-zA-Z0-9\pL\s]+$/u|unique:sub_categories',
            'sub_logo' => 'required',
            'sub_banner' => 'required',
            'sub_status' => 'required',
            'category_id' => 'required',
        ]);
        $data = $request->all();
        unset($data['file']);
        $sub_category->create($data);
        return back()->withSuccess('Sub category created successfully');
    }

    //edit subcategory
    public function edit($sub_id){
        $category_list = DB::table('categories')->where('category_status', '=', 'Active')->orderBy('category_name')->get();
        $subcategory_edit = Sub_category::where('sub_categories.id', '=', $sub_id)
        ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
        ->select('sub_categories.*', 'categories.category_name')
        ->first();
        $getPermission = $this->Permission->getPermission();
        return view('admin.sub_cat.edit_sub', compact('subcategory_edit', 'category_list', 'getPermission'));
    }

    //update
    public function update(Request $request, Sub_category $sub_category, $sub_id){
        $request->validate([
            'sub_name' => ['required', 'regex:/^[a-zA-Z0-9\pL\s]+$/u', Rule::unique('sub_categories')->ignore($sub_id)],
            'sub_status' => 'required',
            'category_id' => 'required',
        ]);

        $sub_category = Sub_category::find($sub_id);
        $data = $request->all();
        unset($data['file']);
        $sub_category->update($data);
        return redirect()->route('subcategory.index')->withSuccess("Subcategory information updated successfully");
    }

    //delete
    public function destroy($sub_id)
    {
        //delete image
        $subcategory = Sub_category::find($sub_id);
        if(file_exists(public_path('/assets/front/img/subcategory/').$subcategory->sub_logo)){
            unlink(public_path('/assets/front/img/subcategory/').$subcategory->sub_logo);
        }

        if(file_exists(public_path('/assets/front/img/subcategory_banner/').$subcategory->sub_banner)){
            unlink(public_path('/assets/front/img/subcategory_banner/').$subcategory->sub_banner);
        }
        
        $subcategory->delete();
        return redirect()->route('subcategory.index')->withSuccess("Subcategory deleted successfully");
    }

    public function upload_image(Request $request){
        
        $data = $request->all();
        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/subcategory/');
            $image->move($image_path, $imageName);
            $data['file'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/subcategory').'/'.$data["file"].'" style="width:100px; height:100px; object-fit:contain;;" />
                         <input type="hidden" name="sub_logo" id="sub_logo" value="'.$data["file"].'" required/>';  
        }
    }

    public function upload_banner(Request $request){
        
        $data = $request->all();
        if ($request->hasFile('file2'))
        {
            $image = $request->file('file2');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/subcategory_banner/');
            $image->move($image_path, $imageName);
            $data['file2'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/subcategory_banner').'/'.$data["file2"].'" style="width:100px; height:100px; object-fit:contain;;" />
                         <input type="hidden" name="sub_banner" id="sub_banner" value="'.$data["file2"].'" required/>';  
        }
    }
}
