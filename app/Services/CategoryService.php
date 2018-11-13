<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 12.11.18
 * Time: 23:20
 */

namespace App\Services;

use App\Category;

class CategoryService implements CategoryServiceInterface
{
    private $imageService;

    /**
     * CategoryService constructor.
     * @param $imageService
     */
    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    public function show($slug)
    {
        return Category::where('slug', $slug)->first();
    }

    public function getAll($pagination, $published)
    {
        if ($published != -1) {
           return Category::where('published', $published)
               ->orderBy('created_at', 'desc')
               ->paginate($pagination);
        }

        return Category::orderBy('created_at', 'desc')
            ->paginate($pagination);
    }

    public function save($data)
    {
        $image = isset($data['file']) ? $data['file'] : null;
        $category = Category::orderBy('id','desc')->first();
        $categoryId = empty($category) ? 0 : $category->id;

        Category::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'published' => $data['published'],
            'image' => $this->imageService->saveImageAndGetName($image, 'categories', $categoryId),
            'created_by' => $data['created_by']
        ]);
    }

    public function update(Category $category, $data)
    {
        $image = isset($data['file']) ? $data['file'] : null;

        $category->update([
            'title' => $data['title'],
            'published' => $data['published'],
            'image' => $this->imageService->replaceImageAndGetName($image, 'categories', $category['id'], $category['image']),
            'modified_by' => $data['modified_by'],
        ]);
    }

    public function remove(Category $category)
    {
        $category->delete();
    }
}