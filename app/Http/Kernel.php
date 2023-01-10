<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        
        'superadmin' => \App\Http\Middleware\Superadmin::class,
        'user' => \App\Http\Middleware\User::class,
        
        'create_user' => \App\Http\Middleware\users\create_user::class,
        'view_user' => \App\Http\Middleware\users\view_user::class,
        'update_user' => \App\Http\Middleware\users\update_user::class,
        'delete_user' => \App\Http\Middleware\users\delete_user::class,

        'create_blog' => \App\Http\Middleware\blogs\create_blog::class,
        'view_blog' => \App\Http\Middleware\blogs\view_blog::class,
        'update_blog' => \App\Http\Middleware\blogs\update_blog::class,
        'delete_blog' => \App\Http\Middleware\blogs\delete_blog::class,

        'create_blog_category' => \App\Http\Middleware\blogCategory\create_blog_category::class,
        'view_blog_category' => \App\Http\Middleware\blogCategory\view_blog_category::class,
        'update_blog_category' => \App\Http\Middleware\blogCategory\update_blog_category::class,
        'delete_blog_category' => \App\Http\Middleware\blogCategory\delete_blog_category::class,

        'create_author' => \App\Http\Middleware\authors\create_author::class,
        'view_author' => \App\Http\Middleware\authors\view_author::class,
        'update_author' => \App\Http\Middleware\authors\update_author::class,
        'delete_author' => \App\Http\Middleware\authors\delete_author::class,

        'create_category' => \App\Http\Middleware\categories\create_category::class,
        'view_category' => \App\Http\Middleware\categories\view_category::class,
        'update_category' => \App\Http\Middleware\categories\update_category::class,
        'delete_category' => \App\Http\Middleware\categories\delete_category::class,

        'create_sub_category' => \App\Http\Middleware\subCayegories\create_sub_category::class,
        'view_sub_category' => \App\Http\Middleware\subCayegories\view_sub_category::class,
        'update_sub_category' => \App\Http\Middleware\subCayegories\update_sub_category::class,
        'delete_sub_category' => \App\Http\Middleware\subCayegories\delete_sub_category::class,

        'create_course' => \App\Http\Middleware\courses\create_course::class,
        'view_course' => \App\Http\Middleware\courses\view_course::class,
        'update_course' => \App\Http\Middleware\courses\update_course::class,
        'delete_course' => \App\Http\Middleware\courses\delete_course::class,

        'create_about_course' => \App\Http\Middleware\aboutCourse\create_about_course::class,
        'view_about_course' => \App\Http\Middleware\aboutCourse\view_about_course::class,
        'update_about_course' => \App\Http\Middleware\aboutCourse\update_about_course::class,
        'delete_about_course' => \App\Http\Middleware\aboutCourse\delete_about_course::class,

        'create_course_resource' => \App\Http\Middleware\courseResource\create_course_resource::class,
        'view_course_resource' => \App\Http\Middleware\courseResource\view_course_resource::class,
        'update_course_resource' => \App\Http\Middleware\courseResource\update_course_resource::class,
        'delete_course_resource' => \App\Http\Middleware\courseResource\delete_course_resource::class,

        'create_course_assignment' => \App\Http\Middleware\courseAssignment\create_course_assignment::class,
        'view_course_assignment' => \App\Http\Middleware\courseAssignment\view_course_assignment::class,
        'update_course_assignment' => \App\Http\Middleware\courseAssignment\update_course_assignment::class,
        'delete_course_assignment' => \App\Http\Middleware\courseAssignment\delete_course_assignment::class,

        'create_learning_option' => \App\Http\Middleware\learnOption\create_learning_option::class,
        'view_learning_option' => \App\Http\Middleware\learnOption\view_learning_option::class,
        'update_learning_option' => \App\Http\Middleware\learnOption\update_learning_option::class,
        'delete_learning_option' => \App\Http\Middleware\learnOption\delete_learning_option::class,

        'create_video' => \App\Http\Middleware\video\create_video::class,
        'view_video' => \App\Http\Middleware\video\view_video::class,
        'update_video' => \App\Http\Middleware\video\update_video::class,
        'delete_video' => \App\Http\Middleware\video\delete_video::class,

        'create_curriculum' => \App\Http\Middleware\curriculum\create_curriculum::class,
        'view_curriculum' => \App\Http\Middleware\curriculum\view_curriculum::class,
        'update_curriculum' => \App\Http\Middleware\curriculum\update_curriculum::class,
        'delete_curriculum' => \App\Http\Middleware\curriculum\delete_curriculum::class,

        'create_course_schedule' => \App\Http\Middleware\courseSchedule\create_course_schedule::class,
        'view_course_schedule' => \App\Http\Middleware\courseSchedule\view_course_schedule::class,
        'update_course_schedule' => \App\Http\Middleware\courseSchedule\update_course_schedule::class,
        'delete_course_schedule' => \App\Http\Middleware\courseSchedule\delete_course_schedule::class,

        'create_review' => \App\Http\Middleware\review\create_review::class,
        'view_review' => \App\Http\Middleware\review\view_review::class,
        'update_review' => \App\Http\Middleware\review\update_review::class,
        'delete_review' => \App\Http\Middleware\review\delete_review::class,

        'create_faq' => \App\Http\Middleware\faq\create_faq::class,
        'view_faq' => \App\Http\Middleware\faq\view_faq::class,
        'update_faq' => \App\Http\Middleware\faq\update_faq::class,
        'delete_faq' => \App\Http\Middleware\faq\delete_faq::class,
        'show_faq' => \App\Http\Middleware\faq\show_faq::class,

        'create_test' => \App\Http\Middleware\test\create_test::class,
        'view_test' => \App\Http\Middleware\test\view_test::class,
        'update_test' => \App\Http\Middleware\test\update_test::class,
        'delete_test' => \App\Http\Middleware\test\delete_test::class,

        'create_page' => \App\Http\Middleware\page\create_page::class,
        'view_page' => \App\Http\Middleware\page\view_page::class,
        'update_page' => \App\Http\Middleware\page\update_page::class,
        'delete_page' => \App\Http\Middleware\page\delete_page::class,

        'create_forum' => \App\Http\Middleware\forum\create_forum::class,
        'view_forum' => \App\Http\Middleware\forum\view_forum::class,
        'update_forum' => \App\Http\Middleware\forum\update_forum::class,
        'delete_forum' => \App\Http\Middleware\forum\delete_forum::class,
        'show_forum' => \App\Http\Middleware\forum\show_forum::class,

        'create_subscription' => \App\Http\Middleware\subscription\create_subscription::class,
        'view_subscription' => \App\Http\Middleware\subscription\view_subscription::class,
        'update_subscription' => \App\Http\Middleware\subscription\update_subscription::class,
        'delete_subscription' => \App\Http\Middleware\subscription\delete_subscription::class,

        'create_menu' => \App\Http\Middleware\menu\create_menu::class,
        'view_menu' => \App\Http\Middleware\menu\view_menu::class,
        'update_menu' => \App\Http\Middleware\menu\update_menu::class,
        'delete_menu' => \App\Http\Middleware\menu\delete_menu::class,

        'view_chat' => \App\Http\Middleware\chat\view_chat::class,

        'create_role' => \App\Http\Middleware\role\create_role::class,
        'view_role' => \App\Http\Middleware\role\view_role::class,
        'update_role' => \App\Http\Middleware\role\update_role::class,
        'delete_role' => \App\Http\Middleware\role\delete_role::class,

        'update_permission' => \App\Http\Middleware\role\update_permission::class,

        'view_website_setting' => \App\Http\Middleware\websiteSetting\view_website_setting::class,
        'update_website_setting' => \App\Http\Middleware\websiteSetting\update_website_setting::class,

        'create_business' => \App\Http\Middleware\business\create_business::class,
        'view_business' => \App\Http\Middleware\business\view_business::class,
        'update_business' => \App\Http\Middleware\business\update_business::class,
        'delete_business' => \App\Http\Middleware\business\delete_business::class,

        'create_email_template' => \App\Http\Middleware\emailTemplate\create_email_template::class,
        'view_email_template' => \App\Http\Middleware\emailTemplate\view_email_template::class,
        'update_email_template' => \App\Http\Middleware\emailTemplate\update_email_template::class,
        'delete_email_template' => \App\Http\Middleware\emailTemplate\delete_email_template::class,

        'view_ticket' => \App\Http\Middleware\ticket\view_ticket::class,
        'delete_ticket' => \App\Http\Middleware\ticket\delete_ticket::class,
        'reply_ticket' => \App\Http\Middleware\ticket\reply_ticket::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
