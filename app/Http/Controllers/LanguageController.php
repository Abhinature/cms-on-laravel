<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LanguageController extends Controller
{

    public function changeLanguage($locale, Request $request)
    {
        $explode = explode('/', url()->previous());
        $count = count($explode);
        if( $explode[$count-1] == 'en' ||  $explode[$count-1] == 'hi') {
            return redirect($locale.'/');
        }
        return redirect($locale.'/'.$explode[$count-1]);
    }
}
