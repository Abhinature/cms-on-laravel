<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\{Page, PageAsset, PageTranslation};
use App\DataTables\{
    PagesDataTable
};
use Illuminate\Support\Facades\Crypt;
class PageController extends Controller
{
    public function index(PagesDataTable $datatable) {
        return $datatable->render('page.index');
    }

    public function add(Request $request) {
        return view('page.add');
    }

    public function store(Request $request) {
        
        DB::beginTransaction();
        
        try {
            $input = $request->all();
            $pageData = [];
            $pageData['name'] = $request['name'];
            $pageData['hi_name'] = $request['hi_name'] ?? '';
            $pageData['is_published'] = $request['is_published'];
            $pageData['status'] = (isset($request['status']) && $request['status'] == 'on') ? 1 : 0;
            
            $page = Page::create($pageData);

            if(!empty($input['page_css']) || !empty($input['page_js'])) {
                $pageAsset          =   new PageAsset();
                $pageAsset->page_id =   $page->id;
                $pageAsset->page_css=   $request['page_css'];
                $pageAsset->page_js =   $request['page_js'];
                $pageAsset->save();
            }
            
            if (!empty($request['language_en']) && !empty($request['title_en']) && !empty($request['main_content_en'])) {
                $PageTranslation = new PageTranslation();
                $PageTranslation->page_id = $page->id;
                $this->saveTranslation($PageTranslation,$request['language_en'],base64_encode($request['main_content_en']),$request['title_en'],$request['heading_en']);
            }

            if (!empty($request['language_hi']) && !empty($request['title_hi']) && !empty($request['main_content_hi'])) {
                $PageTranslation = new PageTranslation();
                $PageTranslation->page_id = $page->id;
                $this->saveTranslation($PageTranslation,$request['language_hi'],base64_encode($request['main_content_hi']),$request['title_hi'],$request['heading_hi']);
            } 
            else {
                
                $PageTranslation = new PageTranslation();
                $PageTranslation->page_id = $page->id;
                $this->saveTranslation($PageTranslation,$request['language_hi'],base64_encode($request['main_content_en']),$request['title_en'],$request['heading_en']);
            }
            
            Session::flash('message', 'success|Page created successfully !');
            DB::commit();
            return redirect(route('page.index'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollback();
            return back();
        }
    }

    private function saveTranslation($model,$lag,$conetnt,$title,$heading)
    {
        $model->language =$lag;
        $model->title = $title;
        $model->main_content =$conetnt; 
        $model->heading =$heading;
        
        $model->save();
    }

    public function edit($id) {
        
        $id = Crypt::decryptString($id);
        $page = Page::findOrFail($id);
        
        if (empty($page)) {
            Session::flash('message', 'danger|Page not found !');
            return redirect(route('page.index'));
        }

        $hindi_translation=PageTranslation::where('page_id',$page->id)->where('language','hi')->first();
        $default_translation=PageTranslation::where('page_id',$page->id)->where('language','en')->first();
        $pageAsset=PageAsset::where('page_id',$id)->first();
        
        return view('page.edit')->with(['page'=> $page,'pageAsset'=>$pageAsset,'hindi_translation'=>$hindi_translation,'default_translation'=>$default_translation]);
    }

    public function update(Request $request) {
        
        $id = Crypt::decryptString($request->id);
        
        $status = ($request->status == 'on' || $request->status == 1) ? 1 : 0;
        $page = Page::find($id);

        if (empty($page)) {
            Session::flash('message', 'danger|Page not found !');
            return redirect(route('page.index'));
        }

        DB::beginTransaction();

        try {
            $page_update = Page::whereId($id)->update([
                'name' => $request->name,
                'status' => $status
            ]);

           if(!empty($request['page_css']) || !empty($request['page_js'])){
                $pageAsset=PageAsset::where('page_id',$id)->first();
                if(empty($pageAsset)){$pageAsset=new PageAsset();}
                $pageAsset->page_id=$page->id;
                $pageAsset->page_css=$request['page_css'];
                $pageAsset->page_js=$request['page_js'];
                $pageAsset->save();
            }

            if (!empty($request['language_en']) && !empty($request['title_en']) && !empty($request['main_content_en'])) {
                $PageTranslation = PageTranslation::where('page_id',$id)->where('language','en')->first();
                $PageTranslation->page_id = $page->id;
                $this->saveTranslation($PageTranslation,$request['language_en'],base64_encode($request['main_content_en']),$request['title_en'],$request['heading_en']);
            }

            if (!empty($request['language_hi']) && !empty($request['title_hi']) && !empty($request['main_content_hi'])) {
                $PageTranslation = PageTranslation::where('page_id',$id)->where('language','hi')->first();
                $this->saveTranslation($PageTranslation,$request['language_hi'],base64_encode($request['main_content_hi']),$request['title_hi'],$request['heading_hi']);
            } 
            else {
                $PageTranslation = PageTranslation::where('page_id',$id)->where('language','hi')->first();
                $this->saveTranslation($PageTranslation,$request['language_hi'],base64_encode($request['main_content_en']),$request['title_en'],$request['heading_en']);
            }

            Session::flash('message', 'success|Page update successfully !');
            DB::commit();
            return redirect(route('page.index'));
        }
        catch(\Exception $e) {
            // dump($e->getLine());
            // dd($e->getMessage());
            Session::flash('message', 'danger|Something went wrong !');
            DB::rollback();
            return redirect(route('page.index'));
        }
    } 

    public function getPageHistory(Request $request) {
        try {
            $id = Crypt::decryptString($request->_id);
            $page = PageTranslation::where('page_id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status'=>200,
                'msg'=>$html
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status'=>500,
                'msg'=>''
            ]);
        }
        
        
    }
}
