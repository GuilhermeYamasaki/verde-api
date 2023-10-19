<?php

namespace App\Repositories\Residue;

use App\Models\Residue as ResidueModel;
use App\Modules\Residue\Domain\ResidueDTO;
use App\Modules\Residue\ResidueRepository;
use Carbon\Carbon;

class EloquentResidueRepository implements ResidueRepository
{
    public function __construct(
        private readonly ResidueModel $residueModel,
        private readonly ResidueDataMapper $residueDataMapper,
    ) {
    }

    public function persist(ResidueDTO $residueDTO): void
    {
        $this->residueModel->updateOrCreate(
            ['id' => $residueDTO->id],
            $this->residueDataMapper->mapToModelData($residueDTO)
        );
    }

    public function persistMany(array $residues): void
    {
        $this->residueModel->insert(
            collect($residues)->map(function ($residue) {
                $residue = $this->residueDataMapper->mapToModelData($residue);
                return array_merge($residue, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            })->toArray()
        );
    }

    public function delete(string $id): void
    {
        $this->residueModel->findOrFail($id)->delete();
    }

    public function exists(string $id): bool
    {
        $residue = $this->residueModel->find($id);

        if (empty($residue)) {
            return false;
        }

        return true;
    }
}
