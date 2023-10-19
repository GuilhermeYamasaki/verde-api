<?php

namespace App\Modules\Residue\Queries;

interface FindResidueQuery
{
    public function handle(string $id): ?array;
}
