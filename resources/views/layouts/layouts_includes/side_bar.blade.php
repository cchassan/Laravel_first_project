<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{route('home')}}"><img src="{{asset('assets/images/image-gallery/GulfConnect-Pro-Logo.png')}}" width="150px" alt="HexaBit Logo" class="img-fluid "></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right"><i class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{asset('assets/images/user.png')}}" class="user-photo" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>Christy Wert</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                    <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="{{setActive(['home'])}}"><a href="{{route('home')}}"><i class="icon-home"></i><span>Dashboard</span></a></li>
                <li class="{{setActive(['material.form.1'])}}">
                    <a href="#WarehouseForm" class="has-arrow"><i class="icon-equalizer"></i><span>Warehouse Form</span></a>
                    <ul>
                        <li class="{{setActive(['material.form.1'])}}"><a href="{{route('material.form.1')}}">Material Entry Form</a></li>
                        <li><a href="#">New Form</a></li>
                        <li><a href="#">Blog List</a></li>
                        <li><a href="#">Blog Detail</a></li>
                    </ul>
                </li>
                @if(Auth::user()->roles->pluck('name')[0] == 'Admin')
                <li class="{{setActive(['users' ,'roles.index'])}} ">
                    <a href="#People" class="has-arrow"><i class="fa fa-user"></i><span>People</span></a>
                    <ul>
                        <li class="{{setActive(['users'])}}"><a href="{{route('users')}}">Users</a></li>
                    </ul>
                    <ul>
                        <li class="{{setActive(['roles.index'])}}"><a href="{{route('roles.index')}}">Roles & Permissions</a></li>
                    </ul>
                </li>
                @endif

            </ul>
        </nav>
    </div>
</div>
