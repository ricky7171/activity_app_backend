<?php
namespace App\Services\Implementations;

use App\Services\Contracts\ActivityServiceContract;
use App\Repositories\Contracts\ActivityRepositoryContract as ActivityRepo;
use App\Exceptions\StoreDataFailedException;

class ActivityServiceImplementation implements ActivityServiceContract {
    protected $activityRepo;
    public function __construct(ActivityRepo $activityRepo)
    {
        $this->activityRepo = $activityRepo;
    }

    public function get() {
        return $this->activityRepo->allOrder('id', 'desc');
    }

    public function store($input) {
        return $this->activityRepo->store($input);
    }

    public function update($input, $id) {
        return $this->activityRepo->update($input, $id);
    }

    public function delete($id) {
        return $this->activityRepo->delete($id);
    }
}