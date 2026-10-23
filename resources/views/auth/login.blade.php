<!doctype html>
<html lang="tr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Giriş yap</title><link rel="stylesheet" href="{{ asset('css/style.css') }}"></head>
<body><main class="form-page"><a href="{{ route('home') }}">← Bloga dön</a><h1>Giriş yap</h1>
@if (session('message'))<p class="notice">{{ session('message') }}</p>@endif
@if ($errors->any())<div class="error"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="post" action="{{ route('login.store') }}">@csrf<label>Kullanıcı adı<input name="username" value="{{ old('username') }}" autocomplete="username" required autofocus></label><label>Şifre<input name="password" type="password" autocomplete="current-password" required></label><button type="submit">Giriş yap</button></form><p>Hesabın yok mu? <a href="{{ route('register') }}">Kayıt ol</a></p>
</main></body></html>
