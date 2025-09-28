<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\GetAppTopCategoryRequest;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\JsonResponse;

class StatisticController extends Controller
{
    public function __construct(
        private readonly ApplicationRepository $applicationRepository
    )
    {}

    public function getAppTopCategory(GetAppTopCategoryRequest $request): JsonResponse
    {
        try {
            return ResponseHelper::success(
                data: ['positions' => $this->applicationRepository->getCategoriesPositions($request->getDate())]
            );
        } catch (\Throwable $th) {
            return ResponseHelper::error(message: $th->getMessage());
        }
    }
}
