<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.articles.index', [
            'articles' => Article::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create', [
            'article' => [],
            'categories' => Category::all(),
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
            'title' => 'required|string|min:6',
            'published' => 'required|boolean',
            'description_short' => 'required|max:30',
            'description' => 'required|max:2048|min:10',
            'category_id' => 'required|int'
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
            'category_id' => $request->category_id,
            'image' => $filename,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('admin.article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article,
            'categories' => Category::all(),
            'delimiter' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
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
            $filename = $article->image;
        }

        $article->update([
            'title' => $request->title,
            'description' => $request->description,
            'description_short' => $request->description_short,
            'published' => $request->published,
            'image' => $filename,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'modified_by' => $request->modified_by,
        ]);

        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->categories()->detach();
        $article->delete();

        return redirect()->route('admin.article.index');
    }

}

