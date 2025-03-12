@php($currentRouteName = Route::currentRouteName())
<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{in_array($currentRouteName,['admin.dashboard']) ? 'active':''}}">
                    <a href="{{route('admin.dashboard')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                
                <li class="{{in_array($currentRouteName,['admin.jobs.index']) ? 'active':''}}">
                    <a href="{{route('admin.jobs.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-users icon-menu"></i>
                        </span>
                        <span class="pcoded-mtext">Jobs</span>
                    </a>
                </li>
                <li class="{{in_array($currentRouteName,['admin.saved-jobs.index']) ? 'active':''}}">
                    <a href="{{route('admin.saved-jobs.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-users icon-menu"></i>
                        </span>
                        <span class="pcoded-mtext">Favorite Jobs</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('admin.logout')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-log-out"></i>
                        </span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>