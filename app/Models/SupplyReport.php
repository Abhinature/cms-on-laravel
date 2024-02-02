<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyReport extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_supply_orders';
    protected $guarded = [];
}
