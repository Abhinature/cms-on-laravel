<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\{
    CmdMessage,
    ApprovedProduct,
    
    ApprovedWebsiteSliderImage,
    ApprovedMediaRelease,
    MediaRelease,
    ApprovedWhatNew,
    WhatsNew,
    ApprovedAwardAchievement,
    AwardAchievements,
    Milestone,
    ApprovedMilestone,
    Page,
    PageTranslation,
    Rti,
    RtiMandatoryDisclosure,
    ApprovedRti,
    ApprovedRtiMandatoryDisclosure
};

use Session;
use Illuminate\Support\Facades\DB;
  
class FrontendController extends Controller
{
    public function index(Request $request) {
        Session::put('user_ip',$request->getClientIp(true));
         DB::table('tbl_ips')->insertGetId(['ip'=>session('user_ip')]);
        $cmd = DB::table('approved_cmd_messages')->orderby('id','DESC')->first();
        $product = ApprovedProduct::where('show_in_slider', 1)->limit('10')->latest()->get();
        $sliderImage = ApprovedWebsiteSliderImage::whereStatus(1)->where('unit_id','0')->orderBy('sequence', 'ASC')->get();
        // dd($sliderImage);
        $mediaRealse = ApprovedMediaRelease::whereStatus(1)->limit(5)->get();
        // dd($mediaRealse);
        $whatnew = ApprovedWhatNew::whereStatus(1)->limit(10)->get();
        $award_achievement = ApprovedAwardAchievement::whereStatus(1)->limit(10)->get();
        $milestone = ApprovedMilestone::whereStatus(1)->limit(10)->get();
       
        return view('front.home')->with(['cmd'=>$cmd,'product' => $product, 'sliderImage' => $sliderImage, 'mediaRealse' => $mediaRealse, 'whatnew' => $whatnew, 'award_achievement' => $award_achievement, 'milestone'=>$milestone]);
    }

    public function previewcmd(Request $request,$id) {
        // $cmd = DB::table('approved_cmd_messages')->orderby('id','DESC')->first();
        $id =  Crypt::decrypt($id);
        $cmd =CmdMessage::where('status','0')->where('id',$id)->first();
        $product = ApprovedProduct::where('show_in_slider', 1)->limit('10')->latest()->get();
        $sliderImage = ApprovedWebsiteSliderImage::whereStatus(1)->where('unit_id','0')->orderBy('sequence', 'ASC')->get();
        // dd($sliderImage);
        $mediaRealse = ApprovedMediaRelease::whereStatus(1)->limit(5)->get();
        // dd($mediaRealse);
        $whatnew = ApprovedWhatNew::whereStatus(1)->limit(10)->get();
        $award_achievement = ApprovedAwardAchievement::whereStatus(1)->limit(10)->get();
        $milestone = ApprovedMilestone::whereStatus(1)->limit(10)->get();
        Session::put('user_ip',$request->getClientIp(true));
        return view('front.home')->with(['cmd'=>$cmd,'product' => $product, 'sliderImage' => $sliderImage, 'mediaRealse' => $mediaRealse, 'whatnew' => $whatnew, 'award_achievement' => $award_achievement, 'milestone'=>$milestone]);
    }
    public function previewmedia(Request $request) {
        $cmd = DB::table('approved_cmd_messages')->orderby('id','DESC')->first();
        $product = ApprovedProduct::where('show_in_slider', 1)->limit('10')->latest()->get();
        $sliderImage = ApprovedWebsiteSliderImage::whereStatus(1)->where('unit_id','0')->orderBy('sequence', 'ASC')->get();
        // dd($sliderImage);
        $mediaRealseA = ApprovedMediaRelease::whereStatus(1)->get();
        // dd($mediaRealseA);
        $mediaRealseC = MediaRelease::whereIn('status',[0,3])->get();
       
        $j = json_encode($mediaRealseA);
        $d=  json_decode($mediaRealseA);
        $j1 = json_encode($mediaRealseC);
        $d1=  json_decode($mediaRealseC);
        $mediaRealse = array_merge($d,$d1);
        // dd($mediaRealse);
        $whatnew = ApprovedWhatNew::whereStatus(1)->limit(10)->get();
        $award_achievement = ApprovedAwardAchievement::whereStatus(1)->limit(10)->get();
        $milestone = ApprovedMilestone::whereStatus(1)->limit(10)->get();
        Session::put('user_ip',$request->getClientIp(true));
        return view('front.home')->with(['cmd'=>$cmd,'product' => $product, 'sliderImage' => $sliderImage, 'mediaRealse' => $mediaRealse, 'whatnew' => $whatnew, 'award_achievement' => $award_achievement, 'milestone'=>$milestone]);
    }

    public function previewmilestone(Request $request) {
        $cmd = DB::table('approved_cmd_messages')->orderby('id','DESC')->first();
        $product = ApprovedProduct::where('show_in_slider', 1)->limit('10')->latest()->get();
        $sliderImage = ApprovedWebsiteSliderImage::whereStatus(1)->where('unit_id','0')->orderBy('sequence', 'ASC')->get();
        // dd($sliderImage);
        $mediaRealse = ApprovedMediaRelease::whereStatus(1)->limit(5)->get();
        // dd($mediaRealse);
        $whatnew = ApprovedWhatNew::whereStatus(1)->limit(10)->get();
        $award_achievement = ApprovedAwardAchievement::whereStatus(1)->limit(10)->get();
        $milestoneA = ApprovedMilestone::whereStatus(1)->get();
        $milestoneC = Milestone::whereIn('status',[0,3])->get();
        // dd($milestoneC);
        $j = json_encode($milestoneA);
        $d=  json_decode($milestoneA);
        $j1 = json_encode($milestoneC);
        $d1=  json_decode($milestoneC);
        $milestone = array_merge($d,$d1);
        // dd($milestone);
        Session::put('user_ip',$request->getClientIp(true));
        return view('front.home')->with(['cmd'=>$cmd,'product' => $product, 'sliderImage' => $sliderImage, 'mediaRealse' => $mediaRealse, 'whatnew' => $whatnew, 'award_achievement' => $award_achievement, 'milestone'=>$milestone]);
    }
    public function previewwhatsnew(Request $request) {
        $cmd = DB::table('approved_cmd_messages')->orderby('id','DESC')->first();
        $product = ApprovedProduct::where('show_in_slider', 1)->limit('10')->latest()->get();
        $sliderImage = ApprovedWebsiteSliderImage::whereStatus(1)->where('unit_id','0')->orderBy('sequence', 'ASC')->get();
        // dd($sliderImage);
        $mediaRealse = ApprovedMediaRelease::whereStatus(1)->limit(5)->get();
        // dd($mediaRealse);
        
        $award_achievement = ApprovedAwardAchievement::whereStatus(1)->limit(10)->get();
        $milestone = ApprovedMilestone::whereStatus(1)->get();
        $whatnewA = ApprovedWhatNew::whereStatus(1)->get();
        $whatnewC = WhatsNew::whereIn('status', [0,3])->get();
        // dd($milestoneC);
        $j = json_encode($whatnewA);
        $d=  json_decode($whatnewA);
        $j1 = json_encode($whatnewC);
        $d1=  json_decode($whatnewC);
        $whatnew = array_merge($d,$d1);
        // dd($milestone);
        Session::put('user_ip',$request->getClientIp(true));
        return view('front.home')->with(['cmd'=>$cmd,'product' => $product, 'sliderImage' => $sliderImage, 'mediaRealse' => $mediaRealse, 'whatnew' => $whatnew, 'award_achievement' => $award_achievement, 'milestone'=>$milestone]);
    }
    public function previewaward(Request $request) {
        $cmd = DB::table('approved_cmd_messages')->orderby('id','DESC')->first();
        $product = ApprovedProduct::where('show_in_slider', 1)->limit('10')->latest()->get();
        $sliderImage = ApprovedWebsiteSliderImage::whereStatus(1)->where('unit_id','0')->orderBy('sequence', 'ASC')->get();
        // dd($sliderImage);
        $mediaRealse = ApprovedMediaRelease::whereStatus(1)->limit(5)->get();
        // dd($mediaRealse);
        
       
        $milestone = ApprovedMilestone::whereStatus(1)->get();
        $whatnew = ApprovedWhatNew::whereStatus(1)->get();
        $award_achievementA = ApprovedAwardAchievement::whereStatus(1)->limit(10)->get();
        $award_achievementC = AwardAchievements::whereIn('status',[0,3])->get();
        // dd($milestoneC);
        $j = json_encode($award_achievementA);
        $d=  json_decode($award_achievementA);
        $j1 = json_encode($award_achievementC);
        $d1=  json_decode($award_achievementC);
        $award_achievement = array_merge($d,$d1);
        // dd($milestone);
        Session::put('user_ip',$request->getClientIp(true));
        return view('front.home')->with(['cmd'=>$cmd,'product' => $product, 'sliderImage' => $sliderImage, 'mediaRealse' => $mediaRealse, 'whatnew' => $whatnew, 'award_achievement' => $award_achievement, 'milestone'=>$milestone]);
    }

    public function listOfCpios(Request $request) {
        $rti = ApprovedRti::where('status',1)->get();

        return view('front.list-of-cpios',['data'=>$rti]);
    }

    public function career() {
        return view('front.career');
    }

    public function openTenders() {
        return view('front.open-tender');
    }

    public function closedTenders(Request $request) {
        return view('front.close-tender');
    }

    public function mandatoryDisclosures (Request $request) {
        $data = ApprovedRtiMandatoryDisclosure::where('status',1)->orderby('id','DESC')->get();
        return view('front.mandatory-disclosures',['data'=>$data]);
    }

    public function contactdetails(){
        $data = DB::table('approved_website_contact')->where('unit_id','0')->orderby('id','DESC')->first();
        return view('front.contact',['data'=>$data]);

    }

    public function findBySlug($url) {
        
        $page = Page::where('url', $url)->first();
        if (!$page) {
            return redirect()->back();
        }
        
        return view('front.dynamic-content')->with([
            'content' => $page->getTranslationAttribute()
        ]);
    }
}
