<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('images/default.png') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Juan Dela Cruz</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
     {{--  <li>
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li> --}}
      <li>
        <a href="{{ route('pages.sections') }}">
          <i class="fa fa-puzzle-piece"></i> <span>Sections Management</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-graduation-cap"></i> <span>Student Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('new.student') }}"><i class="fa fa-circle-o text-aqua"></i> Add Student</a></li>
          <li><a href="{{ route('students.list') }}"><i class="fa fa-circle-o text-aqua"></i> Students List</a></li>

        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i> <span>Employee Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('new.employee') }}"><i class="fa fa-circle-o text-aqua"></i> Add New Employee</a></li>
          <li><a href="{{ route('employees.list') }}"><i class="fa fa-circle-o text-aqua"></i> Employees List</a></li>

        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
