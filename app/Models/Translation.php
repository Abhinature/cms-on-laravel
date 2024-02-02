<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'translations';
    protected $fillable = ['name', 'website_translations_id', 'language'];
}
