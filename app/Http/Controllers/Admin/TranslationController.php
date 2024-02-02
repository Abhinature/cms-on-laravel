<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{WebsiteTranslation, Language, Translation};
use App\DataTables\TranslationsDataTable;
use Session;

class TranslationController extends Controller
{
    /**
     * List of translation
     */
    public function index(TranslationsDataTable $datatable) {
        return $datatable->render('translation.index');
    }

    /**
     * Show edit form
     */
    public function edit(Request $request, $id ) {
        
        $languages          = Language::all();
        $websiteTranslation = WebsiteTranslation::find(base64_decode($id));
        
        if (empty($websiteTranslation)) {
            Session::flash('message', 'danger|Translation not exists !');
            return redirect(route('translation.index'));
        }
        
        $translations       = Translation::where(['website_translations_id' => base64_decode($id)])->get();
        $translation        = array();
        foreach ($translations as $trans) {
            $translation[$trans->language] = $trans->name;
        }

        return view('translation.edit')->with(['language' => $languages, 'websiteTranslation' => $websiteTranslation, 'translation' => $translation]);
    }

    /***
     * Show add form
     */
    public function add(Request $request) {
        $language = Language::all();
        return view('translation.add')->with(['language' => $language]);
    }

    /**
     * Website translation created
     */
    public function save(Request $request) {
        $input = $request->all();
        $websiteTranslation = WebsiteTranslation::create($input);

        $languages = Language::all();
        foreach ($languages as $language) {
            if ($language->title != "English") {
                if (isset($request['name_' . $language->id]) && $request['name_' . $language->id] != '') {
                    $translations = new Translation();
                    $translations->name = $request['name_' . $language->id];
                    $translations->website_translations_id = $websiteTranslation->id;
                    $translations->language = $language->id;
                    $translations->save();
                }
            }
        }

        Session::flash('message', 'success|Translation created successfully !');
        return redirect(route('translation.index'));
    }

    /**
     * Website transaltion updated
     */
    public function update(Request $request) {
        
        $id = base64_decode($request->id);
        $websiteTranslation = WebsiteTranslation::find($id);
        $languages = Language::all();
        foreach ($languages as $language) {
            if ($language->title != "English") {
                if (isset($request['name_' . $language->id]) && $request['name_' . $language->id] != '') {
                    $translations = Translation::where('website_translations_id', $id)->where('language', $language->id)->first();

                    if (!empty($translations)) {

                        $data['name'] = $request['name_' . $language->id];
                        $data['language'] = $language->id;
                        $translations->name = $request['name_' . $language->id];
                        $translations->save();
                    } else {
                        $translations = new Translation();
                        $translations->name = $request['name_' . $language->id];
                        $translations->website_translations_id = $websiteTranslation->id;
                        $translations->language = $language->id;
                        $translations->save();
                    }
                }
            }
        }
        
        if (empty($websiteTranslation)) {
            Session::flash('message', 'danger|Translation not found !');
            return redirect(route('translation.index'));
        }
        
        $capitalTranslation = WebsiteTranslation::where(['id' => $id])->update([
            'slug' => $request->slug,
            'name' => $request->name,
        ]);
        Session::flash('message', 'success|Translation updated successfully !');
        return redirect(route('translation.index'));
    }
}
