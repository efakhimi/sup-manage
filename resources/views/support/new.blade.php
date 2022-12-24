@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">پشتیبانی مشکلات نرم‌افزاری</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">خانه</a></li>
              <li class="breadcrumb-item active">پشتیبانی مشکلات نرم‌افزاری</li>
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
                    <h3 class="card-title">ایجاد درخواست پشتیبانی جدید</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal"  method="POST" action="{{ route('supportNewAction') }}">
                    @csrf
                    <div class="card-body">
                      
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="customer_id" class="col-sm-12 control-label">عنوان شرکت</label>

                              <div class="col-sm-12">
                                <select class="form-control select2" style="width: 100%;" id="customer_id" name="customer_id" required autofocus>
                                @foreach ($customers as $customer)
                                  <option value="{{ $customer->id }}">{{ $customer->cname }}</option>
                                @endforeach
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="category_id" class="col-sm-12 control-label">موضوع درخواست</label>

                              <div class="col-sm-12">
                                <select class="form-control select2" style="width: 100%;" id="category_id" name="category_id" required>
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="title" class="col-sm-12 control-label">عنوان درخواست</label>

                              <div class="col-sm-12">
                                  <input class="form-control" id="title" name="title">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="supuser" class="col-sm-12 control-label">کاربر پشتیبان</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="supuser" value="{{ auth()->user()->fname }}" disabled>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label class="col-sm-12 control-label">شروع</label>

                              <div class="col-sm-12">
                                  <input class="form-control" disabled value="{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i', strtotime(date("Y/m/d H:i")))) }}">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="end_date" class="col-sm-12 control-label">خاتمه</label>

                              <div class="col-sm-12">
                                  <input class="form-control" disabled >
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="callername" class="col-sm-12 control-label">نام درخواست کننده</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="callername" name="callername">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="callertell" class="col-sm-12 control-label">تلفن درخواست کننده</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="callertell" name="callertell">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="desc" class="col-sm-12 control-label">توضیحات</label>

                              <div class="col-sm-12">
                                <textarea class="form-control" rows="3" placeholder="توضیحاتی درباره مشکل مشتری" name="desc" id="desc"></textarea>
                              </div>
                          </div>
                        </div>
                      </div>



                      @if ($errors->has('customer_id'))
                          <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                      @endif
                      @if ($errors->has('category_id'))
                          <span class="text-danger">{{ $errors->first('category_id') }}</span>
                      @endif
                      @if ($errors->has('title'))
                          <span class="text-danger">{{ $errors->first('title') }}</span>
                      @endif
                      @if ($errors->has('callername'))
                          <span class="text-danger">{{ $errors->first('callername') }}</span>
                      @endif
                      @if ($errors->has('callertell'))
                          <span class="text-danger">{{ $errors->first('callertell') }}</span>
                      @endif
                      @if ($errors->has('desc'))
                          <span class="text-danger">{{ $errors->first('desc') }}</span>
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