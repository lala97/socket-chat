@extends('pages.layout')
@section('title')
  Bildiriş
@endsection
@section('content')
  <div id="breadcrumb">
  <div class="container">
     <div class="row">
       <div class="col-lg-12">
         <h1 class="text-left">Bildiriş</h1>
       </div>
    </div>
  </div>
  </div>
  <section id="notification-single">
    @if(isset($notication_single->id))
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <img src="{{url('/image/'.$notication_single->avatar)}}" alt="">
          </div>
          <div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
            <h3 class="not-single-title">
              @if($notication_single->type_id==2)
                <span class="special-istek">{{$notication_single->name}}</span> adlı istifadəçi istəyinizə dəstək vermək istəyir !
              @elseif($notication_single->type_id==1)
                <span class="special-destek">{{$notication_single->name}}</span> adlı istifadəçi dəstəyinizdən yararlanmaq istəyir !
              @endif
            </h3>
            <h4 class="not-single-desc">{{$notication_single->description}}</h4>
            @if($notication_single->notification==0)
              <div class="alert alert-danger" role="alert">
                @if($notication_single->type_id==1)
                  Bu istək imtina edilib !
                @elseif($notication_single->type_id==2)
                  Bu dəstək imtina edilib !
                @endif
              </div>
            @elseif($notication_single->data==0)
              <p class="pull-right">
                <a href="{{url('/accept/'.$notication_single->id)}}" class="btn not-accept"><i class="fa fa-check"></i> Qəbul et</a>
                <a href="{{url('/refusal/'.$notication_single->id)}}" class="btn not-deny"><i class="fa fa-times"></i> İmtina et</a>
              </p>
            @else
            @endif
          </div>
        </div>
      </div>
    @else
      <h1 class="text-center">Sorğunuz düzgün deyil !</h1>
    @endif
  </section>
@endsection
