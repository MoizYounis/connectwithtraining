<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Favorite;
use DB;
use Illuminate\Validation\Rule;
use Validator;
use Hash;
use Illuminate\Support\Facades\Input;
use Session;
use App\Helpers\Helper;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['checkout', 'order_summary']);
    }
    
    public function index(){
        $related_list = DB::table('courses as c')
            ->join('categories as cat', 'c.category_id', '=', 'cat.id')
            ->leftjoin('about_courses as ac', 'ac.course_id', '=', 'c.id')
            ->join('authors as a', 'a.id', '=', 'c.author_id')
            ->select('c.*', 'ac.course_details', 'cat.category_name', 'a.author_name')->orderBy('c.id', 'DESC')->limit(4)->get();
            
        $course_names = DB::table('courses')->select('course_name', 'id')->orderBy('id', 'DESC')->limit(12)->get();
        return view('front.cart.cart', compact('course_names', 'related_list'));
    }
    
    public function getCartHtml(){
        $data = Helper::getCartHtml();
        return $data;
    }
    
    public function deleteCartItemHtml(Request $request){
        $id = $request->cartNo;
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            if(DB::table('cart')->where('id', $id)->delete()){
                echo json_encode(["error"=>"false", "msg"=>"Course Removed From Cart."]);
            }
            else{
                echo json_encode(["error"=>"true", "msg"=>"Course Not Removed From Cart."]);
            }
        }
        else{
            $sessionCartData = Session::get('cart');
            Session::flush("cart");
            unset($sessionCartData[$id]);
            $newCart = array_values($sessionCartData);
            Session::put('cart', $newCart);
            echo json_encode(["error"=>"false", "msg"=>"Course Removed From Cart."]);
        }
    }
    
    //addtocart
    public function addtocart(Request $request){
        $request->validate([
            'course_name' => 'required',
            'id' => 'required',
        ]);
        $data = $request->all();
        $data['quantity'] = 1;
        $flag = true;

        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            $checkCart = Cart::where('user_id', Auth::user()->id)->where('course_id', $data['id'])->first();
            if($checkCart){
                $checkCart->update(['quantity' => DB::raw('quantity+1')]);
                return json_encode(['error' => 'false', 'msg' => 'This Product Already In Cart!.', 'count' => $this->getcountcart()]);
            }
            else{
                Cart::insert(['course_id'=> $data['id'], 'user_id' => Auth::user()->id]);
                return json_encode(['error' => 'false', 'msg' => 'Item Added Into Cart.', 'count' => $this->getcountcart()]);
            }
        }
        else{
            if (!$request->session()->exists('cart')) {
                $cartdata[] = $data;
                Session::put('cart', $cartdata);
                return json_encode(['error' => 'false', 'msg' => 'Item Added Into Cart.', 'count' => count(Session::get('cart'))]);
            }
            else{
                $cartdata = Session::get('cart');
                $i = 0;
                while ($i < count($cartdata)) {
                    if($cartdata[$i]['id'] == $data['id']){
                        Session::flush("cart");
                        $cartdata[$i]['quantity'] += 1;
                        Session::put('cart', $cartdata);
                        $flag = false;
                        break;
                    }
                    $i++;
                }
                if($flag){
                    Session::push('cart', $data);
                    return json_encode(['error' => 'false', 'msg' => 'Item Added Into Cart.', 'count' => count(Session::get('cart'))]);
                }else{
                    return json_encode(['error' => 'false', 'msg' => 'This Product Already In Cart!', 'count' => count(Session::get('cart'))]);    
                }            
            }
        }
        
    }

    public function emptyCart(){
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            if(DB::table('cart')->where('user_id', Auth::user()->id)->delete()){
                return json_encode(['error' => 'false', 'msg' => 'Your cart is empty now!']);
            }
            else{
                return json_encode(['error' => 'true', 'msg' => 'Connection erroe!']);
            }
        }
        else{
            if (Session::exists('cart')) {
                Session::flush("cart");
                return json_encode(['error' => 'false', 'msg' => 'Your cart is empty now!']);
            }
            else{
                return json_encode(['error' => 'true', 'msg' => 'Your cart is empty!']);
            }
        }
    }

    
    public function getcountcart(){
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            return Cart::where('user_id', Auth::user()->id)->count();
        }
        else{
            if (!Request::session()->exists('cart')) {
                return 0;
            }
            else{
                return count(Session::get('cart'));
            }
        }
    }
    
    public function getFavItems(){
        $data = Helper::getFavItems();
        return $data;
    }
    
    public function addtofav(Request $request){
        $request->validate([
            'course_name' => 'required',
            'id' => 'required',
        ]);
        $data = $request->all();

        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            $checkFav = Favorite::where('user_id', Auth::user()->id)->where('course_id', $data['id'])->first();
            if($checkFav){
                $checkFav->delete();
                return json_encode(['error' => 'false', 'msg' => 'Remove From Favorites.']);
            }
            else{
                Favorite::insert(['course_id'=> $data['id'], 'user_id' => Auth::user()->id]);
                return json_encode(['error' => 'false', 'msg' => 'Item Added Into Favorites.']);
            }
        }
        else{
            return json_encode(['error' => 'true', 'msg' => 'You Are Not Loged In.']);
        }
    }
    
    public function deleteFromFav(Request $request){
        $id = $request->favNo;
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            if(DB::table('favorites')->where('id', $id)->delete()){
                echo json_encode(["error"=>"false", "msg"=>"Course Removed From Favorites."]);
            }
            else{
                echo json_encode(["error"=>"true", "msg"=>"Course Not Removed From Favorites."]);
            }
        }
        else{
            echo json_encode(["error"=>"true", "msg"=>"Something Wrong."]);
        }
    }
    
    
    public function checkout(){
        $cartCount = DB::table('cart')->where('user_id', Auth::user()->id)->count();
        if($cartCount > 0){
            $address = DB::table('user_addresses')->where('user_id', Auth::user()->id)->first();
            return view('front.cart.checkout', compact('address'));
        }
        else{
            return back()->with('error','Your Cart Is Empty!');
        }
        
    }
    
    public function order_summary(){
        $cart = DB::table('cart')
        ->join('courses as c', 'c.id', '=', 'cart.course_id')
        ->join('categories as cat', 'c.category_id', '=', 'cat.id')
        ->join('about_courses as ac', 'ac.course_id', '=', 'c.id')->where('cart.user_id', Auth::user()->id)
        ->select('c.*', 'cat.category_name', 'ac.course_details')->orderBy('cart.id', 'DESC')->get();
        
        return view('front.cart.order_summary', compact('cart'));
    }
    
}
