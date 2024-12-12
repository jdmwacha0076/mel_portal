<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = ['goal_name', 'goal_description', 'goal_created_by_user_id'];

    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }

    public function goalCreator()
    {
        return $this->belongsTo(User::class, 'goal_created_by_user_id');
    }
}
