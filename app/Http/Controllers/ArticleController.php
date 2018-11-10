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
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'delimiter' => ''
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
        ]);
        // Handle the user upload of avatar
        if ($request->hasFile('image')) {


            //verify validation
            if ($request->file('image')->isValid()) {

                //save new image
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
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
            'image' => $filename,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'created_by' => $request->created_by,
        ]);

        // Categories
        if ($request->input('categories')) :
            $article->categories()->attach($request->input('categories'));
        endif;

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
