<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Test;
use App\Model\Course;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class TestController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_test')->only(['create', 'store']);
        $this->middleware('view_test')->only('index');
        $this->middleware('update_test')->only(['edit', 'update']);
        $this->middleware('delete_test')->only('destroy');
        $this->Permission = $permission;
    }

    //sub category list
    public function index() {
        $query = Test::query();
        $query->join('courses', 'courses.id', '=', 'tests.course_id')
        ->selectRaw('tests.*, courses.course_name');
        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $test_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.test.list', compact('test_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.test.add', compact('course_list', 'getPermission'));
    }

    public function store(Request $request, Test $test) {
        $request->validate([
            'course_id' => 'required',
            'test_title' => 'required',
            'test_desc' => 'required',
            'test_process' => 'required',
        ]);
        $data = $request->all();
        $test->create($data);
        return back()->withSuccess('Test created successfully');
    }

    //edit test
    public function edit($test_id){
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();

        $test_edit = Test::find($test_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.test.edit', compact('test_edit', 'course_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $test_id){
        $request->validate([
            'course_id' => 'required',
            'test_title' => 'required',
            'test_desc' => 'required',
            'test_process' => 'required',
        ]);

        $test = Test::find($test_id);
        $data = $request->all();
        $test->update($data);
        return redirect()->route('test.index')->withSuccess("Test updated successfully");
    }

    //delete
    public function destroy($test_id)
    {
        $test = Test::find($test_id);        
        $test->delete();
        return redirect()->route('test.index')->withSuccess("Test deleted successfully");
    }
}
