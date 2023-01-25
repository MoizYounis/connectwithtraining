<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\User_type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_role')->only(['create', 'store']);
        $this->middleware('view_role')->only('index');
        $this->middleware('update_role')->only(['edit', 'update']);
        $this->middleware('delete_role')->only('destroy');
        $this->middleware('update_permission')->only('show');
        $this->Permission = $permission;
    }

    public function index()
    {
        $type_list = User_type::all();
        $getPermission = $this->Permission->getPermission();
        return view('admin.role.list', compact('type_list', 'getPermission'));
    }

    public function create()
    {
        return $this->index();
    }

    public function store(Request $request, User_type $ut)
    {
        $request->validate([
            'type_name' => 'required|regex:/^[a-zA-Z0-9\pL\s]+$/u|unique:user_types',
        ]);
        $data = $request->all();
        $type_id = $ut->create($data)->id;
        Permission::create(['user_type_id' => $type_id]);
        return back()->withSuccess('Role created successfully');
    }

    public function edit()
    {
        return $this->index();
    }

    //update
    public function update(Request $request, $role_id)
    {
        $request->validate([
            'type_name' => ['required', 'regex:/^[a-zA-Z0-9\pL\s]+$/u', Rule::unique('user_types')->ignore($role_id)],
        ]);

        $ut = User_type::find($role_id);
        $data = $request->all();
        $ut->update($data);
        return redirect()->back()->withSuccess("Role updated successfully");
    }

    //delete
    public function destroy($role_id)
    {
        $ut = User_type::find($role_id);
        $ut->delete();
        return redirect()->back()->withSuccess('Role deleted successfully');
    }

    public function show($role_id)
    {
        $getPermission = $this->Permission->getPermission();
        $roles = Permission::join('user_types as t', 't.id', '=', 'permissions.user_type_id')
            ->where('user_type_id', $role_id)->get();
        if (count($roles) > 0) {
            $result['type_name'] = $roles[0]->type_name;
            $result['type_id'] = $roles[0]->id;

            $user_view = $roles[0]->user_view;
            $user_create = $roles[0]->user_create;
            $user_update = $roles[0]->user_update;
            $user_delete = $roles[0]->user_delete;

            $blog_view = $roles[0]->blog_view;
            $blog_create = $roles[0]->blog_create;
            $blog_update = $roles[0]->blog_update;
            $blog_delete = $roles[0]->blog_delete;

            $blog_category_view = $roles[0]->blog_category_view;
            $blog_category_create = $roles[0]->blog_category_create;
            $blog_category_update = $roles[0]->blog_category_update;
            $blog_category_delete = $roles[0]->blog_category_delete;

            $author_view = $roles[0]->author_view;
            $author_create = $roles[0]->author_create;
            $author_update = $roles[0]->author_update;
            $author_delete = $roles[0]->author_delete;

            $category_view = $roles[0]->category_view;
            $category_create = $roles[0]->category_create;
            $category_update = $roles[0]->category_update;
            $category_delete = $roles[0]->category_delete;

            $sub_category_view = $roles[0]->sub_category_view;
            $sub_category_create = $roles[0]->sub_category_create;
            $sub_category_update = $roles[0]->sub_category_update;
            $sub_category_delete = $roles[0]->sub_category_delete;

            $course_view = $roles[0]->course_view;
            $course_create = $roles[0]->course_create;
            $course_update = $roles[0]->course_update;
            $course_delete = $roles[0]->course_delete;

            $about_course_view = $roles[0]->about_course_view;
            $about_course_create = $roles[0]->about_course_create;
            $about_course_update = $roles[0]->about_course_update;
            $about_course_delete = $roles[0]->about_course_delete;

            $course_resource_view = $roles[0]->course_resource_view;
            $course_resource_create = $roles[0]->course_resource_create;
            $course_resource_update = $roles[0]->course_resource_update;
            $course_resource_delete = $roles[0]->course_resource_delete;

            $course_assignment_view = $roles[0]->course_assignment_view;
            $course_assignment_create = $roles[0]->course_assignment_create;
            $course_assignment_update = $roles[0]->course_assignment_update;
            $course_assignment_delete = $roles[0]->course_assignment_delete;

            $learning_option_view = $roles[0]->learning_option_view;
            $learning_option_create = $roles[0]->learning_option_create;
            $learning_option_update = $roles[0]->learning_option_update;
            $learning_option_delete = $roles[0]->learning_option_delete;

            $video_view = $roles[0]->video_view;
            $video_create = $roles[0]->video_create;
            $video_update = $roles[0]->video_update;
            $video_delete = $roles[0]->video_delete;

            $curriculum_view = $roles[0]->curriculum_view;
            $curriculum_create = $roles[0]->curriculum_create;
            $curriculum_update = $roles[0]->curriculum_update;
            $curriculum_delete = $roles[0]->curriculum_delete;

            $course_schedule_view = $roles[0]->course_schedule_view;
            $course_schedule_create = $roles[0]->course_schedule_create;
            $course_schedule_update = $roles[0]->course_schedule_update;
            $course_schedule_delete = $roles[0]->course_schedule_delete;

            $review_view = $roles[0]->review_view;
            $review_create = $roles[0]->review_create;
            $review_update = $roles[0]->review_update;
            $review_delete = $roles[0]->review_delete;

            $faq_view = $roles[0]->faq_view;
            $faq_create = $roles[0]->faq_create;
            $faq_update = $roles[0]->faq_update;
            $faq_delete = $roles[0]->faq_delete;
            $faq_show = $roles[0]->faq_show;

            $test_view = $roles[0]->test_view;
            $test_create = $roles[0]->test_create;
            $test_update = $roles[0]->test_update;
            $test_delete = $roles[0]->test_delete;

            $page_view = $roles[0]->page_view;
            $page_create = $roles[0]->page_create;
            $page_update = $roles[0]->page_update;
            $page_delete = $roles[0]->page_delete;

            $forum_view = $roles[0]->forum_view;
            $forum_create = $roles[0]->forum_create;
            $forum_update = $roles[0]->forum_update;
            $forum_delete = $roles[0]->forum_delete;
            $forum_show = $roles[0]->forum_show;

            $subscription_view = $roles[0]->subscription_view;
            $subscription_create = $roles[0]->subscription_create;
            $subscription_update = $roles[0]->subscription_update;
            $subscription_delete = $roles[0]->subscription_delete;

            $menu_view = $roles[0]->menu_view;
            $menu_create = $roles[0]->menu_create;
            $menu_update = $roles[0]->menu_update;
            $menu_delete = $roles[0]->menu_delete;

            $chat_view = $roles[0]->chat_view;

            $role_view = $roles[0]->role_view;
            $role_create = $roles[0]->role_create;
            $role_update = $roles[0]->role_update;
            $role_delete = $roles[0]->role_delete;

            $permission_update = $roles[0]->permission_update;

            $website_setting_view = $roles[0]->website_setting_view;
            $website_setting_update = $roles[0]->website_setting_update;

            $business_view = $roles[0]->business_view;
            $business_create = $roles[0]->business_create;
            $business_update = $roles[0]->business_update;
            $business_delete = $roles[0]->business_delete;

            $email_template_view = $roles[0]->email_template_view;
            $email_template_create = $roles[0]->email_template_create;
            $email_template_update = $roles[0]->email_template_update;
            $email_template_delete = $roles[0]->email_template_delete;

            $ticket_view = $roles[0]->ticket_view;
            $ticket_reply = $roles[0]->ticket_reply;
            $ticket_delete = $roles[0]->ticket_delete;

            $pricing_view = $roles[0]->pricing_view;
            $pricing_create = $roles[0]->pricing_create;
            $pricing_update = $roles[0]->pricing_update;
            $pricing_delete = $roles[0]->pricing_delete;

        } else {
            $user_view = 0;
            $user_create = 0;
            $user_update = 0;
            $user_delete = 0;

            $blog_view = 0;
            $blog_create = 0;
            $blog_update = 0;
            $blog_delete = 0;

            $blog_category_view = 0;
            $blog_category_create = 0;
            $blog_category_update = 0;
            $blog_category_delete = 0;

            $author_view = 0;
            $author_create = 0;
            $author_update = 0;
            $author_delete = 0;

            $category_view = 0;
            $category_create = 0;
            $category_update = 0;
            $category_delete = 0;

            $sub_category_view = 0;
            $sub_category_create = 0;
            $sub_category_update = 0;
            $sub_category_delete = 0;

            $course_view = 0;
            $course_create = 0;
            $course_update = 0;
            $course_delete = 0;

            $about_course_view = 0;
            $about_course_create = 0;
            $about_course_update = 0;
            $about_course_delete = 0;

            $course_resource_view = 0;
            $course_resource_create = 0;
            $course_resource_update = 0;
            $course_resource_delete = 0;

            $course_assignment_view = 0;
            $course_assignment_create = 0;
            $course_assignment_update = 0;
            $course_assignment_delete = 0;

            $learning_option_view = 0;
            $learning_option_create = 0;
            $learning_option_update = 0;
            $learning_option_delete = 0;

            $video_view = 0;
            $video_create = 0;
            $video_update = 0;
            $video_delete = 0;

            $curriculum_view = 0;
            $curriculum_create = 0;
            $curriculum_update = 0;
            $curriculum_delete = 0;

            $course_schedule_view = 0;
            $course_schedule_create = 0;
            $course_schedule_update = 0;
            $course_schedule_delete = 0;

            $review_view = 0;
            $review_create = 0;
            $review_update = 0;
            $review_delete = 0;

            $faq_view = 0;
            $faq_create = 0;
            $faq_update = 0;
            $faq_delete = 0;
            $faq_show = 0;

            $test_view = 0;
            $test_create = 0;
            $test_update = 0;
            $test_delete = 0;

            $page_view = 0;
            $page_create = 0;
            $page_update = 0;
            $page_delete = 0;

            $forum_view = 0;
            $forum_create = 0;
            $forum_update = 0;
            $forum_delete = 0;
            $forum_show = 0;

            $subscription_view = 0;
            $subscription_create = 0;
            $subscription_update = 0;
            $subscription_delete = 0;

            $menu_view = 0;
            $menu_create = 0;
            $menu_update = 0;
            $menu_delete = 0;

            $chat_view = 0;

            $role_view = 0;
            $role_create = 0;
            $role_update = 0;
            $role_delete = 0;

            $permission_update = 0;

            $website_setting_view = 0;
            $website_setting_update = 0;

            $business_view = 0;
            $business_create = 0;
            $business_update = 0;
            $business_delete = 0;

            $email_template_view = 0;
            $email_template_create = 0;
            $email_template_update = 0;
            $email_template_delete = 0;

            $ticket_view = 0;
            $ticket_reply = 0;
            $ticket_delete = 0;

            $pricing_view = 0;
            $pricing_create = 0;
            $pricing_update = 0;
            $pricing_delete = 0;

        }

        $result2[0]['link_name'] = 'Manage Users';
        $result2[0]['permissions'] = array(
            '0' => array('name' => 'user_view', 'value' => $user_view),
            '1' => array('name' => 'user_create', 'value' => $user_create),
            '2' => array('name' => 'user_update', 'value' => $user_update),
            '3' => array('name' => 'user_delete', 'value' => $user_delete),
        );

        $result2[1]['link_name'] = 'Manage blogs';
        $result2[1]['permissions'] = array(
            '0' => array('name' => 'blog_view', 'value' => $blog_view),
            '1' => array('name' => 'blog_create', 'value' => $blog_create),
            '2' => array('name' => 'blog_update', 'value' => $blog_update),
            '3' => array('name' => 'blog_delete', 'value' => $blog_delete),
        );

        $result2[2]['link_name'] = 'Manage blogs Categories';
        $result2[2]['permissions'] = array(
            '0' => array('name' => 'blog_category_view', 'value' => $blog_category_view),
            '1' => array('name' => 'blog_category_create', 'value' => $blog_category_create),
            '2' => array('name' => 'blog_category_update', 'value' => $blog_category_update),
            '3' => array('name' => 'blog_category_delete', 'value' => $blog_category_delete),
        );

        $result2[3]['link_name'] = 'Manage Authors';
        $result2[3]['permissions'] = array(
            '0' => array('name' => 'author_view', 'value' => $author_view),
            '1' => array('name' => 'author_create', 'value' => $author_create),
            '2' => array('name' => 'author_update', 'value' => $author_update),
            '3' => array('name' => 'author_delete', 'value' => $author_delete),
        );

        $result2[4]['link_name'] = 'Manage Categories';
        $result2[4]['permissions'] = array(
            '0' => array('name' => 'category_view', 'value' => $category_view),
            '1' => array('name' => 'category_create', 'value' => $category_create),
            '2' => array('name' => 'category_update', 'value' => $category_update),
            '3' => array('name' => 'category_delete', 'value' => $category_delete),
        );

        $result2[5]['link_name'] = 'Manage Sub Categories';
        $result2[5]['permissions'] = array(
            '0' => array('name' => 'sub_category_view', 'value' => $sub_category_view),
            '1' => array('name' => 'sub_category_create', 'value' => $sub_category_create),
            '2' => array('name' => 'sub_category_update', 'value' => $sub_category_update),
            '3' => array('name' => 'sub_category_delete', 'value' => $sub_category_delete),
        );

        $result2[6]['link_name'] = 'Manage Courses';
        $result2[6]['permissions'] = array(
            '0' => array('name' => 'course_view', 'value' => $course_view),
            '1' => array('name' => 'course_create', 'value' => $course_create),
            '2' => array('name' => 'course_update', 'value' => $course_update),
            '3' => array('name' => 'course_delete', 'value' => $course_delete),
        );

        $result2[7]['link_name'] = 'Manage About Courses';
        $result2[7]['permissions'] = array(
            '0' => array('name' => 'about_course_view', 'value' => $about_course_view),
            '1' => array('name' => 'about_course_create', 'value' => $about_course_create),
            '2' => array('name' => 'about_course_update', 'value' => $about_course_update),
            '3' => array('name' => 'about_course_delete', 'value' => $about_course_delete),
        );

        $result2[8]['link_name'] = 'Manage Courses Resource';
        $result2[8]['permissions'] = array(
            '0' => array('name' => 'course_resource_view', 'value' => $course_resource_view),
            '1' => array('name' => 'course_resource_create', 'value' => $course_resource_create),
            '2' => array('name' => 'course_resource_update', 'value' => $course_resource_update),
            '3' => array('name' => 'course_resource_delete', 'value' => $course_resource_delete),
        );

        $result2[9]['link_name'] = 'Manage Courses Assignment';
        $result2[9]['permissions'] = array(
            '0' => array('name' => 'course_assignment_view', 'value' => $course_assignment_view),
            '1' => array('name' => 'course_assignment_create', 'value' => $course_assignment_create),
            '2' => array('name' => 'course_assignment_update', 'value' => $course_assignment_update),
            '3' => array('name' => 'course_assignment_delete', 'value' => $course_assignment_delete),
        );

        $result2[10]['link_name'] = 'Manage Learning Options';
        $result2[10]['permissions'] = array(
            '0' => array('name' => 'learning_option_view', 'value' => $learning_option_view),
            '1' => array('name' => 'learning_option_create', 'value' => $learning_option_create),
            '2' => array('name' => 'learning_option_update', 'value' => $learning_option_update),
            '3' => array('name' => 'learning_option_delete', 'value' => $learning_option_delete),
        );

        $result2[11]['link_name'] = 'Manage Videos';
        $result2[11]['permissions'] = array(
            '0' => array('name' => 'video_view', 'value' => $video_view),
            '1' => array('name' => 'video_create', 'value' => $video_create),
            '2' => array('name' => 'video_update', 'value' => $video_update),
            '3' => array('name' => 'video_delete', 'value' => $video_delete),
        );

        $result2[12]['link_name'] = 'Manage Curriculums';
        $result2[12]['permissions'] = array(
            '0' => array('name' => 'curriculum_view', 'value' => $curriculum_view),
            '1' => array('name' => 'curriculum_create', 'value' => $curriculum_create),
            '2' => array('name' => 'curriculum_update', 'value' => $curriculum_update),
            '3' => array('name' => 'curriculum_delete', 'value' => $curriculum_delete),
        );

        $result2[13]['link_name'] = 'Manage Course Schedule';
        $result2[13]['permissions'] = array(
            '0' => array('name' => 'course_schedule_view', 'value' => $course_schedule_view),
            '1' => array('name' => 'course_schedule_create', 'value' => $course_schedule_create),
            '2' => array('name' => 'course_schedule_update', 'value' => $course_schedule_update),
            '3' => array('name' => 'course_schedule_delete', 'value' => $course_schedule_delete),
        );

        $result2[14]['link_name'] = 'Manage Reviews';
        $result2[14]['permissions'] = array(
            '0' => array('name' => 'review_view', 'value' => $review_view),
            '1' => array('name' => 'review_create', 'value' => $review_create),
            '2' => array('name' => 'review_update', 'value' => $review_update),
            '3' => array('name' => 'review_delete', 'value' => $review_delete),
        );

        $result2[15]['link_name'] = 'Manage Faq';
        $result2[15]['permissions'] = array(
            '0' => array('name' => 'faq_view', 'value' => $faq_view),
            '1' => array('name' => 'faq_create', 'value' => $faq_create),
            '2' => array('name' => 'faq_update', 'value' => $faq_update),
            '3' => array('name' => 'faq_delete', 'value' => $faq_delete),
            '4' => array('name' => 'faq_show', 'value' => $faq_show),
        );

        $result2[16]['link_name'] = 'Manage Test';
        $result2[16]['permissions'] = array(
            '0' => array('name' => 'test_view', 'value' => $test_view),
            '1' => array('name' => 'test_create', 'value' => $test_create),
            '2' => array('name' => 'test_update', 'value' => $test_update),
            '3' => array('name' => 'test_delete', 'value' => $test_delete),
        );

        $result2[17]['link_name'] = 'Manage Pages';
        $result2[17]['permissions'] = array(
            '0' => array('name' => 'page_view', 'value' => $page_view),
            '1' => array('name' => 'page_create', 'value' => $page_create),
            '2' => array('name' => 'page_update', 'value' => $page_update),
            '3' => array('name' => 'page_delete', 'value' => $page_delete),
        );

        $result2[18]['link_name'] = 'Manage Forum';
        $result2[18]['permissions'] = array(
            '0' => array('name' => 'forum_view', 'value' => $forum_view),
            '1' => array('name' => 'forum_create', 'value' => $forum_create),
            '2' => array('name' => 'forum_update', 'value' => $forum_update),
            '3' => array('name' => 'forum_delete', 'value' => $forum_delete),
            '4' => array('name' => 'forum_show', 'value' => $forum_show),
        );

        $result2[19]['link_name'] = 'Manage Subscriptions';
        $result2[19]['permissions'] = array(
            '0' => array('name' => 'subscription_view', 'value' => $subscription_view),
            '1' => array('name' => 'subscription_create', 'value' => $subscription_create),
            '2' => array('name' => 'subscription_update', 'value' => $subscription_update),
            '3' => array('name' => 'subscription_delete', 'value' => $subscription_delete),
        );

        $result2[20]['link_name'] = 'Manage Menus';
        $result2[20]['permissions'] = array(
            '0' => array('name' => 'menu_view', 'value' => $menu_view),
            '1' => array('name' => 'menu_create', 'value' => $menu_create),
            '2' => array('name' => 'menu_update', 'value' => $menu_update),
            '3' => array('name' => 'menu_delete', 'value' => $menu_delete),
        );

        $result2[21]['link_name'] = 'Manage Chats';
        $result2[21]['permissions'] = array(
            '0' => array('name' => 'chat_view', 'value' => $chat_view),
        );

        $result2[22]['link_name'] = 'Manage Roles';
        $result2[22]['permissions'] = array(
            '0' => array('name' => 'role_view', 'value' => $role_view),
            '1' => array('name' => 'role_create', 'value' => $role_create),
            '2' => array('name' => 'role_update', 'value' => $role_update),
            '3' => array('name' => 'role_delete', 'value' => $role_delete),
        );

        $result2[23]['link_name'] = 'Manage Permissions';
        $result2[23]['permissions'] = array(
            '0' => array('name' => 'permission_update', 'value' => $permission_update),
        );

        $result2[24]['link_name'] = 'Website Settings';
        $result2[24]['permissions'] = array(
            '0' => array('name' => 'website_setting_view', 'value' => $website_setting_view),
            '1' => array('name' => 'website_setting_update', 'value' => $website_setting_update),
        );

        $result2[25]['link_name'] = 'Manage Business';
        $result2[25]['permissions'] = array(
            '0' => array('name' => 'business_view', 'value' => $business_view),
            '1' => array('name' => 'business_create', 'value' => $business_create),
            '2' => array('name' => 'business_update', 'value' => $business_update),
            '3' => array('name' => 'business_delete', 'value' => $business_delete),
        );

        $result2[26]['link_name'] = 'Manage Email Templates';
        $result2[26]['permissions'] = array(
            '0' => array('name' => 'email_template_view', 'value' => $email_template_view),
            '1' => array('name' => 'email_template_create', 'value' => $email_template_create),
            '2' => array('name' => 'email_template_update', 'value' => $email_template_update),
            '3' => array('name' => 'email_template_delete', 'value' => $email_template_delete),
        );

        $result2[27]['link_name'] = 'Manage Tickets';
        $result2[27]['permissions'] = array(
            '0' => array('name' => 'ticket_view', 'value' => $ticket_view),
            '1' => array('name' => 'ticket_reply', 'value' => $ticket_reply),
            '2' => array('name' => 'ticket_delete', 'value' => $ticket_delete),
        );

        $result2[28]['link_name'] = 'Pricing';
        $result2[28]['permissions'] = array(
            '0' => array('name' => 'pricing_view', 'value' => $pricing_view),
            '1' => array('name' => 'pricing_create', 'value' => $pricing_create),
            '2' => array('name' => 'pricing_update', 'value' => $pricing_update),
            '3' => array('name' => 'pricing_delete', 'value' => $pricing_delete),
        );

        $result['data'] = $result2;

        //print_r($result);exit;
        return view('admin.permission.index', compact('getPermission', 'result'));
    }

    public function updatePermission(Request $request)
    {
        $data = $request->all();
        $permission = Permission::where('user_type_id', $data['user_type_id'])->first();
        $permission->update($data);
        return redirect()->back()->withSuccess('Permissions updated.');
    }
}
