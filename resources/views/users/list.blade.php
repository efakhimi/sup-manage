@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">حسابهای کاربری</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">خانه</a></li>
              <li class="breadcrumb-item active">کاربران</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if(session('statusErr'))
            <div class="alert alert-danger">
                {{ session('statusErr') }}
            </div>
        @endif
        </div>
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">کاربران موجود</h3>

                <div class="card-tools">
                    <div class="m-0 float-right">
                        <button type="button" onclick="window.location.href='{{ route("usersNew") }}'" class="btn btn-block btn-outline-success">جدید</button>
                    </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>نام و نام خانوادگی (نام کاربری)</th>
                    <th>موقعیت شغلی</th>
                    <th>آخرین ورود</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                  </tr>
                  
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->fname }}&nbsp;{{ $user->lname }}&nbsp;({{ $user->uname }})</td>
                    <td>{{ $user->job_position }}</td>
                    <td>
                      @if($user->last_login!=null)
                        {{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i', strtotime($user->last_login))) }}
                      @else
                        وارد نشده است
                      @endif
                    </td>
                    <td><i class="nav-icon fa fa-circle-o text-{{ ($user->active == 1 ? 'success' : 'danger') }}"></i>&nbsp;{{ ($user->active == 1 ? 'فعال' : 'مسدود') }}</td>
                    <td>
                        <button type="button" onclick="window.location.href='{{ route("usersUpdateStatusSave")."/". $user->id }}'" class="btn btn-outline-warning">
                            <span class="text-{{ ($user->active == 1 ? 'danger' : 'success') }}">{{ ($user->active == 0 ? 'فعال' : 'مسدود') }}</span>
                        </button>
                        &nbsp;
                        <button type="button" onclick="window.location.href='{{ route("usersShow")."/". $user->id }}'" class="btn btn-outline-info">مشاهده و ویرایش</button>
                        &nbsp;
                        <button type="button" onclick="window.location.href='{{ route("usersDelete")."/". $user->id }}'" class="btn btn-outline-danger">حذف</button>
                        &nbsp;

                    </td>
                  </tr>
                  @endforeach
                </table>
              </div>
              <div class="card-footer clearfix">
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
@include('layouts.fullfooter')