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
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">ایجاد حساب کاربری جدید</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal"  method="POST" action="{{ route('usersNewAction') }}">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="fname" class="col-sm-12 control-label">نام</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="fname" name="fname" placeholder="نام" autofocus>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="lname" class="col-sm-12 control-label">نام خانوادگی</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="lname" name="lname" placeholder="نام خانوادگی">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="uname" class="col-sm-12 control-label">نام کاربری</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="uname" name="uname" placeholder="نام کاربری" required>
                              </div>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="password" class="col-sm-12 control-label">رمز عبور</label>

                              <div class="col-sm-12">
                                  <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور" required>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="password2" class="col-sm-12 control-label">تکرار رمز عبور</label>

                              <div class="col-sm-12">
                                  <input type="password" class="form-control" id="password2" name="password2" placeholder="تکرار رمز عبور" required>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="job_position" class="col-sm-12 control-label">عنوان شغلی</label>

                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="job_position" name="job_position" placeholder="موقعیت شغلی">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="role" class="col-sm-12 control-label">نقش کاربر</label>

                            <div class="col-sm-12">
                              <select class="form-control" name="role" id="role">
                                <option ></option>
                                @foreach($roles as $role)
                                  <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="perm" class="col-sm-12 control-label">دسترسی بیشتر کاربر</label>

                            <div class="col-sm-12">
                              <select multiple class="form-control" name="perm[]" id="perm">
                                @foreach($perms as $perm)
                                  <option value="{{ $perm->name }}">{{ $perm->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                        @if ($errors->has('fname'))
                            <span class="text-danger">{{ $errors->first('fname') }}</span>
                        @endif
                        @if ($errors->has('lname'))
                            <span class="text-danger">{{ $errors->first('lname') }}</span>
                        @endif
                        @if ($errors->has('uname'))
                            <span class="text-danger">{{ $errors->first('uname') }}</span>
                        @endif
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        @if ($errors->has('password2'))
                            <span class="text-danger">{{ $errors->first('password2') }}</span>
                        @endif
                        @if ($errors->has('job_position'))
                            <span class="text-danger">{{ $errors->first('job_position') }}</span>
                        @endif
                        @if ($errors->has('role'))
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                        @endif
                        @if ($errors->has('perm'))
                            <span class="text-danger">{{ $errors->first('perm') }}</span>
                        @endif
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <button type="button" onclick="window.location.href='{{ route("usersList") }}'" class="btn btn-default float-left">بازگشت</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
@include('layouts.fullfooter')