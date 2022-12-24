@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">مشاهده درخواست</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">خانه</a></li>
              <li class="breadcrumb-item active">درخواست ها</li>
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
                    <h3 class="card-title">مشاهده درخواست</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <strong>عنوان شرکت</strong> : {{ $supportRequest->customer->cname }}
                    </div>
                    <div class="col-sm-3">
                      <strong>تلفن شرکت</strong> : {{ $supportRequest->customer->ctell }}
                    </div>
                    <div class="col-sm-3">
                      <strong>رابط فنی</strong> : {{ $supportRequest->customer->techname }}
                    </div>
                    <div class="col-sm-3">
                      <strong>تلفن رابط فنی</strong> : {{ $supportRequest->customer->techtell }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <strong>عنوان درخواست</strong> : {{ $supportRequest->title }}
                    </div>
                    <div class="col-sm-3">
                      <strong>موضوع درخواست</strong> : {{ $supportRequest->category->name }}
                    </div>
                    <div class="col-sm-3">
                      <strong>شروع درخواست</strong> : {{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($supportRequest->start_date))) }}
                    </div>
                    <div class="col-sm-3">
                      <strong>پایان درخواست</strong> : 
                      @if($supportRequest->end_date != null AND $supportRequest->end_date !="")
                        {{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('Y/m/d H:i', strtotime($supportRequest->end_date))) }}
                      @else
                      هنوز تمام نشده است
                      @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <strong>توضیحات</strong> : {{ $supportRequest->desc }}
                    </div>
                    <div class="col-sm-4">
                      <strong>نام درخواست کننده</strong> : {{ $supportRequest->callername }}
                    </div>
                    <div class="col-sm-4">
                      <strong>تلفن درخواست کننده</strong> : {{ $supportRequest->callertell }}
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
                <h3 class="card-title">سایر قراردادهای {{ $supportRequest->customer->cname }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
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
                  
                  @foreach ($otherSupportRequest as $request)
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