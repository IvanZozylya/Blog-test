<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 12.11.18
 * Time: 23:19
 */

namespace App\Services;


use App\Category;

interface CategoryServiceInterface
{
    public function show($slug);

    public function getAll($pagination, $published);

    public function save($data);

    public function update(Category $category, $data);

    public function remove(Category $category);
}