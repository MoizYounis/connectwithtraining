<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Forum;
use App\User;
use App\Model\Forum_reply;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class ForumController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_forum')->only(['create', 'store']);
        $this->middleware('view_forum')->only('index');
        $this->middleware('update_forum')->only(['edit', 'update']);
        $this->middleware('delete_forum')->only('destroy');
        $this->middleware('show_forum')->only('show');
        $this->Permission = $permission;
    }

    public function index() {
        $query = Forum::query();
        $query->join('users', 'users.id', '=', 'forums.user_id')
        ->selectRaw('users.first_name, users.last_name, forums.*');
        if(Auth::user()->userType != "superadmin"){
            $query->where('forums.user_id', Auth::user()->id);
        }
        $forum_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.forum.forum_list', compact('forum_list', 'getPermission'));
    }

    public function create() {
        $user_list = User::all();
        $getPermission = $this->Permission->getPermission();
        return view('admin.forum.add', compact('user_list', 'getPermission'));
    }

    public function store(Request $request, Forum $forum) {
        $request->validate([
            'forum_title' => 'required',
            'forum_detail' => 'required',
            'user_id' => 'required',
        ]);
        $data = $request->all();
        if ($request->get('forum_status')) {
            $data['forum_status'] = "Publish";
        }
        else {
            $data += ["forum_status" => "Unpublished"];
        }
        unset($data['files']);
        $forum->create($data);
        return back()->withSuccess('Forum created successfully');
    }

    
    public function edit($forum_id){
        $user_list = User::all();
        $forum_edit = Forum::find($forum_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.forum.edit', compact('forum_edit', 'user_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $forum_id){
        $request->validate([
            'forum_title' => 'required',
            'forum_detail' => 'required',
            'user_id' => 'required',
        ]);

        $forum = Forum::find($forum_id);
        $data = $request->all();
        if ($request->get('forum_status')) {
            $data['forum_status'] = "Publish";
        }
        else {
            $data += ["forum_status" => "Unpublished"];
        }
        unset($data['files']);
        $forum->update($data);
        return redirect()->route('forum.index')->withSuccess("Forum updated successfully");
    }

    //delete
    public function destroy($forum_id)
    {
        //delete image
        $forum = Forum::find($forum_id);        
        $forum->delete();
        return redirect()->route('forum.index')->withSuccess("Forum deleted successfully");
    }

    public function show($forum_id){
        $user_list = User::all();
        $reply_list = DB::table('forum_replies as fr')
        ->where('fr.forum_id', $forum_id)
        ->join('forums', 'fr.forum_id', '=', 'forums.id')
        ->join('users', 'fr.user_id', '=', 'users.id')
        ->selectRaw('fr.*, users.email, users.image, forums.forum_title, DATE(fr.created_at) as created_at')
        ->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.forum.view_reply', compact('user_list', 'reply_list', 'getPermission'));
    }
}
