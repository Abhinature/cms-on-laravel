<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $table = 'languages';
    public $fillable = [
        'slug',
        'title',
        'flag',
        'caption',
        'status'
    ];
}
