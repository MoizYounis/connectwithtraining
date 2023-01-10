<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Author;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class AuthorController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_author')->only(['create', 'store']);
        $this->middleware('view_author')->only('index');
        $this->middleware('update_author')->only(['edit', 'update']);
        $this->middleware('delete_author')->only('destroy');
        $this->Permission = $permission;
    }

    
    public function index() {
        $query = Author::query();
        $query->join('users', 'users.id', '=', 'authors.user_id')
        ->select('authors.*', 'users.first_name', 'users.last_name');
        if(Auth::user()->userType != "superadmin"){
            $query->where('authors.user_id', Auth::user()->id);
        }
        $author_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.author.author_list', compact('author_list', 'getPermission'));
    }

    public function create() {
        $getPermission = $this->Permission->getPermission();
        return view('admin.author.add', compact('getPermission'));
    }

    public function store(Request $request, Author $author) {
        $request->validate([
            'author_name' => 'required',
            'bio' => 'required',
            'author_image' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ]);
        $data = $request->all();
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        if ($request->hasFile('author_image'))
        {
            $image = $request->file('author_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/author/');
            $image->move($image_path, $imageName);
            $data['author_image'] = $imageName;
        }
        $author->create($data);
        return back()->withSuccess('Author created successfully');
    }

    
    public function edit($author_id){
        $author_edit = Author::find($author_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.author.edit', compact('author_edit', 'getPermission'));
    }

    //update
    public function update(Request $request, $author_id){
        $request->validate([
            'author_name' => 'required',
            'bio' => 'required',
        ]);

        $author = Author::find($author_id);
        $data = $request->all();
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        if ($request->hasFile('author_image'))
        {
            $image = $request->file('author_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/author/');
            $image->move($image_path, $imageName);
            $data['author_image'] = $imageName;
            
            if(file_exists(public_path('/assets/front/img/author/').$author->author_image)){
                unlink(public_path('/assets/front/img/author/').$author->author_image);
            }
        }
        
        $author->update($data);
        return redirect()->route('author.index')->withSuccess("Author updated successfully");
    }

    //delete
    public function destroy($author_id)
    {
        //delete image
        $author = Author::find($author_id);
        if(file_exists(public_path('/assets/front/img/author/').$author->author_image)){
            unlink(public_path('/assets/front/img/author/').$author->author_image);
        }
        $author->delete();
        return redirect()->route('author.index')->withSuccess('Author delete successfully');
    }
}
