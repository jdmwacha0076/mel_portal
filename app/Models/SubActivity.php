<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_activity_name', 
        'sub_activity_description', 
        'activity_id', 
        'sub_activity_startdate', 
        'sub_activity_end_date', 
        'currency_id', 
        'budget', 
        'assignee_id', 
        'status_id', 
        'report_id'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function assignee()
    {
        return $this->belongsTo(Staff::class, 'assignee_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
