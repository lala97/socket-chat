@extends('pages.layout')

@section('title', 'Bütün dəstəklər')

@section('content')
  <div id="breadcrumb">
    <div class="container">
       <div class="row">
         <div class="col-lg-12">
           <h1 class="text-left">Bütün Dəstəklər</h1>
         </div>
      </div>
    </div>
  </div>
  <section id="news">
    <div class="container">
      <div class="row">


        @foreach (array_chunk($datas->getCollection()->all(), 4) as $row)
        <div class="row">
          <div class="col-lg-12">
          {{-- <div class="col-lg-offset-1"> --}} {{--deyishdirile biler --}}
            <!-- News block -->
            @foreach($row as $data)
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 padding0 thumbnail">
                  <div class="news-block">
                    <div class="news-image col-lg-12 padding0">
                      <div class="news-type news-destek">
                        Dəstək
                      </div>
                      <a href="{{url('/single/'.$data->id)}}"><img src="{{url('/image/' .$data->shekiller[0]->imageName)}}" alt="İstək image" /></a>
                    </div>
                    <div class="news-content col-lg-12 padding0">
                      <div class="news-title">
                        <a href="{{url('/single/'.$data->id)}}">{{$data->title}}</a>
                      </div>
                      <div class="news-location col-lg-12">
                        <p><i class="fa fa-map-marker"></i> {{strlen($data->location) > 45 ? substr($data->location,0,45).' ...' : $data->location}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          {{-- </div> --}}
          </div>
        </div>
       @endforeach
           <div class="pull-right">

          {{$datas->links()}}
        </div>
        {{-- <div class="col-lg-12">
          <!-- News block -->
          @foreach ($datas as $data)
            @if($data->status=='1' && $data->type_id=='1')
              <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 padding0 thumbnail">
                <div class="news-block">
                  <div class="news-image col-lg-12 padding0">
                    <div class="news-type news-destek">
                      Dəstək
                    </div>
                    <a href="{{url('/single/'.$data->id)}}"><img src="{{url('/image/' .$data->shekiller[0]->imageName)}}" alt="İstək image" /></a>
                  </div>
                  <div class="news-content col-lg-12 padding0">
                    <div class="news-title">
                      <a href="{{url('/single/'.$data->id)}}">{{$data->title}}</a>
                    </div>
                    <div class="news-location col-lg-12">
                      <p><i class="fa fa-map-marker"></i> {{strlen($data->location) > 45 ? substr($data->location,0,45).' ...' : $data->location}}</p>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div> --}}
        </div>
      </div>
    </div>
  </section>
@endsection
