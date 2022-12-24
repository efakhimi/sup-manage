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
                <h3 class="card-title">پشتیبانی های موجود</h3>

                <div class="card-tools">
                    <div class="m-0 float-right">
                        <button type="button" onclick="window.location.href='{{ route("supportNew") }}'" class="btn btn-block btn-outline-success">جدید</button>
                    </div>
                </div>
                
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
              <div class="card-footer clearfix">
                @if ($requests->hasPages())
                  <ul class="pagination pagination-sm m-0 float-right">
                    @if (!$requests->onFirstPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ ($requests->url(1)) }}">
                                <i class="w-4 h-4" data-feather="chevrons-right"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ ($requests->previousPageUrl()) }}">
                                <i class="w-4 h-4" data-feather="chevron-right"></i>
                            </a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="{{ ($requests->url($requests->currentPage() - 1)) }}">{{ ($requests->currentPage() - 1) }}</a>
                        </li>
                    @endif
                    <li class="page-item active">
                        <a class="page-link" href="{{ ($requests->url($requests->currentPage())) }}">{{ ($requests->currentPage()) }}</a>
                    </li>
                    @if ($requests->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ ($requests->url($requests->currentPage() + 1)) }}">{{ ($requests->currentPage() + 1) }}</a>
                        </li>
                        
                        <li class="page-item">
                            <a class="page-link" href="{{ ($requests->nextPageUrl()) }}">
                                <i class="w-4 h-4" data-feather="chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ ($requests->url($requests->lastPage())) }}">
                                <i class="w-4 h-4" data-feather="chevrons-left"></i>
                            </a>
                        </li>
                    @endif
                  </ul>
                @endif
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