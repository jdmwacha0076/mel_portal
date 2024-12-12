<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['activity_name', 'activity_description', 'activity_start_date', 'activity_end_date', 'objective_id'];

    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }

    public function subActivities()
    {
        return $this->hasMany(SubActivity::class);
    }
}
