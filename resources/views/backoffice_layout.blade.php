<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>
    @if (\Request::is('new-order'))
      @yield('new_order_title')
    @elseif (\Request::is('dates'))
      @yield('dates_management_title')
    @elseif (\Request::is('backusers'))
      @yield('users_management_title')
    @endif
  </title>

  {{-- Favicon --}}
  <link rel="icon" type="image/png" href="img/karitelocompra_logo_mini.png"/>

  {{-- Custom fonts for this template --}}
  
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="http://fonts.cdnfonts.com/css/my-butterfly" rel="stylesheet">

  {{-- Custom styles for this template--}}
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/cm_karitelocompra_css.css" rel="stylesheet">

  @if (\Request::is('new-order'))
    @yield('new_order_header')
  @elseif (\Request::is('dates'))
    @yield('dates_management_header')
  @elseif (\Request::is('backusers'))
    @yield('users_management_header')
  @endif

</head>

<body id="page-top">

  {{-- Page Wrapper --}}
  <div id="wrapper">

    {{-- Sidebar --}}
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      {{-- Sidebar - Brand --}}
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="img/karitelocompra_menu_logo.png"></img>
        </div>
      </a>

      {{-- Divider --}}
      <hr class="sidebar-divider my-0">

      {{-- Nav Item - Dashboard --}}
      <li class="nav-item 
      @if (\Request::is('backoffice_layout'))
        active
      @endif
      ">
        <a class="nav-link" href="{{ url('backoffice_layout') }}">
          <i class="fas fa-fw fa-chart-line"></i>
          <span>@lang('Summary')</span></a>
      </li>

      {{-- Divider --}}
      <hr class="sidebar-divider">

      {{-- Heading --}}
      <div class="sidebar-heading">
        @lang('Lists')
      </div>

      {{-- Nav Item - List Summary --}}
      <li class="nav-item 
      @if (\Request::is('new-order') || \Request::is('orders'))
        active
      @endif
      ">
        <a class="nav-link 
        @if (\Request::is('new-order') || \Request::is('orders'))
          {{-- nothing --}}
        @else
          collapsed
        @endif
        " href="#" data-toggle="collapse" data-target="#collapseLists"
          aria-expanded="
          @if (\Request::is('new-order') || \Request::is('orders'))
            true
          @else
            false
          @endif
          " aria-controls="collapseLists">
          <i class="fas fa-fw fa-columns"></i>
          <span>@lang('Lists Management')</span>
        </a>
        <div id="collapseLists" class="collapse 
        @if (\Request::is('new-order') || \Request::is('orders'))
          show
        @else
          {{-- nothing --}}
        @endif
        " aria-labelledby="headingLists" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item 
              @if (\Request::is('new-order'))
                active
              @endif
              " href="{{ url('new-order') }}">
                <i class="fas fa-list-ol"></i>
                <span>@lang('New List')</span>
              </a>
              <a class="collapse-item" href="{{ url('order-list') }}">
                <i class="fas fa-clipboard-list"></i>
                <span>@lang('Lists Summary')</span>
              </a>
          </div>
        </div>
      </li>

      {{-- Divider --}}
      <hr class="sidebar-divider">

      {{-- Heading --}}
      <div class="sidebar-heading">
        @lang('Calendar')
      </div>

      {{-- Nav Item - Dates Summary --}}
      <li class="nav-item 
      @if (\Request::is('dates'))
        active
      @endif
      ">
        <a class="nav-link" href="{{ url('dates') }}">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>@lang('Dates Summary')</span></a>
      </li>

      {{-- Divider --}}
      <hr class="sidebar-divider">

      {{-- Heading --}}
      <div class="sidebar-heading">
        @lang('Users')
      </div>
      
      {{-- Nav Item - Users Management --}}
      <li class="nav-item 
      @if (\Request::is('backusers'))
        active
      @endif
      ">
        <a class="nav-link" href="{{ url('backusers') }}">
          <i class="fas fa-users-cog"></i>
          <span>@lang('Users Management')</span>
        </a>
      </li>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>
    {{-- End of Sidebar --}}

    {{-- Content Wrapper --}}
    <div id="content-wrapper" class="d-flex flex-column">

      {{-- Main Content --}}
      <div id="content">

        {{-- Topbar --}}
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          {{-- Sidebar Toggle (Topbar) --}}
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          {{-- Topbar Navbar --}}
          <ul class="navbar-nav ml-auto">

            {{-- Nav Item - User Information --}}
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="cm-span-a-display mr-2 d-none d-lg-inline text-gray-600 small">@yield('username')</span>
                <i class="fas fa-user"></i>
              </a>
              {{-- Dropdown - User Information --}}
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  @lang('Logout')
                </a>
              </div>
            </li>

          </ul>

        </nav>
        {{-- End of Topbar --}}

        {{-- Begin Page Content --}}
        <div class="container-fluid">

          @if (\Request::is('new-order'))
            @yield('new_order_page_header')
          @elseif (\Request::is('dates'))
            @yield('dates_management_page_header')
          @elseif (\Request::is('backusers'))
            @yield('users_management_page_header')
          @endif

          @if (\Request::is('new-order'))
            @yield('new_order_checkout')
          @elseif (\Request::is('dates'))
            @yield('dates_calendar')
          @elseif (\Request::is('backusers'))
            @yield('users_table')
          @endif

          

        </div>
        {{-- End Of Page Content --}}

      </div>
      {{-- End of Main Content --}}

      {{-- Footer --}}
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>@lang('All rights reserved.') &copy; @lang('webtags.company2_name') 2021 | 
            @lang('Web Site Developed By:') <a href="https://caelumdev.com" class="cm-a-clr" target="_blank"> @lang('webtags.caelumdev')</a></span>
          </div>
        </div>
      </footer>
      {{-- End of Footer --}}

    </div>
    {{-- End of Content Wrapper --}}

  </div>
  {{-- End of Page Wrapper --}}

  {{-- Scroll to Top Button--}}
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  @if (\Request::is('new-order'))
    @yield('new_order_form_modals')
  @elseif (\Request::is('dates'))
    @yield('dates_form_modals')
  @elseif (\Request::is('backusers'))
    @yield('users_form_modals')
  @endif

  {{-- Logout Modal--}}
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Ready to Leave?')</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">@lang('Are you sure you want to Logout?')</div>
        <div class="modal-footer">
          <button class="btn btn-cancel" type="button" data-dismiss="modal">@lang('Cancel')</button>
          <a class="btn btn-primary" href="{{ url('/logout') }}">@lang('Logout')</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Bootstrap core JavaScript--}}
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  {{-- Core plugin JavaScript--}}
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  {{-- Custom scripts for all pages--}}
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/cm_karitelocompra_js.js"></script>

  @if (\Request::is('new-order'))
    @yield('new_order_footer')
  @elseif (\Request::is('dates'))
    @yield('dates_management_footer')
  @elseif (\Request::is('backusers'))
    @yield('users_management_footer')
  @endif

</body>

</html>
