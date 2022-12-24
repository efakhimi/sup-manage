@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">حساب کاربری</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">خانه</a></li>
              <li class="breadcrumb-item active">پروفایل</li>
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
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/img/user.png') }}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">
                  @if($user->fname)
                    {{$user->fname}} 
                  @endif
                  @if($user->lname)
                    {{$user->lname}} 
                  @endif
                </h3>

                <p class="text-muted text-center">
                  @if($user->job_position)
                    {{$user->job_position}} 
                  @endif
                </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>درخواست های ایجاد شده</b> <a class="float-left">۵۴۳</a>
                  </li>
                  <li class="list-group-item">
                    <b>تاریخ ایجاد حساب</b> <a class="float-left">{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i', strtotime($user->created_at))) }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>آخرین بروز رسانی</b> <a class="float-left">{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i', strtotime($user->updated_at))) }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>آخرین ورود</b> <a class="float-left">{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i', strtotime($user->last_login))) }}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab">فعالیت‌ها</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">تنظیمات</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active show" id="activity">

                    <table class="table">
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>شرکت</th>
                        <th>دسته‌بندی مشکل</th>
                        <th>عنوان درخواست</th>
                        <th>تماس گیرنده</th>
                        <th>شروع</th>
                        <th>خاتمه</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                      </tr>
                      
                      @foreach ($requests as $request)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('contractShow')."/".$request->customer->id }}">{{ $request->customer->cname }}</a></td>
                        <td><a href="{{ route('supportShow')."/".$request->id }}">{{ $request->category->name }}</a></td>
                        <td><a href="{{ route('supportShow')."/".$request->id }}">{{ $request->title }}</a></td>
                        <td>{{ $request->callername }}</td>
                        <td>{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i', strtotime($request->start_date))) }}</td>
                        <td>
                          @if($request->end_date != null AND $request->end_date !="")
                            {{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i', strtotime($request->end_date))) }}
                          @else
                          <button type="button" onclick="window.location.href='{{ route("supportUpdateEnd")."/". $request->id }}'" class="btn btn-outline-info">خاتمه</button>
                          @endif
                        </td>
                        <td><i class="nav-icon fa fa-circle-o text-{{ ($request->solved == 0 ? 'danger' : 'success') }}"></i>&nbsp;{{ ($request->solved == 0 ? 'حل نشده' : 'حل شده') }}</td>
                        <td>
                            <button type="button" onclick="window.location.href='{{ route("supportUpdateStatusSave")."/". $request->id }}'" class="btn btn-outline-warning" {{ ($request->solved == 0 ? '' : 'disabled') }}>
                                <span class="text-success">حل شده</span>
                            </button>
                            &nbsp;
                            <button type="button" onclick="window.location.href='{{ route("supportUpdate")."/". $request->id }}'" class="btn btn-outline-info">ویرایش</button>
                            &nbsp;
                            <button type="button" onclick="window.location.href='{{ route("supportDelete")."/". $request->id }}'" class="btn btn-outline-danger">حذف</button>
                            &nbsp;

                        </td>
                      </tr>
                      @endforeach
                    </table>

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="settings">
                    @if(Illuminate\Support\Facades\Route::is('userProfile'))
                      <form class="form-horizontal"  method="POST" action="{{ route('userEditProfileStore') }}">
                        @csrf
                        <div class="form-group">
                          <label for="fname" class="col-sm-2 control-label">نام</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="نام" value="{{ $user->fname }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="lname" class="col-sm-2 control-label">نام خانوادگی</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="نام خانوادگی" value="{{ $user->lname }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="uname" class="col-sm-2 control-label">نام کاربری</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Name" value="{{ $user->uname }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="password" class="col-sm-2 control-label">رمز عبور جدید</label>

                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="password2" class="col-sm-2 control-label">تکرار رمز عبرو جدید</label>

                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password2" name="password2" >
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">ذخیره</button>
                          </div>
                        </div>
                      </form>
                      @if ($errors->has('uname'))
                        <span class="text-danger">{{ $errors->first('uname') }}</span>
                      @endif
                      @if ($errors->has('fname'))
                        <span class="text-danger">{{ $errors->first('fname') }}</span>
                      @endif
                      @if ($errors->has('lname'))
                        <span class="text-danger">{{ $errors->first('lname') }}</span>
                      @endif
                      @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                      @endif
                      @if ($errors->has('password2'))
                        <span class="text-danger">{{ $errors->first('password2') }}</span>
                      @endif
                    @else
                      <form class="form-horizontal"  method="POST" action="{{ route('usersUpdateSave')."/".$user->id }}">
                        @csrf
                        <div class="form-group">
                          <label for="fname" class="col-sm-2 control-label">نام</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="نام" value="{{ $user->fname }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="lname" class="col-sm-2 control-label">نام خانوادگی</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="نام خانوادگی" value="{{ $user->lname }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="uname" class="col-sm-2 control-label">نام کاربری</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Name" value="{{ $user->uname }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="job_position" class="col-sm-2 control-label">موقعیت شغلی</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="job_position" name="job_position" placeholder="موقعیت شغلی" value="{{ $user->job_position }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="password" class="col-sm-2 control-label">رمز عبور جدید</label>

                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="password2" class="col-sm-2 control-label">تکرار رمز عبرو جدید</label>

                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password2" name="password2" >
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">ذخیره</button>
                          </div>
                        </div>
                      </form>
                      @if ($errors->has('uname'))
                        <span class="text-danger">{{ $errors->first('uname') }}</span>
                      @endif
                      @if ($errors->has('fname'))
                        <span class="text-danger">{{ $errors->first('fname') }}</span>
                      @endif
                      @if ($errors->has('lname'))
                        <span class="text-danger">{{ $errors->first('lname') }}</span>
                      @endif
                      @if ($errors->has('job_position'))
                        <span class="text-danger">{{ $errors->first('job_position') }}</span>
                      @endif
                      @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                      @endif
                      @if ($errors->has('password2'))
                        <span class="text-danger">{{ $errors->first('password2') }}</span>
                      @endif
                    @endif
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
@include('layouts.fullfooter')