<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Course;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class CourseController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_course')->only(['create', 'store']);
        $this->middleware('view_course')->only('index');
        $this->middleware('update_course')->only(['edit', 'update']);
        $this->middleware('delete_course')->only('destroy');
        $this->Permission = $permission;
    }

    
    public function index() {
        $query = Course::query();
        $query->join('users', 'users.id', '=', 'courses.user_id')
        ->join('authors', 'authors.id', '=', 'courses.author_id')
        ->join('categories as c', 'c.id', '=', 'courses.category_id')
        ->select('courses.*', 'users.first_name', 'users.last_name', 'authors.author_name', 'c.category_name');
        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $course_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.course.course_list', compact('course_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin"){
            $category_list = DB::table('categories')->orderBy('category_name')->where('user_id', Auth::user()->id)->get();
            $author_list = DB::table('authors')->orderBy('author_name')->where('user_id', Auth::user()->id)->get();
        }
        else{
            $category_list = DB::table('categories')->orderBy('category_name')->get(); 
            $author_list = DB::table('authors')->orderBy('author_name')->get();            
        }
        $user_list = DB::table('users')->orderBy('first_name')->get();
        
        $getPermission = $this->Permission->getPermission();
        return view('admin.course.add_course', compact('user_list', 'category_list', 'author_list', 'getPermission'));
    }

    public function store(Request $request, Course $course) {
        $request->validate([
            'author_id' => 'required',
            'category_id' => 'required',
            'course_name' => 'required|regex:/^[a-zA-Z0-9\pL\s]+$/u',
            'course_duration' => 'required',
            'course_price' => 'required',
            'course_start_date' => 'required',
            'course_timing' => 'required',
            'course_image' => 'required',
        ]);
        $data = $request->all();
        unset($data['file']);
        
        if(isset($data['class_feature_title']) or isset($data['class_feature_title_hover'])){
            $classFeature = array(
                'class_feature_title' => $data['class_feature_title'],
                'class_feature_title_hover' => $data['class_feature_title_hover']
            );
            $data['class_features'] = json_encode($classFeature);
            unset($data['class_feature_title']);
            unset($data['class_feature_title_hover']);
        }
        
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        $course->create($data);
        return back()->withSuccess('Course created successfully');
    }

    //edit category
    public function edit($course_id){
        $user_list = DB::table('users')->orderBy('first_name')->get();
        if(Auth::user()->userType != "superadmin"){
            $category_list = DB::table('categories')->orderBy('category_name')->where('user_id', Auth::user()->id)->get();
            $author_list = DB::table('authors')->orderBy('author_name')->where('user_id', Auth::user()->id)->get();
        }
        else{
            $category_list = DB::table('categories')->orderBy('category_name')->get(); 
            $author_list = DB::table('authors')->orderBy('author_name')->get();            
        }
        $course_edit = Course::find($course_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.course.edit_course', compact('course_edit', 'user_list', 'category_list', 'author_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $course_id){
        $request->validate([
            'author_id' => 'required',
            'category_id' => 'required',
            'course_name' => 'required|regex:/^[a-zA-Z0-9\pL\s]+$/u',
            'course_duration' => 'required',
            'course_price' => 'required',
            'course_start_date' => 'required',
            'course_timing' => 'required'
        ]);

        $course = Course::find($course_id);
        $data = $request->all();
        unset($data['file']);
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        if(isset($data['class_feature_title']) or isset($data['class_feature_title_hover'])){
            $classFeature = array(
                'class_feature_title' => $data['class_feature_title'],
                'class_feature_title_hover' => $data['class_feature_title_hover']
            );
            $data['class_features'] = json_encode($classFeature);
            unset($data['class_feature_title']);
            unset($data['class_feature_title_hover']);
        }
        else{
            $data['class_features'] = null;
        }
        
        if(isset($data['course_image'])){
            if(file_exists(public_path('/assets/front/img/course/').$course->course_image)){
                unlink(public_path('/assets/front/img/course/').$course->course_image);
            }
        }
        $course->update($data);
        return redirect()->route('course.index')->withSuccess("Course updated successfully");
    }

    //delete
    public function destroy($course_id)
    {
        //delete image
        $course = Course::find($course_id);       

        //delete image
        if(file_exists(public_path('/assets/front/img/course/').$course->course_image)){
            unlink(public_path('/assets/front/img/course/').$course->course_image);
        }
        $course->delete();
        return redirect()->route('course.index')->withSuccess('Course delete successfully');
    }

    public function upload_image(Request $request){        
        $data = $request->all();
        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/course/');
            $image->move($image_path, $imageName);
            $data['file'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/course').'/'.$data["file"].'" style="width:100px; height:100px; object-fit:contain;;" />
                         <input type="hidden" name="course_image" id="course_image" value="'.$data["file"].'" required/>';  
        }
    }
}
