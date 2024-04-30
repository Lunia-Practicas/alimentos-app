<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

readonly class DeleteProductService
{

    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function handle(DeleteProductRequest $param, $id_product): void
    {
        DB::beginTransaction();

        try {
            $this->productRepository->delete($id_product);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete product');
        }

        DB::commit();
    }
}
