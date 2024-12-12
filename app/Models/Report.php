<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['report_name', 'report_description', 'report_date', 'created_by','file_path'];

    public function subActivities()
    {
        return $this->hasMany(SubActivity::class);
    }

    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
}
