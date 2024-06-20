<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{route('home')}}"><img src="{{asset('assets/images/image-gallery/GulfConnect-Pro-Logo.png')}}" width="150px" alt="Gulf Biotech Logo" class="img-fluid "></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm btn-default float-right"><i class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{Auth::user()->user_image}}" class="user-photo" alt="User Profile Picture">
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
                @can('location-list')
                <li class="{{setActive(['location'])}}"><a href="{{route('location')}}"><i class="icon-globe"></i><span>Locations</span></a></li>
                @endcan
                @if(Gate::check('material-record-Entry-create') || Gate::check('material-receiving-create') || Gate::check('goods-receiving-create') )
                <li class="{{setActive(['material.Entry.Record', 'material.Receiving.Form', 'goods.Receiving.Notes'])}}">
                    <a href="#WarehouseForm" class="has-arrow"><i class="icon-equalizer"></i><span>Warehouse</span></a>
                    <ul>
                        @can('material-record-Entry-create')
                            <li class="{{setActive(['material.Entry.Record'])}}"><a href="{{route('material.Entry.Record')}}">Material Entry Record</a></li>
                        @endcan
                        @can('material-receiving-create')
                            <li class="{{setActive(['material.Receiving.Form'])}}"><a href="{{route('material.Receiving.Form')}}">Material Receiving Form</a></li>
                        @endcan
                        @can('goods-receiving-create')
                            <li class="{{setActive(['goods.Receiving.Notes'])}}"><a href="{{route('goods.Receiving.Notes')}}">Goods Receiving Notes</a></li>
                        @endcan
                        <li><a href="#">Bin Card</a></li>
                    </ul>
                </li>
                @endif
                @can('routeAdministration-list')
                    <li class="{{setActive(['routeAdministration'])}}"><a href="{{route('routeAdministration')}}"><i class="fa fa-map-signs"></i><span>Route Administration</span></a></li>
                @endcan
                @can('secondaryPackagingFormat-list')
                    <li class="{{setActive(['secondaryPackagingFormat'])}}"><a href="{{route('secondaryPackagingFormat')}}"><i class="fa fa-sitemap"></i><span>Packaging Format</span></a></li>
                @endcan
                @if(Gate::check('product-create') || Gate::check('product-recipe-create') )
                <li class="{{setActive(['product.create', 'productRecipe.create'])}}">
                        <a href="#ProductionForm" class="has-arrow"><i class="fa fa-cubes"></i><span>Production</span></a>
                        <ul>
                            @can('product-create')
                                <li class="{{setActive(['product.create'])}}"><a href="{{route('product.create')}}">Add Product</a></li>
                            @endcan
                            @can('product-recipe-create')
                                <li class="{{setActive(['productRecipe.create'])}}"><a href="{{route('productRecipe.create')}}">Add Product Recipe</a></li>
                            @endcan
                        </ul>
                    </li>
                @endif

                <li class="{{setActive(['material.Entry.Record.Report','material.Receiving.Report','goods.Receiving.Report' ,'product.Report', 'product.Recipe.Report'])}}">
                    <a href="#Reports" class="has-arrow"><i class="icon-equalizer"></i><span>Reports</span></a>
                    <ul>
                        @can('material-record-Entry-list')
                            <li class="{{setActive(['material.Entry.Record.Report'])}}"><a href="{{route('material.Entry.Record.Report')}}">Material Entry Record Reports</a></li>
                        @endcan
                        @can('material-receiving-list')
                                <li class="{{setActive(['material.Receiving.Report'])}}"><a href="{{route('material.Receiving.Report')}}">Material Receiving Reports</a></li>
                        @endcan
                        @can('goods-receiving-list')
                            <li class="{{setActive(['goods.Receiving.Report'])}}"><a href="{{route('goods.Receiving.Report')}}">Goods Receiving Reports</a></li>
                        @endcan
                        @can('product-list')
                            <li class="{{setActive(['product.Report'])}}"><a href="{{route('product.Report')}}">Product Reports</a></li>
                        @endcan
                        @can('product-recipe-list')
                            <li class="{{setActive(['product.Recipe.Report'])}}"><a href="{{route('product.Recipe.Report')}}">Product Recipe Reports</a></li>
                        @endcan
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
