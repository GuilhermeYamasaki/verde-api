<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Residue extends Model
{
    use Uuids;

    protected $fillable = [
        'id', 'name', 'type', 'category', 'technology', 'class', 'unit_measurement', 'weight'
    ];
}
