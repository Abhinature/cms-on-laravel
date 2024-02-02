<?php
use App\Models\WebsiteTranslation;

$transations=WebsiteTranslation::select('id','name','slug')->get();
$message=array();

foreach ($transations as $transation){
    if(isset($transation->gettranslation('hi')->name))
    $message[$transation->slug]=$transation->name;
}
return $message;
