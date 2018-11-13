<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Services\CategoryServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index',[
            'categories' => $this->categoryService->getAll(10, -1)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create',[
            'category' => []
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
        //Fields validation
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
            'title' => 'required|string|between:2,100',
            'published' => 'required|boolean',
        ]);

        $data = $request->only('title', 'slug', 'published', 'created_by');
        // Handle the user upload of avatar
        if ($request->hasFile('image')) {
            //verify validation
            if ($request->file('image')->isValid()) {
                //save image
                $data['file'] = $request->file('image');
            }
        }

        $this->categoryService->save($data);

        return redirect()->route('admin.category.index');
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
            'category'   => $category
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
        //Fields validation
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
            'title' => 'required|string|between:2,100',
            'published' => 'required|boolean',

        ]);

        $data = $request->only('title', 'published', 'modified_by');
        // Handle the user upload of avatar
        if ($request->hasFile('image')) {
            //verify validation
            if ($request->file('image')->isValid()) {
                //save image
                $data['file'] = $request->file('image');
            }
        }

        $this->categoryService->update($category, $data);

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
        $this->categoryService->remove($category);

        return redirect()->route('admin.category.index');
    }
}