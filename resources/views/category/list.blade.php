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
                <h3 class="card-title">دسته‌بندی های موجود</h3>

                <div class="card-tools">
                    <div class="m-0 float-right">
                        <button type="button" onclick="window.location.href='{{ route("categoryNew") }}'" class="btn btn-block btn-outline-success">جدید</button>
                    </div>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>عنوان</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                  </tr>
                  
                  @foreach ($categories as $cat)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cat->name }}</td>
                    <td><i class="nav-icon fa fa-circle-o text-{{ ($cat->active == 0 ? 'danger' : 'success') }}"></i></td>
                    <td>
                        <button type="button" onclick="window.location.href='{{ route("categoryUpdateStatusSave")."/". $cat->id }}'" class="btn btn-outline-warning">
                            <span class="text-{{ ($cat->active == 0 ? 'success' : 'danger') }}">{{ ($cat->active == 0 ? 'فعال' : 'غیرفعال') }}</span>
                        </button>
                        &nbsp;
                        <button type="button" onclick="window.location.href='{{ route("categoryUpdate")."/". $cat->id }}'" class="btn btn-outline-info">ویرایش</button>
                        &nbsp;
                        <button type="button" onclick="window.location.href='{{ route("categoryDelete")."/". $cat->id }}'" class="btn btn-outline-danger">حذف</button>
                        &nbsp;

                    </td>
                  </tr>
                  @endforeach
                </table>
              </div>
              <div class="card-footer clearfix">
                @if ($categories->hasPages())
                  <ul class="pagination pagination-sm m-0 float-right">
          
                    <!-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> -->
                    
                    @if (!$categories->onFirstPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ ($categories->url(1)) }}">
                                <i class="w-4 h-4" data-feather="chevrons-right"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ ($categories->previousPageUrl()) }}">
                                <i class="w-4 h-4" data-feather="chevron-right"></i>
                            </a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="{{ ($categories->url($categories->currentPage() - 1)) }}">{{ ($categories->currentPage() - 1) }}</a>
                        </li>
                    @endif
                    <li class="page-item active">
                        <a class="page-link" href="{{ ($categories->url($categories->currentPage())) }}">{{ ($categories->currentPage()) }}</a>
                    </li>
                    @if ($categories->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ ($categories->url($categories->currentPage() + 1)) }}">{{ ($categories->currentPage() + 1) }}</a>
                        </li>
                        
                        <li class="page-item">
                            <a class="page-link" href="{{ ($categories->nextPageUrl()) }}">
                                <i class="w-4 h-4" data-feather="chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ ($categories->url($categories->lastPage())) }}">
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