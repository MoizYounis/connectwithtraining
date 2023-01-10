<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\About_course;
use App\Model\Course;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
    
class AboutCourseController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_about_course')->only(['create', 'store']);
        $this->middleware('view_about_course')->only('index');
        $this->middleware('update_about_course')->only(['edit', 'update']);
        $this->middleware('delete_about_course')->only('destroy');
        $this->Permission = $permission;
    }

    //sub category list
    public function index() {
        $query = About_course::query();
        $query->join('courses', 'courses.id', '=', 'about_courses.course_id')
        ->selectRaw('about_courses.*, courses.course_name');

        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $about_list = $query->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.aboutCourse.list', compact('about_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
        
        $getPermission = $this->Permission->getPermission();
        return view('admin.aboutCourse.add', compact('course_list', 'getPermission'));
    }

    public function store(Request $request, About_course $about) {
        $request->validate([
            'course_id' => 'required',
            'course_details' => 'required',
        ]);
        $data = $request->all();
        
        
        if(!empty($data['pointer_title'][0]) or !empty($data['pointer_desc'][0])){
            $data['pointer_title'] = implode(',', $data['pointer_title']);
            $data['pointer_desc'] = implode(',', $data['pointer_desc']);
        }
        else{
            unset($data['pointer_title']);
            unset($data['pointer_desc']);
        }
        
        unset($data['files']);
        
        $about->create($data);
        return back()->withSuccess('Created successfully');
    }

    //edit test
    public function edit($test_id){
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
        
        $about_edit = About_course::find($test_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.aboutCourse.edit', compact('about_edit', 'course_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $about_id){
        $request->validate([
            'course_id' => 'required',
            'course_details' => 'required',
        ]);

        $about = About_course::find($about_id);
        $data = $request->all();
        if(!empty($data['pointer_title'][0]) or !empty($data['pointer_desc'][0])){
            $data['pointer_title'] = implode(',', $data['pointer_title']);
            $data['pointer_desc'] = implode(',', $data['pointer_desc']);
        }
        else{
            unset($data['pointer_title']);
            unset($data['pointer_desc']);
        }
        unset($data['files']);
        $about->update($data);
        return redirect()->route('aboutCourse.index')->withSuccess("Information updated successfully");
    }

    //delete
    public function destroy($about_id)
    {
        $about = About_course::find($about_id);        
        $about->delete();
        return redirect()->route('aboutCourse.index')->withSuccess("Deleted successfully");
    }
}
