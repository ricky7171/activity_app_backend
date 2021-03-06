<?php

namespace App\Repositories\Implementations;

use App\Repositories\Contracts\SettingRepositoryContract;
use App\Models\Setting;
use App\Models\Activity;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SettingRepositoryImplementation extends BaseRepositoryImplementation implements SettingRepositoryContract  {
    public function __construct(Setting $builder)
    {
        $this->builder = $builder;
    }

    public function getFormatted() {
        $settings = $this->builder->all();
        $result = [];

        foreach($settings as $setting) {
            $result[$setting->key] = $setting->value;
        }

        return $result;
    }

    public function save($key, $value) {
        $setting = $this->builder->where('key', $key)->first() ?: $this->builder;
        $setting->key = $key;
        $setting->value = $value;
        $setting->save();

        return $setting;
    }

    
}