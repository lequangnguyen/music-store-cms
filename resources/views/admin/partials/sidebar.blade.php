<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>MANAGEMENT</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('Admin::user@index') }}"><i class="fa fa-circle-o"></i>Users</a></li>
                    <li><a href="{{ route('Admin::category@index') }}"><i class="fa fa-circle-o"></i>Categories</a></li>
                    <li><a href="{{ route('Admin::product@index') }}"><i class="fa fa-circle-o"></i>Products</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>