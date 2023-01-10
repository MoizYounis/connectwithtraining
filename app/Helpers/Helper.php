<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Course;
use App\Model\Cart;
use App\Model\General_setting;
use DB;
use Session;
use Illuminate\Support\Facades\Cookie;

class Helper
{
    public static function filterBy($data)
    {
        $limit = isset($data['limit']) ? $data['limit'] : "8";
        if(isset($data['postRequest']['category']) && $data['postRequest']['category'] != ''){
            $query = Course::query();
            $query->join('categories as cat', 'courses.category_id', '=', 'cat.id')
            ->leftjoin('about_courses as ac', 'ac.course_id', '=', 'courses.id')
            ->join('authors as a', 'a.id', '=', 'courses.author_id')
            ->select('courses.*', 'ac.course_details', 'cat.category_name', 'a.author_name')->orderBy('courses.id', 'DESC');
            $catid = $data['postRequest']['category'];
            $query->where('cat.id', $catid);
            $course_list = $query->limit(8)->get();
        }
        elseif(isset($data['postRequest']['search']) && $data['postRequest']['search'] != ''){
            $query = Course::query();
            $query->join('categories as cat', 'courses.category_id', '=', 'cat.id')
            ->leftjoin('about_courses as ac', 'ac.course_id', '=', 'courses.id')
            ->join('authors as a', 'a.id', '=', 'courses.author_id')
            ->select('courses.*', 'ac.course_details', 'cat.category_name', 'a.author_name')->orderBy('courses.id', 'DESC');
            $search = $data['postRequest']['search'];
            $query->where('course_name', 'LIKE', '%'.$search.'%');
            $query->orWhere('ac.course_details', 'LIKE', '%'.$search.'%');
            $course_list = $query->limit(8)->get();
        }
        elseif(isset($data['postRequest']['priceRange']) && $data['postRequest']['priceRange'] != ''){
            $priceRange = explode(",", $data['postRequest']['priceRange']);
            $query = Course::query();
            $query->join('categories as cat', 'courses.category_id', '=', 'cat.id')
            ->leftjoin('about_courses as ac', 'ac.course_id', '=', 'courses.id')
            ->join('authors as a', 'a.id', '=', 'courses.author_id')
            ->select('courses.*', 'ac.course_details', 'cat.category_name', 'a.author_name')->orderBy('courses.id', 'DESC');
            $query->where('courses.course_price', '>=', $priceRange[0]);
            $query->where('courses.course_price', '<=', $priceRange[1]);
            // echo $query->toSql();
            $course_list = $query->limit(8)->get();
        }
        elseif(isset($data['postRequest']['courseStatus']) && $data['postRequest']['courseStatus'] != ''){
            $query = Course::query();
            $query->join('categories as cat', 'courses.category_id', '=', 'cat.id')
            ->leftjoin('about_courses as ac', 'ac.course_id', '=', 'courses.id')
            ->join('authors as a', 'a.id', '=', 'courses.author_id')
            ->select('courses.*', 'ac.course_details', 'cat.category_name', 'a.author_name');
            
            $courseStatus = $data['postRequest']['courseStatus'];
            
            if($courseStatus == "lowtohigh"){
                $query->orderBy('courses.course_price', 'ASC');
            }
            elseif($courseStatus == "hightolow"){
                $query->orderBy('courses.course_price', 'DESC');
            }
            else{
                $query->where('courses.course_status', $courseStatus)->orderBy('courses.id', 'DESC');
            }
                
            $course_list = $query->limit($limit)->get();
        }
        else{ 
            $query = Course::query();
            $query->join('categories as cat', 'courses.category_id', '=', 'cat.id')
            ->leftjoin('about_courses as ac', 'ac.course_id', '=', 'courses.id')
            ->join('authors as a', 'a.id', '=', 'courses.author_id')
            ->select('courses.*', 'ac.course_details', 'cat.category_name', 'a.author_name')->orderBy('courses.id', 'DESC');
            $query->where('course_status', '=', 'Default');
            $course_list = $query->limit($limit)->get();
        }


        if(count($course_list) > 0){
            $html = '';
            if(isset($data['design']) && $data['design'] != ''){
                $html = '<div class="traning-outer list-traning-outer">
							<ul>';
                foreach($course_list as $course){
                    $total_videos = DB::table('videos')->where('course_id', $course->id)->count();
                    $html.='<li class="trn-list">
					<div class="trn-top">
						<div class="list-trn-top">
							<div class="left">
								<h2 class="trn-title">'.ucwords($course->course_certification_type).'</h2>
								<div class="img-part">
									<img src="'.asset('public/assets/front/img/course/'.$course->course_image).'" alt="'.$course->course_name.'">
									<div class="ins">
										<p>'.ucwords($course->category_name).'</p>
										<h3>'.ucwords($course->course_name).'</h3>
									</div>
									<a class="learn-more" href="'.url('courses', str_replace(' ', '-', strtolower($course->course_name))).'">Learn More</a>
									<div class="quick-links">
										<ul>
											<li class="watch">
												<a href="'.url('courses', str_replace(' ', '-', strtolower($course->course_name))).'">
													<span class="icon"><i class="fa fa-eye"></i></span>
													<span class="con">Watch</span>
												</a>
												
											</li>
											<li class="buy-now">
												<a href="'.url('cart').'">
													<span class="icon"><i class="fa fa-rss"></i></span>
													<span class="con">Buy Now</span>
												</a>
												
											</li>
											<li class="cart" onclick="addToCart('."'".$course->course_name."'".', '."'".$course->id."'".')">
												<a href="javascript:void(0);">
													<span class="icon"><i class="fa fa-cart-plus"></i></span>
													<span class="con">Cart</span>
												</a>
											</li>
											<li class="favr" onclick="addToFav('."'".$course->course_name."'".', '."'".$course->id."'".')">
												<a href="javascript:void(0)">
													<span class="icon"><i class="fa fa-heart"></i></span>
													<span class="con">Favorite</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="right">
								<div class="after-img-part">
									<div class="left">
										<h2>'.ucwords($course->course_name).'</h2>
										<p class="con">'.$course->course_details.'</p>
									</div>
									<div class="right">
										<div class="take-cours"><a herf="#" onclick="addToCart('."'".$course->course_name."'".', '."'".$course->id."'".')" class="cus-btn">Take Course</a></div>
										<div class="calender-date">
											<div>
										        <div class="cal-month">
										            <h5>'.date("F", strtotime($course->course_start_date)).'</h5>  
										        </div>
										        <div class="cal-date">
										            <h2>'.date("d", strtotime($course->course_start_date)).'</h2>
										        </div>
										    </div>
										</div>
										<div class="rating-outer">
											<p class="rating-con">'.Helper::getRating($course->id)['str'].'</p>
											<div class="rating-star">
												<span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 1){ $html .= " checked"; } $html .= '"></span>
                                                <span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 2){ $html .= " checked"; } $html .= '"></span>
                                                <span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 3){ $html .= " checked"; } $html .= '"></span>
                                                <span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 4){ $html .= " checked"; } $html .= '"></span>
                                                <span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 5){ $html .= " checked"; } $html .= '"></span>
											</div>
										</div>
										<div class="count-lec">
											<p>'.$total_videos.' videos</p>
											<p>'.$course->author_name.'</p>
										</div>
									</div>
								</div>
							</div>
						</div>
							<div class="web-training-outer">
								<div class="lrn-option-outer">
									<p class="option-title">Available Learning Options</p>
									<ul class="option-crs">
										<li class="online">
											<a href="'.url('courses/type/online').'">
												<span class="icon"></span>
												<span class="con">Select Online Training</span>
											</a>
										</li>
										<li class="class-roome">
											<a href="'.url('courses/type/onsite').'">
												<span class="icon"></span>
												<span class="con">Select Onsite Classroom</span>
											</a>
										</li>
										<li class="other">
											<a href="'.url('courses/type/your-pace').'">
												<span class="icon"></span>
												<span class="con">Select Your Pace</span>
											</a>
										</li>
									</ul>
									
								</div>
								<div class="chat-outer">
									<ul>
										<li class="chat-with">
											<a href="javascript:void(0);" data-modalId="'.$course->id.'" class="openInsModal">Chat With Instructor</a>
										</li>
										<li class="price">
											<span class="old-price">';
                                            if($course->course_discout_type == "Percentage"){
                                                $newPrice = $course->course_price * $course->course_discout / 100;
                                                $newPrice = $course->course_price - $newPrice;
                                                $html .= Helper::changeCurrency($course->course_price);
                                            }
                                            elseif($course->course_discout_type == "Amount"){
                                                $newPrice = $course->course_price - $course->course_discout;
                                                $html .= Helper::changeCurrency($course->course_price);
                                            }
                                            else{
                                                $newPrice = $course->course_price;
                                            }
                                            $html .='</span>
                                            <span class="crunt-price">'.Helper::changeCurrency($newPrice).'</span>
										</li>
									</ul>
									<div class="radio-btn">
										<input type="radio" name="online">
										<span class="btn-radio">radio-btn</span>
									</div>
									<div class="request-btn">
										<a href="#">Request for Classroom Course</a>
									</div>
								</div>
							</div>
						</div>
					</li>';
                }
                $html.='</ul></div>';
            }
            else{
                foreach($course_list as $course){
                    $total_videos = DB::table('videos')->where('course_id', $course->id)->count();
                    $html.='
                    <li class="home-trn-list">
                        <div>
                            <h2 class="trn-title">'.ucwords($course->course_certification_type).'</h2>
                            <div class="img-part">
                                <img src="'.asset('public/assets/front/img/course/'.$course->course_image).'" alt="'.$course->course_name.'">
                                <div class="ins">
                                    <p>'.ucwords($course->category_name).'</p>
                                    <h3>'.ucwords($course->course_name).'</h3>
                                </div>
                                <a class="learn-more" href="'.url('courses', str_replace(' ', '-', strtolower($course->course_name))).'">Learn More</a>
                                <div class="quick-links">
                                    <ul>
                                        <li class="watch">
                                            <a href="'.url('courses', str_replace(' ', '-', strtolower($course->course_name))).'">
                                                <span class="icon"><i class="fa fa-eye"></i></span>
                                                <span class="con">Watch</span>
                                            </a>
                                        </li>
                                        <li class="buy-now">
                                            <a href="'.url('cart').'">
                                                <span class="icon"><i class="fa fa-rss"></i></span>
                                                <span class="con">Buy Now</span>
                                            </a>
                                        </li>
                                        <li class="cart" onclick="addToCart('."'".$course->course_name."'".', '."'".$course->id."'".')">
                                            <a href="javascript:void(0);">
                                                <span class="icon"><i class="fa fa-cart-plus"></i></span>
                                                <span class="con">Cart</span>
                                            </a>
                                        </li>
                                        <li class="favr" onclick="addToFav('."'".$course->course_name."'".', '."'".$course->id."'".')">
                                            <a href="javascript:void(0);">
                                                <span class="icon"><i class="fa fa-heart"></i></span>
                                                <span class="con">Favorite</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="web-training-outer">
                                <div class="after-img-part">
                                    <div class="left">
                                        <h2>'.ucwords($course->course_name).'</h2>
                                        <p class="con">';if(strlen($course->course_details)>175){ $html.=substr_replace($course->course_details, '...', 176); }else{$html.=$course->course_details;} $html .= '</p>
                                    </div>
                                    <div class="right">
                                        <div class="rating-outer">
                                            <p class="rating-con">'.Helper::getRating($course->id)['str'].'</p>
                                            <div class="rating-star">
                                                <span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 1){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                                                <span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 2){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                                                <span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 3){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                                                <span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 4){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                                                <span class="fa fa-star';if(Helper::getRating($course->id)['star_rating'] >= 5){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                                            </div>
                                        </div>
                                        <div class="count-lec">
                                            <p>'.$total_videos.' videos</p>
                                            <p>'.$course->author_name.'</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="lrn-option-outer">
                                    <p class="option-title">Available Learning Options</p>
                                    <ul class="option-crs">
                                        <li class="online">
                                            <a href="'.url('courses/type/online').'">
                                            <span class="icon"></span>
                                            <span class="con">Select Online Training</span>
                                            </a>
                                        </li>
                                        <li class="class-roome">
                                            <a href="'.url('courses/type/onsite').'">
                                            <span class="icon"></span>
                                            <span class="con">Select Onsite Classroom</span>
                                            </a>
                                        </li>
                                        <li class="other">
                                            <a href="'.url('courses/type/your-pace').'">
                                            <span class="icon"></span>
                                            <span class="con">Select Your Pace</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="take-cours"><a herf="#" onclick="addToCart('."'".$course->course_name."'".', '."'".$course->id."'".')" class="cus-btn">Take Course</a></div>
                                </div>
                                <div class="chat-outer">
                                    <ul>
                                        <li class="chat-with">
                                            <a href="javascript:void(0);" data-modalId="'.$course->id.'" class="openInsModal">Chat With Instructor</a>
                                        </li>
                                        <li class="price">
                                            <span class="old-price">';
                                            if($course->course_discout_type == "Percentage"){
                                                $newPrice = $course->course_price * $course->course_discout / 100;
                                                $newPrice = $course->course_price - $newPrice;
                                                $html .= Helper::changeCurrency($course->course_price);
                                            }
                                            elseif($course->course_discout_type == "Amount"){
                                                $newPrice = $course->course_price - $course->course_discout;
                                                $html .= Helper::changeCurrency($course->course_price);
                                            }
                                            else{
                                                $newPrice = $course->course_price;
                                            }
                                            $html .='</span>
                                            <span class="crunt-price">'.Helper::changeCurrency($newPrice).'</span>
                                        </li>
                                    </ul>
                                    <div class="radio-btn">
                                        <input type="radio" name="online">
                                        <span class="btn-radio">radio-btn</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>';
                }
            }
            return json_encode(['error' => 'false', 'result' => $html, 'msg' => 'Course Found']);
        }
        else{
            return json_encode(['error' => 'false', 'result' => array(), "msg" => "No Course Found"]);    
        }
    }
        
        
    public static function getCartHtml()
    {
        $gs = General_setting::first();
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            $cartData = DB::table('cart')
            ->join('courses as c', 'c.id', '=', 'cart.course_id')
            ->join('categories as cat', 'c.category_id', '=', 'cat.id')
            ->join('authors as a', 'a.id', '=', 'c.author_id')->where('cart.user_id', Auth::user()->id)
            ->select('cart.id as cid', 'c.*', 'cat.category_name', 'a.author_name')->orderBy('cart.id', 'DESC')->get();
        }
        else{
            if (session()->exists('cart')) {
                $sessionCart = Session::get('cart');
                $i = 0;
                $ids = [];
                while($i < count($sessionCart)){
                    $ids[] = $sessionCart[$i]['id'];
                    $i++;
                }
                $cartData = DB::table('courses as c')
                ->join('categories as cat', 'c.category_id', '=', 'cat.id')
                ->join('authors as a', 'a.id', '=', 'c.author_id')
                ->whereIn('c.id', $ids)
                ->select('c.*', 'cat.category_name', 'a.author_name')->orderBy('c.id', 'DESC')->get();
            }
            else{
                $cartData = [];
            }
            
        }
        
        if(count($cartData) > 0){
            $cart = '';
            $totalPrice = 0;
            $i = 0;
            foreach($cartData as $c){
                $cart .= '<div class="cart-all-pro-items">
        			<div class="pro-add-items">
        				<div class="cart-intro-outer">
        					<table>
        						<tbody>
        							<tr>
        								<td class="edit-outer">
        									<div class="edit-con">
        										<!--<a class="edit"><i class="fa fa-edit" aria-hidden="true"></i>edit</a>-->
        									</div>
        									<div class="add-remove-box">
        										<div class="add-cart-item">
        											<div class="add-box add-all">
        												<a>
        													<span class=""><input type="checkbox" class="checkSingle"value="';if(Auth::user()!==null && !empty(Auth::user())){ $cart.=$c->cid; }else{ $cart.=$i; }$cart.='"></span>
        													<span class="minus deleteItem" onclick="deleteFromCart(';if(Auth::user()!==null && !empty(Auth::user())){$cart.="'".$c->cid."'";}else{$cart.="'".$i."'";}$cart.=')">-</span>
        												</a>
        											</div>
        										</div>
        									</div>
        								</td>
        								<td><img src="'.asset('public/assets/front/img/course/'.$c->course_image).'" alt="car-image" class="image"/></td>
        								<td>
        									<h3 class="itro">'.ucwords($c->course_certification_type).'</h3>
        									<h2 class="pro-name">'.ucwords($c->course_name).'</h2>
        									<p class="curs-name">'.ucwords($c->category_name).'</p>
        									<p class="teacher-name">Class by '.ucwords($c->author_name).'</p>
        									<div class="buy-btn">';
        										//<button class="btn cus-btn">Buy Now</button>
        									$cart .='</div>
        									<div class="duration">
        										<span class="c-d">Class Duration</span>
        										<span class="wk">'.ucwords($c->course_duration).'</span>
        									</div
        									<div class="des">
        									    <span>';
        									    if($c->course_discout_type == 'Amount')
        									        $cart .='Get Amount '.$c->course_discout.' Discount.';
        									    elseif($c->course_discout_type == 'Percentage')
        									        $cart .='Get '.$c->course_discout.'% Discount.';
        									    else
        									        $cart .='No Discount Offer Available.';
        							
        									    $cart .= '</span>
        									</div>
        								</td>
        								<td>
        									<div class="crt-rating">
        										<div class="rating-outer">
        											<p class="rating-con">'.Helper::getRating($c->id)['str'].'</p>
        											<div class="rating-star">
        												<span class="fa fa-star';if(Helper::getRating($c->id)['star_rating'] >= 1){ $cart .= " checked"; }else{ $cart .= ""; } $cart .= '"></span>
                                                        <span class="fa fa-star';if(Helper::getRating($c->id)['star_rating'] >= 2){ $cart .= " checked"; }else{ $cart .= ""; } $cart .= '"></span>
                                                        <span class="fa fa-star';if(Helper::getRating($c->id)['star_rating'] >= 3){ $cart .= " checked"; }else{ $cart .= ""; } $cart .= '"></span>
                                                        <span class="fa fa-star';if(Helper::getRating($c->id)['star_rating'] >= 4){ $cart .= " checked"; }else{ $cart .= ""; } $cart .= '"></span>
                                                        <span class="fa fa-star';if(Helper::getRating($c->id)['star_rating'] >= 5){ $cart .= " checked"; }else{ $cart .= ""; } $cart .= '"></span>
        											</div>
        								        </div>
        									</div>
        									<!--<div class="Pro-code duration">-->
        									<!--	<span class="c-d">Promo Code :</span>-->
        									<!--	<input type="text" class="wk" placeholder="SPRING356"/>-->
        									<!--</div>-->
        								</td>
        								<td>
        									<div class="abt-class">
        										<span class="calendar">
        										    <div class="cart">
        										        <span class="con-title">Class Starts On</span>
												        <div class="cal-month">
												            <b>'.date("F", strtotime($c->course_start_date)).'</b>  
												        </div>
												        <div class="cal-date">
												            <b>'.date("d", strtotime($c->course_start_date)).'</b>
												        </div>
												    </div>
        										</span>
        									</div>
        									<div class="price">
        										<span><del>';
        										    if($c->course_discout_type == "Percentage"){
                                                        $newPrice = $c->course_price * $c->course_discout / 100;
                                                        $newPrice = $c->course_price - $newPrice;
                                                        $cart .= Helper::changeCurrency($c->course_price);
                                                    }
                                                    elseif($c->course_discout_type == "Amount"){
                                                        $newPrice = $c->course_price - $c->course_discout;
                                                        $cart .= Helper::changeCurrency($c->course_price);
                                                    }
                                                    else{
                                                        $newPrice = $c->course_price;
                                                    }
        										$cart .= '</del></span>'.Helper::changeCurrency($newPrice);
        										$totalPrice += $c->course_price;
        									$cart .= '</div>
        								</td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        			</div>
        		</div>';
        		$i++;
            }

            return json_encode(["error"=>"false", "data"=>$cart, "msg"=>"success", "totalItem"=>count($cartData), "totalPrice"=>Helper::changeCurrency($totalPrice), 'shippingCharges'=>Helper::changeCurrency($gs->shipping_charges), 'finalAmount'=>Helper::changeCurrency($gs->shipping_charges+$totalPrice)]);
        }
        else{
            return json_encode(["error"=>"true", "data"=>'', "msg"=>"<p style='text-align:center; margin:10px;'>Cart Is Empty.</p>", "totalItem"=>'0', "totalPrice"=>Helper::changeCurrency(0), 'shippingCharges'=>Helper::changeCurrency($gs->shipping_charges), 'finalAmount'=>Helper::changeCurrency($gs->shipping_charges+0)]);
        }
    }
    
    
    public static function getFavItems(){
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            $fav = DB::table('favorites as fav')
            ->join('courses as c', 'c.id', '=', 'fav.course_id')
            ->join('categories as cat', 'c.category_id', '=', 'cat.id')
            ->join('authors as a', 'a.id', '=', 'c.author_id')
            ->where('fav.user_id', Auth::user()->id)
            ->select('c.*', 'cat.category_name', 'fav.id as favid', 'a.author_name')->orderBy('fav.id', 'DESC')->get();
            
            if(count($fav) > 0){
                $html = '';
                $html .='<h2>Your Favorites List</h2>
						<div class="wish-list-item">
							<div class="save-item-outer">
								<span class="left">Saved Items</span>
								<span class="right">price</span>
							</div>';
							foreach($fav as $fav){
							    $html .= '<div class="wishlist-pro">
                            		<div class="cart-intro-outer">
                            			<table>
                            				<tbody>
                            					<tr>
                            						<td width="230px">
                            							<img src="'.asset('public/assets/front/img/course/'.$fav->course_image).'" alt="'.$fav->course_name.'" class="image">
                            							
                            						</td>
                            						<td>
                            							<h3 class="itro">'.ucwords($fav->course_certification_type).'</h3>
                            							<h2 class="pro-name">'.ucwords($fav->course_name).'</h2>
                            							<p class="curs-name">'.ucwords($fav->category_name).'</p>
                            							<p class="teacher-name">Class By '.ucwords($fav->author_name).'</p>
                            							<div class="buy-btn">
                            								<button class="btn cus-btn btn1" onclick="addToCart('."'".$fav->course_name."'".', '."'".$fav->id."'".')">Buy Now</button>
                            							</div>
                            							<div class="duration">
                            								<span class="c-d">Class Duration</span>
                            								<span class="wk">'.ucwords($fav->course_duration).'</span>
                            							</div>
                            							<div class="des"><b>';
                            							    if($fav->course_discout_type == 'Amount')
                            				                    $html.='Get Amount '.$fav->course_discout.' Discount.';
                            				                elseif($fav->course_discout_type == 'Percentage')
                            				                    $html.='Get '.$fav->course_discout.'% Discount.';
                            				                else
                            				                    $html.='No Discount Offer Available.';
                            							$html.='</b></div>
                            						</td>
                            						<td>
                            							<div class="crt-rating">
                            								<div class="rating-outer">
                        										<p class="rating-con">'.Helper::getRating($fav->id)['str'].'</p>
                        										<div class="rating-star">
                        											<span class="fa fa-star';if(Helper::getRating($fav->id)['star_rating'] >= 1){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                                                                    <span class="fa fa-star';if(Helper::getRating($fav->id)['star_rating'] >= 2){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                                                                    <span class="fa fa-star';if(Helper::getRating($fav->id)['star_rating'] >= 3){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                                                                    <span class="fa fa-star';if(Helper::getRating($fav->id)['star_rating'] >= 4){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                                                                    <span class="fa fa-star';if(Helper::getRating($fav->id)['star_rating'] >= 5){ $html .= " checked"; }else{ $html .= ""; } $html .= '"></span>
                        										</div>
                            								</div>
                            							</div>
                            							<a href="'.url('courses', str_replace(' ', '-', strtolower($fav->course_name))).'" class="learn-more">Learn More</a>
                            						</td>
                            						<td>
                            							<div class="abt-class">
                            								<span class="con-title">Class Starts On</span>
                            								<span class="calendar">
                            								    <div>
															        <div class="cal-month">
															            <h5>'.date("F", strtotime($fav->course_start_date)).'</h5>  
															        </div>
															        <div class="cal-date">
															            <h2>'.date("d", strtotime($fav->course_start_date)).'</h2>
															        </div>
															    </div>
                            								</span>
                            							</div>
                            						</td>
                            						<td style=" vertical-align: middle;   text-align: center;"  class="buy-btn">
                            							<a class="move btn cus-btn" onclick="moveToCart('."'".$fav->course_name."'".', '."'".$fav->id."'".');">Move to Cart</a>
                            							<a onclick="addToFav('."'".$fav->course_name."'".', '."'".$fav->id."'".');" class="btn cus-btn btn1">Remove</a>
                            							<div class="price">
                            								<span><del>';
                            								    if($fav->course_discout_type == "Percentage"){
                                                                    $newPrice = $fav->course_price * $fav->course_discout / 100;
                                                                    $newPrice = $fav->course_price - $newPrice;
                                                                    $html .= Helper::changeCurrency($fav->course_price);
                                                                }
                                                                elseif($fav->course_discout_type == "Amount"){
                                                                    $newPrice = $fav->course_price - $fav->course_discout;
                                                                    $html .= Helper::changeCurrency($fav->course_price);
                                                                }
                                                                else{
                                                                    $newPrice = $fav->course_price;
                                                                }
                            								$html.='</del></span>'.Helper::changeCurrency($newPrice).'
                            							</div>
                            						</td>
                            					</tr>
                            				</tbody>
                            			</table>
                            		</div>
                            	</div>';
							}
				$html .='</div>';
                return json_encode(['error'=>"false", 'data'=>$html]);
            }
            else{
                return json_encode(['error'=>"false", 'data'=>'<h2>Your Favorites List Is Empty</h2>']);
            }
        }
        else{
            return json_encode(['error'=>"true", 'data'=>'<h2>Your Favorites List Is Empty</h2>']);
        }
    }
    
    
    public static function getRating($course_id){
        $total_review = DB::table('reviews')->where('course_id', $course_id)->count();
        
        $rating = DB::table('reviews')
            ->groupBy('rating')
            ->select('rating', DB::raw('count(*) as total'))->where('course_id', $course_id)->get();
            
        $rating_count_total = $rating;
        $rat = 0;
        foreach($rating as $rating){
            $rating_data[] = $rating->rating;
            $rat += $rating->total * $rating->rating;
        }
        
        if($total_review > 0){
            return array('str' => '<br>'.round($rat/$total_review, 1).'</b>('.$total_review.')', 'star_rating' => round($rat/$total_review, 1));
        }
        else{
            return array('str' => '<br>0 Ratings</b>', 'star_rating' => 0);
        }
    }
    
    public static function getcountcart(){
        if(isset(Auth::user()->id) && Auth::user()->id != ''){
            return Cart::where('user_id', Auth::user()->id)->count();
        }
        else{
            if (!Session::exists('cart')) {
                return 0;
            }
            else{
                return count(Session::get('cart'));
            }
        }
    }
    
    public static function getCurrencyList(){
        $list = file_get_contents('https://api.exchangerate-api.com/v4/latest/USD');
        $list = json_decode($list);
        return $list->rates;
    }
    
    public static function changeCurrency($price, $currencyText = NULL, $currencyValue = NULL){
        if ($currencyText === NULL) {
            $currencyText = isset($_COOKIE['custom_currency'])?$_COOKIE['custom_currency']:"";
        }
        if ($currencyValue === NULL) {
            $currencyValue = isset($_COOKIE['custom_currency_value'])?$_COOKIE['custom_currency_value']:"";
        }
    
        if ($currencyValue=='') {
            $currencyValue = 1;
            $currencyText = '$';
        }
    
        $price = $price * $currencyValue;
        $price = round($price);
        $price = number_format($price);
    
        if ($currencyText == 'USD') {
            $currencyText = '$';
        }
    
        return "$currencyText$price";
    }
    
    public static function getCurrencyWithIp(){
        if(isset($_COOKIE['custom_currency'])){
            return $_COOKIE['custom_currency'];
        }
        else{
            $ip = $_SERVER["HTTP_X_REAL_IP"];
            $json = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);
            $details = json_decode($json);
            
            setcookie("custom_currency", $details->geoplugin_currencyCode, time() + (86400 * 30), "/");
            setcookie("custom_currency_value", $details->geoplugin_currencyConverter, time() + (86400 * 30), "/");
            // setcookie("custom_currency_value", $details->geoplugin_currencySymbol_UTF8, time() + (86400 * 30), "/");
            
            return $details->geoplugin_currencyCode;
        }
    }
}

?>