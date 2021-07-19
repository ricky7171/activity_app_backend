<?php

namespace App\Repositories\Implementations;

use App\Repositories\Contracts\ActivityRepositoryContract;
use App\Models\Activity;

class ActivityRepositoryImplementation extends BaseRepositoryImplementation implements ActivityRepositoryContract  {
    public function __construct(Activity $builder)
    {
        $this->builder = $builder;
    }

    public function search($fields) {
        $result = \App\Models\Activity::orWhere(function($query) use ($fields) {
            foreach ($fields as $key => $value) {
                $query->orWhere($key, 'like', "%" . $value . "%");
            }
        })->get();
        return $result;
    }

    public function getUsingMonthYear($month, $year) {
        return Activity::with(['histories' => function($query) use ($month, $year) {
            $query->whereYear("date", $year)->whereMonth("date", $month);
        }])->get();
    }

    public function changePosition($id, $new_position) {
        $activity = Activity::find($id);
        $activity->position = $new_position;
        $activity->save();
    }
}