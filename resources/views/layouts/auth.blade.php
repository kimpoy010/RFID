<!DOCTYPE html>
<html>
<head>
  @include('partials._head')
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
  <!-- .wrapper -->
<div class="wrapper">

  @include('partials._header')
  @include('partials._leftbar')

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield('page-title')
        </h1>
        @include('partials._flash')
      </section>

      <!-- Main content -->
      <section class="content">
        @yield('content')
      </section>
      <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->

  @include('partials._footer')
  @include('partials._rightbar')

</div>
<!-- ./wrapper -->
@include('partials._js')
@yield('scripts')
</body>
</html>
