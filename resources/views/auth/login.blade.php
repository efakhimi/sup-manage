@include('layouts.header')

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../"><b>ورود به سامانه</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>

      <form method="POST" action="{{ route('login.custom') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" id="uname" class="form-control" name="uname" required autofocus>
            <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
        </div>
            @if ($errors->has('uname'))
                <span class="text-danger">{{ $errors->first('uname') }}</span>
            @endif
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">
            {{ Session::get('error')}}
            </div>
            @endif
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

@include('layouts.footer')