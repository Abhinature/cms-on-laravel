<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedWhois extends Model
{
    
    protected $table = 'approved_whois';
    protected $guarded = [];
    use HasFactory;
}
