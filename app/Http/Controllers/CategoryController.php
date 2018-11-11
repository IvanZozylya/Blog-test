<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //show all category
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::paginate(10)
        ]);
    }

    //show simple category
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $articles = Article::where('category_id',$category->id)->orderBy('id','desc')->paginate(5);

        return view('categories.show', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }
}
