<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryInterface;

class CategoryRepository implements CategoryInterface
{
    public function getAll()
    {
        return Category::get();
    }

    public function findById($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = Category::find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Category::find($id);
        return $category->delete();
    }
}