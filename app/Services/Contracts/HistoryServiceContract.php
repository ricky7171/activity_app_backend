<?php

namespace App\Services\Contracts;

interface HistoryServiceContract {
    public function get();

    public function store($input);

    public function update($input, $id);

    public function delete($id);
    
    public function search($fields);
}