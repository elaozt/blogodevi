<!doctype html>
<html lang="tr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Yeni makale</title><link rel="stylesheet" href="{{ asset('css/style.css') }}"></head>
<body><main class="form-page"><a href="{{ route('home') }}">← Bloga dön</a><h1>Yeni makale</h1>
@if ($errors->any())<div class="error"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="post" action="{{ route('articles.store') }}">@csrf<label>Başlık<input name="title" maxlength="200" value="{{ old('title') }}" required></label><label>Makale<textarea name="content" rows="12" required>{{ old('content') }}</textarea></label><button type="submit">Yayımla</button></form>
</main></body></html>
