<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CmdMessage extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    // protected $fillable = ['image', 'en_description', 'hi_description', 'publish_time', 'live_table_id', 'status', 'remarks', 'created_by'];
    protected $guarded = [];

    public function descritionVal() {
        $lang = app()->getLocale();
        $column = $lang."_description";
         $datad = $this->select($column.' as description')->where('status',1)->first();
        return $datad->description;
    }
}
