<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class DispachedJob extends Model
{
    use Uuids;

    protected $fillable = [
        'job', 'status', 'response', 'started_at'
    ];

    protected $casts = [
        'created_at'  => 'datetime:d/m/Y H:i',
        'updated_at'  => 'datetime:d/m/Y H:i',
        'started_at'  => 'datetime:d/m/Y H:i',
    ];
}
