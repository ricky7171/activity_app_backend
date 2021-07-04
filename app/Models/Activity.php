<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'default_value', 'target', 'can_change', 'use_textfield'];

    public function histories() {
        return $this->hasMany(History::class);
    }

    public function delete()
    {   
        foreach($this->histories as $history) { $history->delete(); }
        return parent::delete();
    }
}
