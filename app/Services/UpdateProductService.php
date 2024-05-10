<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

readonly class UpdateProductService
{

    public function __construct(private ProductRepository $productRepository)
    {

    }

    public function handle(UpdateProductRequest $request)
    {
        $id = $request->id;
        $id_updated = $request->id_updated;
        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'weight' => $request->weight,
            'origin' => $request->origin,
            'price' => $request->price,
            'vegan' => $request->vegan,
            'gluten'=> $request->gluten,
            'updated_by' => $id_updated
        ];

        DB::beginTransaction();

        try{
            $category = $this->productRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Unable to update product');
        }

        DB::commit();

        return $category;
    }
}
