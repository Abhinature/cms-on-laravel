<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\{
    PageTranslation
};

class Page extends Model implements Auditable
{
    use HasSlug;
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;


    public $table = 'pages';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $guarded = [];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('url');
    }

    public function pageTranslations()
    {
        return $this->hasMany(PageTranslation::class, 'page_id');
    }

    public function getTranslationAttribute(){
        return  PageTranslation::where('page_id', $this->id)->where('language', app()->getLocale())->first();
    }

    public function pageNameVal() {
        $lang = app()->getLocale();
        $column = ($lang == 'hi') ? 'hi_name' : 'name';
        $data = $this->select($column.' as column');         
        return $data->column;
    }
}
