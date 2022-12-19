@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">دسته‌بندی مشکلات نرم‌افزاری</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">خانه</a></li>
              <li class="breadcrumb-item active">دسته‌بندی مشکلات نرم‌افزاری</li>
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
                    <h3 class="card-title">ایجاد دسته‌بندی جدید مشکلات نرم‌افزاری</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal"  method="POST" action="{{ route('categoryNewAction') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="catTitle" class="col-sm-2 control-label">عنوان</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="catTitle" name="name" placeholder="عنوان دسته‌بندی">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="catTitle" class="col-sm-2 control-label">وضعیت</label>

                            <div class="col-sm-10">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="catActive" name="active">
                                    <label class="custom-control-label" for="catActive">فعال باشد؟</label>
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
                        <button type="button" onclick="window.location.href='{{ route("categoryList") }}'" class="btn btn-default float-left">بازگشت</button>
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