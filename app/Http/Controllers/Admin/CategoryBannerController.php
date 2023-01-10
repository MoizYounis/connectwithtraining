<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category_banner;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
use Session;
    
class CategoryBannerController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //edit
    public function index(){
        $edit = Category_banner::get()->first();
        return view('admin.homepage_banner_block.edit', compact('edit'));
    }

    //update
    public function update(Request $request){
        $request->validate([
            'title1' => 'required',
            'img1' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'url1' => 'required',
            'title2' => 'required',
            'img2' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'url2' => 'required',
            'title3' => 'required',
            'img3' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'url3' => 'required',
            'title4' => 'required',
            'img4' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'url4' => 'required',
            'title5' => 'required',
            'img5' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'url5' => 'required',
            'title6' => 'required',
            'img6' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'url6' => 'required',
        ]);

        $cb = Category_banner::first();
        $num = 1;
        $data = $request->all();
        while($num <= 6){
            if ($request->hasFile('img'.$num))
            {
                $image = $request->file('img'.$num);
                $imageName = date("d_m_Y_").rand().'_'.$image->getClientOriginalName();
                $image_path = public_path('/assets/main/');
                $image->move($image_path, $imageName);
                $data['img'.$num] = $imageName;
            }
            $num++;     
        }
        
        $cb->update($data);
        return redirect()->back()->withSuccess("information updated successfully");
    }
}
