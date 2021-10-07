<?php

namespace App\Repositories\Implementations;

use App\Repositories\Contracts\ActivityRepositoryContract;
use App\Models\Activity;
use DB;

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
        // return Activity::with(['histories' => function($query) use ($month, $year) {
        //     $query->whereYear("date", $year)->whereMonth("date", $month);
        // }])->get();

        $get_score_query = "
        CASE
            WHEN activities.type = 'count' THEN COUNT(histories.id)
            WHEN activities.type = 'value' THEN SUM(histories.value)
        END as score
        ";
        
        $join_histories = function($join) use($month, $year) {
            $join->on('histories.activity_id', 'activities.id')
                ->whereYear("histories.date", $year)
                ->whereMonth("histories.date", $month);
        };
        
        $activities = Activity::with(['histories' => function($query) use ($month, $year) {
                $query->whereYear("date", $year)->whereMonth("date", $month);
            }])
            ->leftJoin('histories', $join_histories)
            ->select(DB::raw('activities.id, activities.type, activities.title, activities.target, activities.value'))
            ->addSelect(DB::raw($get_score_query))
            ->addSelect(DB::raw('COUNT(histories.id) as count'))
            ->groupBy('histories.activity_id')
            ->groupBy(DB::raw('activities.id, activities.type, activities.title, activities.target, activities.value'))
            ->orderByDesc(DB::raw('MAX(histories.created_at)'))
            ->get()
            ;

        $activities = $activities->map(function($activity){
            $left = $activity->target - $activity->score;
            $is_red = $activity->score < $activity->target;
            
            $data = [
                'id' => $activity->id,
                'type' => $activity->type,
                'title' => $activity->title,
                'target' => $activity->target,
                'score' => $activity->score ?? 0,
                'count' => $activity->count, 
            ];
            
            if($activity->type == 'speedrun') {
                $histories = $activity->histories;
                if(count($histories)) {
                    $timestamps = $histories->map(function($history){
                        return Activity::convertSpeedrunValueToTimestamp($history->value);
                    });
                    $avg = $timestamps->avg();
                    $score = Activity::convertTimestampToSpeedrunValue($avg);


                    $speedtarget = $activity->value;
                    $speedtarget_timestamp = Activity::convertSpeedrunValueToTimestamp($speedtarget);

                    $is_red = $avg > $speedtarget_timestamp;
                    $data['best_time'] = Activity::convertTimestampToSpeedrunValue($timestamps->min());
                } else {
                    $score = '00h 00m 00s';
                    $is_red = false;
                    $data['best_time'] = $score;

                }
                $data['title'] .= " ({$activity->value})";
                $data['score'] = $score;
                $left = $activity->target - $activity->count;

            }

            $data['left'] = $left < 0 ? 0 : $left;
            $data['is_red'] = $is_red;
            $data['histories'] = $activity->histories;

            return $data;
        });

        return $activities;
    }

    public function changePosition($new_position) {
        foreach($new_position as $position => $id) {
            $activity = Activity::find($id);
            $activity->position = $position;
            $activity->save();
        }
    }
}