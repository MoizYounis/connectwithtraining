<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\Blog_meta;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class BlogController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_blog')->only(['create', 'store']);
        $this->middleware('view_blog')->only('index');
        $this->middleware('update_blog')->only(['edit', 'update']);
        $this->middleware('delete_blog')->only('destroy');
        $this->Permission = $permission;
    }

    public function index() {
        $query = Blog::query();
        $query->leftjoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_cat_id')
        ->leftjoin('users', 'users.id', '=', 'blogs.user_id')
        ->select('blogs.*', 'blog_categories.blog_cat_name', 'users.first_name', 'users.last_name');

        if(Auth::user()->userType != "superadmin"){
            $query->where('blogs.user_id', Auth::user()->id);
        }
        $blog_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.blog.blog_list', compact('blog_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin"){
            $blog_cat_list = DB::table('blog_categories')->orderBy('blog_cat_name')->where('user_id', Auth::user()->id)->get();    
        }
        else{
            $blog_cat_list = DB::table('blog_categories')->orderBy('blog_cat_name')->get(); 
        }        

        $user_list = DB::table('users')->orderBy('first_name')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.blog.add_blog', compact('blog_cat_list', 'user_list', 'getPermission'));
    }

    public function store(Request $request, Blog $blog) {
        $request->validate([
            'blog_title' => 'required',
            'blog_cat_id' => 'required',
            'blog_content' => 'required',
        ]);
        $data = $request->all();        

        if($data['blog_meta_key'][0] != '' or $data['blog_meta_value'][0] != ''){
            $metakey = implode(',', $data['blog_meta_key']);
            $metaValue = implode(',', $data['blog_meta_value']);
            $meta = array('blog_meta_key' => $metakey, 'blog_meta_value' => $metaValue);
        }

        unset($data['files']);
        unset($data['blog_meta_key']);
        unset($data['blog_meta_value']);

        if ($request->get('blog_status')) {
            $data['blog_status'] = "Publish";
        }
        else {
            $data += ["blog_status" => "Unpublished"];
        }

        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }

        $blog_id = $blog->create($data)->id;
        
        if(isset($meta)){
            $meta += ['blog_id' => $blog_id];
            Blog_meta::create($meta);
        }
        return back()->withSuccess('Blog created successfully');
    }

    public function edit($blog_id){
        if(Auth::user()->userType != "superadmin"){
            $blog_cat_list = DB::table('blog_categories')->orderBy('blog_cat_name')->where('user_id', Auth::user()->id)->get();    
        }
        else{
            $blog_cat_list = DB::table('blog_categories')->orderBy('blog_cat_name')->get(); 
        }
        $user_list = DB::table('users')->orderBy('first_name')->get();
        $getPermission = $this->Permission->getPermission();
        $blog_edit = Blog::where('blogs.id', $blog_id)
        ->leftjoin('blog_meta', 'blog_meta.blog_id', '=', 'blogs.id')
        ->select('blogs.*', 'blog_meta.blog_meta_key', 'blog_meta.blog_meta_value')->first();
        
        return view('admin.blog.edit_blog', compact('blog_edit', 'blog_cat_list', 'user_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $blog_id){
        $request->validate([
            'blog_title' => 'required',
            'blog_cat_id' => 'required',
            'blog_content' => 'required',
        ]);

        $blog = Blog::find($blog_id);
        $data = $request->all();
        
        if($data['blog_meta_key'][0] != '' or $data['blog_meta_value'][0] != ''){
            $metakey = implode(',', $data['blog_meta_key']);
            $metaValue = implode(',', $data['blog_meta_value']);
            $meta_data = array('blog_meta_key' => $metakey, 'blog_meta_value' => $metaValue);
        }

        unset($data['blog_meta_key']);
        unset($data['blog_meta_value']);  
        unset($data['files']);
        
        if ($request->get('blog_status')) {
            $data['blog_status'] = "Publish";
        }
        else {
            $data += ["blog_status" => "Unpublished"];
        }
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        $blog->update($data);

        if(isset($meta_data)){
            $meta = Blog_meta::where('blog_id', $blog_id)->first();
            if($meta){
                $meta->update($meta_data);
            }
            else{
                $meta_data += ['blog_id' => $blog_id];
                Blog_meta::create($meta_data);
            }
            
        }
        return redirect()->route('blog.index')->withSuccess("Blog updated successfully");
    }

    //delete
    public function destroy($blog_id)
    {
        //delete image
        $blog = Blog::find($blog_id);        
        $blog->delete();
        
        //delete meta
        // $meta = Blog_meta::where('blog_id', $blog_id)->first();
        // if($meta){
        //     $meta->delete();
        // }
        return redirect()->route('blog.index')->withSuccess("Blog deleted successfully");
    }
}
