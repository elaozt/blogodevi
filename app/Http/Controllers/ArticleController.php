<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('blog.index', ['articles' => Article::latest()->get(), 'blogName' => config('blog.name')]);
    }

    public function create(): View
    {
        return view('blog.new-article');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'content' => ['required', 'string', 'max:10000'],
        ], ['title.required' => 'Başlık boş bırakılamaz.', 'content.required' => 'Makale boş bırakılamaz.']);

        Article::create($data);

        return redirect()->route('home')->with('message', 'Makale yayımlandı.');
    }
}
