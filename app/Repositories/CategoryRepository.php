<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CategoryRepository.
 */
class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create($data)
    {
        $category = Category::create($data);

        $category->fresh();
        return $category;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $productsCount = Product::where('category_id', $category->id)->count();

        if ($productsCount > 0) {
            throw new ModelNotFoundException('No se puede borrar la categoría porque tiene productos asociados.');
        }
        $category->delete();
    }

    public function listAll()
    {
        return Category::all();
    }

    public function update($data, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }


}
