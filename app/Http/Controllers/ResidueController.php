<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResidueRequest;
use App\Http\Requests\UpdateResidueRequest;
use App\Jobs\InsertResiduesJob;
use App\Modules\Residue\Queries\FindResidueQuery;
use App\Modules\Residue\Queries\ListResiduesQuery;
use App\Modules\Residue\UseCases\DeleteResidue;
use App\Modules\Residue\UseCases\ResidueInput;
use App\Modules\Residue\UseCases\UpdateResidue;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResidueController extends Controller
{
    public function __construct(
        private readonly UpdateResidue $updateResidue,
        private readonly DeleteResidue $deleteResidue,
        private readonly ListResiduesQuery $listResiduesQuery,
        private readonly FindResidueQuery $findResidueQuery
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $residues = $this->listResiduesQuery->handle(
            $request->get('page', 1),
            $request->get('limit', 15),
        );

        return response()->json($residues);
    }

    public function store(StoreResidueRequest $request): JsonResponse
    {
        $storagePath = $request->file('spreadsheet')->store('spreadsheets');

        $jobId = InsertResiduesJob::send(['storagePath' => $storagePath]);

        return response()->json([
            'job_id' => $jobId,
            'check_status' => route('dispatched.job.show', $jobId),
            'message' => 'Planilha logo será processada'
        ], 200);
    }

    public function show(string $id): JsonResponse
    {
        try {
            $residue = $this->findResidueQuery->handle($id);
        } catch (Exception $exception) {
            return $this->handleCatch($exception, ['id' => $id]);
        }

        return response()->json($residue, 200);
    }

    public function update(UpdateResidueRequest $request, string $id): JsonResponse
    {
        $input = new ResidueInput(
            $request->name,
            $request->type,
            $request->category,
            $request->technology,
            $request->class,
            $request->unit_measurement,
            $request->weight,
        );

        try {
            $this->updateResidue->handle($id, $input);
        } catch (Exception $exception) {
            return $this->handleCatch($exception, ['id' => $id]);
        }

        return response()->json([
            'message' => 'Resíduo atualizado'
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $this->deleteResidue->handle($id);
        } catch (Exception $exception) {
            return $this->handleCatch($exception, ['id' => $id]);
        }

        return response()->json([
            'message' => 'Resíduo excluído'
        ], 200);
    }
}
