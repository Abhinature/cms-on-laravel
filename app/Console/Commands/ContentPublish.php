<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
use App\Models\CmdMessage;

class ContentPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:content-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        
        $tableName = [
            'AwardAchievements'         => [
                'foreign_key'       =>'award_id',
                'approved_table'    => 'ApprovedAwardAchievement'
            ],
            'CmdMessage'                => [
                'foreign_key'       =>'message_id',
                'approved_table'    => 'ApprovedCmdMessage'
            ],
            'MediaRelease'              => [
                'foreign_key'       =>'media_release_id',
                'approved_table'    => 'ApprovedMediaRelease'
            ],
            'Milestone'                 => [
                'foreign_key'       =>'milestone_id',
                'approved_table'    => 'ApprovedMilestone'
            ],
            // 'UnitProduct'               => [
            //     'foreign_key'       =>'product_id',
            //     'approved_table'    => 'ApprovedProduct'
            // ],
            'UnitWebsite'               => [
                'foreign_key'       =>'website_id',
                'approved_table'    => 'ApprovedUnitWebsite'
            ],
            'UnitWebsiteContact'        => [
                'foreign_key'       =>'contact_id',
                'approved_table'    => 'ApprovedWebsiteContact'
            ],
            'Websitesliderimage'        => [
                'foreign_key'       =>'slider_image_id',
                'approved_table'    => 'ApprovedWebsiteSliderImage'
            ],
            'WhatsNew'                  => [
                'foreign_key'       =>'news_id',
                'approved_table'    => 'ApprovedWhatNew'
            ],
            'Whois'                     => [
                'foreign_key'       =>'who_id',
                'approved_table'    => 'ApprovedWhois'
            ],
        ];

        foreach($tableName as $table => $val) 
        {
            $entity = 'App\\Models\\' . $table;
            $data = $entity::whereStatus(1)->whereNotNull('publish_time')->where('publish_time', '>=', Carbon::now())->get();

            if( !empty($data) ) 
            {
                foreach($data as $innKey => $innVal) 
                {
                    $clone = $innVal->replicate();
                    $stdCollect = collect($clone->toArray());
                    $stdCollect->put($val['foreign_key'], $innVal->id);
                    $array = $stdCollect->toArray();
                    unset($array['live_table_id']);
                    unset($array['publish_time']);
                    unset($array['remarks']);
                    
                    if( $innVal->live_table_id == '0' || $innVal->live_table_id == null ) 
                    {
                        $approved_table = 'App\\Models\\' . $val['approved_table'];
                        $approved_table = new $approved_table;
                        $id = $approved_table::insertGetId($array);

                        $innVal::update(['live_table_id' => $id]);
                    }
                    else 
                    {
                        // update existing record
                        $approved_table = 'App\\Models\\' . $val['approved_table'];
                        $approved_table = new $approved_table;
                        $approved_table::where('id', $innVal->live_table_id)->update($array);
                    }
                }
            }
        }
        
    }
}
