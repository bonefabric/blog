<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{

    /**
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    public function sendResponse(array $data = [], int $status = 200): JsonResponse
    {
        return response()->json(
            array_merge($data, [
                'meta' => [
                    'status' => $status,
                ],
            ])
        );
    }
}
