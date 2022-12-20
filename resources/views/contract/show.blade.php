@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">مشاهده قرارداد</h1>
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
                    <h3 class="card-title">مشاهده قرارداد</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <strong>عنوان شرکت</strong> : {{ $contract->customer->cname }}
                    </div>
                    <div class="col-sm-3">
                      <strong>تلفن شرکت</strong> : {{ $contract->customer->ctell }}
                    </div>
                    <div class="col-sm-3">
                      <strong>رابط فنی</strong> : {{ $contract->customer->techname }}
                    </div>
                    <div class="col-sm-3">
                      <strong>تلفن رابط فنی</strong> : {{ $contract->customer->techtell }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <strong>شماره قرارداد</strong> : {{ $contract->contract_no }}
                    </div>
                    <div class="col-sm-4">
                      <strong>شروع قرارداد</strong> : {{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($contract->start_date))) }}
                    </div>
                    <div class="col-sm-4">
                      <strong>پایان قرارداد</strong> : {{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($contract->end_date))) }}
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">سایر قراردادهای {{ $contract->customer->cname }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>شماره قرارداد</th>
                    <th>تاریخ شروع قرارداد</th>
                    <th>تاریخ پایان قرارداد</th>
                  </tr>
                  
                  </thead>
                  <tbody>
                  @foreach ($otherContracts as $con)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $con->contract_no }}</td>
                    <td>{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($con->start_date))) }}</td>
                    <td>{{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($con->end_date))) }}</td>
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