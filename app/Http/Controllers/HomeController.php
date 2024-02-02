<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{
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
    UnitUser
};
use Auth;
use App\Charts\DashboardChart;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $startDate  = $request->start_date ?? '';
        $endDate    = $request->end_date ?? '';

        $filterCondition    = (!empty($startDate) && !empty($endDate))  ? [$startDate, $endDate] : '';
        $createdBy          = (!empty($request->created_by)) ? $request->created_by : '';


        // Pending Count
        $AwardAchievements = $CmdMessage = $MediaRelease = $Milestone = $WhatsNew = $Whois = 0;
        if (Auth::user()->unit_id == 0) :

            // $sql = "select count(*) from award_achievements where live_table_id = 0";
            // if( !empty($startDate) && !empty($endDate) ) {
            //     $sql .= " and created_at between ".$startDate." and ".$endDate;
            // }
            // if( !empty($createdBy) ) {
            //     $sql .= "and created_by = ".$createdBy;
            // }

            $AwardAchievements  = AwardAchievements::where('live_table_id', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $CmdMessage         = CmdMessage::where('live_table_id', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $MediaRelease       = MediaRelease::where('live_table_id', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $Milestone          = Milestone::where('live_table_id', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $WhatsNew           = WhatsNew::where('live_table_id', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $Whois              = Whois::where('live_table_id', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
        endif;

        $UnitWebsite        = UnitWebsite::where('live_table_id', '0')
            ->where('unit_id', Auth::user()->unit_id)
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })
            // ->when($createdBy, function( $query, $createdBy ){
            //     $query->where('created_by', $createdBy);
            // })
            ->count();
        $UnitWebsiteContact = UnitWebsiteContact::where('live_table_id', '0')
            ->where('unit_id', Auth::user()->unit_id)
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })
            // ->when($createdBy, function( $query, $createdBy ){
            //     $query->where('created_by', $createdBy);
            // })
            ->count();
        $Websitesliderimage = Websitesliderimage::where('live_table_id', '0')
            ->where('unit_id', Auth::user()->unit_id)
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })
            // ->when($createdBy, function( $query, $createdBy ){
            //     $query->where('created_by', $createdBy);
            // })
            ->count();

        $pendingCount = $AwardAchievements + $CmdMessage + $MediaRelease + $Milestone + $UnitWebsite + $UnitWebsiteContact + $Websitesliderimage + $WhatsNew + $Whois;

        // Approve Count
        $ApproveAwardAchievements = $ApproveCmdMessage = $ApproveMediaRelease = $ApproveMilestone = $ApproveWhatsNew = $ApproveWhois = 0;
        if (Auth::user()->unit_id == 0) :
            $ApproveAwardAchievements  = AwardAchievements::where('live_table_id', '!=', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $ApproveCmdMessage         = CmdMessage::where('live_table_id', '!=', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $ApproveMediaRelease       = MediaRelease::where('live_table_id', '!=', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $ApproveMilestone          = Milestone::where('live_table_id', '!=', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $ApproveWhatsNew           = WhatsNew::where('live_table_id', '!=', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $ApproveWhois              = Whois::where('live_table_id', '!=', '0')
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();

            $ApprovedProducts = 0;
        endif;
        $ApprovedProducts = UnitProduct::where('live_table_id', '!=', '0')
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })

            ->count();
        $ApproveUnitWebsite        = UnitWebsite::where('live_table_id', '!=', '0')
            ->where('unit_id', Auth::user()->unit_id)
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })
            // ->when($createdBy, function( $query, $createdBy ){
            //     $query->where('created_by', $createdBy);
            // })
            ->count();
        $ApproveUnitWebsiteContact = UnitWebsiteContact::where('live_table_id', '!=', '0')
            ->where('unit_id', Auth::user()->unit_id)
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })
            // ->when($createdBy, function( $query, $createdBy ){
            //     $query->where('created_by', $createdBy);
            // })
            ->count();
        $ApproveWebsitesliderimage = Websitesliderimage::where('live_table_id', '!=', '0')
            ->where('unit_id', Auth::user()->unit_id)
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })
            // ->when($createdBy, function( $query, $createdBy ){
            //     $query->where('created_by', $createdBy);
            // })
            ->count();

        $approveCount   = $ApprovedProducts + $ApproveAwardAchievements + $ApproveCmdMessage + $ApproveMediaRelease + $ApproveMilestone + $ApproveUnitWebsite + $ApproveUnitWebsiteContact + $ApproveWebsitesliderimage + $ApproveWhatsNew + $ApproveWhois;

        // Reject Count
        $RejectAwardAchievements = $RejectCmdMessage = $RejectMediaRelease = $RejectMilestone = $RejectWhatsNew = $RejectWhois = $RejectUnitWebsite = $RejectUnitWebsiteContact = $RejectWebsitesliderimage = 0;
        if (Auth::user()->unit_id == 0) :
            $RejectAwardAchievements  = AwardAchievements::where('live_table_id', '0')
                ->whereStatus(4)
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $RejectCmdMessage         = CmdMessage::where('live_table_id', '0')
                ->whereStatus(4)
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $RejectMediaRelease       = MediaRelease::where('live_table_id', '0')
                ->whereStatus(4)
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $RejectMilestone          = Milestone::where('live_table_id', '0')
                ->whereStatus(4)
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $RejectWhatsNew           = WhatsNew::where('live_table_id', '0')
                ->whereStatus(4)
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
            $RejectWhois              = Whois::where('live_table_id', '0')
                ->whereStatus(4)
                ->when($filterCondition, function ($query, $filterCondition) {
                    $query->whereBetween('created_at', $filterCondition);
                })
                // ->when($createdBy, function( $query, $createdBy ){
                //     $query->where('created_by', $createdBy);
                // })
                ->count();
        endif;

        $RejectUnitWebsite        = UnitWebsite::where('live_table_id', '0')
            ->where('unit_id', Auth::user()->unit_id)
            ->whereStatus(4)
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })
            // ->when($createdBy, function( $query, $createdBy ){
            //     $query->where('created_by', $createdBy);
            // })
            ->count();
        $RejectUnitWebsiteContact = UnitWebsiteContact::where('live_table_id', '0')
            ->where('unit_id', Auth::user()->unit_id)
            ->whereStatus(4)
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })
            // ->when($createdBy, function( $query, $createdBy ){
            //     $query->where('created_by', $createdBy);
            // })
            ->count();
        $RejectWebsitesliderimage = Websitesliderimage::where('live_table_id', '0')
            ->where('unit_id', Auth::user()->unit_id)
            ->whereStatus(4)
            ->when($filterCondition, function ($query, $filterCondition) {
                $query->whereBetween('created_at', $filterCondition);
            })
            // ->when($createdBy, function( $query, $createdBy ){
            //     $query->where('created_by', $createdBy);
            // })
            ->count();

        $rejectCount = $RejectAwardAchievements + $RejectCmdMessage + $RejectMediaRelease + $RejectMilestone + $RejectWhatsNew + $RejectWhois + $RejectUnitWebsite + $RejectUnitWebsiteContact + $RejectWebsitesliderimage;


        $totalCount     = $pendingCount + $approveCount + $rejectCount;

        // Generate Chart
        $chart = new DashboardChart;

        $chart->labels(['All', 'Pending', 'Approved', 'Reject']);
        $dataset = $chart->dataset('My dataset 1', 'pie', [$totalCount, $pendingCount, $approveCount, $rejectCount]);


        $dataset->backgroundColor(collect(['#17c1e8', '#fbcf33', '#82d616', '#ea0606']));
        $dataset->color(collect(['#17c1e8', '#fbcf33', '#82d616', '#ea0606']));
        $chart->height(100);
        $chart->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ],
            'title' => [
                'display' => true,
                'text' => 'Overview'
            ],
            'maintainAspectRatio' => true,
            'responsive' => true
        ]);

        // 
        $unitList = '';

        // this is a super admin
        // if( Auth::user()->unit_id == 0 )
        // {
        //     $unitList = 'Yantra India Limited';
        //     $createdBy = 0;
        // }
        // else
        // {
        //     $unitList = optional(Auth::user())->unitData->unit_name ?? '';
        //     $createdBy = Auth::user()->unit_id;
        // }

        $dropdownOpt = [
            '' => 'All',
            '0' => 'YIL HQ',
            '1' => 'Ordnance Factory Ambajhari',
            '2' => 'Ordnance Factory Ambarnath',
            '3' => 'Ordnance Factory Bhusawal',
            '4' => 'Ordnance Factory Dum Dum',
            '5' => 'Ordnance Factory Katni',
            '6' => 'Ordnance Factory Muradnagar',
            '7' => 'Metal And Steel Factory Ishapore',
            '8' => 'Grey Iron Foundry Jabalpur',

        ];

        // if unit is 0 then show YIL admin
        // otherwise show unit name
        return view('home')->with([
            'pendingCount'  => $pendingCount,
            'approveCount'  => $approveCount,
            'chart'         => $chart,
            'totalCount'    => $totalCount,
            'rejectCount'   => $rejectCount,
            'startDate'     => $startDate,
            'endDate'       => $endDate,
            // 'unitList'      => $unitList,
            // 'emailFilter'   => $createdBy,
            'dropdownOpt'   =>  $dropdownOpt
        ]);
    }
}
