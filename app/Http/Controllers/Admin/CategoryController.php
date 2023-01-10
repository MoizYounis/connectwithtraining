<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class CategoryController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_category')->only(['create', 'store']);
        $this->middleware('view_category')->only('index');
        $this->middleware('update_category')->only(['edit', 'update']);
        $this->middleware('delete_category')->only('destroy');
        $this->Permission = $permission;
    }

    
    public function index() {
        $query = Category::query();
        $query->join('users', 'users.id', '=', 'categories.user_id')
        ->select('categories.*', 'users.first_name', 'users.last_name');
        if(Auth::user()->userType != "superadmin"){
            $query->where('categories.user_id', Auth::user()->id);
        }
        $category_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.category.category_list', compact('category_list', 'getPermission'));
    }

    public function create() {
        $getPermission = $this->Permission->getPermission();
        return view('admin.category.add_category', compact('getPermission'));
    }

    public function store(Request $request, Category $category) {
        $request->validate([
            'category_name' => 'required|regex:/^[a-zA-Z0-9\pL\s]+$/u|unique:categories',
            'category_logo' => 'required',
            'category_banner' => 'required',
            'category_status' => 'required',
        ]);
        $data = $request->all();
        unset($data['file']);
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        $category->create($data);
        return back()->withSuccess('category created successfully');
    }

    //edit category
    public function edit($category_id){
        $getPermission = $this->Permission->getPermission();
        $category_edit = Category::find($category_id);
        return view('admin.category.edit_category', compact('category_edit', 'getPermission'));
    }

    //update
    public function update(Request $request, $category_id){
        $request->validate([
            'category_name' => ['required', 'regex:/^[a-zA-Z0-9\pL\s]+$/u', Rule::unique('categories')->ignore($category_id)], 
            'category_status' => 'required',          
        ]);

        $category = Category::find($category_id);
        $data = $request->all();
        unset($data['file']);
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        $category->update($data);
        return redirect()->route('category.index')->withSuccess("category information updated successfully");
    }

    //delete
    public function destroy($category_id)
    {
        //delete image
        $category = Category::find($category_id);
        if(file_exists(public_path('/assets/front/img/category/').$category->category_logo)){
            unlink(public_path('/assets/front/img/category/').$category->category_logo);
        }
        if(file_exists(public_path('/assets/front/img/category_banner/').$category->category_banner)){
            unlink(public_path('/assets/front/img/category_banner/').$category->category_banner);
        }
        
        $category->delete();
        return redirect()->route('category.index')->withSuccess('Category delete successfully');
    }


    public function upload_image(Request $request){
        
        $data = $request->all();
        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/category/');
            $image->move($image_path, $imageName);
            $data['file'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/category').'/'.$data["file"].'" style="width:100px; height:100px; object-fit:contain;;" />
                         <input type="hidden" name="category_logo" id="category_logo" value="'.$data["file"].'" required/>';  
        }
    }

    public function upload_banner(Request $request){
        
        $data = $request->all();
        if ($request->hasFile('file2'))
        {
            $image = $request->file('file2');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/category_banner/');
            $image->move($image_path, $imageName);
            $data['file2'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/category_banner').'/'.$data["file2"].'" style="width:100px; height:100px; object-fit:contain;;" />
                         <input type="hidden" name="category_banner" id="category_banner" value="'.$data["file2"].'" required/>';  
        }
    }
}
