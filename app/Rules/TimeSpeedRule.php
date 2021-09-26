<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TimeSpeedRule implements Rule
{
    public $type;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->type !== 'timespeed') {
            return true;
        }

        // format example : 1h 34m 33s 74ms
        $split = explode(' ', $value);

        if(count($split) > 4) {
            return false;
        }

        if(!strpos($split[0],'h') || 
            !strpos($split[1],'m') ||
            !strpos($split[2],'s') ||
            !strpos($split[3],'ms')) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Time as speed target must be in the format: 1h 34m 33s 74ms';
    }
}
