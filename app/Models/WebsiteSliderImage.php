<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class WebsiteSliderImage extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'website_slider_images';
    protected $guarded = [];

    protected $auditEvents = [
        'created',
        'updated',
        'deleted',
        'restored',
    ];
}
