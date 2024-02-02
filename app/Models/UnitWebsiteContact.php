<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UnitWebsiteContact extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'unit_website_contact';
    protected $guarded = [];
}
