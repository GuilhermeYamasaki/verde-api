<?php

namespace App\Http\Controllers;

use App\Models\DispachedJob;
use Illuminate\Http\JsonResponse;

class DispatchedJobController extends Controller
{
    public function show(string $id): JsonResponse
    {
        $dispachedJob = DispachedJob::findOrFail($id);

        return response()->json($dispachedJob, 200);
    }
}
