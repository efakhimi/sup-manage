@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">مشتری ها</h1>
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
                <h3 class="card-title">مشتری های موجود</h3>

                <div class="card-tools">
                    <div class="m-0 float-right">
                        <button type="button" onclick="window.location.href='{{ route("customerNew") }}'" class="btn btn-block btn-outline-success">جدید</button>
                    </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>عنوان</th>
                    <th>تلفن شرکت</th>
                    <th>رابط فنی</th>
                    <th>تلفن رابط فنی</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                  </tr>
                  
                  </thead>
                  <tbody>
                  @foreach ($customers as $customer)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->cname }}</td>
                    <td>{{ $customer->ctell }}</td>
                    <td>{{ $customer->techname }}</td>
                    <td>{{ $customer->techtell }}</td>
                    <td><i class="nav-icon fa fa-circle-o text-{{ ($customer->status == "فعال" ? 'success' : ($customer->status == "غیرفعال" ? 'secondary' : 'danger')) }}"></i>&nbsp;{{$customer->status}}</td>
                    <td>
                        <button type="button" onclick="window.location.href='{{ route("customerUpdate")."/". $customer->id }}'" class="btn btn-outline-info">ویرایش</button>
                        &nbsp;
                        <button type="button" onclick="window.location.href='{{ route("customerDelete")."/". $customer->id }}'" class="btn btn-outline-danger">حذف</button>
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