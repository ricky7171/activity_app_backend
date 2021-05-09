<?php

namespace App\Repositories\Implementations;

use App\Repositories\Contracts\HistoryRepositoryContract;
use App\Models\History;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HistoryRepositoryImplementation extends BaseRepositoryImplementation implements HistoryRepositoryContract  {
    public function __construct(History $builder)
    {
        $this->builder = $builder;
    }

    public function search($fields) {
        $result = DB::table("histories")
            ->join("activities", "activities.id", "histories.activity_id")
            ->orWhere(function($query) use ($fields) {
                foreach ($fields as $key => $value) {
                    if($key != "activity_title") {
                        $query->orWhere($key, 'like', "%" . $value . "%");
                    } else {
                        $query->orWhere("activities.title", "like", "%" . $value . "%");
                    }
                }
            })
            ->select("histories.*", "activities.id as activity_id", "activities.title as activity_title")
            ->get();
          
        return $result;
    }
}