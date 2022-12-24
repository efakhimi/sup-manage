@include('layouts.header')


<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="{{ route('home') }}"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">خانه</a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('assets/img/site_logo_lg_fa.png') }}" alt="AMF Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">پنل کاربری</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('assets/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              @if(auth()->user()->fname)
                {{auth()->user()->fname}} 
              @endif
              @if(auth()->user()->lname)
                {{auth()->user()->lname}} 
              @endif
            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('dashboard') ? 'active' : '')}}">
                <i class="fa fa-desktop nav-icon"></i>
                <p>داشبورد</p>
              </a>
            </li>


            @if(
              auth()->user()->hasPermissionTo('view_category') or 
              auth()->user()->hasPermissionTo('edit_category') or 
              auth()->user()->hasPermissionTo('delete_category') or 
              auth()->user()->hasPermissionTo('create_category')
            )
            <li class="nav-item has-treeview {{((Illuminate\Support\Facades\Route::is('categoryList') 
              or Illuminate\Support\Facades\Route::is('categoryNew') ) ? 'menu-open' : '')}}">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-sitemap"></i>
                <p>
                دسته‌بندی مشکلات
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(auth()->user()->hasPermissionTo('create_category'))
                <li class="nav-item">
                  <a href="{{ route('categoryNew') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('categoryNew') ? 'active' : '')}}">
                    <i class="fa fa-tag nav-icon"></i>
                    <p>دسته‌بندی جدید</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermissionTo('view_category') or auth()->user()->hasPermissionTo('edit_category') or auth()->user()->hasPermissionTo('delete_category'))
                <li class="nav-item">
                  <a href="{{ route('categoryList') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('categoryList') ? 'active' : '')}}">
                    <i class="fa fa-tags nav-icon"></i>
                    <p>تمام دسته‌بندی ها</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            @endif
            @if(
              auth()->user()->hasPermissionTo('view_customer') or 
              auth()->user()->hasPermissionTo('edit_customer') or 
              auth()->user()->hasPermissionTo('delete_customer') or 
              auth()->user()->hasPermissionTo('create_customer') or
              auth()->user()->hasPermissionTo('view_contract') or 
              auth()->user()->hasPermissionTo('edit_contract') or 
              auth()->user()->hasPermissionTo('delete_contract') or 
              auth()->user()->hasPermissionTo('create_contract')
            )
            <li class="nav-item has-treeview {{((Illuminate\Support\Facades\Route::is('customerList') 
              or Illuminate\Support\Facades\Route::is('customerNew') 
              or Illuminate\Support\Facades\Route::is('contractNew') 
              or Illuminate\Support\Facades\Route::is('contractList') 
              ) ? 'menu-open' : '')}}">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-address-book-o"></i>
                <p>
                مشتری ها و قرارداد ها
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(auth()->user()->hasPermissionTo('create_customer'))
                <li class="nav-item">
                  <a href="{{ route('customerNew') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('customerNew') ? 'active' : '')}}">
                    <i class="fa fa-user-plus nav-icon"></i>
                    <p>مشتری جدید</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermissionTo('view_customer') or auth()->user()->hasPermissionTo('edit_customer') or auth()->user()->hasPermissionTo('delete_customer'))
                <li class="nav-item">
                  <a href="{{ route('customerList') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('customerList') ? 'active' : '')}}">
                    <i class="fa fa-users nav-icon"></i>
                    <p>تمام مشتری ها</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermissionTo('create_contract'))
                <li class="nav-item">
                  <a href="{{ route('contractNew') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('contractNew') ? 'active' : '')}}">
                    <i class="fa fa-edit nav-icon"></i>
                    <p>قرارداد جدید</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermissionTo('view_contract') or auth()->user()->hasPermissionTo('edit_contract') or auth()->user()->hasPermissionTo('delete_contract'))
                <li class="nav-item">
                  <a href="{{ route('contractList') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('contractList') ? 'active' : '')}}">
                    <i class="fa fa-diamond nav-icon"></i>
                    <p>تمام قرارداد ها</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            @endif
            @if(auth()->user()->hasPermissionTo('view_suprequest') or auth()->user()->hasPermissionTo('edit_suprequest') or auth()->user()->hasPermissionTo('delete_suprequest') or auth()->user()->hasPermissionTo('create_suprequest'))
            <li class="nav-item has-treeview {{((Illuminate\Support\Facades\Route::is('supportNew') 
              or Illuminate\Support\Facades\Route::is('supportList') ) ? 'menu-open' : '')}}">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-envelope-o"></i>
                <p>
                درخواست های پشتیبانی
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(auth()->user()->hasPermissionTo('create_suprequest'))
                <li class="nav-item">
                  <a href="{{ route('supportNew') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('supportNew') ? 'active' : '')}}">
                    <i class="fa fa-pencil-square-o nav-icon"></i>
                    <p>ثبت درخواست پشتیبانی</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermissionTo('view_suprequest') or auth()->user()->hasPermissionTo('edit_suprequest') or auth()->user()->hasPermissionTo('delete_suprequest'))
                <li class="nav-item">
                  <a href="{{ route('supportList') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('supportList') ? 'active' : '')}}">
                    <i class="fa fa-list-alt nav-icon"></i>
                    <p>تمام درخواست ها</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            @endif
            @if(auth()->user()->hasPermissionTo('view_user') or auth()->user()->hasPermissionTo('edit_user') or auth()->user()->hasPermissionTo('delete_user') or auth()->user()->hasPermissionTo('create_user'))
            <li class="nav-item has-treeview {{((Illuminate\Support\Facades\Route::is('usersNew') 
              or Illuminate\Support\Facades\Route::is('roleNew')
              or Illuminate\Support\Facades\Route::is('usersList') ) ? 'menu-open' : '')}}">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-envelope-o"></i>
                <p>
                حساب های کاربری
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if(auth()->user()->hasPermissionTo('create_user'))
                <li class="nav-item">
                  <a href="{{ route('usersNew') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('usersNew') ? 'active' : '')}}">
                    <i class="fa fa-pencil-square-o nav-icon"></i>
                    <p>حساب کاربری جدید</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermissionTo('create_roles'))
                <li class="nav-item">
                  <a href="{{ route('roleNew') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('roleNew') ? 'active' : '')}}">
                    <i class="fa fa-pencil-square-o nav-icon"></i>
                    <p>نقش کاربری جدید</p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermissionTo('view_user') or auth()->user()->hasPermissionTo('edit_user') or auth()->user()->hasPermissionTo('delete_user'))
                <li class="nav-item">
                  <a href="{{ route('usersList') }}" class="nav-link {{(Illuminate\Support\Facades\Route::is('usersList') ? 'active' : '')}}">
                    <i class="fa fa-list-alt nav-icon"></i>
                    <p>مدیریت حساب ها</p>
                  </a>
                </li>
                @endif
              </ul>
            </li>
                @endif
            <li class="nav-item">
              <a href="{{ route('userProfile') }}" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                  پروفایل
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('signout') }}" class="nav-link">
                <i class="nav-icon fa fa-sign-out"></i>
                <p>
                  خروج
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>

