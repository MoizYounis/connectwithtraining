<?php
//admin route
// Route::get('AdminLogin/', 'Admin\LoginController@showLoginForm')->name('admin.login');
// Route::post('authenticate', 'Admin\LoginController@authenticate')->name('admin.authenticate');

Route::group(['middleware' => ['auth','superadmin']], function(){

	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('admin-password/reset', 'Admin\ResetPasswordController@reset');
	Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

	//admin dashboard
	Route::get('dashboard', 'Admin\AdminController@index')->name('admin_dashboard');
	Route::get('profile', 'Admin\AdminController@admin_profile');
	Route::post('profile/update', 'Admin\AdminController@update_admin_profile')->name('update_admin_profile');
	Route::get('password', 'Admin\AdminController@admin_password');
	Route::put('changePassword', 'Admin\AdminController@change_password')->name('change_password');

	//category
	Route::resource('category', 'Admin\CategoryController');
	Route::post('category/upload/image', 'Admin\CategoryController@upload_image');
	Route::post('category/upload/banner', 'Admin\CategoryController@upload_banner');

	//brand
	// Route::resource('brand', 'Admin\BrandController');
	// Route::post('brand/upload/image', 'Admin\BrandController@upload_image');
	// Route::post('brand/upload/banner', 'Admin\BrandController@upload_banner');
	// Route::get('brand', 'Admin\BrandController@index');
	// Route::get('brand/fetchdata', 'Admin\BrandController@fetchdata');
	// Route::post('brand/store', 'Admin\BrandController@store');
	// Route::any('brand/delete/{id}', 'Admin\BrandController@destroy');
	// Route::any('brand/edit/{id}', 'Admin\BrandController@edit');




	//sub-category
	Route::resource('subcategory', 'Admin\SubCatConroller');
	Route::post('subcategory/upload/image', 'Admin\SubCatConroller@upload_image');
	Route::post('subcategory/upload/banner', 'Admin\SubCatConroller@upload_banner');

	//sub-menu
	Route::resource('childcategory', 'Admin\ChildCatConroller');
	Route::post('childcategory/upload/image', 'Admin\ChildCatConroller@upload_image');
	Route::post('childcategory/upload/banner', 'Admin\ChildCatConroller@upload_banner');

	//admin review
	Route::resource('review', 'Admin\ReviewController');

	//order
	Route::resource('order', 'Admin\OrderController');
	Route::any('order/status/update/{invoice_order_id}/{status}', 'Admin\OrderController@update_status_update');
	Route::any('order/detail/{invoice_order_id}', 'Admin\OrderController@order_invoice_detail');

	//user
	Route::get('user_list', 'Admin\UserController@index')->middleware('view_user');
	Route::get('add_user', 'Admin\UserController@add_user')->middleware('create_user');
	Route::post('user/create', 'Admin\UserController@create_user')->middleware('create_user');
	Route::delete('user/destroy/{id}', 'Admin\UserController@destroy')->middleware('delete_user');

	Route::get('user_status_update/{id}/{value}', 'Admin\UserController@status_update')
				->name('user_status_update');
	Route::get('user/profile/{id}', 'Admin\UserController@user_profile')->name('user_profile');
	
	Route::get('user/edit/{id}', 'Admin\UserController@edit_user')->middleware('update_user');
	Route::post('user/update/{id}', 'Admin\UserController@update_user')->middleware('update_user');
	Route::post('user/upload/image', 'Admin\UserController@upload_image');


	//banner
// 	Route::get('banner/list', 'Admin\BannerController@banner_list')->name('banner_list');
// 	Route::get('banner/add', 'Admin\BannerController@add_banner')->name('add_banner');
// 	Route::post('banner/create', 'Admin\BannerController@create_banner')->name('create_banner');
// 	Route::get('banner/edit/{banner_id}', 'Admin\BannerController@edit_banner')->name('edit_banner');
// 	Route::post('banner/update/{banner_id}', 'Admin\BannerController@update_banner')->name('update_banner');
// 	Route::delete('banner/destroy/{banner_id}', 'Admin\BannerController@destroy');

	// payment history
	Route::resource('payment', 'Admin\PayController');

	//admin contact panel
	Route::get('contact', 'Admin\ContactController@contact')->name('admin.contact');
	Route::delete('contact/destroy/{id}', 'Admin\ContactController@destroy');

	Route::get('subscribers', 'Admin\SubscriberController@index');
	Route::delete('subscribers/destroy/{id}', 'Admin\SubscriberController@destroy');
    Route::post('subscribers/update/discount', 'Admin\SubscriberController@update_discount');

	//logo icon
	Route::get('website/setting', 'Admin\FrontendSettingController@index');
	Route::post('website/upload_logo', 'Admin\FrontendSettingController@upload_logo');
	Route::post('website/update/logo', 'Admin\FrontendSettingController@logoicon_update');

	//social
	Route::get('frontend/social', 'Admin\FrontendSettingController@social')->name('social');
	Route::post('frontend/socialAdd', 'Admin\FrontendSettingController@socialAdd');
	Route::post('socialAdd/destroy/{social_id}', 'Admin\FrontendSettingController@socialDestroy');

	//aboutus
	Route::get('frontend/aboutus', 'Admin\FrontendSettingController@aboutus')->name('aboutus');
	Route::post('frontend/aboutus_update', 'Admin\FrontendSettingController@aboutus_update')->name('aboutus_update');

	//footer
	Route::post('website/updateFooter', 'Admin\FrontendSettingController@updateFooter');

	//contactus
	Route::get('frontend/contactus', 'Admin\FrontendSettingController@contactus')->name('contactus');
	Route::post('frontend/contactus_update', 'Admin\FrontendSettingController@contactus_update')->name('contactus_update');

	Route::get('frontend/privacy-policy', 'Admin\FrontendSettingController@privacy')->name('admin.privacy');
	Route::post('frontend/privacy_update', 'Admin\FrontendSettingController@privacy_update')->name('privacy_update');

	Route::get('frontend/terms', 'Admin\FrontendSettingController@terms')->name('admin.terms');
	Route::post('frontend/terms/update', 'Admin\FrontendSettingController@terms_update')->name('terms_update');

    //homepage banner
	Route::get('homepage/banner', 'Admin\FrontendSettingController@homepageBanner');
	Route::post('homepage/banner/update', 'Admin\FrontendSettingController@homepageBannerUpdate');
	
	//public reviews
	Route::resource('reviews', 'Admin\PublicReviewController');


	//email template
	Route::resource('emailTemplate', 'Admin\EmailTemplateController');

	Route::post('import', 'Admin\ImportController@import');

	Route::resource('blog', 'Admin\BlogController');
	Route::resource('blogcategory', 'Admin\BlogCatController');
	Route::resource('pricing', 'Admin\PricingController');
	Route::resource('author', 'Admin\AuthorController');	
	
	Route::resource('course', 'Admin\CourseController');
	Route::post('course/upload/image', 'Admin\CourseController@upload_image');
	Route::resource('courseResources', 'Admin\CourseResourcesController');
	Route::resource('courseAssignment', 'Admin\CourseAssignmentController');
	
	Route::resource('staticPage', 'Admin\StaticPageController');
	Route::resource('forum', 'Admin\ForumController');
	Route::resource('learningOption', 'Admin\LearnOptionController');
	Route::resource('video', 'Admin\VideoController');
	Route::post('video/upload/image', 'Admin\VideoController@upload_image');
	Route::post('video/upload/video', 'Admin\VideoController@upload_video');
	Route::resource('aboutCourse', 'Admin\AboutCourseController');
	Route::resource('test', 'Admin\TestController');
	Route::resource('curriculum', 'Admin\CurriculumController');
	Route::resource('faq', 'Admin\FaqController');
	Route::resource('review', 'Admin\ReviewController');
	Route::resource('schedule', 'Admin\ScheduleController');
	Route::resource('instructor', 'Admin\ScheduleController');
	Route::resource('roles', 'Admin\RoleController');
	Route::post('updatePermission', 'Admin\RoleController@updatePermission');
	Route::resource('business', 'Admin\BusinessController');
	Route::resource('inssupport', 'Admin\InssupportController');


	Route::resource('subscription', 'Admin\SubscriptionController');
	Route::resource('menu', 'Admin\MenuController');
	
	Route::get('chat', 'Admin\ChatController@index');
	Route::get('chat/get_another_user/{user_id}', 'Admin\ChatController@get_another_user');
	Route::post('chat/sendMsg', 'Admin\ChatController@send');

	Route::any('chat/sendMsg', 'Admin\ChatController@send');
	Route::any('chat/getMsgs/{user_id}/{another_user_id}', 'Admin\ChatController@getmsgs');

	Route::get('ticket', 'Admin\TicketController@index')->middleware('view_ticket');
	Route::delete('ticket/destroy/{id}', 'Admin\TicketController@destroy')->middleware('delete_ticket');
	Route::get('ticket/statusUpdate', 'Admin\TicketController@update_status');
	Route::get('ticket/reply/{id}', 'Admin\TicketController@reply')->middleware('reply_ticket');
	Route::post('ticket/sendReply', 'Admin\TicketController@sendReply')->middleware('reply_ticket');

});
?>