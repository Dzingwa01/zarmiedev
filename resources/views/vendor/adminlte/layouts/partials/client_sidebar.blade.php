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
            <li><a href="{{url('home')}}" ><i class='fa fa-home'></i><span style="cursor:pointer;"> Dashboard</span></a></li>
            <li><a href=""><i class="fa fa-life-bouy"></i> <span style="cursor:pointer;">Manage Favourites</span></a></li>
            <li><a href=""><i class="fa fa-history"></i> <span style="cursor:pointer;">Order History</span></a></li>


            {{--</li>--}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
