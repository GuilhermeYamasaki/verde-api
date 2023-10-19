<?php

namespace App\Repositories\Residue;

use App\Models\Residue as ResidueModel;
use App\Modules\Residue\Domain\ResidueDTO;
use App\Modules\Residue\Domain\ResidueFactory;

class ResidueDataMapper
{
    public function __construct(
        private readonly ResidueFactory $residueFactory,
    ) {
    }

    public function mapToDomain(ResidueModel $residueModel): ResidueDTO
    {
        return $this->residueFactory->restore(
            $residueModel->id,
            $residueModel->name,
            $residueModel->type,
            $residueModel->category,
            $residueModel->technology,
            $residueModel->class,
            $residueModel->unit_measurement,
            $residueModel->weight
        );
    }

    public function mapToModelData(ResidueDTO $residueDTO): array
    {
        return [
            'id' => $residueDTO->id,
            'name' => $residueDTO->name,
            'type' => $residueDTO->type,
            'category' => $residueDTO->category,
            'technology' => $residueDTO->technology,
            'class' => $residueDTO->class,
            'unit_measurement' => $residueDTO->unitMeasurement,
            'weight' => $residueDTO->weight
        ];
    }
}
