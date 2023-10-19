<?php

namespace App\Modules\Residue\Domain;

use Illuminate\Support\Str;

class ResidueFactory
{
    public function new(
        string $name,
        string $type,
        string $category,
        string $technology,
        string $class,
        string $unitMeasurement,
        string $weight
    ): ResidueDTO {
        return new ResidueDTO(
            Str::uuid(),
            $name,
            $type,
            $category,
            $technology,
            $class,
            $unitMeasurement,
            floatval($weight),
        );
    }

    public function restore(
        string $id,
        string $name,
        string $type,
        string $category,
        string $technology,
        string $class,
        string $unitMeasurement,
        string $weight
    ): ResidueDTO {
        return new ResidueDTO(
            $id,
            $name,
            $type,
            $category,
            $technology,
            $class,
            $unitMeasurement,
            floatval($weight),
        );
    }
}
