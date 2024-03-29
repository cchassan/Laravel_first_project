<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{route('home')}}"><img src="{{asset('assets/images/image-gallery/GulfConnect-Pro-Logo.png')}}" width="150px" alt="HexaBit Logo" class="img-fluid "></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right"><i class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{asset('assets/images/avatar.jpg')}}" class="user-photo" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{Auth::user()->name}}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="{{route('profile')}}"><i class="icon-user"></i>My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="icon-menu"><i class="icon-power"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="{{setActive(['home'])}}"><a href="{{route('home')}}"><i class="icon-home"></i><span>Dashboard</span></a></li>
                @can('location-create')
                <li class="{{setActive(['location'])}}"><a href="{{route('location')}}"><i class="icon-globe"></i><span>Locations</span></a></li>
                @endcan

                <li class="{{setActive(['material.Entry.Record', 'material.Receiving.Form', 'goods.Receiving.Notes'])}}">
                    <a href="#WarehouseForm" class="has-arrow"><i class="icon-equalizer"></i><span>Warehouse Form</span></a>
                    <ul>
                        @can('material-record-Entry-create')
                        <li class="{{setActive(['material.Entry.Record'])}}"><a href="{{route('material.Entry.Record')}}">Material Entry Record</a></li>
                        @endcan
                        <li class="{{setActive(['material.Receiving.Form'])}}"><a href="{{route('material.Receiving.Form')}}">Material Receiving Form</a></li>
                        <li class="{{setActive(['goods.Receiving.Notes'])}}"><a href="{{route('goods.Receiving.Notes')}}">Goods Receiving Notes</a></li>
                        <li><a href="#">Bin Card</a></li>
                    </ul>
                </li>

                <li class="{{setActive(['material.Entry.Record.Report'])}}">
                    <a href="#Reports" class="has-arrow"><i class="icon-equalizer"></i><span>Reports</span></a>
                    <ul>
                        @can('material-record-Entry-list')
                        <li class="{{setActive(['material.Entry.Record.Report'])}}"><a href="{{route('material.Entry.Record.Report')}}">Material Entry Record Reports</a></li>
                        @endcan
                        <li class="{{setActive(['material.Receiving.Report'])}}"><a href="{{route('material.Receiving.Report')}}">Material Receiving Reports</a></li>
                            <li class="{{setActive(['goods.Receiving.Report'])}}"><a href="{{route('goods.Receiving.Report')}}">Goods Receiving Reports</a></li>
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
