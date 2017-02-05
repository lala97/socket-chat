@extends('pages.layout')

@section('title','Haqqımızda')

@section('content')
  <div id="breadcrumb">
    <div class="container">
       <div class="row">
         <div class="col-lg-12">
           <h1>Haqqımızda</h1>
         </div>
      </div>
    </div>
  </div>
<section id="about-us">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <p class="about-us-desc">
          Bumeranq.org fərqli istək sahibləri və onlara dəstək verə biləcək insanları bir araya toplayan online platformadır.
          Bu platform ölkəmiz üçün nəzərdə tutulmuşdur, və Azərbaycanın istənilən yerindən istifadə oluna bilər.
          Əsas olaraq 2 bölmədən ibarət olan saytın istifadə qaydaları aşağıdakı kimidir:
        </p>
        <p class="about-us-desc">
          <span class="about-us-istek">İstək əlavə et:</span> Bu bölümdə yaşadığınız yerdə sizə lazım olan bir ehtiyacı daxil edirsiniz.
          Sizdən istəyiniz barədə ətraflı və düzgün məlumat yerləşdirməyiniz (əlaqə məlumatları, düzgün şəkil, dəqiq ünvan, və s.) xahiş olunur.
          İstək əlavə etmək üçün Bumeranq.org'a üzv olmağınız kifayətdir. Əlavə etdiyiniz istək moderasiyadan keçdikdən sonra xəritədə
          və istəklər bölməsində hamıya açıq şəkildə görünəcək. Bundan sonra sizə kimsə dəstək verərsə
          həmin dəstəkçinin qısa məlumatları və dəstək açıqlaması sizə bildiriş şəklində görünəcək və yalnız siz qəbul etdikdən sonra
          sizin şəxsi məlumatlarınız (Ad, telefon və s.) həmin dəstəkçiyə göndəriləcək. Bu barədə Bumeranq.org portalı sizin şəxsi
          informasiyalarınızın 3-cü bir şəxs tərəfindən görülməyəcəyinə zəmanət verir.
        </p>

        <p class="about-us-desc">
          <span class="about-us-destek">Dəstək əlavə et:</span> Bu bölümdə fərd və yaxud təşkilat olaraq dəstək yerləşdirilməsi mümkündür.
          Qaydalar istək əlavə et bölməsində olduğu kimi qalır. Dəstək yerləşdirilib moderasiyadan keçdikdən sonra dəstəyə ehtiyacı olan
          fərd yaxud təşkilat Bumeranq.org'a üzv olduqdan sonra yerləşdirilən dəstəyə müraciət göndərə bilər. Gizlilik prinsipi eyni olaraq qalır və
          sizin informasiyalarınız siz qəbul etmədiyiniz müddətdə digər bir fərd yaxud təşkilata ötürülmür.
        </p>
      </div>

      <div class="col-lg-12 about-us-team">
        <h1 class="text-center">Komandamız</h1>
        <hr>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 about-us-team-wrapper">
          <div class="about-us-team-block">
            <div class="about-us-team-img">
              <img src="{{url('/images/lala.jpg')}}" class="img-responsive" alt="team image">
            </div>
            <div class="about-us-team-details">
              <h3 class="about-us-team-details-title">Lalə Məmmədova</h3>
              <p class="about-us-team-details-desc">BDU - Komputer elmləri</p>
              <p class="about-us-team-details-desc">lale.m@code.edu.az</p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 about-us-team-wrapper">
          <div class="about-us-team-block">
            <div class="about-us-team-img">
              <img src="{{url('/images/farid.jpg')}}" class="img-responsive" alt="team image">
            </div>
            <div class="about-us-team-details">
              <h3 class="about-us-team-details-title">Fərid Babayev</h3>
              <p class="about-us-team-details-desc">AzTU - Komputer elmləri</p>
              <p class="about-us-team-details-desc">farid.b@code.edu.az</p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 about-us-team-wrapper">
          <div class="about-us-team-block">
            <div class="about-us-team-img">
              <img src="{{url('/images/naseh.jpg')}}" class="img-responsive" alt="team image">
            </div>
            <div class="about-us-team-details">
              <h3 class="about-us-team-details-title">Naseh Bədəlov</h3>
              <p class="about-us-team-details-desc">QU - Sənaye mühəndisliyi</p>
              <p class="about-us-team-details-desc">nasehbadalov@gmail.com</p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 about-us-team-wrapper">
          <div class="about-us-team-block">
            <div class="about-us-team-img">
              <img src="{{url('/images/gunel.jpeg')}}" class="img-responsive" alt="team image">
            </div>
            <div class="about-us-team-details">
              <h3 class="about-us-team-details-title">Günel İsmayılova</h3>
              <p class="about-us-team-details-desc">ADNSU - Komputer mühəndisliyi</p>
              <p class="about-us-team-details-desc">gunel.i@code.edu.az</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
