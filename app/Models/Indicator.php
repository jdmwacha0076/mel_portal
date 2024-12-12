<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_type',
        'parent_id',
        'indicator_name',
        'target_value',
        'achieved_value',
        'number_of_people',
        'budget',
        'start_date',
        'end_date'
    ];

    public function parent()
    {
        return $this->morphTo();
    }
}

