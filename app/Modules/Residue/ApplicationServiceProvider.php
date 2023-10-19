<?php

declare(strict_types=1);

namespace App\Modules\Residue;

use App\Modules\Residue\Queries\FindResidueQuery;
use App\Modules\Residue\Queries\ListResiduesQuery;
use App\Queries\Residue\EloquentFindResidueQuery;
use App\Queries\Residue\EloquentListResiduesQuery;
use App\Repositories\Residue\EloquentResidueRepository;
use Illuminate\Support\ServiceProvider;

final class ApplicationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ResidueRepository::class, EloquentResidueRepository::class);
        $this->app->bind(ListResiduesQuery::class, EloquentListResiduesQuery::class);
        $this->app->bind(FindResidueQuery::class, EloquentFindResidueQuery::class);
    }
}
