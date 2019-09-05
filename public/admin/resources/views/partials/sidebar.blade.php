@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('quickadmin.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('clubs_&_society_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-mortar-board"></i>
                    <span>@lang('quickadmin.clubs-societies.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('category_access')
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="fa fa-align-justify"></i>
                            <span>@lang('quickadmin.categories.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('club_access')
                    <li>
                        <a href="{{ route('admin.clubs.index') }}">
                            <i class="fa fa-mortar-board"></i>
                            <span>@lang('quickadmin.clubs.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('update_access')
                    <li>
                        <a href="{{ route('admin.updates.index') }}">
                            <i class="fa fa-newspaper-o"></i>
                            <span>@lang('quickadmin.updates.title')</span>
                        </a>
                    </li>@endcan

                    @can('comment_access')
                    <li>
                        <a href="{{ route('admin.comments.index') }}">
                            <i class="fa fa-commenting"></i>
                            <span>@lang('quickadmin.comments.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-question-circle"></i>
                    <span>Q & A</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('thread_access')
                    <li>
                        <a href="{{ route('admin.threads.index') }}">
                            <i class="fa fa-question-circle"></i>
                            <span>Questions</span>
                        </a>
                    </li>@endcan
                    @can('comment_access')
                    <li>
                        <a href="{{ route('admin.threadcomments.index') }}">
                            <i class="fa fa-commenting"></i>
                            <span>Answers</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>
            


            @can('events1_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-star"></i>
                    <span>@lang('quickadmin.events1.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('event_access')
                    <li>
                        <a href="{{ route('admin.events.index') }}">
                            <i class="fa fa-star-o"></i>
                            <span>@lang('quickadmin.events.title')</span>
                        </a>
                    </li>@endcan

                    @can('invitation_access')
                    <li>
                        <a href="{{ route('admin.invitations.index') }}">
                            <i class="fa fa-envelope-o"></i>
                            <span>@lang('quickadmin.invitations.title')</span>
                        </a>
                    </li>@endcan

                    @can('volunteer_access')
                    <li>
                        <a href="{{ route('admin.volunteers.index') }}">
                            <i class="fa fa-user-plus"></i>
                            <span>@lang('quickadmin.volunteers.title')</span>
                        </a>
                    </li>@endcan

                    @can('comment_access')
                    <li>
                        <a href="{{ route('admin.eventcomments.index') }}">
                            <i class="fa fa-commenting"></i>
                            <span>Discussions</span>
                        </a>
                    </li>@endcan

                    <li>
                        <a href="{{url('admin/calendar')}}">
                          <i class="fa fa-calendar"></i>
                          <span class="title">
                            Calendar
                          </span>
                        </a>
                    </li>
                    
                </ul>
            </li>@endcan

            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

