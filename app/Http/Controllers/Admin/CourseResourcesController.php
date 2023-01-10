<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Course_resource;
use App\Model\Course;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class CourseResourcesController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_course_resource')->only(['create', 'store']);
        $this->middleware('view_course_resource')->only('index');
        $this->middleware('update_course_resource')->only(['edit', 'update']);
        $this->middleware('delete_course_resource')->only('destroy');
        $this->Permission = $permission;
    }

    public function index() {
        $query = Course_resource::query();
        $query->join('courses', 'courses.id', '=', 'course_resources.course_id')
        ->selectRaw('course_resources.*, courses.course_name');
        
        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $res_list = $query->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.courseResource.list', compact('res_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
            
        $getPermission = $this->Permission->getPermission();
        return view('admin.courseResource.add', compact('course_list', 'getPermission'));
    }

    public function store(Request $request, Course_resource $cr) {
        $request->validate([
            'course_id' => 'required',
            'course_resource' => 'required'
        ]);
        $data = $request->all();
        unset($data['files']);
        $cr->create($data);
        return back()->withSuccess('Resource created successfully');
    }


    public function edit($res_id){
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
        
        $res_edit = Course_resource::find($res_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.courseResource.edit', compact('course_list', 'res_edit', 'getPermission'));
    }

    //update
    public function update(Request $request, $res_id){
        $request->validate([
            'course_id' => 'required',
            'course_resource' => 'required'
        ]);

        $res = Course_resource::find($res_id);
        $data = $request->all();
        unset($data['files']);
        $res->update($data);
        return redirect()->route('courseResources.index')->withSuccess("Resource updated successfully");
    }

    //delete
    public function destroy($res_id)
    {
        $res = Course_resource::find($res_id);        
        $res->delete();
        return redirect()->route('courseResources.index')->withSuccess("Resource deleted successfully");
    }
}
