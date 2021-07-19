<?php

namespace App\Services\Contracts;

interface ActivityServiceContract {
    public function get();

    public function store($input);

    public function update($input, $id);

    public function delete($id);

    public function search($fields);

    public function getUsingMonthYear($month, $year);

    public function changePosition($id, $new_position);
    
}