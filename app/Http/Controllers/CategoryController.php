<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //show all category
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::where('published', 1)->orderBy('created_at', 'desc')->paginate(6)
        ]);
    }

    //show simple category
    public function show($slug)
    {
        $users = User::all();
        $category = Category::where('slug', $slug)->first();
        $articles = Article::where('category_id', $category->id)->where('published', 1)->orderBy('id', 'desc')->paginate(5);

        return view('categories.show', [
            'category' => $category,
            'articles' => $articles,
            'users' => $users
        ]);
    }
}
