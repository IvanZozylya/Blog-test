<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //show one article
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('articles.show', [
            'article' => $article,
            'user' => User::where('id',$article->created_by)->first(),
        ]);
    }
}
