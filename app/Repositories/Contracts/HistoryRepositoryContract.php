<?php

namespace App\Repositories\Contracts;

interface HistoryRepositoryContract
{
    public function search($fields);

    public function getHistoryRange();

    public function storeBulk($input);

    public function deleteBulk($input);

}
