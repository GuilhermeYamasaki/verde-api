<?php

namespace App\Modules\Residue\Queries;

interface ListResiduesQuery
{
    public function handle(int $page = 1, int $limit = 15): array;
}
