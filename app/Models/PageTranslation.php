<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\{
    Page
};

class PageTranslation extends Model implements Auditable
{
    use HasSlug;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'page_translations';
    protected $primaryKey = 'id';


    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $guarded = [];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('url');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
