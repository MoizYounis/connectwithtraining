<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Sub_category;
use App\Model\Child_category;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class ChildCatConroller extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //sub category list
    public function index() {
        $child_list = DB::table('child_categories')
        ->join('categories', 'categories.id', '=', 'child_categories.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'child_categories.sub_id')
        ->select('child_categories.*', 'categories.category_name', 'sub_categories.sub_name')
        ->get();
        $category_list = DB::table('categories')->where('category_status', '=', 'Active')->orderBy('category_name')->get();
        return view('admin.child_cat.child_list', compact('child_list', 'category_list'));
    }

    public function add_sub_menu() {
        $category_list = DB::table('categories')->where('category_status', '=', 'Active')->orderBy('category_name')->get();
        return view('admin.child_cat.add_menu', compact('category_list'));
    }

    public function get_subcat(Request $request){
        $category_id = $request->get('category_id');
        $sub_cat_list = DB::table('sub_categories')
        ->where('category_id', '=', $category_id)
        ->where('sub_status', '=', 'Active')
        ->orderBy('sub_name')->get();   
        if(count($sub_cat_list) > 0){
            return response()->json($sub_cat_list);
        }
    }

    public function store(Request $request, Child_category $childcat) {
        $request->validate([
            'child_name' => 'required|regex:/^[a-zA-Z0-9\pL\s]+$/u|unique:child_categories',
            'category_id' => 'required',
            'sub_id' => 'required',
            'child_status' => 'required',
        ]);
        $data = $request->all();
        unset($data['file']);
        $childcat->create($data);
        return back()->withSuccess('Child category created successfully');
    }


    public function edit($child_id){
        $category_list = DB::table('categories')->where('category_status', '=', 'Active')->orderBy('category_name')->get();
        $sub_cat_list = DB::table('sub_categories')->where('sub_status', '=', 'Active')->orderBy('sub_name')->get();
        $child_edit = DB::table('child_categories')->where('child_categories.id', '=', $child_id)
        ->join('categories', 'categories.id', '=', 'child_categories.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'child_categories.sub_id')
        ->select('child_categories.*', 'categories.category_name', 'sub_categories.sub_name')
        ->first();

        $category_list = DB::table('categories')->where('category_status', '=', 'Active')->orderBy('category_name')->get();
        $sub_cat_list = DB::table('sub_categories')
            ->where('sub_status', '=', 'Active')
            ->where('category_id', '=', $child_edit->category_id)
            ->orderBy('sub_name')->get();

        return view('admin.child_cat.edit_child', compact('child_edit', 'category_list', 'sub_cat_list'));
    }

    //update
    public function update(Request $request, Child_category $child_cat, $child_id){
        $request->validate([
            'child_name' => ['required', 'regex:/^[a-zA-Z0-9\pL\s]+$/u', Rule::unique('child_categories')->ignore($child_id)],
            'category_id' => 'required',
            'sub_id' => 'required',
            'child_status' => 'required',
        ]);

        $child_cat = Child_category::find($child_id);
        $data = $request->all();
        unset($data['file']);
        $child_cat->update($data);
        return redirect()->route('childcategory.index')->withSuccess("Child category information updated successfully");
    }

    //delete
    public function destroy($child_id)
    {
        $childcat = Child_category::find($child_id);
        $childcat->delete();
        return redirect()->route('childcategory.index')->withSuccess("Child category deleted successfully");
    }

    public function upload_image(Request $request){
        
        $data = $request->all();
        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/childcat/');
            $image->move($image_path, $imageName);
            $data['file'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/childcat').'/'.$data["file"].'" style="width:100px; height:100px; object-fit:contain;;" />
                         <input type="hidden" name="child_logo" id="child_logo" value="'.$data["file"].'" required/>';  
        }
    }

    public function upload_banner(Request $request){
        
        $data = $request->all();
        if ($request->hasFile('file2'))
        {
            $image = $request->file('file2');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/childcat_banner/');
            $image->move($image_path, $imageName);
            $data['file2'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/childcat_banner').'/'.$data["file2"].'" style="width:100px; height:100px; object-fit:contain;;" />
                         <input type="hidden" name="child_banner" id="child_banner" value="'.$data["file2"].'" required/>';  
        }
    }
}
