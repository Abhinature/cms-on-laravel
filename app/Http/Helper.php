<?php
use Illuminate\Support\Facades\Session;
use App\Models\{
    User,
    ApprovedUnitWebsite,
    ApprovedQuickLink,
    PasswordHistory,
    TblIPBlocklist,
    Unit,
    FinancialYear,
    Page
};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use OwenIt\Auditing\Models\Audit;

if (!function_exists('displayAlert')) {
    function displayAlert()
    {
        if (Session::has('message')) {
            // Here type represnt the class of alert
            list($type, $message) = explode('|', Session::get('message'));
            return sprintf('<div class="text-white alert alert-%s">%s</div>', $type, $message);
        }

        return '';
    }
}

if(!function_exists('getlastauditentrytime')){
    function getlastauditentrytime(){
        $data =  Audit::Orderby('id','DESC')->first();
        return $data->updated_at;
    }
}

if(!function_exists('uniqueipscount')){
    function uniqueipscount(){
     $data =   DB::table('tbl_ips')->select('ip')->DISTINCT('ip')->count();
        return $data;
    }
}
if (!function_exists('footerLinks')) {
    function footerLinks()
    {
      return ApprovedQuickLink::where('status',1)->get();
    }
}

if (!function_exists('getUnitName')) {
    function getUnitName($id)
    {
      return Unit::where('id',$id)->first();
    }
}

if(!function_exists('getUnitLogo')){
    function getUnitLogo($id){
       $logo =  ApprovedUnitWebsite::select('website_logo')->where('unit_id',$id)->orderby('id','DESC')->first();
       return $logo->website_logo;
    }
}

if (!function_exists('getFinancialYearById')) {
    function getFinancialYearById($id)
    {
      return FinancialYear::where('id',$id)->first();
    }
}

if (!function_exists('printOldOrDbValue')) {
    function printOldOrDbValue($key, $data = null)
    {

        $value = '';

        if (!empty($key)) {
            if (!empty(old($key))) {
                // Return Old Value
                $value = old($key);
            } elseif (!empty($data)) {
                // Return Value from db
                if (is_object($data)) {
                    $value = $data->$key;
                } elseif (is_array($data)) {
                    $value = $data[$key];
                }
            }
            return $value;
        }
        return $value;
    }
}

if (!function_exists('fetchingSingleValue')) {
    function fetchingSingleValue($tableName, $columnName, $colVal, $fetchCol)
    {
        $data = \DB::table($tableName)->where($columnName, $colVal)->select($fetchCol)->first();
        if (empty($data))
            return '';
        return $data->$fetchCol;
    }
}

if( !function_exists('userPasswordAlreadyUsed') ) {
    function userPasswordAlreadyUsed($userId, $password) {
        return PasswordHistory::where(['user_id' => $userId, 'password' => $password])->count();
    }
}

if(!function_exists('lockAccount')) {
    function lockAccount($ip) {
        TblIPBlocklist::create(['fld_ip'=>$ip]);
    }
}

if( !function_exists('dateTimeFormat') ) {
    function dateTimeFormat($dateTime = null) {
        return Carbon::parse($dateTime)->toDateTimeString() ?? '';
    }
}

if( !function_exists('sendMail') ) {
    function sendMail($to = null, $subject = null, $message = null) {
         $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $headers .= "From: noreply@gov.in"."\r\n";
        ini_set('smtp_port', '25');
        $result = mail($to, $subject, $message, $headers);
        if(!$result){
            return false;
        }
        return true;
    }
}

if( !function_exists('tableNameToReadableName') ) {
    function tableNameToReadableName($table_name) {
        return match($table_name) {
            'award_achievements'    => 'Award Achievement',
            'cmd_messages'          => 'CMD Message',
            'media_releases'        => 'Media Release',
            'milestones'            => 'Milestone',
            'unit_websites'         => 'Unit Website',
            'unit_website_contact'  => 'Unit Website Contract',
            'website_slider_images' => 'Website Slider Images',
            'whats_news'            => 'Whats News',
            'whois'                 => 'Who Is',
            default                 => ''
        };
    }
}

if( !function_exists('fetchDynamicPages') ) {
    function fetchDynamicPages() {
        return Page::whereStatus(1)->get();
    }
}