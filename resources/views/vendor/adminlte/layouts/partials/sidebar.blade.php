<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="margin-top:3em;">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel" style="height: 5em;">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" style="margin-top:2em;">
            {{--<li class="header">{{ trans('adminlte_lang::message.header') }}</li>--}}
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{route('admin_home')}}" ><i class='fa fa-home'></i><span style="cursor:pointer;"> Dashboard</span></a></li>
                <li class="treeview">
                    <a href=""  ><i class="fa fa-list"></i><span><i class="fa fa-angle-left pull-right" Menus</span></a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('manage_menus')}}">Menu Items</a></li>
                        <li><a href="#">Menu Categories</a></li>
                        {{--<li><a href="{{route('manage_ingredients')}}">Ingredients</a></li>--}}
                    </ul>
                </li>
                <li class="treeview">
                    <a href=""  ><i class="fa fa-list"></i><span ><i class="fa fa-angle-left pull-right" Ingredients</span></a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('manage_ingredients')}}">Ingredients</a></li>
                        <li><a  href="{{route('ingredient_type_home')}}">Ingredient Types</a></li>

                    </ul>
                </li>
                <li><a href="{{route('users')}}"><i class="fa fa-users"></i> <span style="cursor:pointer;">Users</span></a></li>

            {{--</li>--}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
