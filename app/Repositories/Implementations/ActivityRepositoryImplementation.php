<?php

namespace App\Repositories\Implementations;

use App\Repositories\Contracts\ActivityRepositoryContract;
use App\Models\Activity;

class ActivityRepositoryImplementation extends BaseRepositoryImplementation implements ActivityRepositoryContract  {
    public function __construct(Activity $builder)
    {
        $this->builder = $builder;
    }
}