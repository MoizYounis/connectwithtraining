<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Course;
use DB;
use Illuminate\Validation\Rule;
use Validator;
use Hash;
use Illuminate\Support\Facades\Input;
use Session;
use App\Helpers\Helper;

class CourseController extends Controller
{
    public function index($slug=''){
        if($slug != ''){
            $slug = ucwords(str_replace('-', ' ', $slug));
            
            $course_list = DB::table('courses as c')
            ->join('categories as cat', 'c.category_id', '=', 'cat.id')
            ->leftjoin('about_courses as ac', 'ac.course_id', '=', 'c.id')
            ->join('authors as a', 'a.id', '=', 'c.author_id')
            ->where('c.course_learning_status', $slug)
            ->select('c.*', 'ac.course_details', 'cat.category_name', 'a.author_name')->orderBy('c.id', 'DESC')->get();
        }
        else{
            $course_list = DB::table('courses as c')
            ->join('categories as cat', 'c.category_id', '=', 'cat.id')
            ->leftjoin('about_courses as ac', 'ac.course_id', '=', 'c.id')
            ->join('authors as a', 'a.id', '=', 'c.author_id')
            ->select('c.*', 'ac.course_details', 'cat.category_name', 'a.author_name')->orderBy('c.id', 'DESC')->get();
        }
        
        $category_data = DB::table('categories')
            ->where('category_status', 'Active')
            ->orderBy('category_name', 'asc')->get();

        $price = DB::table('courses')->selectRaw('MAX(course_price) as max_price')->first();
		
		return view('front.course.course_list', compact('course_list', 'category_data', 'price'))->with('i', (request()->input('course_list', 1) -1) *5);
    }

    public function course_details($slug){
        $slug = str_replace('-', ' ', $slug);
        $course_details = DB::table('courses as c')
        ->join('categories as cat', 'c.category_id', '=', 'cat.id')
        ->leftjoin('about_courses as ac', 'ac.course_id', '=', 'c.id')
        ->leftjoin('course_resources as cr', 'cr.course_id', '=', 'c.id')
        ->leftjoin('authors', 'authors.id', '=', 'c.author_id')
        ->where('c.course_name', $slug)
        ->select('c.*', 'ac.course_details', 'ac.course_goals', 'ac.course_diff', 'ac.pmp_desc', 'ac.pointer_title', 'ac.pointer_desc', 'cat.category_name', 'cr.course_resource', 'authors.author_name', 'authors.bio', 'authors.award', 'authors.hobbies', 'authors.author_image')->first();

        $learning_option = DB::table('learning_options')->where('course_id', $course_details->id)->orderBy('id', 'desc')->get();
        
        $curriculum_total_lecture = DB::table('curriculum_course_relation')->where('course_id', $course_details->id)->count();
        $curriculum = DB::table('curriculum as c')
            ->join('curriculum_course_relation as ccr', 'c.id', '=', 'ccr.curriculum_id')
            ->where('ccr.course_id', $course_details->id)->where('c.curr_status', 'Active')
            ->get();

        $schedule = DB::table('schedules as s')
            ->join('schedule_course_relation as scr', 's.id', '=', 'scr.schedule_id')
            ->where('scr.course_id', $course_details->id)->where('s.schedule_status', 'Active')
            ->orderBy('s.schedule_date', 'DESC')
            ->get();

        $video = DB::table('videos')->where('course_id', $course_details->id)->first();

        $test = DB::table('tests')->where('course_id', $course_details->id)->orderBy('id', 'desc')->limit(10)->get();
        $test2 = DB::table('tests')->where('course_id', $course_details->id)->orderBy('id', 'desc')->limit(10)->get();
        
        $assignment = DB::table('assignments')->where('course_id', $course_details->id)->orderBy('id', 'desc')->limit(10)->get();

        $review = DB::table('reviews')
                    ->join('users', 'users.id', '=', 'reviews.user_id')
                    ->where('course_id', $course_details->id)
                    ->selectRaw('reviews.*, users.first_name, users.last_name, users.image')
                    ->orderBy('id', 'desc')->get();

        $rating = DB::table('reviews')
            ->groupBy('rating')
            ->select('rating', DB::raw('count(*) as total'))->where('course_id', $course_details->id)->get();
            
        
        $lo = DB::table('learning_options as lo')->join('courses as c', 'c.id', '=', 'lo.course_id')->where('lo.course_id', $course_details->id)->get();
        
        $faq = DB::table('faq')->where('course_id', $course_details->id)->orderBy('id', 'desc')->get();
        $ins = DB::table('instructor_support')->where('course_id', $course_details->id)->orderBy('id', 'desc')->first();
        // print_r($ins);exit;

        return view('front.course.course_details', compact('course_details', 'lo', 'curriculum_total_lecture', 'curriculum', 'schedule', 'video', 'test', 'test2', 'assignment', 'review', 'rating', 'faq', 'ins'));
    }

    public function filterBy(Request $request)
    {
        $data = $request->all();
        $result = Helper::filterBy($data);
        return $result;
    }
    
    public function getRelatedCourse(Request $request){
        $data = $request->all();
        $result = Helper::filterBy($data);
        return $result;
    }
    
    public function getCourseByCart(Request $request){
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            $data = $request->all();
            
            $course_list = DB::table('courses as c')
            ->join('cart', 'cart.course_id', '=', 'c.id')
            ->whereIn('cart.id', $data['items'])
            ->where('cart.user_id', Auth::user()->id)
            ->select('c.course_name', 'c.id as cid')->get();
            
            if(count($course_list) > 0){
                return json_encode(['error' => 'false', 'msg' => 'Course Available!', 'data'=>$course_list]);
            }
            else{
                return json_encode(['error' => 'true', 'msg' => 'Course Not Available!', 'data'=>[]]);
            }
        }
        else{
            return json_encode(['error' => 'true', 'msg' => 'You Are Not Loged In!']);
        }
    }
}
