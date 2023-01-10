<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Curriculum;
use App\Model\Curriculum_course_relation;
use App\Model\Course;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class CurriculumController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_curriculum')->only(['create', 'store']);
        $this->middleware('view_curriculum')->only('index');
        $this->middleware('update_curriculum')->only(['edit', 'update']);
        $this->middleware('delete_curriculum')->only('destroy');
        $this->Permission = $permission;
    }

    public function index() {
        $query = Curriculum::query();
        $query->join('curriculum_course_relation as ccr', 'ccr.curriculum_id', '=', 'curriculum.id')
        ->join('courses', 'courses.id', '=', 'ccr.course_id')
        ->selectRaw('curriculum.*, courses.course_name');

        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $curr_list = $query->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.curriculum.list', compact('curr_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.curriculum.add', compact('course_list', 'getPermission'));
    }

    public function store(Request $request, Curriculum $curr) {
        $request->validate([
            'course_id' => 'required',
            'curr_title' => 'required'
        ]);
        $data = $request->all();
        $course_id = $data['course_id'];
        unset($data['course_id']);
        unset($data['files']);
        if ($request->get('curr_status')) {
            $data['curr_status'] = "Active";
        }
        else {
            $data += ["curr_status" => "Inactive"];
        }
        $curr_id = $curr->create($data)->id;
        Curriculum_course_relation::create(['course_id' => $course_id, 'curriculum_id' => $curr_id]);
        return back()->withSuccess('Created successfully');
    }

    //edit test
    public function edit($curr_id){
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();

        $curr_edit = Curriculum::join('curriculum_course_relation as ccr', 'curriculum.id', '=', 'ccr.curriculum_id')->where('ccr.curriculum_id', $curr_id)
        ->selectRaw('curriculum.*, ccr.course_id')
        ->first();
        $getPermission = $this->Permission->getPermission();

        //print_r($curr_edit);exit;
        return view('admin.curriculum.edit', compact('curr_edit', 'course_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $curr_id){
        $request->validate([
            'course_id' => 'required',
            'curr_title' => 'required',
        ]);

        $curr = Curriculum::find($curr_id);
        $data = $request->all();

        $course_id = $data['course_id'];
        unset($data['course_id']);
        unset($data['files']);
        
        if ($request->get('curr_status')) {
            $data['curr_status'] = "Active";
        }
        else {
            $data += ["curr_status" => "Inactive"];
        }
        $curr->update($data);

        $ccr = Curriculum_course_relation::where('curriculum_id', $curr_id)->first();
        $ccr->update(['course_id' => $course_id]);
        return redirect()->route('curriculum.index')->withSuccess("Information updated successfully");
    }

    //delete
    public function destroy($curr_id)
    {
        $curr = Curriculum::find($curr_id);        
        $curr->delete();
        return redirect()->route('curriculum.index')->withSuccess("Deleted successfully");
    }
}
