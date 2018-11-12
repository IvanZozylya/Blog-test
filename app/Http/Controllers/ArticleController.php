<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create', [
            'article' => [],
            'categories' => Category::where('published', 1)->orderBy('created_at','desc')->paginate(12)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
            'title' => 'required|string|min:6',
            'published' => 'required|boolean',
            'description_short' => 'required|max:50',
            'description' => 'required|max:2048|min:10',
            'category_id' => 'required|int'
        ]);
        // Handle the user upload of avatar
        if ($request->hasFile('image')) {


            //verify validation
            if ($request->file('image')->isValid()) {

                //Получить последнюю новость
                $lastArticle = Article::OrderBy('id','desc')->first();

                //Изменяем ее значение на +1
                if(!empty($lastArticle)){
                    $lastId = $lastArticle->id + 1;
                }

                //save new image
                $image = $request->file('image');
                $filename = $lastId . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(700, 500)->save(public_path('images/uploads/articles/' . $filename));


            }
        } else {

            $filename = 'default.jpg';
        }

        $article = Article::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'description_short' => $request->description_short,
            'published' => $request->published,
            'category_id' => $request->category_id,
            'image' => $filename,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('all_categories');
    }

    //show one article
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('articles.show', [
            'article' => $article,
            'user' => User::where('id', $article->created_by)->first(),
        ]);
    }
}
