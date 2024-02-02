<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translation;

class WebsiteTranslation extends Model
{
    public $table = 'website_translations';
    public $fillable = [
        'name',
        'slug',
    ];

    public function gettranslation($lang){
      
        $trans= Translation::where('website_translations_id', $this->id)->join('languages','languages.id','translations.language')->where('languages.slug',$lang)->first();
        return $trans;
     }
}
