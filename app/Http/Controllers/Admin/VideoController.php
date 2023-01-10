<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Video;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class VideoController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_video')->only(['create', 'store']);
        $this->middleware('view_video')->only('index');
        $this->middleware('update_video')->only(['edit', 'update']);
        $this->middleware('delete_video')->only('destroy');
        $this->Permission = $permission;
    }
    
    public function index() {
        $query = Video::query();
        $query->join('courses', 'courses.id', '=', 'videos.course_id')
        ->selectRaw('videos.*, courses.course_name');

        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $video_list = $query->get();

        $getPermission = $this->Permission->getPermission();       
        return view('admin.video.list', compact('video_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = DB::table('courses')->where('courses.user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = DB::table('courses')->orderBy('course_name')->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.video.add', compact('course_list', 'getPermission'));
    }

    public function store(Request $request, Video $video) {
        $request->validate([
            'video_title' => 'required',
            //'video_link' => 'required',
            'video_banner' => 'required',
            'video_type' => 'required',
        ]);
        $data = $request->all();
        unset($data['file']);
        if ($request->get('video_status')) {
            $data['video_status'] = "Publish";
        }
        else {
            $data += ["video_status" => "Unpublished"];
        }

        if ($request->hasFile('file2'))
        {
            $image = $request->file('file2');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/videos/');
            $image->move($image_path, $imageName);
            $data['video_link'] = $imageName;
            unset($data['file2']);
        }
        $video->create($data);
        return back()->withSuccess('Video added successfully');
    }

    //edit video
    public function edit($video_id){
        if(Auth::user()->userType != "superadmin")
            $course_list = DB::table('courses')->where('courses.user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = DB::table('courses')->orderBy('course_name')->get();
        
        $video_edit = Video::find($video_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.video.edit', compact('video_edit', 'course_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $video_id){
        $request->validate([
            'video_title' => 'required',
            //'video_link' => 'required',
            // 'video_banner' => 'required',
            'video_type' => 'required',
        ]);

        $video = Video::find($video_id);
        $data = $request->all();
        unset($data['file']);
        if ($request->get('video_status')) {
            $data['video_status'] = "Publish";
        }
        else {
            $data += ["video_status" => "Unpublished"];
        }

        if ($request->hasFile('file2'))
        {
            $image = $request->file('file2');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/videos/');
            $image->move($image_path, $imageName);
            $data['video_link'] = $imageName;
            unset($data['file2']);
        }
        
        $video->update($data);
        return redirect()->route('video.index')->withSuccess("Video information updated successfully");
    }

    //delete
    public function destroy($video_id)
    {
        //delete image
        $video = Video::find($video_id);
        if(!empty($video->video_banner) && file_exists(public_path('/assets/front/img/videoBanner/').$video->video_banner)){
            unlink(public_path('/assets/front/img/videoBanner/').$video->video_banner);
        }
        if(!empty($video->video_link) && file_exists(public_path('/assets/front/img/videos/').$video->video_link)){
            unlink(public_path('/assets/front/img/videos/').$video->video_link);
        }
        
        $video->delete();
        return redirect()->route('video.index')->withSuccess('Video delete successfully');
    }


    public function upload_image(Request $request){
        
        $data = $request->all();
        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/videoBanner/');
            $image->move($image_path, $imageName);
            $data['file'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/videoBanner').'/'.$data["file"].'" style="width:100px; height:100px; object-fit:contain;;" />
                         <input type="hidden" name="video_banner" id="video_banner" value="'.$data["file"].'" required/>';  
        }
    }

    // public function upload_video(Request $request){

    //     $data = $request->all();

    //     if ($request->hasFile('file2'))
    //     {

    //         $image = $request->file('file2');
    //         $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
    //         $image_path = public_path('/assets/front/img/videos/');
    //         $image->move($image_path, $imageName);
    //         $data['file2'] = $imageName;

    //         return array('img' => '<img src="'.asset('public/assets/front/img/videos').'/'.$data["file2"].'" style="width:100px; height:100px; object-fit:contain;;" />', 'input' => '<input type="hidden" name="video_link" id="video_link" value="'.$data["file2"].'" required/>');
    //     }
    // }
}
