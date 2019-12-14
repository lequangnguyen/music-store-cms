<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{ route('Admin::user@index') }}"><i class="fa fa-circle-o"></i>Users</a></li>
            <li><a href="{{ route('Admin::category@index') }}"><i class="fa fa-circle-o"></i>Categories</a></li>
            <li><a href="{{ route('Admin::artist@index') }}"><i class="fa fa-circle-o"></i>Artists</a></li>
            <li><a href="{{ route('Admin::product@index') }}"><i class="fa fa-circle-o"></i>Products</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
