@extends('pages.layout')

@section('title','Login')

@section('content')
  <div id="breadcrumb">
  <div class="container">
     <div class="row">
          <h1 class="text-left">Admin Login</h1>
    </div>
  </div>
</div>
  <section id="loginpage">
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
            @if (Session::has('istekerror'))
              <div class="alert alert-danger" role="alert">{{Session::get('istekerror')}}</div>
            @elseif (Session::has('destekerror'))
              <div class="alert alert-danger" role="alert">{{Session::get('destekerror')}}</div>
            @endif
              <div class="panel panel-default">
                  <div class="panel-body">
                      <form class="form-horizontal" role="form" method="POST" action="{{ url('alfagen/postLogin') }}">
                          {{ csrf_field() }}
                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label for="email" class="col-md-4 control-label">E-Mail adresi</label>
                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                              <label for="password" class="col-md-4 control-label">Şifrə</label>
                              <div class="col-md-6">
                                  <input id="password" type="password" class="form-control" name="password">
                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn">
                                      <i class="fa fa-btn fa-sign-in"></i> Daxil ol
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
