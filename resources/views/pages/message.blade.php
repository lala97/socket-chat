@extends('pages.layout')
@section('title')
  Bildiriş
@endsection
@section('content')
  <div id="breadcrumb">
  <div class="container">
     <div class="row">
       <div class="col-lg-12">
         <h1 class="text-left">Ismarıclar</h1>
       </div>
    </div>
  </div>
  </div>
  <section id="notification-single">
    @if(isset($data_join->id))
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <img src="{{url('/image/'.$data_join->avatar)}}" alt="">
          </div>
          <div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
            <h3 class="not-single-title">
              @if($data_join->type_id==2)
                <span class="special-istek">{{$data_join->name}}</span> adlı istifadəçi dəstəyinizi qəbul etdi !
              @elseif($data_join->type_id==1)
                <span class="special-destek">{{$data_join->name}}</span> adlı istifadəçi istəyinizi qəbul etdi
              @endif
            </h3>
            <h4 class="not-single-desc">Email: {{$data_join->email}}</h4>
            <h4 class="not-single-desc">Şəhər : {{$data_join->city}}</h4>
            <h4 class="not-single-desc">Ünvan : {{$data_join->location}}</h4>
            <h4 class="not-single-desc">Tel : {{$data_join->phone}}</h4>
          </div>
        </div>
      </div>
    @else
      <h1 class="text-center">Sorğunuz düzgün deyil !</h1>
    @endif
  </section>
@endsection
