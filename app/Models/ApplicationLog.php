<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationLog extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "version", "description"
    ];

    protected $dates = ['deleted_at'];
    
    use HasFactory;
}
