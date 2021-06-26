<?php

namespace App\Repositories\Contracts;

interface ActivityRepositoryContract
{
    public function search($fields);

    public function getUsingMonthYear($month, $year);
}
