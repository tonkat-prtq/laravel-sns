<?php

namespace App\Http\Controllers;

use App\Article;

use App\Http\Requests\ArticleRequest;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
  public function index()
  {  
    $articles = Article::all()->sortByDesc('created_at');
    return view('articles.index', ['articles' => $articles]);
  }

  public function create() // Railsでいう def createみたいな感じ
  {
    return view('articles.create');
  }

  public function store(ArticleRequest $request, Article $article)
  {
    $article->fill($request->all());
    $article->user_id = $request->user()->id;
    $article->save();
    return redirect()->route('articles.index');
  }

  public function edit(Article $article) // Article型に型付けし、ArticleモデルのインスタンスのDI（依存性の注入）が行われている
  {
    return view('articles.edit', ['article' => $article]);
  }
}
