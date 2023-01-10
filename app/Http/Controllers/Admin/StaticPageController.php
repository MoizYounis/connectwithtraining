<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Static_page;
use App\Model\Page_meta;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class StaticPageController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_page')->only(['create', 'store']);
        $this->middleware('view_page')->only('index');
        $this->middleware('update_page')->only(['edit', 'update']);
        $this->middleware('delete_page')->only('destroy');
        $this->Permission = $permission;
    }

    //sub category list
    public function index() {
        $query = Static_page::query();        
        $query->join('users', 'users.id', '=', 'static_pages.user_id')
        ->select('static_pages.*', 'users.first_name', 'users.last_name')
        ->orderBy('page_title');
        if(Auth::user()->userType != "superadmin"){
            $query->where('static_pages.user_id', Auth::user()->id);
        }
        $page_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.staticPage.page_list', compact('page_list', 'getPermission'));
    }

    public function create() {
        $user_list = DB::table('users')->orderBy('first_name')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.staticPage.add_page', compact('user_list', 'getPermission'));
    }

    public function store(Request $request, Static_page $static_page) {
        $request->validate([
            'page_title' => 'required',
            'page_content' => 'required',
        ]);
        $data = $request->all();

        if($data['page_meta_key'][0] != '' or $data['page_meta_value'][0] != ''){
            $metakey = implode(',', $data['page_meta_key']);
            $metaValue = implode(',', $data['page_meta_value']);
            $meta = array('page_meta_key' => $metakey, 'page_meta_value' => $metaValue);
        }
        
        unset($data['page_meta_key']);
        unset($data['page_meta_value']);        
        unset($data['files']);

        if ($request->get('page_status')) {
            $data['page_status'] = "Publish";
        }
        else {
            $data += ["page_status" => "Unpublished"];
        }
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }

        $page_id = $static_page->create($data)->id;
        if(isset($meta)){
            $meta += ['page_id' => $page_id];
            Page_meta::create($meta);
        }
        
        return back()->withSuccess('Page created successfully');
    }

    //edit subcategory
    public function edit($page_id){
        $user_list = DB::table('users')->orderBy('first_name')->get();
        $page_edit = Static_page::where('static_pages.id', $page_id)
        ->leftjoin('page_meta', 'page_meta.page_id', '=', 'static_pages.id')
        ->select('static_pages.*', 'page_meta.page_meta_key', 'page_meta.page_meta_value')->first();
        $getPermission = $this->Permission->getPermission();
        return view('admin.staticPage.edit_page', compact('page_edit', 'user_list', 'getPermission'));
    }

    //update
    public function update(Request $request, $page_id){
        $request->validate([
            'page_title' => 'required',
            // 'page_content' => 'required',
        ]);

        $static_page = Static_page::find($page_id);
        $data = $request->all();
        
        if($static_page->page_name == 'about'){
            
            //left images
            if ($request->hasFile('left_img1'))
            {
                $image = $request->file('left_img1');
                $imageName = 'left-side1'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['left_img1'] = $imageName;
            }
            else{
                $leftImg1 = json_decode($static_page->page_content);
                $data['left_img1'] = $leftImg1->left_img1;
            }
            
            if ($request->hasFile('left_img2'))
            {
                $image = $request->file('left_img2');
                $imageName = 'left-side2'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['left_img2'] = $imageName;
            }
            else{
                $leftImg2 = json_decode($static_page->page_content);
                $data['left_img2'] = $leftImg2->left_img2;
            }
            
            if ($request->hasFile('left_img3'))
            {
                $image = $request->file('left_img3');
                $imageName = 'left-side3'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['left_img3'] = $imageName;
            }
            else{
                $leftImg3 = json_decode($static_page->page_content);
                $data['left_img3'] = $leftImg3->left_img3;
            }
            
            //right images
            if ($request->hasFile('right_img1'))
            {
                $image = $request->file('right_img1');
                $imageName = 'right-side1'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['right_img1'] = $imageName;
            }
            else{
                $rightImg1 = json_decode($static_page->page_content);
                $data['right_img1'] = $rightImg1->right_img1;
            }
            
            if ($request->hasFile('right_img2'))
            {
                $image = $request->file('right_img2');
                $imageName = 'right-side2'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['right_img2'] = $imageName;
            }
            else{
                $rightImg2 = json_decode($static_page->page_content);
                $data['right_img2'] = $rightImg2->right_img2;
            }
            
            if ($request->hasFile('right_img3'))
            {
                $image = $request->file('right_img3');
                $imageName = 'right-side3'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['right_img3'] = $imageName;
            }
            else{
                $rightImg3 = json_decode($static_page->page_content);
                $data['right_img3'] = $rightImg3->right_img3;
            }
            
            //below image
            if ($request->hasFile('below_img1'))
            {
                $image = $request->file('below_img1');
                $imageName = 'below-side1'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['below_img1'] = $imageName;
            }
            else{
                $belowImg1 = json_decode($static_page->page_content);
                $data['below_img1'] = $belowImg1->below_img1;
            }
            
            if ($request->hasFile('below_img2'))
            {
                $image = $request->file('below_img2');
                $imageName = 'below-side2'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['below_img2'] = $imageName;
            }
            else{
                $belowImg2 = json_decode($static_page->page_content);
                $data['below_img2'] = $belowImg2->below_img2;
            }
            
            if ($request->hasFile('below_img3'))
            {
                $image = $request->file('below_img3');
                $imageName = 'below-side3'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['below_img3'] = $imageName;
            }
            else{
                $belowImg3 = json_decode($static_page->page_content);
                $data['below_img3'] = $belowImg3->below_img3;
            }
            
            if ($request->hasFile('below_img4'))
            {
                $image = $request->file('below_img4');
                $imageName = 'below-side4'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['below_img4'] = $imageName;
            }
            else{
                $belowImg4 = json_decode($static_page->page_content);
                $data['below_img4'] = $belowImg4->below_img4;
            }
            
            if ($request->hasFile('center_img'))
            {
                $image = $request->file('center_img');
                $imageName = 'center-side'.time().'.'.$image->getClientOriginalExtension();
                $image_path = public_path('/assets/front/img/about/');
                $image->move($image_path, $imageName);
                $data['center_img'] = $imageName;
            }
            else{
                $centerImg = json_decode($static_page->page_content);
                $data['center_img'] = $centerImg->center_img;
            }
            
            $contentData = array(
                'left_img1'               => $data['left_img1'],
                'left_img2'               => $data['left_img2'],
                'left_img3'               => $data['left_img3'],
                'left_first_img_title1'   => $data['left_first_img_title1'],
                'left_second_img_title2'  => $data['left_second_img_title2'],
                'left_thired_img_title3'  => $data['left_thired_img_title3'],
                
                'right_img1'               => $data['right_img1'],
                'right_img2'               => $data['right_img2'],
                'right_img3'               => $data['right_img3'],
                'right_first_img_title1'  => $data['right_first_img_title1'],
                'right_second_img_title2'  => $data['right_second_img_title2'],
                'right_thired_img_title3'  => $data['right_thired_img_title3'],
                
                'center_img'              => $data['center_img'],
                'center_img_title'        => $data['center_img_title'],
                
                'below_img1'               => $data['below_img1'],
                'below_img2'               => $data['below_img2'],
                'below_img3'               => $data['below_img3'],
                'below_img4'               => $data['below_img4'],
                'below_first_img_title1'  => $data['below_first_img_title1'],
                'below_second_img_title2' => $data['below_second_img_title2'],
                'below_thired_img_title3' => $data['below_thired_img_title3'],
                'below_fourth_img_title4' => $data['below_fourth_img_title4'],
                
                'middle_title'            => $data['middle_title'],
                'middle_desc'             => $data['middle_desc']
            );
            
            $data['page_content'] = json_encode($contentData);
            
            unset($data['left_img1']);
            unset($data['left_img2']);
            unset($data['left_img3']);
            unset($data['left_first_img_title1']);
            unset($data['left_second_img_title2']);
            unset($data['left_thired_img_title3']);
            
            unset($data['right_img1']);
            unset($data['right_img2']);
            unset($data['right_img3']);
            unset($data['right_first_img_title1']);
            unset($data['right_second_img_title2']);
            unset($data['right_thired_img_title3']);
            
            unset($data['below_img1']);
            unset($data['below_img2']);
            unset($data['below_img3']);
            unset($data['below_img4']);
            unset($data['below_first_img_title1']);
            unset($data['below_second_img_title2']);
            unset($data['below_thired_img_title3']);
            unset($data['below_fourth_img_title4']);
            
            unset($data['center_img']);
            unset($data['center_img_title']);
            
            unset($data['middle_title']);
            unset($data['middle_desc']);
        }
        
        
        if($data['page_meta_key'][0] != '' or $data['page_meta_value'][0] != ''){
            $metakey = implode(',', $data['page_meta_key']);
            $metaValue = implode(',', $data['page_meta_value']);
            $meta_data = array('page_meta_key' => $metakey, 'page_meta_value' => $metaValue);
        }
                
        unset($data['page_meta_key']);
        unset($data['page_meta_value']);        
        unset($data['files']);

        if ($request->get('page_status')) {
            $data['page_status'] = "Publish";
        }
        else {
            $data += ["page_status" => "Unpublished"];
        }
        if (!$request->get('user_id')) {
            $data += ["user_id" => Auth::user()->id];
        }

        $static_page->update($data);      


        if(isset($meta_data)){
            $meta = Page_meta::where('page_id', $page_id)->first();
            if($meta){
                $meta->update($meta_data);
            }
            else{
                $meta_data += ['page_id' => $page_id];
                Page_meta::create($meta_data);
            }
        }
        return redirect()->route('staticPage.index')->withSuccess("Page updated successfully");
    }

    //delete
    public function destroy($page_id)
    {
        //delete image
        $page = Static_page::find($page_id);        
        $page->delete();
        
        // //delete meta
        // $meta = Page_meta::where('page_id', $page_id)->first();
        // if($meta){
        //     $meta->delete();
        // }
        return redirect()->route('staticPage.index')->withSuccess("Page deleted successfully");
    }
}
