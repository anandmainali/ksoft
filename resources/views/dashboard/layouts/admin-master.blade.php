<!-- Header -->
  @include('dashboard.includes.header')

<!-- Header Close -->

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
  @include('dashboard.includes.navbar')
    <!-- Navbar Close -->

    <!-- Left side column. contains the logo and sidebar -->
  @include('dashboard.includes.sidebar')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield('title')
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">@yield('title')</li>
        </ol>
      </section>
      @yield('content')

    </div>
    <!-- /.content-wrapper -->
  @include('dashboard.includes.footer')