@extends('pages.layout')

@section('title','Qeydiyyat')


@section('content')

  <div id="breadcrumb">
    <div class="container">
       <div class="row">
         <div class="col-lg-12">
           <h1 class="text-left">Qeydiyyat</h1>
         </div>
      </div>
    </div>
  </div>
  {{-- Google+ ve Facebook datalari Session ile gelir --}}
  @if (Session::has('user') && Session::has('email'))
   <?php $name = Session::get('user');?>
   <?php $username = Session::get('user');?>
   <?php $email = Session::get('email');?>

@else
   <?php $name = old('name');?>
   <?php $username = old('username');?>
   <?php $email = old('email');?>

@endif
  <section id="register">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 padding0">
        @if (Session::has('warning'))
        <div class="alert alert-danger" role="alert">{{Session::get('warning')}}</div>
        @elseif (Session::has('status'))
        <div class="alert alert-success" role="alert">{{Session::get('status')}}</div>
        @endif
        @if ($errors->has('name') || $errors->has('username') || $errors->has('phone') || $errors->has('email') || $errors->has('password') || $errors->has('password_confirmation'))
             <span class="help-block">
             <div class="alert alert-danger"><p>Ulduz ilə işarəli xanaları boş saxlamayın.</p></div>
           </span>
         @endif
        <form action="{{ url('/register') }}" method="post">
          {{csrf_field()}}
          <div class="col-lg-6">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name">Ad, Soyad <span> *</span></label>
              <input type="text" name="name" class="form-control" value="{{$name}}">
            </div>
            <div class="form-group{{$errors->has('username') ? ' has-error ' : ''}}">
              <label for="name">İstifadəçi adı<span> *</span></label>
              <input type="text" name="username" class="form-control" value="{{$username}}">
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="operator">Əlaqə nömrəsi<span> *</span></label>
              <div class="input-group">
                  <div class="input-group-addon">
                      <input type="hidden" id="operator" name="operator" value="55">
                      +994
                          <select id="operator-numbers" name="operator-numbers">
                                <option>55</option>
                                <option>51</option>
                                <option>50</option>
                                <option>70</option>
                                <option>77</option>
                          </select>
                      </div>
                <input type="text" class="form-control" name="phone" value="{{substr(old('phone'),0,7)}}" maxlength="7">
              </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email">Email<span> *</span></label>
              <input type="email" name="email" class="form-control" value="{{$email}}">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
              <label for="city">Şəhər/Rayon</label>
              <input type="text" id="city" class="hidden" name="city" value="Bakı">
              <select id="CitySelectOption" class="form-control" name="city">
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
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password">Şifrə<span> *</span></label>
              <input type="password" name="password" class="form-control" placeholder="Minimum 6 simvol">
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <label for="password">Təkrar Şifrə<span> *</span></label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Minimum 6 simvol">
            </div>
            <div class="form-group text-center">
              <input type="submit" class="btn" value="GÖNDƏR">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
