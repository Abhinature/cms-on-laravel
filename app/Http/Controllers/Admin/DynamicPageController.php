<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Crypt;
class DynamicPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = DynamicPage::all();
       return view('dynamic-page.list')->with(['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit = DynamicPage::where('status',1)->get();
        return view('dynamic-page.add')->with(['unit'=>$unit]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = DynamicPage::select()->where('slug',$request->input('slug'))->first();

        if(empty($data)){          
            $unit = new DynamicPage; 
            $unit->page_title = $request->input('page_title'); 
            $unit->slug = $request->input('slug'); 
            $unit->parent_page = $request->input('parent_page');
            $unit->meta_title = $request->input('meta_title'); 
            $unit->meta_keyword = $request->input('meta_keyword'); 
            $unit->meta_description = $request->input('meta_description'); 
            $unit->description = $request->input('description'); 
            $unit->created_by = Auth::user()->id;
            $unit->save();
            return redirect('dynamic-pages')->with(['msg'=>'Page Created Successfully']);
        }else{
            return redirect()->back()->with(['msg'=>'Page Already Exists !!']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(DynamicPage $dynamicPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DynamicPage $dynamicPage ,$id)
    {
        $id = Crypt::decrypt($id);
        $unit = DynamicPage::where('status',1)->where('id','!=',$id)->get();
        $data = DynamicPage::where('id',$id)->first();
        return view('dynamic-page.edit')->with(['unit'=>$unit,'data'=>$data]);

    }

    public function SubmitReview(DynamicPage $dynamicPage,$id){
        $id = Crypt::decrypt($id);
        DynamicPage::where('id',$id)->update(['submit_for_review'=>'1']);
        return redirect()->back()->with('msg','Page Submitted For Review');
    }

    public function DynamicPageForReview (DynamicPage $dynamicPage){
        $data= DynamicPage::where('submit_for_review','1')->get();
        return view('dynamic-page.list-review-page')->with(['data' => $data]);
    }

    public function ApprovePage(DynamicPage $dynamicPage,$id){
        $id = Crypt::decrypt($id);
        DynamicPage::where('id',$id)->update(['status'=>'1']);
        return redirect()->back()->with('msg','Page Approved');
    }
    public function RejectPage(DynamicPage $dynamicPage,$id){
        $id = Crypt::decrypt($id);
        DynamicPage::where('id',$id)->update(['status'=>'2']);
        return redirect()->back()->with('msg','Page Submitted For Review');
    }
    public function PublishPage(DynamicPage $dynamicPage,$id){
        $id = Crypt::decrypt($id);
        DynamicPage::where('id',$id)->update(['status'=>'3']);
        return redirect()->back()->with('msg','Page published');
    }

    public function UnPublishPage(DynamicPage $dynamicPage,$id){
        $id = Crypt::decrypt($id);
        DynamicPage::where('id',$id)->update(['status'=>'4']);
        return redirect()->back()->with('msg','Page unpublished');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DynamicPage $dynamicPage)
    {

        $data = DynamicPage::select()->where('slug',$request->input('slug'))->where('id','!=',Crypt::decrypt($request->input('hid')))->first();

        if(empty($data)){ 
        DynamicPage::where('id',Crypt::decrypt($request->input('hid')))->update([
            'page_title' => $request->input('page_title'), 
            'slug' => $request->input('slug'),
            'parent_page' => $request->input('parent_page'),
            'meta_title' => $request->input('meta_title'), 
            'meta_keyword' => $request->input('meta_keyword'), 
            'meta_description' => $request->input('meta_description'), 
            'description' => $request->input('description'),
            'status' => 0,
            'submit_for_review' =>0

        ]);
        return redirect('dynamic-pages')->with(['msg'=>'Page Updated Successfully']);
    }else{
        return redirect()->back()->with(['msg'=>'Page Already Exists !!']);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DynamicPage $dynamicPage)
    {
        //
    }
}
