<?php

namespace App\Http\Controllers\API\Super;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;
    protected $categoryRepository;
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        $locale = app()->getLocale();
        $categories = $categories->map(function ($category) use ($locale) {
            return [
                'id' => $category->id,
                'name' => $category->getTranslation('name', $locale),
                'image' => $category->image,
            ];
        });
        return $this->success($categories);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return $this->notFound();
        }
        $locale = app()->getLocale();
        $translatedCategory = [
            'id' => $category->id,
            'name' => $category->getTranslation('name', $locale),
            'image' => $category->image,
        ];

        return $this->success($translatedCategory);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'image' => 'required|image'
        ]);
        $data['image'] = Helper::storeImage($request->file('image'), 'categories');
        $this->categoryRepository->create($data);
        return $this->success([], __('main.created successful'));
    }
    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'image' => 'nullable|image'
        ]);
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return $this->notFound();
        }
        if ($request->hasFile('image')) {
            $data['image'] = Helper::updateImage($request->file('image'), $category->image, 'categories');
        }
        $this->categoryRepository->update($id, $data);
        return $this->success([], __('main.updated successful'));
    }
    public function delete($id)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return $this->notFound();
        }
        Helper::deleteImage($category->image);
        $this->categoryRepository->delete($id);
        return $this->success([], __('main.deleted successful'));
    }
}