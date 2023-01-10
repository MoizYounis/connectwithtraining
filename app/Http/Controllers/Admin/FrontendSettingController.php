<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\General_setting;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use DB;
use App\Model\Social;

class FrontendSettingController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('view_website_setting')->only('index');
        $this->middleware('update_website_setting')->only(['logoicon_update', 'updateFooter', 'contactus_update', 'homepageBanner', 'homepageBannerUpdate']);
        $this->Permission = $permission;
    }
    
	//logo icon
    public function index() {
        $getPermission = $this->Permission->getPermission();
        return view('admin.frontend_setting.index', compact('getPermission'));
    }

    public function upload_logo(Request $request){
        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/logo/');
            $image->move($image_path, $imageName);
            $data['file'] = $imageName;
            echo $data['file'];
        }

        if ($request->hasFile('file2'))
        {
            $image = $request->file('file2');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/logo/');
            $image->move($image_path, $imageName);
            $data['file2'] = $imageName;
            echo $data['file2'];
        }
    }

    public function logoicon_update(Request $request, General_setting $gs) {
        $data = $request->all();
        $gs = General_setting::first();
        $gs->update($data);
        return back()->withSuccess('Information updated successfully');
    }    


    //social Link
    public function social() {
        $socialList = Social::all();
        $getPermission = $this->Permission->getPermission();
        return view('admin.frontend_setting.sociallink', compact('socialList', 'getPermission'));
    }

    public function socialAdd(Request $request, General_setting $gs) {
        $data = $request->all();
        $social = array(
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'google' => $data['google'],
            'youtube' => $data['youtube'],
            'linkdin' => $data['linkdin'],
            'instagram' => $data['instagram'],
        );
        unset($data);
        $setting = General_setting::first();
        $data['social_links'] = json_encode($social);
        $setting->update($data);
        return back()->withSuccess('Information added successfully');
    }

    public function socialDestroy($id) {
        Social::destroy($id);
        return back()->withSuccess('Information deleted successfully');
    }

    //about us
    public function aboutus() {
        $setting = General_setting::first();
        return view('admin.frontend_setting.aboutus', compact('setting'));
    }

    public function aboutus_update(Request $request) {
        $setting = General_setting::first();
        $data = $request->all();
        $setting->update($data);

        return back()->withSuccess('Information updated successfully');
    }

    public function contactus_update(Request $request) {

        $request->validate([
            'contact_title' => 'max:255',
            'contact_phone' => 'max:255',
            'contact_email' => 'email|string|max:255',
        ]);
        $setting = General_setting::first();
        $data = $request->all();
        $setting->update($data);
        return back()->withSuccess("Information updated successfully");
    }


    //testimonial
    public function testimonial() {
        $setting = General_setting::first();
        $testimonialList = Testimonial::all();
        return view('admin.frontend_setting.testimonial', compact('setting', 'testimonialList'));
    }

    public function testimonial_update(Request $request) {
        $request->validate([
            'testimonial_title' => 'required|max:255',
        ]);
        $id = $request->get('general_settings_id');
        $setting = General_setting::find($id);
        $data = $request->all();
        $setting->update($data);
        return back()->withSuccess('Information updated successfully');
    }

    public function storeNewTestimonial(Request $request, Testimonial $testimonial) {
        $request->validate([
            'testimonial_name' => 'required|max:255',
            'testimonial_designation' => 'max:255',
            'testimonial_comment' => 'required',
            'testimonial_image' => 'image|mimes:jpeg,jpg,png',
        ]);
        $data = $request->all();
        // if ($request->hasFile('image')) {
        //     $image = $request->image;
        //     $imageObj = Image::make($image);
        //     $imageObj->resize(352, 352)->save('assets/frontend/images/testimonial/' . $image->hashname());
        //     $data['image'] = $image->hashname();
        // }
        $testimonial->create($data);
        return back()->withSuccess("Information added successfully");
    }

    //faq
    public function faq() {
        $setting = General_setting::first();
        $faqList = Faq::all();
        return view('admin.frontend_setting.faq', compact('setting', 'faqList'));
    }

    public function store_faq(Request $request, Faq $faq) {
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        $data = $request->all();

        $faq->create($data);

        return back()->withSuccess("Information added successfully");
    }

    public function updateNewFaq(Request $request, Faq $faq) {

        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        $data = $request->all();

        $faq->update($data);

        return back()->withSuccess("Information updated successfully");
    }

    public function deleteFaq(Faq $faq) {

        Faq::destroy($faq->id);
        return back()->withSuccess("Information deleted successfully");
    }


    //footer
    public function footer() {
        $setting = General_setting::first();
        return view('admin.frontend_setting.footer', compact('setting'));
    }

    public function privacy(){
        $setting = General_setting::first();
        return view('admin.frontend_setting.privacy', compact('setting'));
    }

    public function privacy_update(Request $request) {
        $setting = General_setting::first();
        $data = $request->all();
        $setting->update($data);
        return back()->withSuccess("Information updated successfully");
    }
    
    public function terms(){
        $setting = General_setting::first();
        return view('admin.frontend_setting.terms', compact('setting'));
    }
    
    public function terms_update(Request $request) {
        $setting = General_setting::first();
        $data = $request->all();
        unset($data['files']);
        $setting->update($data);
        return back()->withSuccess("Information updated successfully");
    }

    public function updateFooter(Request $request) {

        $id = $request->get('general_settings_id');
        $setting = General_setting::first();
        $data = $request->all();
        $setting->update($data);
        return back()->withSuccess("Information updated successfully");
    }
    
    public function homepageBanner(){
        $getPermission = $this->Permission->getPermission();
        $setting = General_setting::first();
        // dd(json_decode($setting->homepage)->review_images[0]);
        return view('admin.frontend_setting.homepage', compact('setting', 'getPermission'));
    }
    
    public function homepageBannerUpdate(Request $request){
        $setting = General_setting::first();
        $data = $request->all();
        
        if ($request->hasFile('banner_img')){
            $image = $request->file('banner_img');
            $imageName = 'center-side'.time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/banner/');
            $image->move($image_path, $imageName);
            $banner_img = $imageName;
        }
        else{
            $banner_img = json_decode($setting->homepage);
            $banner_img = $banner_img->banner_img;
        }
        
        if ($request->hasFile('homepage_middle_img')){
            $image = $request->file('homepage_middle_img');
            $imageName = 'center-side'.time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/banner/');
            $image->move($image_path, $imageName);
            $homepage_middle_img = $imageName;
        }
        else{
            $homepage_middle_img = json_decode($setting->homepage);
            $homepage_middle_img = $homepage_middle_img->homepage_middle_img;
        }
        $publicReviews = json_decode($setting->homepage)->review_images;
        if ($request->hasFile('review_image_1'))
        {
            // dd($request->file('review_images'));
            // dd($request->file('review_images')[$i]);
            $image = $request->file('review_image_1');
            $imageName = 'review_images'.time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/publicReviews/');
            $image->move($image_path, $imageName);
            $publicReviews[0] = $imageName;
        }
        else{
            $publicReviews[0] = $publicReviews[0];
        }
        
        
        if ($request->hasFile('review_image_2'))
        {
            $image = $request->file('review_image_2');
            $imageName = 'review_images2'.time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/publicReviews/');
            $image->move($image_path, $imageName);
            json_decode($setting->homepage)->review_images[1] = $imageName;
            $publicReviews[1] = $imageName;
        }
        else{
            // $publicReviews = json_decode($setting->homepage);
            // $publicReviews[1] = $publicReviews->review_images;
            $publicReviews[1] = $publicReviews[1];
            
        }
        
        if ($request->hasFile('review_image_3'))
        {
            $image = $request->file('review_image_3');
            $imageName = 'review_images3'.time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/publicReviews/');
            $image->move($image_path, $imageName);
            json_decode($setting->homepage)->review_images[2] = $imageName;
            $publicReviews[2] = $imageName;
        }
        else{
            $publicReviews[2] = $publicReviews[2];
        }
        
        if ($request->hasFile('review_image_4'))
        {
            $image = $request->file('review_image_4');
            $imageName = 'review_images4'.time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/publicReviews/');
            $image->move($image_path, $imageName);
            json_decode($setting->homepage)->review_images[3] = $imageName;
            $publicReviews[3] = $imageName;
        }
        else{
            $publicReviews[3] = $publicReviews[3];
        }
        
        // dd($publicReviews);
        $homepageData = array(
            'text_on_banner'       => $data['text_on_banner'],
            'banner_footer_text'   => $data['banner_footer_text'],
            'banner_img'           => $banner_img,
            'banner_timer'         => $data['banner_timer'],
            
            'minddle_img_title'    => $data['minddle_img_title'],
            'minddle_img_subtitle' => $data['minddle_img_subtitle'],
            'homepage_middle_img'  => $homepage_middle_img,
            
            'review_section_heading' => $data['review_section_heading'],
            
            'review_title1' => $data['review_title1'],
            'review_title2' => $data['review_title2'],
            'review_title3' => $data['review_title3'],
            'review_title4' => $data['review_title4'],
            
            'review_rating1' => $data['review_rating1'],
            'review_rating2' => $data['review_rating2'],
            'review_rating3' => $data['review_rating3'],
            'review_rating4' => $data['review_rating4'],
            
            'review_comment1' => $data['review_comment1'],
            'review_comment2' => $data['review_comment2'],
            'review_comment3' => $data['review_comment3'],
            'review_comment4' => $data['review_comment4'],
            'review_images' => $publicReviews
        );
        
        unset($data);
        $data['homepage'] = json_encode($homepageData);
        
        $setting->update($data);
        return back()->withSuccess("Information updated successfully");
    }
}
