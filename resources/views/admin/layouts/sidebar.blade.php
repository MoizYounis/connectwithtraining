<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" class="bg-theme bg-theme2" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <!-- <img src="{{asset('public/assets/admin/images/logo-icon.png')}}" class="logo-icon" alt="logo icon"> -->
       <h5 class="logo-text">Connect With Training</h5>
     </a>
   </div>
   <div class="user-details">
    <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
        <div class="avatar">
          @if(Auth::user()->image)
            <img class="mr-3 side-user-img" src="{{asset('public/assets/front/img/user').'/'.Auth::user()->image}}" alt="user avatar">
          @else
            <img class="mr-3 side-user-img" src="{{asset('public/assets/admin/images/avatars/avtar.png')}}" alt="user avatar">
          @endif
        </div>
       <div class="media-body">
          <h6 class="side-user-name">{{ucfirst(Auth::user()->first_name).' '.Auth::user()->last_name}}</h6>
      </div>
    </div>
  </div>
    
    <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      
      <li id="dashboard">
        <a href="{{route('admin_dashboard')}}" class="waves-effect">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      @if($getPermission->user_view == 1)
      <li id="user">
        <a href="{{url('admin/user_list')}}" class="waves-effect">
          <i class="zmdi zmdi-accounts-alt"></i> <span>Users</span>
        </a>
      </li>
      @endif

      @if($getPermission->blog_view == 1)
      <li id="blog">
        <a href="javascript:void();" class="waves-effect">
          <i class="zmdi zmdi-reader"></i>
          <span>Blogs</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="{{route('blog.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Blog</a></li>
          <li><a href="{{route('blogcategory.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> 
            Blog Category
          </a></li>
        </ul>
      </li>
      @endif

      @if($getPermission->author_view == 1)
      <li id="author">
        <a href="{{route('author.index')}}" class="waves-effect">
          <i class="zmdi zmdi-account"></i> <span>Authors</span>
        </a>
      </li>
      @endif

      @if($getPermission->category_view == 1 || $getPermission->sub_category_view == 1)
      <li>
        <a href="javascript:void();" class="waves-effect">
          <i class="zmdi zmdi-view-dashboard"></i>
          <span>Cateogry Master</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
            @if($getPermission->category_view == 1)
              <li><a href="{{route('category.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Main Category</a></li>
            @endif
            
            @if($getPermission->sub_category_view == 1)
              <!-- <li><a href="{{route('subcategory.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> -->
              <!--  Sub Category-->
              <!--</a></li>-->
            @endif
        </ul>
      </li>
      @endif

      @if($getPermission->course_view == 1 || 
          $getPermission->about_course_view == 1 ||
          $getPermission->course_resource_view == 1 ||
          $getPermission->course_assignment_view == 1 ||
          $getPermission->learning_option_view == 1 ||
          $getPermission->video_view == 1 ||
          $getPermission->curriculum_view == 1 ||
          $getPermission->course_schedule_view == 1 ||
          $getPermission->review_view == 1 ||
          $getPermission->faq_view == 1)
      <li id="course">
        <a href="javascript:void();" class="waves-effect">
          <i class="zmdi zmdi-book"></i>
          <span>Courses</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          
          @if($getPermission->course_view == 1)
          <li><a href="{{route('course.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Main Courses</a></li>
          @endif

          @if($getPermission->about_course_view == 1)
          <li><a href="{{route('aboutCourse.index')}}"><i class="zmdi zmdi-long-arrow-right"></i>
            About Course
          </a></li>
          @endif
          
          @if($getPermission->course_resource_view)
          <li><a href="{{route('courseResources.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> 
            Course Resources
          </a></li>
          @endif
          
          <li><a href="{{route('inssupport.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Instructor Support</a></li>

          @if($getPermission->course_assignment_view)
          <li><a href="{{route('courseAssignment.index')}}"><i class="zmdi zmdi-long-arrow-right"></i>
            Course Assignments
          </a></li>
          @endif

          @if($getPermission->learning_option_view)
          <li><a href="{{route('learningOption.index')}}"><i class="zmdi zmdi-long-arrow-right"></i>
            Learning Options
          </a></li>
          @endif

          @if($getPermission->video_view)
          <li><a href="{{route('video.index')}}"><i class="zmdi zmdi-long-arrow-right"></i>
            Videos
          </a></li>
          @endif

          @if($getPermission->curriculum_view)
          <li><a href="{{route('curriculum.index')}}"><i class="zmdi zmdi-long-arrow-right"></i>
            Curriculum
          </a></li>
          @endif

          @if($getPermission->course_schedule_view)
          <li><a href="{{route('schedule.index')}}"><i class="zmdi zmdi-long-arrow-right"></i>
            Course Schedule
          </a></li>
          @endif

          @if($getPermission->review_view)
          <li><a href="{{route('review.index')}}"><i class="zmdi zmdi-long-arrow-right"></i>
            Review
          </a></li>
          @endif

          @if($getPermission->faq_view)
          <li><a href="{{route('faq.index')}}"><i class="zmdi zmdi-long-arrow-right"></i>
            Faq
          </a></li>
          @endif

        </ul>
      </li>
      @endif

      @if($getPermission->test_view)
      <li id="test">
        <a href="{{route('test.index')}}" class="waves-effect">
          <i class="zmdi zmdi-edit"></i> <span>Manage Test</span>
        </a>
      </li>
      @endif

      @if($getPermission->page_view)
      <li id="staticPage">
        <a href="{{route('staticPage.index')}}" class="waves-effect">
          <i class="zmdi zmdi-receipt"></i> <span>Static Pages</span>
        </a>
      </li>
      @endif
      
      @if($getPermission->forum_view)
      <li id="forum">
        <a href="{{route('forum.index')}}" class="waves-effect">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Forum</span>
        </a>
      </li>
      @endif
      
      @if($getPermission->role_view)
      <li id="role">
        <a href="javascript:void();" class="waves-effect">
          <i class="zmdi zmdi-key"></i>
          <span>Permissions</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">          
            <li><a href="{{route('roles.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> User Roles</a></li>
        </ul>
      </li>
      @endif
      
      @if($getPermission->subscription_view)
      <li id="subscription">
        <a href="{{route('subscription.index')}}" class="waves-effect">
          <i class="zmdi zmdi-receipt"></i> <span>Subscription</span>
        </a>
      </li>
      @endif
      
      @if($getPermission->menu_view)
      <li id="menu">
        <a href="{{route('menu.index')}}" class="waves-effect">
          <i class="zmdi zmdi-menu"></i> <span>Manage Menus</span>
        </a>
      </li>
      @endif    
      
      @if($getPermission->chat_view)
      <li id="chat">
        <a href="{{url('admin/chat')}}" class="waves-effect">
          <i class="zmdi zmdi-comment"></i> <span>Manage Chat</span>
        </a>
      </li>
      @endif
      
      @if($getPermission->website_setting_view || $getPermission->email_template_view)
      <li id="setting">
        <a href="javascript:void();" class="waves-effect">
          <i class="zmdi zmdi-settings"></i>
          <span>Website Settings</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          @if($getPermission->website_setting_view)
          <li><a href="{{url('admin/website/setting')}}"><i class="zmdi zmdi-long-arrow-right"></i> Web Settings</a></li>
          @endif
          
          @if($getPermission->email_template_view)
          <li><a href="{{route('emailTemplate.index')}}"><i class="zmdi zmdi-long-arrow-right"></i> Email Settings</a></li>
          @endif
        </ul>
      </li>
      @endif

      @if($getPermission->business_view)
      <li id="business">
        <a href="{{route('business.index')}}" class="waves-effect">
          <i class="zmdi zmdi-money"></i> <span>Business Manage</span>
        </a>
      </li>
      @endif

      @if($getPermission->ticket_view)
      <li id="ticket">
        <a href="{{url('admin/ticket')}}" class="waves-effect">
          <i class="zmdi zmdi-ticket-star"></i> <span>Ticket System</span>
        </a>
      </li>
      @endif
      
      <li id="homepage">
        <a href="{{url('admin/homepage/banner')}}" class="waves-effect">
          <i class="zmdi zmdi-ticket-star"></i> <span>Manage Homepage</span>
        </a>
      </li>
      
      <li id="contact">
        <a href="{{url('admin/contact')}}" class="waves-effect">
          <i class="zmdi zmdi-comment"></i> <span>Contacts</span>
        </a>
      </li>
      
      <li id="subscriber">
        <a href="{{url('admin/subscribers')}}" class="waves-effect">
          <i class="zmdi zmdi-comment"></i> <span>Subscribers</span>
        </a>
      </li>

      <li id="pricing">
        <a href="{{url('admin/pricing')}}" class="waves-effect">
          <i class="zmdi zmdi-comment"></i> <span>Pricing</span>
        </a>
      </li>

      <br><br><br><br>      
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->


