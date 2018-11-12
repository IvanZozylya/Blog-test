<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index',[
            'categories' => Category::paginate(10)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();

        return view('admin.categories.create',[
            'category' => [],
            'categories' => $category,
            'delimiter' => ''
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Валидация полей
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
            'title' => 'required|string|between:2,100',
            'published' => 'required|boolean',

        ]);

        // Handle the user upload of avatar
        if ($request->hasFile('image')) {


            //verify validation
            if ($request->file('image')->isValid()) {

                //Получить последнюю категорию
                $lastCategory = Category::OrderBy('id','desc')->first();

                //Изменяем ее значение на +1
                if(!empty($lastCategory)){
                    $lastId = $lastCategory->id + 1;
                }else{
                    $lastId = 1;
                }

                //save image
                $image = $request->file('image');
                $filename = $lastId . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(700, 500)->save(public_path('images/uploads/categories/' . $filename));

            }
        } else {

            $filename = 'default.jpg';
        }

        Category::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'published' => $request->published,
            'image' => $filename,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('admin.category.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',[
            'category'   => $category,
            'categories' => Category::all(),
            'delimiter'  => ''
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //Валидация полей
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
            'title' => 'required|string|between:2,100',
            'published' => 'required|boolean',

        ]);

        // Handle the user upload of avatar
        if ($request->hasFile('image')) {


            //verify validation
            if ($request->file('image')->isValid()) {

                //Удаление старой картинки
                $oldImage = $category['image'];
                if ($oldImage != 'default.jpg') {
                    if (file_exists(public_path('/images/uploads/categories/' . $oldImage))) {
                        unlink(public_path('images/uploads/categories/' . $oldImage));
                    }
                }

                //save new image
                $image = $request->file('image');
                $filename = $category['id'] . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(700, 500)->save(public_path('images/uploads/categories/' . $filename));

            }
        } else {
            $filename = $category->image;
        }

        $category->update([
            'title' => $request->title,
            'published' => $request->published,
            'image' => $filename,
            'modified_by' => $request->modified_by,
        ]);

        return redirect()->route('admin.category.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index');
    }
}