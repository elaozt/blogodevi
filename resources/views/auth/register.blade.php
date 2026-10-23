<!doctype html>
<html lang="tr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Hesap oluştur</title><link rel="stylesheet" href="{{ asset('css/style.css') }}"></head>
<body><main class="form-page"><a href="{{ route('home') }}">← Bloga dön</a><h1>Hesap oluştur</h1><p class="muted">Kayıtlı kişiler makaleleri okuyabilir. Makale ekleme yalnızca blog sahibine açıktır.</p>
@if ($errors->any())<div class="error"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="post" action="{{ route('register.store') }}">@csrf<label>Kullanıcı adı<input name="username" minlength="3" maxlength="60" value="{{ old('username') }}" autocomplete="username" required></label><label>Şifre<input name="password" type="password" minlength="8" autocomplete="new-password" required></label><label>Şifre tekrarı<input name="password_confirmation" type="password" minlength="8" autocomplete="new-password" required></label><button type="submit">Kayıt ol</button></form>
</main></body></html>
