<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $fillable = ['objective_name', 'objective_description', 'goal_id', 'objective_created_by_user_id'];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function objectiveCreator()
    {
        return $this->belongsTo(User::class, 'objective_created_by_user_id');
    }
}
