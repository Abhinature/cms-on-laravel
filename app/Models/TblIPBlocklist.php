<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblIPBlocklist extends Model
{
    protected $table = 'tbl_ipblocklist';
    protected $fillable = ['fld_ip'];
}
