<?php

namespace App\Modules\Residue\UseCases;

final class ResidueInput
{
    public function __construct(
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
