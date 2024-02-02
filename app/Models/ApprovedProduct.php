<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedProduct extends Model
{
    use HasFactory;

    protected $table = 'approved_products';
    protected $fillable = [];
      
}
