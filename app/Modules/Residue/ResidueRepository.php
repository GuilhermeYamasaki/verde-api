<?php

namespace App\Modules\Residue;

use App\Modules\Residue\Domain\ResidueDTO;

interface ResidueRepository
{
    public function persist(ResidueDTO $residueDTO): void;
    public function persistMany(array $residues): void;
    public function delete(string $id): void;
    public function exists(string $id): bool;
}
