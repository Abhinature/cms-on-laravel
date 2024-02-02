<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Page
};

class PageAsset extends Model
{
    public $table = 'page_assets';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $guarded = [];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
