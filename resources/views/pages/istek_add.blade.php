@extends('pages.layout')
@section('title','İstək əlavə et')
@section('content')

<style type="text/css">

</style>

<div id="myModal" class="modalsss">

  <!-- Modal content -->
  <div class="modal-content">
    <span id="ModalClose" class="close">&times;</span>
    <p></p>
  </div>

</div>

<div id="breadcrumb">
<div class="container">
   <div class="row">
     <div class="col-lg-12">
       <h1 class="text-left">Yeni İstək</h1>
     </div>
  </div>
</div>
</div>
@if(Auth::user())
  <section id="add">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div id="map"></div>
        <button id="MyLocation" class="btn" type="button" name="button">Məni Tap</button>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        @if (Session::has('istekadded'))
          <div class="alert alert-success" role="alert">{{Session::get('istekadded')}}</div>
        @endif
        @if (Session::has('imageerror'))
          <div class="alert alert-danger" role="alert">{{Session::get('imageerror')}}</div>
        @endif
        @if (Session::has('dateerror'))
          <div class="alert alert-danger" role="alert">{{Session::get('dateerror')}}</div>
        @endif
        <div id="ajaxErrorImage"></div>

              @if ($errors->has('about') || $errors->has('about') || $errors->has('lat') || $errors->has('lng') || $errors->has('nov') || $errors->has('date'))
                  <span class="help-block">
                    <div class="alert alert-danger"><p>Ulduz ilə işarəli xanaları boş saxlamayın.</p></div>
                  </span>
              @endif

        <form id="forUploadImages" action="{{url('/istek-add')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          {{-- <=================title input ================> --}}
          <div class="col-lg-6">
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              <label for="name">Başlıq<SPAN> *</SPAN></label>
              <input type="text" name="title" class="form-control" maxlength="33" value="{{ old('title') }}">
            </div>

            {{-- <=================location input ================> --}}
            <div class="form-group{{ $errors->has('location') || $errors->has('lat') && $errors->has('lng')? ' has-error' : '' }}">
              <label for="name">Ünvan<SPAN> *</SPAN></label>
                 <input type="hidden" id="lat" name="lat">
                  <input type="hidden" id="lng" name="lng">
              <input type="text" name="location" class="form-control" id="adress" placeholder="">
            </div>

            {{-- <=================organization input ================> --}}
            <div class="form-group">
              <label for="name">Təşkilat adı</label>
              <input type="text" name="org" class="form-control" placeholder="Yoxdursa boş buraxın" value="{{ old('org') }}">
            </div>

            {{-- <=================About input ================> --}}
            <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
              <label for="name">Açıqlama<SPAN> *</SPAN></label>
              <textarea name="about" class="form-control" rows="6" cols="80">{{ old('about') }}</textarea>
            </div>
          {{-- <=================image input ================> --}}
            <div class="form-group{{ $errors->has('image[]') ? ' has-error' : '' }}">
              <label for="email">Şəkil <SPAN> *</SPAN></label>
              <a class="forImg form-control btn btn-default">Şəkil Seç</a>
              <input id="forLimitFile" type="file" name="image[]" class="imgInput hidden form-control" value="{{ old('image') }}" multiple>
              <p>Eyni anda bir və ya bir neçə şəkil seçə bilərsiniz</p>
            </div>
          {{-- for showing uploaded image --}}
          <div id="viewImage"></div>

          </div>
          <div class="col-lg-6">

            {{-- <=================Name input ================> --}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="city">Ad, Soyad<SPAN> *</SPAN></label>
              <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
            </div>

            {{-- <=================Phone input ================> --}}
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="operator">Əlaqə nömrəsi<SPAN> *</SPAN></label>
              <div class="input-group">
                  <div class="input-group-addon">
                      <input id="operator" type="hidden" name="operator" value="{{substr(Auth::user()->phone,4,2) == '55' ? '55' : substr(Auth::user()->phone,4,2) }}">
                      +994
                          <select id="operator-numbers" name="operator-numbers">
                            <option {{substr(Auth::user()->phone,4,2) == '55' ? 'selected' : '' }}>55</option>
                            <option {{substr(Auth::user()->phone,4,2) == '51' ? 'selected' : '' }}>51</option>
                            <option {{substr(Auth::user()->phone,4,2) == '50' ? 'selected' : '' }}>50</option>
                            <option {{substr(Auth::user()->phone,4,2) == '70' ? 'selected' : '' }}>70</option>
                            <option {{substr(Auth::user()->phone,4,2) == '77' ? 'selected' : '' }}>77</option>
                          </select>
                      </div>
                <input id="inputNumber" type="text" class="form-control" name="phone" value="{{substr(Auth::user()->phone,6)}}" maxlength="7">
              </div>
            </div>

            {{-- <=================Email input ================> --}}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="password">Email<SPAN> *</SPAN></label>
              <input type="email" name="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}">
            </div>

            {{-- <=================Nov input ================> --}}
            <div class="form-group{{ $errors->has('nov') ? ' has-error' : '' }}">
              <label for="password">Növ<SPAN> *</SPAN></label>
              <input type="text" name="nov" class="form-control" placeholder="Məsələn: Təhsil, texnologiya və s." value="{{ old('nov') }}">
            </div>

            {{-- <=================Date input ================> --}}
            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
              <label for="date">İstəyin müddəti<SPAN> *</SPAN></label>
              <input type="date" name="date" class="form-control" id="date" value="{{ old('date') }}">
              @if ($errors->has('date'))
                  <span class="help-block">
                    <strong>Seçdiyiniz tarix sizin elanınızın bitmə müddətini göstərir. Həmin gündən sonra elan görünməyəcək</strong>
                  </span>
              @endif
            </div>
            <div class="form-group text-right">
              <input type="submit" class="btn" value="GÖNDƏR">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </section>
@elseif(Auth::guest())
  <section id="add">
    <div class="alert alert-danger">
      <h1 class="text-center">İstək əlavə etmək üçün <a href="#" data-toggle="modal" data-target="#contact-login-modal" class="register-color">daxil olun</a> ya da <a href="{{url('/Qeydiyyat')}}" class="register-color">qeydiyyatdan</a> keçməyiniz tələb olunur.</h1>
    </div>
  </section>
@endif

@endsection
@section('scripts')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAanmTrOlQYWRepobnwqSO1E2SOoHYMRBA&libraries=places&callback=initAutocomplete&language=az"
         async defer></script>
@endsection
