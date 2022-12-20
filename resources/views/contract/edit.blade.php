@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ویرایش قرارداد</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">خانه</a></li>
              <li class="breadcrumb-item active">قرارداد ها</li>
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
                    <h3 class="card-title">ویرایش قرارداد</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal"  method="POST" action="{{ route('contractUpdateSave')."/".$contract->id }}">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="customerTitle" class="col-sm-12 control-label">عنوان شرکت</label>

                              <div class="col-sm-12">
                                  <input type="text" disabled class="form-control" id="customerTitle" value="{{ $contract->customer->cname }}">
                              </div>
                          </div>
                        </div>
                        
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="start_date" class="col-sm-12 control-label">تاریخ شروع قرارداد</label>

                              <div class="col-sm-12">
                                  <input class="form-control" id="start_date" name="start_date" value="{{ $contract->start_date }}" required>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="end_date" class="col-sm-12 control-label">تاریخ پایان قرارداد</label>

                              <div class="col-sm-12">
                                  <input class="form-control" id="end_date" name="end_date" value="{{ $contract->end_date }}" required>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                              <label for="contract_no" class="col-sm-12 control-label">شماره قرارداد</label>

                              <div class="col-sm-12">
                                  <input type="text" class="form-control" id="contract_no" name="contract_no" placeholder="شماره قرارداد"  value="{{ $contract->contract_no }}" required>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="status" class="col-sm-12 control-label">وضعیت</label>

                            <div class="col-sm-12">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="status" name="status" {{ ($contract->status == 1 ? 'checked': '') }} >
                                  <label class="custom-control-label" for="status">فعال باشد؟</label>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @if ($errors->has('start_date'))
                          <span class="text-danger">{{ $errors->first('start_date') }}</span>
                      @endif
                      @if ($errors->has('end_date'))
                          <span class="text-danger">{{ $errors->first('end_date') }}</span>
                      @endif
                      @if ($errors->has('contract_no'))
                          <span class="text-danger">{{ $errors->first('contract_no') }}</span>
                      @endif
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ذخیره</button>
                        <button type="button" onclick="window.location.href='{{ route("contractList") }}'" class="btn btn-default float-left">بازگشت</button>
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