<?php

namespace App\Http\Controllers;

use App\Article;
use App\Services\CategoryServiceInterface;
use App\User;

class CategoryController extends Controller
{

    private $categoryService;

    /**
     * CategoryController constructor.
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    //show all category
    public function index()
    {
        return view('categories.index', [
            'categories' => $this->categoryService->getAll(6, 1)
        ]);
    }

    //show simple category
    public function show($slug)
    {
        $users = User::all();
        $category = $this->categoryService->show($slug);

        //TODO: move to service
        $articles = Article::where('category_id', $category->id)->where('published', 1)->orderBy('id', 'desc')->paginate(5);

        return view('categories.show', [
            'category' => $category,
            'articles' => $articles,
            'users' => $users
        ]);
    }

}
