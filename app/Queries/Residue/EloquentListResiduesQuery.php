<?php

namespace App\Queries\Residue;

use App\Modules\Residue\Queries\ListResiduesQuery;
use App\Models\Residue as ResidueModel;
use App\Utils\PaginateUtil;

class EloquentListResiduesQuery implements ListResiduesQuery
{
    public function __construct(
        private readonly ResidueModel $residueModel,
        private readonly PaginateUtil $paginateUtil,
    ) {
    }

    public function handle(int $page = 1, int $limit = 15): array
    {
        $data = $this->residueModel->paginate($limit)->toArray();

        $data['data'] = collect($data['data'])->map(fn ($residue) => [
            'id' => $residue['id'],
            'name' => $residue['name'],
            'type' => $residue['type'],
            'category' => $residue['category'],
        ])->toArray();

        return $this->paginateUtil->mapData($data);
    }
}
