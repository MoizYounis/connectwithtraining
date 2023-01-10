<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Schedule_course_relation;
use App\Model\Schedule;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class ScheduleController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_course_schedule')->only(['create', 'store']);
        $this->middleware('view_course_schedule')->only('index');
        $this->middleware('update_course_schedule')->only(['edit', 'update']);
        $this->middleware('delete_course_schedule')->only('destroy');
        $this->Permission = $permission;
    }

    public function index() {
        $query = Schedule::query();
        $query->join('schedule_course_relation as scr', 'scr.schedule_id', '=', 'schedules.id')
        ->join('courses', 'courses.id', '=', 'scr.course_id')
        ->selectRaw('schedules.*');

        if(Auth::user()->userType != "superadmin"){
            $query->where('courses.user_id', Auth::user()->id);
        }
        $schedule_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.schedule.list', compact('schedule_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = DB::table('courses')->where('courses.user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = DB::table('courses')->orderBy('course_name')->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.schedule.add', compact('course_list', 'getPermission'));
    }

    public function store(Request $request, Schedule $schedule) {
        $request->validate([
            'course_id' => 'required',
            'schedule_title' => 'required',
            'schedule_date' => 'required',
            'schedule_time' => 'required'
        ]);
        $data = $request->all();
        $course_id = $data['course_id'];
        unset($data['course_id']);
        if ($request->get('schedule_status')) {
            $data['schedule_status'] = "Active";
        }
        else {
            $data += ["schedule_status" => "Inactive"];
        }
        $schedule_id = $schedule->create($data)->id;
        Schedule_course_relation::create(['course_id' => $course_id, 'schedule_id' => $schedule_id]);
        return back()->withSuccess('Schedule Created successfully');
    }

    //edit test
    public function edit($schedule_id){
        if(Auth::user()->userType != "superadmin")
            $course_list = DB::table('courses')->where('courses.user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = DB::table('courses')->orderBy('course_name')->get();

        $schedule_edit = Schedule::join('schedule_course_relation as scr', 'schedules.id', '=', 'scr.schedule_id')->where('scr.schedule_id', $schedule_id)
        ->selectRaw('schedules.*, scr.course_id')
        ->first();
        $getPermission = $this->Permission->getPermission();
        return view('admin.schedule.edit', compact('schedule_edit', 'course_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $schedule_id){
        $request->validate([
            'course_id' => 'required',
            'schedule_title' => 'required',
            'schedule_date' => 'required',
            'schedule_time' => 'required'
        ]);

        $schedule = Schedule::find($schedule_id);
        $data = $request->all();

        $course_id = $data['course_id'];
        unset($data['course_id']);
        
        if ($request->get('schedule_status')) {
            $data['schedule_status'] = "Active";
        }
        else {
            $data += ["schedule_status" => "Inactive"];
        }
        $schedule->update($data);

        $scr = Schedule_course_relation::where('schedule_id', $schedule_id)->first();
        $scr->update(['course_id' => $course_id]);
        return redirect()->route('schedule.index')->withSuccess("Schedule updated successfully");
    }

    //delete
    public function destroy($schedule_id)
    {
        $schedule = Schedule::find($schedule_id);        
        $schedule->delete();
        return redirect()->route('schedule.index')->withSuccess("Schedule deleted successfully");
    }
}
