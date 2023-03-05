<?php

//frontend
Route::get('not_allowed', function () {return view('errors.403');});
Route::get('/', 'Front\HomeController@home')->name('home');
Route::get('/forgot_password', 'Auth\ForgotPasswordController@forgotPassword')->name('user_forgot_password');
Route::get('read_blog/{id}', 'Front\HomeController@readBlog');
Route::post('filterBy', 'Front\CourseController@filterBy');

Route::post('subscribe', 'Front\HomeController@subscribe');

//save review
Route::post('review', 'Front\HomeController@review');

//apply coupon
Route::post('validate/coupon', 'Front\HomeController@coupon');

Route::get('checkout', 'Front\CartController@checkout');
Route::get('order-summary', 'Front\CartController@order_summary');

//payment plan
Route::get('payment-plan', 'Front\PaymentController@payment_plan');

Route::get('thankyou', 'Front\PaymentController@thankyou');

//cart ajax
Route::post('getCartHtml', 'Front\CartController@getCartHtml');
Route::post('deleteCartItemHtml', 'Front\CartController@deleteCartItemHtml');
//cart db
Route::resource('cart', 'Front\CartController');
Route::get('cart/update/{cart_id}/{quantity}', 'Front\CartController@update');

//add to cart
Route::post('addtocart', 'Front\CartController@addtocart');
Route::any('getcountcart', 'Front\CartController@getcountcart');
Route::post('emptyCart', 'Front\CartController@emptyCart');

//add to fav
Route::post('getFavItems', 'Front\CartController@getFavItems');
Route::post('addtofav', 'Front\CartController@addtofav');
Route::post('deleteFromFav', 'Front\CartController@deleteFromFav');

//related, polpular, featured
Route::post('getRelatedCourse', 'Front\CourseController@getRelatedCourse');

//getCourseByCart
Route::post('getCourseByCart', 'Front\CourseController@getCourseByCart');

//set cookie
Route::post('setCurrency', 'Front\HomeController@setCurrencyCookie');

//create course
Route::get('create-course', function () {return view('front.createCourse.index');});

//refer a friend
Route::get('refer-a-friend', 'Front\ReferController@referpage');
Route::get('refer-program', 'Front\ReferController@referProgram');
Route::get('refer-program-invitation', 'Front\ReferController@referProgramInvitation');
Route::post('referSendMail', 'Front\ReferController@referSendMail');

Route::get('page/{slug}', 'Front\HomeController@callStaticPage');
Route::get('about', 'Front\HomeController@aboutPage');
Route::get('contact', 'Front\HomeController@contactusPage');
Route::get('services', function () {return view('front.pages.service');});
Route::post('contact/submit', 'Front\HomeController@contactSubmit');
Route::get('faq', 'Front\HomeController@callStaticPage');
Route::get('privacy-policy', 'Front\HomeController@callStaticPage');
Route::get('terms-conditions', 'Front\HomeController@callStaticPage');
Route::get('trust-safety', 'Front\HomeController@callStaticPage');
Route::get('security', 'Front\HomeController@callStaticPage');
Route::get('legal', 'Front\HomeController@callStaticPage');
Route::get('press', 'Front\HomeController@callStaticPage');
Route::get('copyrights', 'Front\HomeController@callStaticPage');
Route::get('fees-charges', 'Front\HomeController@callStaticPage');
Route::get('our-payment-plan', 'Front\HomeController@callStaticPage');
Route::get('giving-back', 'Front\HomeController@callStaticPage');
Route::get('coming-soon', 'Front\HomeController@callStaticPage');

Route::get('become-an-instructor', 'Front\HomeController@become_an_instructor');

Route::get('courses', 'Front\CourseController@index');
Route::get('courses/{slug}', 'Front\CourseController@course_details');
Route::get('courses/type/{slug}', 'Front\CourseController@index');

//chat with instructor
Route::post('chatWithInstructor', 'Front\HomeController@chatWithInstructor');

Route::get('gift-card', function () {return view('front.gift.gift-card');});

Route::get('get-more', 'Front\GetMoreController@getmore');
Route::get('how-it-works', 'Front\GetMoreController@howItWorks');
Route::get('interview-questions', 'Front\GetMoreController@interview_question');
Route::get('extensive-interview-plans', 'Front\GetMoreController@extensive_interview_plans');
Route::get('resume-building', 'Front\GetMoreController@resume_building');

//===================================User section=================================
//================================================================================
Route::any('userLogin', 'Auth\LoginController@authenticate');
Route::group(['middleware' => ['auth', 'user']], function () {
    Route::get('/user/dashboard', 'Front\UserController@index')->name('user_dashboard');
    Route::get('/user/delete/account', 'Front\UserController@deleteAccount')->name('delete_account');
    Route::get('/get/user/change/password', 'Front\UserController@changePassword')->name('get.change.password');
    Route::get('/add/payment/info', 'Front\UserController@addPaymentInfo')->name('add.payment.info');
    Route::post('/save/payment/info', 'Front\UserController@savePaymentInfo')->name('save.payment.info');
    Route::get('/update/payment/info', 'Front\UserController@updatePaymentInfo')->name('update.payment.info');
    //pay
    Route::post('pay', 'Front\PaymentController@pay');
    Route::get('/user/profile', 'Front\UserController@user_profile')->name('user_profile');
    Route::post('/user/profile/update', 'Front\UserController@update_user_profile')->name('update_user_profile');
    Route::post('user/profile/pic/update', 'Front\UserController@update_profile_pic');
    Route::get('/user/password', 'Front\UserController@user_password')->name('user_password');
    Route::any('/user/changePassword', 'Front\UserController@change_password')->name('user.change_password');
    Route::post('user/account/delete', 'Front\UserController@delete_account');
    Route::get('/user/installments', 'Front\UserController@userInstallments')->name('user.installments');
    //user order list
    Route::get('user/myorders', 'Front\UserController@my_orders');
    Route::any('user/order/detail/{invoice_order_id}', 'Front\UserController@order_invoice_detail');
    Route::any('user/cancel/order/{invoice_order_id}', 'Front\UserController@cancel_order');
});
//->middleware('verified')

Auth::routes(['verify' => true]);
