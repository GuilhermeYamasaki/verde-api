<?php

namespace App\Modules\Residue\UseCases;

use App\Modules\Residue\Domain\ResidueFactory;
use App\Modules\Residue\ResidueRepository;

class InsertManyResidues
{
    public function __construct(
        private readonly ResidueRepository $residueRepository,
        private readonly ResidueFactory $residueFactory
    ) {
    }

    public function handle(array $residues)
    {
        $residues = collect($residues)->map(fn (ResidueInput $input) => $this->residueFactory->new(
            $input->name,
            $input->type,
            $input->category,
            $input->technology,
            $input->class,
            $input->unitMeasurement,
            $input->weight,
        ))->toArray();

        $this->residueRepository->persistMany($residues);
    }
}
