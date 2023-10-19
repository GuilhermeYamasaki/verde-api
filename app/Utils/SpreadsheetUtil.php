<?php

namespace App\Utils;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Shuchkin\SimpleXLSX;

class SpreadsheetUtil
{
    public function mapToCollection(string $storagePath): Collection
    {
        $path = storage_path("app/{$storagePath}");

        if (!file_exists($path)) {
            throw new RuntimeException('Spreadsheet not exists', 404);
        }

        try {
            $spreadsheet = SimpleXLSX::parse($path);

            /**
             * Filtrar qualquer linha ou coluna vazia capturada
             */
            $spreadsheet = collect($spreadsheet->rows())->filter(function ($row) { // Primeiro filtrar as linhas vazias
                $allCellValues = collect($row)->reduce(function ($allCellValues, $cellValue) { // Concateno todos os valores das colunas da linha em uma unica variável
                    return $allCellValues . $cellValue;
                }, '');

                $rowIsEmpty = empty($allCellValues);

                return !$rowIsEmpty; // Faço inverso de uma linha vazia, pois espero retorno apenas de linhas preenchidas
            })->map(function ($row) { // Faço remapeamento dos dados para remover colunas que estão vazias
                return collect($row)->filter(fn ($cell) => !empty($cell));
            })->values();
            /**
             * Fim da filtragem qualquer linha ou coluna vazia capturada
             */

            //Capturo primeira linha com valor da planilha e formato o texto
            $header = $spreadsheet->first()->map(fn ($value) => Str::slug($value, '_'));

            //Remapeio com novas chaves dos valores, removendo cabeçalho da planilha
            $collection = $spreadsheet->skip(1)->map(function ($row) use ($header) {
                return (object) $header->combine($row)->toArray();
            })->values();

            return $collection;
        } catch (Exception $exception) {
            Log::error(null, [
                'exception' => $exception
            ]);

            throw new RuntimeException('Spreadsheet invalid', 422);
        }
    }
}
