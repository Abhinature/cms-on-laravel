<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Download extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $guarded = [];

    /*********Status used ******/
     
    // status 0 -> created
    // status 3 -> submitted for review
    // status 1 -> Approved
    // status 10 -> deletion
    // status 11 -> request for deletion sent to admin 
    // status 12 -> status change for request for deletion
}
