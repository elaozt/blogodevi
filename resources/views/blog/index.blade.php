<!doctype html>
<html lang="tr">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>{{ $blogName }}</title><link rel="stylesheet" href="{{ asset('css/style.css') }}"></head>
<body>
<header class="top"><a class="brand" href="{{ route('home') }}">{{ $blogName }}</a><nav>
@guest <a href="{{ route('login') }}">Giriş yap</a><a href="{{ route('register') }}">Kayıt ol</a>
@else <span>Merhaba, {{ auth()->user()->username }}</span><form method="post" action="{{ route('logout') }}" class="inline">@csrf<button type="submit">Çıkış yap</button></form>@if (auth()->user()->role === 'OWNER')<a class="button" href="{{ route('articles.create') }}">Makale ekle</a>@endif @endguest
</nav></header>
<main><h1>Makaleler</h1>
@if (session('message'))<p class="notice">{{ session('message') }}</p>@endif
@forelse ($articles as $article)<article class="card"><h2>{{ $article->title }}</h2><time>{{ $article->created_at?->format('d.m.Y H:i') }}</time><p class="content">{{ $article->content }}</p></article>
@empty<p class="muted">Henüz makale eklenmemiş.</p>@endforelse
</main></body></html>
