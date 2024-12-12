<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['currency_name'];

    public function subActivities()
    {
        return $this->hasMany(SubActivity::class);
    }
}
