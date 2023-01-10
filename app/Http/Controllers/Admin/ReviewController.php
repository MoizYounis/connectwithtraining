<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Course;
use App\Model\Permission;
use App\User;
use App\Model\Review;
use Auth;
use Validator;
use DB;
use Session;
    
class ReviewController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_review')->only(['create', 'store']);
        $this->middleware('view_review')->only('index');
        $this->middleware('update_review')->only(['edit', 'update']);
        $this->middleware('delete_review')->only('destroy');
        $this->Permission = $permission;
    }

    public function index(){
        $query = Review::query();
    	$query->join('users', 'users.id', '=', 'reviews.user_id')
        ->join('courses', 'courses.id', '=', 'reviews.course_id')
        ->selectRaw('reviews.*, users.first_name, users.last_name, courses.course_name')
        ->orderBy('reviews.id', 'DESC');
        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $review = $query->get();
        $getPermission = $this->Permission->getPermission();

    	return view('admin.review.list', compact('review', 'getPermission'));
    }

    public function create(){
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();

        $user_list = User::orderBy('first_name')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.review.add', compact('user_list', 'course_list', 'getPermission'));
    }

    public function store(Request $request, Review $review){
        $request->validate([
            'course_id' => 'required',
            'user_id' => 'required',
            'rating' => 'required',
            'comment' => 'required'
        ]);
        $data = $request->all();
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        $review->create($data);
        return redirect()->back()->withSuccess("Review created successfully");
    }

    public function edit($review_id){
        if(Auth::user()->userType != "superadmin")
            $course_list = Course::where('user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = Course::orderBy('course_name')->get();

        $user_list = User::orderBy('first_name')->get();
        $edit_review = Review::find($review_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.review.edit', compact('user_list', 'course_list', 'edit_review', 'getPermission'));
    }

    public function update(Request $request, $review_id){
        $request->validate([
            'course_id' => 'required',
            'user_id' => 'required',
            'rating' => 'required',
            'comment' => 'required'
        ]);
        $review = Review::find($review_id);
        $data = $request->all();
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }
        $review->update($data);
        return redirect()->route('review.index')->withSuccess("Review updated successfully");
    }

    public function destroy($review_id)
    {
        $review = Review::find($review_id);
        $review->delete();
        return redirect()->back()->withSuccess("Review Deleted");
    }
}
