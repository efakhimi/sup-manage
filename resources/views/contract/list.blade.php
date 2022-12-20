@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">قرارداد ها</h1>
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
                <h3 class="card-title">قرارداد های موجود</h3>

                <div class="card-tools">
                    <div class="m-0 float-right">
                        <button type="button" onclick="window.location.href='{{ route("contractNew") }}'" class="btn btn-block btn-outline-success">جدید</button>
                    </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>عنوان شرکت</th>
                    <th>شماره قرارداد</th>
                    <th>تاریخ شروع قرارداد</th>
                    <th>تاریخ پایان قرارداد</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                  </tr>
                  
                  </thead>
                  <tbody>
                  @foreach ($contracts as $contract)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('contractShow')."/".$contract->id }}">{{ $contract->customer->cname }}</a></td>
                    <td><a href="{{ route('contractShow')."/".$contract->id }}">{{ $contract->contract_no }}</a></td>
                    <td>{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($contract->start_date))) }}</td>
                    <td>{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($contract->end_date))) }}</td>
                    <td><i class="nav-icon fa fa-circle-o text-{{ ($contract->status == 1 ? 'success' : 'danger') }}"></i>&nbsp;{{ ($contract->status == 0 ? 'غیرفعال' : 'فعال') }}</td>
                    <td>
                        <button type="button" onclick="window.location.href='{{ route("contractUpdateStatusSave")."/". $contract->id }}'" class="btn btn-outline-warning">
                            <span class="text-{{ ($contract->status == 1 ? 'danger' : 'success') }}">{{ ($contract->status == 1 ? 'غیرفعال' : 'فعال') }}</span>
                        </button>
                        &nbsp;
                        <button type="button" onclick="window.location.href='{{ route("contractUpdate")."/". $contract->id }}'" class="btn btn-outline-info">ویرایش</button>
                        &nbsp;
                        <button type="button" onclick="window.location.href='{{ route("contractDelete")."/". $contract->id }}'" class="btn btn-outline-danger">حذف</button>
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