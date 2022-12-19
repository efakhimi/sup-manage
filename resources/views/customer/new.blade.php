@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">مشتری جدید</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">خانه</a></li>
              <li class="breadcrumb-item active">مشتری ها</li>
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
                    <h3 class="card-title">ایجاد مشتری جدید</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal"  method="POST" action="{{ route('customerNewAction') }}">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="customerTitle" class="col-sm-12 control-label">عنوان شرکت</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="customerTitle" name="cname" placeholder="عنوان شرکت" required autofocus>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="ctell" class="col-sm-12 control-label">تلفن شرکت</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="ctell" name="ctell" placeholder="تلفن شرکت">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="caddress" class="col-sm-12 control-label">آدرس شرکت</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="caddress" name="caddress" placeholder="آدرس شرکت">
                              </div>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="techname" class="col-sm-12 control-label">رابط فنی</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="techname" name="techname" placeholder="رابط فنی شرکت">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="techtell" class="col-sm-12 control-label">تلفن رابط فنی</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="techtell" name="techtell" placeholder="تلفن رابط فنی شرکت">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="status" class="col-sm-12 control-label">وضعیت</label>

                            <div class="col-sm-12">
                              <select class="form-control" name="status" id="status">
                                <option value="فعال">فعال</option>
                                <option value="غیرفعال">غیرفعال</option>
                                <option value="مسدود">مسدود</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت</button>
                        <button type="button" onclick="window.location.href='{{ route("customerList") }}'" class="btn btn-default float-left">بازگشت</button>
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