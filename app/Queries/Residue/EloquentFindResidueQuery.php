<?php

namespace App\Queries\Residue;

use App\Modules\Residue\Queries\FindResidueQuery;
use App\Models\Residue as ResidueModel;
use RuntimeException;

class EloquentFindResidueQuery implements FindResidueQuery
{
    public function __construct(
        private readonly ResidueModel $residueModel
    ) {
    }

    public function handle(string $id): ?array
    {
        $residue = $this->residueModel->find($id);

        if (empty($residue)) {
            throw new RuntimeException('Resíduo não existe', 404);
        }

        return [
            'id' => $residue->id,
            'name' => $residue->name,
            'type' => $residue->type,
            'category' => $residue->category,
            'technology' => $residue->technology,
            'class' => $residue->class,
            'unit_measurement' => $residue->unitMeasurement,
            'weight' => $residue->weight
        ];
    }
}
