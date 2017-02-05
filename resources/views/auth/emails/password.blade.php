<h1>Salam, {{$user->name}}</h1>

<p>Bizə şifrənizi dəyişmək barədə istək daxil olmuşdur.</p>

<p>Şifrənizi dəyişmək üçün aşağıdakı linkə klikləməyiniz kifayətdir:</p>
<div class="reset-password-button">
  <p>
    <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> Şifrəni dəyiş </a>
  </p>
</div>
