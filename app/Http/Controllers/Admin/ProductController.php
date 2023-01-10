<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Sub_category;
use App\Model\Product_seo;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
    
class ProductController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }

    public function get_sub_cat($category_id)
    {
        $sub_cat_list = DB::table('sub_categories')
        ->where('sub_status', '=', 'Active')
        ->where('category_id', '=', $category_id)
        ->pluck("sub_name", "id");
        return response()->json($sub_cat_list);
    }
    public function get_child($sub_id)
    {
        $child_list = DB::table('child_categories')
        ->where('child_status', '=', 'Active')
        ->where('sub_id', '=', $sub_id)
        ->pluck("child_name", "id");
        return response()->json($child_list);
    }

    //Product list
    public function index(){
        $product_list = DB::table('products')
        ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
        ->leftjoin('sub_categories', 'sub_categories.id', '=', 'products.sub_id')
        ->leftjoin('child_categories', 'child_categories.id', '=', 'products.child_id')
        ->select('products.*', 'categories.category_name', 'sub_categories.sub_name', 'child_categories.child_name')
        ->orderBy('products.id', 'DESC')->get();        
        return view('admin.product.product_list', compact('product_list'));
    }

    //add product
    public function create(){
        $cat_list = DB::table('categories')
        ->where('category_status', '=', 'Active')
        ->get();
        $sub_cat_list = DB::table('sub_categories')
        ->where('sub_status', '=', 'Active')
        ->get();
        $child_list = DB::table('child_categories')
        ->where('child_status', '=', 'Active')
        ->get();
        $brand_list = DB::table('brands')->where('brand_status', 'Active')->orderBy('brand_name')->get();
        $tag_list = DB::table('tags')->orderBy('tag_name')->get();

        return view('admin.product.add_product', compact('cat_list', 'sub_cat_list', 'child_list', 'brand_list', 'tag_list'));
    }

    public function store(Request $request, Product $product) {
        $request->validate([
            'product_name' => 'required|unique:products',
            'product_desc' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'sub_id' => 'required',
            'product_price' => 'required',
            'product_base_img' => 'required',
            'additional_images' => 'required',
        ]);

        $data = $request->all();
        
        $meta = array('meta_title' => $data['meta_title'], 'meta_desc' => $data['meta_desc']);

        unset($data['meta_title']);
        unset($data['meta_desc']);
        unset($data['files']);

        $data['tag_id'] = implode(",", $data['tag_id']);
        $data['additional_images'] = implode(",", $data['additional_images']);
        
        if ($request->get('product_enable')) {
            $data['product_enable'] = "Active";
        }
        else {
            $data += ["product_enable" => "Inactive"];
        }

        $product_id = $product->create($data)->id;
        $meta += ['product_id' => $product_id];
        Product_seo::create($meta);
        return back()->withSuccess('Product created successfully');
    }

    //edit product
    public function edit($product_id){
        //$product_id = decrypt($product_id);
        $product_edit = Product::where('products.id', '=', $product_id)
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_id')
        ->leftjoin('child_categories', 'child_categories.id', '=', 'products.child_id')
        ->join('product_seo', 'product_seo.product_id', '=', 'products.id')
        ->select('products.*', 'categories.category_name', 'sub_categories.sub_name', 'child_categories.child_name', 'product_seo.meta_title', 'product_seo.meta_desc')
        ->first();
        
        $cat_list = DB::table('categories')
        ->where('categories.category_status', '=', 'Active')
        ->get();

        $sub_cat_list = DB::table('sub_categories')
        ->where('sub_status', '=', 'Active')
        ->where('category_id', '=', $product_edit->category_id)
        ->get();

        $child_list = DB::table('child_categories')
        ->where('child_status', '=', 'Active')
        ->where('sub_id', '=', $product_edit->sub_id)
        ->get();

        $brand_list = DB::table('brands')->where('brand_status', 'Active')->orderBy('brand_name')->get();
        $tag_list = DB::table('tags')->orderBy('tag_name')->get();

        return view('admin.product.edit_product', compact('product_edit', 'cat_list', 'sub_cat_list', 'child_list', 'brand_list', 'tag_list'));
    }

    //update
    public function update(Request $request, $product_id){
        $request->validate([
            'product_name' => ['required', Rule::unique('products')->ignore($product_id)],
            'product_desc' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'sub_id' => 'required',
            'product_price' => 'required',
        ]);

        $product = Product::find($product_id);
        $data = $request->all();
        $meta_data = array('meta_title' => $data['meta_title'], 'meta_desc' => $data['meta_desc'], 'product_id' => $product_id);

        unset($data['meta_title']);
        unset($data['meta_desc']);
        unset($data['files']);

        $data['tag_id'] = implode(",", $data['tag_id']);
        $data['additional_images'] = implode(",", $data['additional_images']);
        
        if ($request->get('product_enable')) {
            $data['product_enable'] = "Active";
        }
        else {
            $data += ["product_enable" => "Inactive"];
        }
        $product->update($data);

        $meta = Product_seo::where('product_id', $product_id)->first();
        $meta->update($meta_data);

        return redirect()->route('product.index')->withSuccess("Product updated successfully");
    }

    //delete
    public function destroy($product_id)
    {
        //delete image
        $product = Product::find($product_id);
        if(!empty($product->product_base_img)){
            if(file_exists(public_path('/assets/front/img/product/').$product->product_base_img)){
                unlink(public_path('/assets/front/img/product/').$product->product_base_img);
            }
        }
        if(!empty($product->additional_images)){
            $i = 0;
            $additional_images = explode(',', $product->additional_images);
            while($i < count($additional_images)){
                if(file_exists(public_path('/assets/front/img/product/').$additional_images[$i])){
                    unlink(public_path('/assets/front/img/product/').$additional_images[$i]);
                }    
                $i++;
            }            
        }
        
        $product->delete();
        $meta = Product_seo::where('product_id', $product_id)->first();
        $meta->delete();
        return redirect()->route('product.index')->withSuccess("Product deleted successfully");
    }

    public function upload_image(Request $request){
        
        $data = $request->all();
        if ($request->hasFile('file'))
        {
            $image = $request->file('file');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/product/');
            $image->move($image_path, $imageName);
            // $data['file'] = $imageName;
            echo '<img src="'.asset('public/assets/front/img/product').'/'.$imageName.'" style="width:100px; height:100px; object-fit:contain;" />
                <input type="hidden" name="product_base_img" id="product_base_img" value="'.$imageName.'" required/>';
        }
        else{            
            $image = $request->file('file2');
            $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_path = public_path('/assets/front/img/product/');
            $image->move($image_path, $imageName);
            // $data['file'] = $imageName;
            $data['img'] = '<img src="'.asset('public/assets/front/img/product').'/'.$imageName.'" style="width:100px; height:100px; object-fit:contain; display: inline-block; "/>';
            $data['image_name'] = '<option selected value="'.$imageName.'">'.$imageName.'</option>';
            return response()->json($data);
        }

    }

    // public function multiple_images(Request $request){
        
    //     $data = $request->all();
    //     if ($request->hasFile('file'))
    //     {
    //         $image = $request->file('file');
    //         $imageName = rand(1000,9999).time().'.'.$image->getClientOriginalExtension();
    //         $image_path = public_path('/assets/front/img/product/');
    //         $image->move($image_path, $imageName);
    //         //$data['file'] = $imageName;
    //         //echo '<img src="'.asset('public/assets/front/img/product').'/'.$data["file"].'" style="width:100px; height:100px; object-fit:contain;;" />
    //         return response()->json(['success' => $imageName]);
    //     }
    // }
}