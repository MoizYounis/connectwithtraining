<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Learning_option;
use App\Model\Permission;
use App\Model\Course;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class LearnOptionController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_learning_option')->only(['create', 'store']);
        $this->middleware('view_learning_option')->only('index');
        $this->middleware('update_learning_option')->only(['edit', 'update']);
        $this->middleware('delete_learning_option')->only('destroy');
        $this->Permission = $permission;
    }

    //sub category list
    public function index() { 
        $query = Learning_option::query();
        $query->join('courses', 'courses.id', '=', 'learning_options.course_id')
        ->selectRaw('learning_options.*, courses.course_name');

        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $option_list = $query->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.learnOption.index', compact('option_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
        
        $getPermission = $this->Permission->getPermission();
        return view('admin.learnOption.add', compact('course_list', 'getPermission'));
    }

    public function store(Request $request, Learning_option $lo) {
        $request->validate([
            'course_id' => 'required',
            'learn_title' => 'required',
        ]);
        $data = $request->all();
        $lo->create($data);
        return back()->withSuccess('Learning option created successfully');
    }

    public function edit($lo){
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();
        
        $lo_edit = Learning_option::find($lo);
        $getPermission = $this->Permission->getPermission();
        return view('admin.learnOption.edit', compact('lo_edit', 'course_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $option_id){
        $request->validate([
            'course_id' => 'required',
            'learn_title' => 'required',
        ]);

        $lo = Learning_option::find($option_id);
        $data = $request->all();
        $lo->update($data);
        return redirect()->route('learningOption.index')->withSuccess("Learning option updated successfully");
    }

    //delete
    public function destroy($option_id)
    {
        $as = Learning_option::find($option_id);        
        $as->delete();
        return redirect()->route('learningOption.index')->withSuccess("Learning option deleted successfully");
    }
}
