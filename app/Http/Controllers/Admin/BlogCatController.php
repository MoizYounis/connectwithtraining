<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Blog_category;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class BlogCatController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_blog_category')->only(['create', 'store']);
        $this->middleware('view_blog_category')->only('index');
        $this->middleware('update_blog_category')->only(['edit', 'update']);
        $this->middleware('delete_blog_category')->only('destroy');
        $this->Permission = $permission;
    }

    //sub category list
    public function index() {
        $query = Blog_category::query();
        $query->orderBy('blog_cat_name');
        if(Auth::user()->userType != "superadmin"){
            $query->where('user_id', Auth::user()->id);
        }
        $blog_cat_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.blogCategory.cat_list', compact('blog_cat_list', 'getPermission'));
    }

    // public function create() {
    //     return view('admin.blog.add_blog', compact('blog_cat_list', 'user_list'));
    // }

    public function store(Request $request, Blog_category $blogCat) {
        $request->validate([
            'blog_cat_name' => 'required',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $blogCat->create($data);
        return back()->withSuccess('Category created successfully');
    }

    //update
    public function update(Request $request, $blog_cat_id){
        $request->validate([
            'blog_cat_name' => 'required',
        ]);

        $blog = Blog_category::find($blog_cat_id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $blog->update($data);
        return redirect()->route('blogcategory.index')->withSuccess("Category updated successfully");
    }

    //delete
    public function destroy($blog_cat_id)
    {
        //delete image
        $blog = Blog_category::find($blog_cat_id);        
        $blog->delete();
        return redirect()->route('blogcategory.index')->withSuccess("Category deleted successfully");
    }
}
