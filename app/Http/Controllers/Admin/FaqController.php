<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Faq;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
    
class FaqController extends Controller
{
	public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_faq')->only(['create', 'store']);
        $this->middleware('view_faq')->only('index');
        $this->middleware('update_faq')->only(['edit', 'update']);
        $this->middleware('delete_faq')->only('destroy');
        $this->middleware('show_faq')->only('show');
        $this->Permission = $permission;
    }
    
    public function index() {
        $query = Faq::query();
        $query->join('courses as c', 'c.id', '=', 'faq.course_id')
        ->selectRaw('c.course_name, faq.*');

        if(Auth::user()->userType != "superadmin"){
            $query->where('c.user_id', Auth::user()->id);
        }
        $faq_list = $query->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.faq.list', compact('faq_list', 'getPermission'));
    }

    public function create() {
        if(Auth::user()->userType != "superadmin")
            $course_list = DB::table('courses')->where('courses.user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = DB::table('courses')->orderBy('course_name')->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.faq.add', compact('course_list', 'getPermission'));
    }

    public function store(Request $request, Faq $faq) {
        $request->validate([
            'course_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);
        $data = $request->all();
        
        if ($request->hasFile('faq_file'))
        {
            $image = $request->file('faq_file');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/faq/');
            $image->move($image_path, $imageName);
            $data['faq_file'] = $imageName;
        }

        $faq->create($data);
        return back()->withSuccess('Faq created successfully');
    }

    public function edit($faqid){
        if(Auth::user()->userType != "superadmin")
            $course_list = DB::table('courses')->where('courses.user_id', Auth::user()->id)->orderBy('course_name')->get();
        else
            $course_list = DB::table('courses')->orderBy('course_name')->get();

        $faq_edit = Faq::find($faqid);
        $getPermission = $this->Permission->getPermission();
        return view('admin.faq.edit', compact('faq_edit', 'course_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $faqid){
        $request->validate([
            'course_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);

        $data = $request->all();
        $faq = Faq::find($faqid);

        if ($request->hasFile('faq_file'))
        {
            $image = $request->file('faq_file');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/faq/');
            $image->move($image_path, $imageName);
            $data['faq_file'] = $imageName;

            if(!empty($faq->faq_file)){
                if(file_exists(public_path('/assets/front/img/faq/').$faq->faq_file)){
                    unlink(public_path('/assets/front/img/faq/').$faq->faq_file);
                }
            }
        }
        
        $faq->update($data);
        return redirect()->route('faq.index')->withSuccess("Faq updated successfully");
    }

    //delete
    public function destroy($faqid)
    {
        $faq = Faq::find($faqid);
        if(!empty($faq->faq_file)){
            if(file_exists(public_path('/assets/front/img/faq/').$faq->faq_file)){
                unlink(public_path('/assets/front/img/faq/').$faq->faq_file);
            }
        }
        
        $faq->delete();
        return redirect()->back()->withSuccess('Faq delete successfully');
    }

    public function show($faq_id){
        $faq = Faq::find($faq_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.faq.show', compact('faq', 'getPermission'));
    }    
}
