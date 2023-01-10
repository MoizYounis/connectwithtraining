<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Assignment;
use App\Model\Permission;
use App\Model\Course;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class CourseAssignmentController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_course_assignment')->only(['create', 'store']);
        $this->middleware('view_course_assignment')->only('index');
        $this->middleware('update_course_assignment')->only(['edit', 'update']);
        $this->middleware('delete_course_assignment')->only('destroy');
        $this->Permission = $permission;
    }

    //sub category list
    public function index() {
        $query = Assignment::query();
        $query->join('courses', 'courses.id', '=', 'assignments.course_id')
        ->selectRaw('assignments.*, courses.course_name');
        
        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $assign_list = $query->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.assignment.list', compact('assign_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
        
        $getPermission = $this->Permission->getPermission();
        return view('admin.assignment.add', compact('course_list', 'getPermission'));
    }

    public function store(Request $request, Assignment $as) {
        $request->validate([
            'course_id' => 'required',
            'assign_title' => 'required',
        ]);
        $data = $request->all();
        $as->create($data);
        return back()->withSuccess('Assignment created successfully');
    }

    
    public function edit($assign_id){
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
        
        $assign_edit = Assignment::find($assign_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.assignment.edit', compact('assign_edit', 'course_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $assign_id){
        $request->validate([
            'course_id' => 'required',
            'assign_title' => 'required',
        ]);

        $as = Assignment::find($assign_id);
        $data = $request->all();
        $as->update($data);
        return redirect()->route('courseAssignment.index')->withSuccess("Assignment updated successfully");
    }

    //delete
    public function destroy($assign_id)
    {
        $as = Assignment::find($assign_id);        
        $as->delete();
        return redirect()->route('courseAssignment.index')->withSuccess("Assignment deleted successfully");
    }
}
