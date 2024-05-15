<?php

namespace App\Services;

use App\Repositories\ImageRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

readonly class UpdateImageByIdService
{
    public function __construct(private ImageRepository $imageRepository)
    {

    }

    public function handle(UpdateImageByIdRequest $param)
    {
        $id = $param->id;

        $data = [
            'image' => $param->image
        ];

        DB::beginTransaction();

        try {
            $image = $this->imageRepository->update($id, $data);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Unable to update description');
        }

        DB::commit();
        return $image;
    }
}
