@extends('pages.layout')

@section('title', 'Şifrə bərpası')
  
@section('content')
  <div id="breadcrumb">
  <div class="container">
     <div class="row">
       <div class="col-lg-12">
         <h1>Şifrə Bərpası</h1>
       </div>
    </div>
  </div>
</div>

<section id="password-reset">
  <div class="container">
      <div class="row">
          <div class=" col-lg-8 col-md-8 col-md-offset-2">
            @if (session('status'))
                <div class="alert alert-success">
                    {{-- {{ session('status') }} --}}
                    Biz sizin emailinizə şifrəni bərpa etmək üçün link göndərdik zəhmət olmasa emailinizi yoxlayın.
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>E-Mail adresinizi yazın</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group pass-reset-form">
                    <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn">
                          <i class="fa fa-btn fa-envelope"></i> Şifrə dəyişmə linkini göndər
                      </button>
                    </div>
                </div>
            </form>
          </div>
      </div>
  </div>
<section>
@endsection
