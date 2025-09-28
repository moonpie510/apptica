<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

/**
 * Хелпер для стандартизации ответов API.
 */
class ResponseHelper
{
    /**
     * Возвращает json успешного ответа.
     */
    public static function success(array $data = [], string $message = 'ok', int $code = 200): JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * Возвращает json об ошибках.
     */
    public static function error(array $errors = [], string $message = 'fail', int $code = 400): JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'error' => $errors
        ]);
    }
}
