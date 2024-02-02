<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedAwardAchievement extends Model
{
    protected $table = 'approved_award_achievements';
    // protected $fillable = ['award_id', 'title', 'image', 'description', 'status', 'created_by', 'created_at', 'updated_at'];  
    protected $guarded = []; 

}
