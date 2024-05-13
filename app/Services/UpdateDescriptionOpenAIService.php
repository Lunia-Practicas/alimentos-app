<?php

namespace App\Services;

use App\Repositories\DescriptionRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

readonly class UpdateDescriptionOpenAIService
{
    public function __construct(private DescriptionRepository $descriptionRepository)
    {

    }

    public function handle(UpdateDescriptionOpenAIRequest $param)
    {
        $id = $param->id;

        $data = [
            'description' => $param->description,
            'title' => $param->title,
        ];

        DB::beginTransaction();

        try {
            $description = $this->descriptionRepository->update($id, $data);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Unable to update description');
        }

        DB::commit();
        return $description;
    }
}
