@extends('pages.layout')
@section('title','Ətraflı')
@section('content')
  <div id="breadcrumb">
  <div class="container">
     <div class="row">
       <div class="col-lg-12">
         <h1 class="text-left">{{$single->title}}</h1>
       </div>
    </div>
  </div>
</div>
<section id="single">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="single-img">
          <div class="single-img-deadline">
            <i class="fa fa-calendar"></i>
            @if(!$diff->d == 0 && $diff->m == 0)
                {{$diff->d}} gün
            @elseif(!$diff->y == 0 && !$diff->m == 0 && $diff->d == 0)
              {{$diff->y}} il {{$diff->m}} ay
            @elseif (!$diff->y == 0 && $diff->m == 0 && $diff->d == 0)
              {{$diff->y}} il
            @elseif ($diff->y == 0 && !$diff->m == 0 && !$diff->d == 0)
              {{$diff->m}} ay {{$diff->d}} gün
            @else
                {{$diff->y}} il {{$diff->m}} ay {{$diff->d}} gün
            @endif
          </div>
          <img src="{{url('/image/'.$single->shekiller[0]->imageName)}}" class="img-responsive" alt="" />
          <div class="single-img-location">
            <i class="fa fa-map-marker"></i> {{$single->location}}
          </div>
        </div>
      </div>
      @php
        $url = 'http://13.94.234.172:88/single/'.$single->id;
      @endphp
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="single-social">
          <ul class="list-inline">
              <li class="single-social-facebook faceBook">
                <div class="social-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
                  <i class="fa fa-facebook"></i> PAYLAŞ
                </a>
              </div>
              </li>
            <li  class="single-social-google" >
              <div class="social-buttons">
                <a href="https://plus.google.com/share?url={{ $url }}">
                  <i class="fa fa-google-plus"></i> PAYLAŞ
                </a>
              </div>
            </li>
          </ul>
        </div>
        <div class="single-content">
          <p>
            {{$single->about}}
          </p>
        </div>
        @if(Auth::user())
            @if (!$check)
              @if(Auth::user()->id != $single->user_id)

                <div class="single-support">
                  <p class="text-right">
                    @if ($single->type_id == 2)
                      @if (Session::has('description_destek'))
                        <div class="alert alert-success" role="alert">{{Session::get('description_destek')}}</div>
                      @endif
                      <a class="btn destek-ol-button" role="button"><i class="fa fa-check"></i> DƏSTƏK OLMAQ İSTƏYİRƏM</a>
                      @else
                        @if (Session::has('description_istek'))
                          <div class="alert alert-success" role="alert">{{Session::get('description_istek')}}</div>
                        @endif
                      <a class="btn destek-ol-button" role="button"><i class="fa fa-check"></i> DƏSTƏKDƏN YARARLANMAQ İSTƏYİRƏM</a>
                    @endif
                      <div class="alert alert-success destek-ol-message">

                          <form class="" action="{{url('/notification/'.$single->id)}}" method="post">
                            {{csrf_field()}}
                              <label for=""><h4>Açıqlama</h4></label>
                              <textarea name="description" rows="8" cols="80" class="form-control"></textarea>
                              <input type="submit" name="send" class="pull-right btn" value="Göndər">
                              <div class="clear-fix"></div>
                          </form>
                      </div>
                  </p>
                </div>
            @endif
          @else
              @if (Session::has('description_destek'))
                <div class="alert alert-success" role="alert">{{Session::get('description_destek')}}</div>
              @elseif (Session::has('description_istek'))
                <div class="alert alert-success" role="alert">{{Session::get('description_istek')}}</div>
              @elseif ($single->type_id == 1)
                <div class="alert alert-success" role="alert">Siz artıq bu dəstəkdən yararlanmaq üçün müraciət etmisiniz.</div>
              @elseif ($single->type_id == 2)
                <div class="alert alert-success" role="alert">Siz artıq bu istəyə dəstək göndərmisiniz.</div>
              @endif
          @endif


        @elseif(Auth::guest() && $check == false)
          <div class="single-support">
            <p class="text-right">
              @if ($single->type_id == 2)
                <a class="btn destek-ol-button" role="button"><i class="fa fa-check"></i> DƏSTƏK OLMAQ İSTƏYİRƏM</a>
                @else
                <a class="btn destek-ol-button" role="button"><i class="fa fa-check"></i> DƏSTƏKDƏN YARARLANMAQ İSTƏYİRƏM</a>
              @endif
            </p>
          </div>
          <div class="alert alert-danger destek-ol-message">
            @if ($single->type_id == 2)
              <h5 class="text-center">Dəstək olmaq üçün <a href="/Qeydiyyat" class="register-color">qeydiyyatdan</a> keçməyiniz tələb olunur</h5>
              @else
              <h5 class="text-center">Dəstəkdən yararlanmaq üçün <a href="/Qeydiyyat" class="register-color">qeydiyyatdan</a> keçməyiniz tələb olunur</h5>
            @endif
          </div>
        @endif
@endsection
