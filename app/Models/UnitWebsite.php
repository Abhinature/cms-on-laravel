<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UnitWebsite extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'unit_websites';
    protected $guarded = [];
}
