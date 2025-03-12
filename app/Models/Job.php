<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'company', 'category', 'location', 'description', 'url',
        'salary_min', 'salary_max', 'latitude', 'longitude', 'contract_time'
    ];

    public function getCreatedAtAttribute($value){
        return date('Y-m-d h:i A',strtotime($value)); 
     }
}
