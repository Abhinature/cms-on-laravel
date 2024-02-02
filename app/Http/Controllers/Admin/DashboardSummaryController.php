<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ {
    AwardAchievements,
    CmdMessage,
    MediaRelease,
    Milestone,
    UnitProduct,
    UnitWebsite,
    UnitWebsiteContact,
    Websitesliderimage,
    WhatsNew,
    Whois,
};
use Auth;
use Illuminate\Support\Facades\Crypt;

class DashboardSummaryController extends Controller
{
    /**
     * Get All pending data
     */
    public function pending() 
    {
        $AwardAchievements = $CmdMessage = $MediaRelease = $Milestone = $WhatsNew = $Whois = [];
        if( Auth::user()->unit_id == 0 ):
            $AwardAchievements  = AwardAchievements::selectRaw('title, IFNULL(NULL, "award_achievements") as table_name, created_by, created_at,type')->where('live_table_id', '0')->get()->toArray();
            $CmdMessage         = CmdMessage::selectRaw('en_description as title , IFNULL(NULL, "cmd_messages") as table_name, created_by, created_at,type')->where('live_table_id', '0')->get()->toArray();
            $MediaRelease       = MediaRelease::selectRaw('en_title as title , IFNULL(NULL, "media_releases") as table_name, created_by, created_at,type')->where('live_table_id', '0')->get()->toArray();
            $Milestone          = Milestone::selectRaw('en_milestone as title , IFNULL(NULL, "milestones") as table_name, created_by, created_at,type')->where('live_table_id', '0')->get()->toArray();
            $WhatsNew           = WhatsNew::selectRaw('news_file as title , IFNULL(NULL, "whats_news") as table_name, created_by, created_at,type')->where('live_table_id', '0')->get()->toArray();
            $Whois              = Whois::selectRaw('en_department as title , IFNULL(NULL, "whois") as table_name, created_by, created_at,type')->where('live_table_id', '0')->get()->toArray();
        endif;

        
        $UnitWebsite        = UnitWebsite::selectRaw('website_en_title as title , IFNULL(NULL, "unit_websites") as table_name, created_by, created_at,type')->where('live_table_id', '0')->where('unit_id', Auth::user()->unit_id)->get()->toArray();
        $UnitWebsiteContact = UnitWebsiteContact::selectRaw('en_address as title , IFNULL(NULL, "unit_website_contact") as table_name, created_by, created_at,type')->where('live_table_id', '0')->where('unit_id', Auth::user()->unit_id)->get()->toArray();
        $Websitesliderimage = Websitesliderimage::selectRaw('slider_image as title , IFNULL(NULL, "website_slider_images") as table_name, created_by, created_at,type')->where('live_table_id', '0')->where('unit_id', Auth::user()->unit_id)->get()->toArray();
        $products = UnitProduct::selectRaw('product_name as title ,"products" as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id','0')->where('unit_id', Auth::user()->unit_id)->Orderby('created_at','DESC')->get()->toArray();
               

        $data = array_merge($AwardAchievements, $CmdMessage, $MediaRelease, $Milestone, $UnitWebsite, $UnitWebsiteContact, $Websitesliderimage, $WhatsNew, $Whois,$products);
        $sortedArr = collect($data )->sortByDesc('created_at')->all();
        return view('dashboard.dashboard')->with(['data' => $sortedArr,'view_for' =>'pending']);
    }

    public function approve() 
    {
        $AwardAchievements = $CmdMessage = $MediaRelease = $Milestone = $WhatsNew = $Whois = [];
        if( Auth::user()->unit_id == 0 ):
            $AwardAchievements  = AwardAchievements::selectRaw('title, IFNULL(NULL, "award_achievements") as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->Orderby('created_at','DESC')->get()->toArray();
            $CmdMessage         = CmdMessage::selectRaw('en_description as title , IFNULL(NULL, "cmd_messages") as table_name, created_by,created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->Orderby('created_at','DESC')->get()->toArray();
            $MediaRelease       = MediaRelease::selectRaw('en_title as title , IFNULL(NULL, "media_releases") as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->Orderby('created_at','DESC')->get()->toArray();
            $Milestone          = Milestone::selectRaw('en_milestone as title , IFNULL(NULL, "milestones") as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->Orderby('created_at','DESC')->get()->toArray();
            $WhatsNew           = WhatsNew::selectRaw('news_file as title , IFNULL(NULL, "whats_news") as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->Orderby('created_at','DESC')->get()->toArray();
            $Whois              = Whois::selectRaw('en_department as title , IFNULL(NULL, "whois") as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->Orderby('created_at','DESC')->get()->toArray();
        endif;
        
        $UnitWebsite        = UnitWebsite::selectRaw('website_en_title as title , IFNULL(NULL, "unit_websites") as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->where('unit_id', Auth::user()->unit_id)->Orderby('created_at','DESC')->get()->toArray();
        $UnitWebsiteContact = UnitWebsiteContact::selectRaw('en_address as title , IFNULL(NULL, "unit_website_contact") as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->where('unit_id', Auth::user()->unit_id)->Orderby('created_at','DESC')->get()->toArray();
        $Websitesliderimage = Websitesliderimage::selectRaw('slider_image as title , IFNULL(NULL, "website_slider_images") as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->where('unit_id', Auth::user()->unit_id)->Orderby('created_at','DESC')->get()->toArray();
        $products = UnitProduct::selectRaw('product_name as title ,"products" as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id', '!=', '0')->where('unit_id', Auth::user()->unit_id)->Orderby('created_at','DESC')->get()->toArray();
               

        $data = array_merge($AwardAchievements, $CmdMessage, $MediaRelease, $Milestone, $UnitWebsite, $UnitWebsiteContact, $Websitesliderimage, $WhatsNew, $Whois,$products);
        // $sorted = $data->sortBy('created_at');
        $sortedArr = collect($data )->sortByDesc('created_at')->all();
        return view('dashboard.dashboard')->with(['data' => $sortedArr,'view_for' =>'approve']);
    }

   


    function reject(Request $request) 
    {
        $AwardAchievements = $CmdMessage = $MediaRelease = $Milestone = $WhatsNew = $Whois = [];
        if( Auth::user()->unit_id == 0 ):
            $AwardAchievements  = AwardAchievements::selectRaw('title, IFNULL(NULL, "award_achievements") as table_name, created_by, created_at,type')->where('live_table_id', '0')->whereStatus(4)->get()->toArray();
            $CmdMessage         = CmdMessage::selectRaw('en_description as title , IFNULL(NULL, "cmd_messages") as table_name, created_by, created_at,type')->where('live_table_id', '0')->whereStatus(4)->get()->toArray();
            $MediaRelease       = MediaRelease::selectRaw('en_title as title , IFNULL(NULL, "media_releases") as table_name, created_by, created_at,type')->where('live_table_id', '0')->whereStatus(4)->get()->toArray();
            $Milestone          = Milestone::selectRaw('en_milestone as title , IFNULL(NULL, "milestones") as table_name, created_by, created_at,type')->where('live_table_id', '0')->whereStatus(4)->get()->toArray();
            $WhatsNew           = WhatsNew::selectRaw('news_file as title , IFNULL(NULL, "whats_news") as table_name, created_by, created_at,type')->where('live_table_id', '0')->whereStatus(4)->get()->toArray();
            $Whois              = Whois::selectRaw('en_department as title , IFNULL(NULL, "whois") as table_name, created_by, created_at,type')->where('live_table_id', '0')->whereStatus(4)->get()->toArray();
        endif;

        
        $UnitWebsite        = UnitWebsite::selectRaw('website_en_title as title , IFNULL(NULL, "unit_websites") as table_name, created_by, created_at,type')->where('live_table_id', '0')->where('unit_id', Auth::user()->unit_id)->whereStatus(4)->get()->toArray();
        $UnitWebsiteContact = UnitWebsiteContact::selectRaw('en_address as title , IFNULL(NULL, "unit_website_contact") as table_name, created_by, created_at,type')->where('live_table_id', '0')->where('unit_id', Auth::user()->unit_id)->whereStatus(4)->get()->toArray();
        $Websitesliderimage = Websitesliderimage::selectRaw('slider_image as title , IFNULL(NULL, "website_slider_images") as table_name, created_by, created_at,type')->where('live_table_id', '0')->where('unit_id', Auth::user()->unit_id)->whereStatus(4)->get()->toArray();
        $products = UnitProduct::selectRaw('product_name as title ,IFNULL(NULL, "product") as table_name, created_by, created_at,action_by,action_date,type')->where('live_table_id','0')->where('unit_id', Auth::user()->unit_id)->whereStatus(4)->Orderby('created_at','DESC')->get()->toArray();
         
        $data = array_merge($AwardAchievements, $CmdMessage, $MediaRelease, $Milestone, $UnitWebsite, $UnitWebsiteContact, $Websitesliderimage, $WhatsNew, $Whois,$products);
        $sortedArr = collect($data )->sortByDesc('created_at')->all();
        return view('dashboard.dashboard')->with(['data' => $sortedArr,'view_for' =>'reject']);
    }

    function redirectPath($tableName) {

        if( Crypt::decrypt($tableName) == 'cmd_messages' ) {
            return redirect()->route('cmd-message');
        }
        return redirect()->route('unit-website', ['tableName' => $tableName]);
    }
}

