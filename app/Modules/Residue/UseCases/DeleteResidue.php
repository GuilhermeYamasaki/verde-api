<?php

namespace App\Modules\Residue\UseCases;

use App\Modules\Residue\ResidueRepository;
use RuntimeException;

class DeleteResidue
{
    public function __construct(
        private readonly ResidueRepository $residueRepository,
    ) {
    }

    public function handle(string $id)
    {
        if (!$this->residueRepository->exists($id)) {
            throw new RuntimeException('Resíduo não existe', 404);
        }

        $this->residueRepository->delete($id);
    }
}
