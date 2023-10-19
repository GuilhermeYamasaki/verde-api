<?php

namespace App\Jobs;

use App\Enums\DispatchedJobStatus;
use App\Modules\Residue\UseCases\ResidueInput;
use App\Modules\Residue\UseCases\InsertManyResidues;
use App\Utils\SpreadsheetUtil;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InsertResiduesJob extends Job
{
    public function __construct(
        private readonly string $storagePath,
    ) {
    }

    public function handle(SpreadsheetUtil $spreadsheetUtil, InsertManyResidues $insertManyResidues): void
    {
        try {
            $this->processStatus(DispatchedJobStatus::PROCESSING);

            $spreadsheetItems = $spreadsheetUtil->mapToCollection($this->storagePath);

            $residues = $spreadsheetItems->map(fn ($item) => new ResidueInput(
                $item->nome_comum_do_residuo,
                $item->tipo_de_residuo,
                $item->categoria,
                $item->tecnologia_de_tratamento,
                $item->classe,
                $item->unidade_de_medida,
                $item->peso
            ))->toArray();

            $amountResidues = count($residues);

            $insertManyResidues->handle($residues);

            Storage::delete($this->storagePath);

            $status = DispatchedJobStatus::SUCCESS;
            $response = "Foram adicionados {$amountResidues} resíduos com sucesso";
        } catch (Exception $exception) {
            $status = DispatchedJobStatus::FAILED;
            $response = $exception->getMessage();

            Log::error($exception->getMessage(), [
                'storage_path' => $this->storagePath,
                'exception' => $exception
            ]);
        } finally {
            $this->endedStatus($status, $response);
        }
    }
}
