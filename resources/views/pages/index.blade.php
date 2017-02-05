@extends('pages.layout')

@section('title','Ana Səhifə')

@section('content')
  <section id="map">
  <div class="container-fluid">
    <div class="row">
      <div id="searchBoxDrag">
            <form id="mapSearch" class="form-inline" method="get">
                 <ul>
                   <li>
                       <label> Şəhər / region</label>
                       <input id="Loc" type="text" class="hidden" name="keyword" value="all">
                       <select class="Test" id="acar">
                         <option name="location" value="all">Hamısı</option>
                         <option value="Bakı">Bakı</option>
                         <option value="Abşeron">Abşeron</option>
                         <option value="Ağdam">Ağdam</option>
                         <option value="Ağdaş">Ağdaş</option>
                         <option value="Avalueabədi">Ağcabədi</option>
                         <option value="Ağstafa">Ağstafa</option>
                         <option value="Ağsu">Ağsu</option>
                         <option value="Astara">Astara</option>
                         <option value="Babək">Babək</option>
                         <option value="Balakən">Balakən</option>
                         <option value="Bərdə">Bərdə</option>
                         <option value="Beyləqan">Beyləqan</option>
                         <option value="Biləsuvar">Biləsuvar</option>
                         <option value="Cəbrayıl">Cəbrayıl</option>
                         <option value="Cəlilabad">Cəlilabad</option>
                         <option value="Culfa">Culfa</option>
                         <option value="Daşkəsən">Daşkəsən</option>
                         <option value="Füzuli">Füzuli</option>
                         <option value="Gədəbəy">Gədəbəy</option>
                         <option value="Goranboy">Goranboy</option>
                         <option value="Göyçay">Göyçay</option>
                         <option value="Göygöl">Göygöl</option>
                         <option value="Hacıqabul">Hacıqabul</option>
                         <option value="Xaçmaz">Xaçmaz</option>
                         <option value="Xızı">Xızı</option>
                         <option value="Xocalı">Xocalı</option>
                         <option value="Xocavənd">Xocavənd</option>
                         <option value="İmişli">İmişli</option>
                         <option value="İsmayıllı">İsmayıllı</option>
                         <option value="Kəlbəcər">Kəlbəcər</option>
                         <option value="Kəngərli">Kəngərli</option>
                         <option value="Kürdəmir">Kürdəmir</option>
                         <option value="Qəbələ">Qəbələ</option>
                         <option value="Qax">Qax</option>
                         <option value="Qazax">Qazax</option>
                         <option value="Qobustan">Qobustan</option>
                         <option value="Quba">Quba</option>
                         <option value="Qubadlı">Qubadlı</option>
                         <option value="Qusar">Qusar</option>
                         <option value="Laçın">Laçın</option>
                         <option value="Lənkəran">Lənkəran</option>
                         <option value="Lerik">Lerik</option>
                         <option value="Masallı">Masallı</option>
                         <option value="Neftçala">Neftçala</option>
                         <option value="Oğuz">Oğuz</option>
                         <option value="Ordubad">Ordubad</option>
                         <option value="Sumqayıt">Sumqayıt</option>
                         <option value="Saatlı">Saatlı</option>
                         <option value="Sabirabad">Sabirabad</option>
                         <option value="Sədərək">Sədərək</option>
                         <option value="Salyan">Salyan</option>
                         <option value="Samux">Samux</option>
                         <option value="Şabran">Şabran</option>
                         <option value="Şahbuz">Şahbuz</option>
                         <option value="Şəki">Şəki</option>
                         <option value="Şamaxı">Şamaxı</option>
                         <option value="Şəmkir">Şəmkir</option>
                         <option value="Şərur">Şərur</option>
                         <option value="Şuşa">Şuşa</option>
                         <option value="Siyəzən">Siyəzən</option>
                         <option value="Tərtər">Tərtər</option>
                         <option value="Tovuz">Tovuz</option>
                         <option value="Ucar">Ucar</option>
                         <option value="Yardımlı">Yardımlı</option>
                         <option value="Yevlax">Yevlax</option>
                         <option value="Zəngilan">Zəngilan</option>
                         <option value="Zaqatala">Zaqatala</option>
                         <option value="Zərdab">Zərdab</option>
                       </select>
                   </li>
                     <li>
                       <label> İstək / Dəstək</label>
                       <input id="Type" type="text" class="hidden" name="city" value="all">
                       <select class="Test" id="seher">
                         <option  name="type" value="all">Hamısı</option>
                         <option name="type" value="1">Dəstək</option>
                         <option name="type" value="2">İstək</option>
                       </select>

                     </li>
                 </ul>
                 <div class="search-error-desc">
                   <p class="infoMessage text-center"></p>
                 </div>
           </form>
           </div>
      <img class="Load openLoad closeLoad" src="{{url('images/info-loading.gif')}}">
      <div id="InfoMap">
      </div>
    </div>
  </div>
</section>
<section id="news">
  <div class="container">
     <div class="row">
      <div class="news-left col-lg-6 col-md-6 col-sm-12 col-xs-12 padding0">
        <div class="col-lg-12 news-type-title">
          <h1>İSTƏKLƏR</h1>
          <hr>
        </div>
{{-- {{dd($datas_istek)}} --}}
        <!-- News block -->
        @foreach ($datas_istek as $data)
          {{-- @if($data->type_id=='2') --}}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding0 thumbnail">
              <div class="news-block">
                <div class="news-image col-lg-12 padding0">
                  <div class="news-type news-istek">
                    İstək
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
          {{-- @endif --}}
        @endforeach

        <div class="col-lg-12 news-all-isteks-button">
          <a href="/istek-list" class="btn pull-right">Bütün istəklər <i class="fa fa-angle-right"></i></a>
        </div>
      </div>

      <div class="news-right col-lg-6 col-md-6 col-sm-12 col-xs-12 padding0">
        <div class="col-lg-12 news-type-title">
          <h1>DƏSTƏKLƏR</h1>
          <hr>
        </div>
        <!-- News block -->
        @foreach ($datas_destek as $data)
          {{-- @if($data->type_id=='1') --}}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding0 thumbnail">
              <div class="news-block">
                <div class="news-image col-lg-12 padding0">
                  <div class="news-type news-destek">
                    Dəstək
                  </div>
                  <a href="{{url('/single/'.$data->id)}}"><img src="{{url('/image/'.$data->shekiller[0]->imageName)}}" alt="İstək image" /></a>
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
          {{-- @endif --}}
        @endforeach
        <!-- News block end -->
        <div class="col-lg-12 news-all-desteks-button">
          <a href="/destek-list" class="btn pull-right">Bütün dəstəklər <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('scripts')
  <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAanmTrOlQYWRepobnwqSO1E2SOoHYMRBA&callback=Mydata&language=az" async defer></script>

@endsection
