<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['staff_name', 'level', 'contacts'];

    public function createdReports()
    {
        return $this->hasMany(Report::class, 'created_by');
    }

    public function assignedSubActivities()
    {
        return $this->hasMany(SubActivity::class, 'assignee_id');
    }
}
