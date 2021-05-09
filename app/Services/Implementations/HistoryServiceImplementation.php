<?php
namespace App\Services\Implementations;

use App\Services\Contracts\HistoryServiceContract;
use App\Repositories\Contracts\HistoryRepositoryContract as HistoryRepo;
use App\Exceptions\StoreDataFailedException;
use Illuminate\Support\Arr;

class HistoryServiceImplementation implements HistoryServiceContract {
    protected $historyRepo;
    public function __construct(HistoryRepo $historyRepo)
    {
        $this->historyRepo = $historyRepo;
    }

    public function get() {
        $data = $this->historyRepo->datatableWith(['activity:id,title'])
            ->orderBy('id', 'desc')->get();
        
        $data = collect($data)->map(function ($item) {
            $item = Arr::add($item, 'activity_title', $item['activity']['title']);
            return Arr::except($item, ['activity']);
        });
        return $data->toArray();
    }

    public function store($input) {
        return $this->historyRepo->store($input);
    }

    public function update($input, $id) {
        return $this->historyRepo->update($input, $id);
    }

    public function delete($id) {
        return $this->historyRepo->delete($id);
    }

    public function search($fields) {
        return $this->historyRepo->search($fields);
    }
}