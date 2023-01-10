<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Inssupport;
use App\Model\Course;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class InssupportController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        // $this->middleware('create_author')->only(['create', 'store']);
        // $this->middleware('view_author')->only('index');
        // $this->middleware('update_author')->only(['edit', 'update']);
        // $this->middleware('delete_author')->only('destroy');
        $this->Permission = $permission;
    }

    
    public function index() {
        $query = Inssupport::query();
        $query->join('courses as c', 'c.id', '=', 'instructor_support.course_id')
        ->select('instructor_support.*', 'c.course_name');
        if(Auth::user()->userType != "superadmin"){
            $query->where('instructor_support.user_id', Auth::user()->id);
        }
        $ins_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.inssupport.list', compact('ins_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
            
        $getPermission = $this->Permission->getPermission();
        return view('admin.inssupport.add', compact('getPermission', 'course_list'));
    }

    public function store(Request $request, Inssupport $ins) {
        $request->validate([
            'title1' => 'required',
            'title2' => 'required',
            'title2' => 'required',
            'details1' => 'required',
            'details2' => 'required',
            'details2' => 'required',
            'course_id' => 'required',
        ]);
        $data = $request->all();
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        $ins->create($data);
        return back()->withSuccess('Created successfully');
    }

    
    public function edit($id){
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
            
        $ins_edit = Inssupport::find($id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.inssupport.edit', compact('ins_edit', 'getPermission', 'course_list'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title1' => 'required',
            'title2' => 'required',
            'title2' => 'required',
            'details1' => 'required',
            'details2' => 'required',
            'details2' => 'required',
            'course_id' => 'required',
        ]);

        $ins = Inssupport::find($id);
        $data = $request->all();
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        
        $ins->update($data);
        return redirect()->route('inssupport.index')->withSuccess("Updated successfully");
    }

    public function destroy($id)
    {
        $ins = Inssupport::find($id);
        $ins->delete();
        return redirect()->route('inssupport.index')->withSuccess('Delete successfully');
    }
}