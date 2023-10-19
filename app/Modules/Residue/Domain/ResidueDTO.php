<?php

namespace App\Modules\Residue\Domain;

final class ResidueDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $type,
        public string $category,
        public string $technology,
        public string $class,
        public string $unitMeasurement,
        public float $weight
    ) {
    }
}
