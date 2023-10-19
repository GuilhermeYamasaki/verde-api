<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function handleCatch(Exception $exception, array $logVars = []): JsonResponse
    {
        $context = [
            'exception' => $exception
        ];

        Log::error($exception->getMessage(), array_merge($logVars, $context));

        $code = intval($exception->getCode());
        if ($code < 200) {
            $code = 400;
        }

        return response()->json([
            'message' => $exception->getMessage()
        ], $code);
    }
}
