<?php

namespace App\Modules\Residue\UseCases;

use App\Modules\Residue\Domain\ResidueFactory;
use App\Modules\Residue\ResidueRepository;
use RuntimeException;

class UpdateResidue
{
    public function __construct(
        private readonly ResidueRepository $residueRepository,
        private readonly ResidueFactory $residueFactory
    ) {
    }

    public function handle(string $id, ResidueInput $input)
    {
        if (!$this->residueRepository->exists($id)) {
            throw new RuntimeException('Resíduo não existe', 404);
        }

        $residue = $this->residueFactory->restore(
            $id,
            $input->name,
            $input->type,
            $input->category,
            $input->technology,
            $input->class,
            $input->unitMeasurement,
            $input->weight,
        );

        $this->residueRepository->persist($residue);
    }
}
