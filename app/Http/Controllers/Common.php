<?php

namespace App\Http\Controllers;

use App\Models\AwardAchievements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Milestone;
use App\Models\MediaRelease;
use App\Models\WhatsNew;
use App\Models\Whois;
use App\Models\{
    ApprovedDownload,
    Rti,Download,
    ApprovedWhois,
    Unit,
    CmdMessage,
    Career,
    UnitWebsite,
    ApprovedUnitWebsite,
    UnitWebsiteContact,
    UnitProduct,
    UnitManufacturingFacility,
    WebsiteSliderImage,
    ApprovedProduct,
    QuickLink,
    RtiMandatoryDisclosure,
    ELibrary,
    ApprovedELibrary,
    ApprovedWebsiteContact,
    SupplyReport,
    Tender

};
use Illuminate\Support\Facades\DB;

class Common extends Controller
{
    public function submitforreview($id,$tab){
        
        $id =  Crypt::decrypt($id); 
        $tab =  Crypt::decrypt($tab);
        // dd($tab);
        if($tab =='slider_image'){
            WebsiteSliderImage::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }

        if($tab == 'unit_product'){
            // dd('hello');
            UnitProduct::find($id)->update(['status' => 3]);
            $msg = 'Content Submitted For Review';

        }

        if($tab =='milestone'){
            Milestone::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }

        if($tab =='media'){
            MediaRelease::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }
        if($tab =='new'){
            WhatsNew::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }
        
        if($tab =='whois'){
            Whois::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }

        if($tab =='award'){
            AwardAchievements::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }
        if($tab =='about'){
            UnitWebsite::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }
        if($tab =='contact'){
            UnitWebsiteContact::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }
        if($tab == 'manu_facility'){
            UnitManufacturingFacility::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }
        
        if($tab =='cmd_message'){
            CmdMessage::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }
        if($tab =='poirti'){
            Rti::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review';
        }
        if($tab == 'mandatory'){
            RtiMandatoryDisclosure::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review'; 
        }
        if($tab == 'download'){
            Download::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review'; 
        }
        if($tab == 'quick'){
            QuickLink::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review'; 
        }
        if($tab == 'career'){
            Career::find($id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review'; 
        }
        if($tab == 'library'){
            ELibrary::where('id',$id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review'; 
        }

        if($tab == 'tender'){
            Tender::where('id',$id)->update(['status'=>3]);
            $msg = 'Content Submitted For Review'; 
        }
            return redirect()->back()->with('msg',$msg);
            

    }

    public function getelibrarydata(){
       $data =  ApprovedELibrary::where('status','1')->get();
       return view('front.elib',['data'=>$data]);
    }

    public function deleteContent($id,$tab){
        
        // $id =  Crypt::decrypt($id); $tab =  Crypt::decrypt($tab);
        // dd($tab);
        if($tab =='slider_image'){
            WebsiteSliderImage::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }

        if($tab == 'unit_product'){
            // dd('hello');
            UnitProduct::where('id',$id)->update(['status' => 10]);
            $msg = 'Content Deleted';

        }

        if($tab =='milestone'){
            Milestone::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }

        if($tab =='media'){
            MediaRelease::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        if($tab =='new'){
            WhatsNew::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        
        if($tab =='whois'){
            Whois::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }

        if($tab =='award'){
            AwardAchievements::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        if($tab =='about'){
            UnitWebsite::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        if($tab =='contact'){
            UnitWebsiteContact::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        if($tab == 'manu_facility'){
            UnitManufacturingFacility::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        
        if($tab =='cmd_message'){
            CmdMessage::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        if($tab =='poirti'){
            Rti::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        if($tab == 'mandatory'){
            RtiMandatoryDisclosure::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'download'){
            Download::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'quick'){
            QuickLink::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'career'){
            Career::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'supply'){
            SupplyReport::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'library'){
            ELibrary::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'tender'){
            Tender::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
            return redirect()->back()->with('msg',$msg);
            

    }
    /******************sent request for deletion ***********/
    public function sentDeleteRequestForApprovalContent($id,$tab){
        
        $id =  Crypt::decrypt($id); $tab =  Crypt::decrypt($tab);
        // dd($tab);
        if($tab =='slider_image_for_delete'){
            WebsiteSliderImage::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Content Deleted';
        }

        if($tab == 'unit_product'){
            // dd('hello');
            UnitProduct::where('id',$id)->update(['status' => 10]);
            $msg = 'Content Deleted';

        }

        if($tab =='milestone_for_delete'){
            Milestone::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Deletion request has been sent';
        }

        if($tab =='media_release_for_delete'){
            MediaRelease::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Deletion request has been sent';
        }
        if($tab =='new_request_for_delete'){
            WhatsNew::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Content Deleted';
        }
        
        if($tab =='whois_for_delete'){
            Whois::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Deletion request has been sent';
        }

        if($tab =='award_request_for_delete'){
            AwardAchievements::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Content Deleted';
        }
        if($tab =='about'){
            UnitWebsite::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Deletion request has been sent';
        }
        if($tab =='contact_for_delete'){
            UnitWebsiteContact::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Deletion request has been sent';
        }
        if($tab == 'manu_facility'){
            UnitManufacturingFacility::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        
        if($tab =='cmd_message_for_delete'){
            CmdMessage::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Deletion request has been sent';
        }
        if($tab =='poirti'){
            Rti::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted';
        }
        if($tab == 'mandatory'){
            RtiMandatoryDisclosure::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'download_request_for_delete'){
            Download::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Deletion request has been sent'; 
        }
        if($tab == 'quick'){
            QuickLink::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'career'){
            Career::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'library'){
            ELibrary::where('id',$id)->update(['status'=>10]);
            $msg = 'Content Deleted'; 
        }
        if($tab == 'tender_for_delete'){
            Tender::where('id',$id)->update(['status'=>11 , 'type'=>2]);
            $msg = 'Deletion request has been sent'; 
        }
            return redirect()->back()->with('msg',$msg);
            

    }
    /*****************************end srfd *****************/
    // public function DeleteRequestForApprovalContent($tab,$id){
       
    //     if($tab =='slider_image'){
    //         WebsiteSliderImage::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }

    //     if($tab == 'unit_product'){
    //         // dd('hello');
    //         UnitProduct::where('id',$id)->update(['status' => 12]);
    //         $msg = 'Content Deleted';

    //     }

    //     if($tab =='milestone'){
    //         Milestone::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }

    //     if($tab =='media'){
    //         MediaRelease::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }
    //     if($tab =='new'){
    //         WhatsNew::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }
        
    //     if($tab =='whois'){
    //         Whois::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }

    //     if($tab =='award'){
    //         AwardAchievements::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }
    //     if($tab =='about'){
    //         UnitWebsite::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }
    //     if($tab =='contact'){
    //         UnitWebsiteContact::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }
    //     if($tab == 'manu_facility'){
    //         UnitManufacturingFacility::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }
        
    //     if($tab =='cmd_message'){
    //         CmdMessage::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }
    //     if($tab =='poirti'){
    //         Rti::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted';
    //     }
    //     if($tab == 'mandatory'){
    //         RtiMandatoryDisclosure::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted'; 
    //     }
    //     if($tab == 'download'){
    //         Download::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Requested For Deletion is Submited'; 
    //     }
    //     if($tab == 'quick'){
    //         QuickLink::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted'; 
    //     }
    //     if($tab == 'career'){
    //         Career::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted'; 
    //     }
    //     if($tab == 'library'){
    //         ELibrary::where('id',$id)->update(['status'=>12]);
    //         $msg = 'Content Deleted'; 
    //     }
    //         return redirect()->back()->with('msg',$msg);
            
    // }

    public function productionpage(){
        $check = Unit::select('units.en_unit_name','units.hi_unit_name','units.unit_logo','units.id','unit_websites.website_logo')->leftjoin('unit_websites','units.id','=','unit_websites.unit_id')->where('units.status','1')->get();
        return view('productionpage')->with(['production_units'=>$check]);
        
    }

    public function getwhoiswho(){
        $check = ApprovedWhois::where('status','1')->get();
        return view('whois')->with(['data' => $check]);
    }

    public function getyilproducts(){
        $units  = Unit::all();
        $check = ApprovedProduct::all();
        return view('yil-product')->with(['data' => $check,'unit'=>$units]);
    }

    public function getaboutyil($id = 0){        
        $unit = ApprovedUnitWebsite::where('unit_id','0')->orderby('id','DESC')->first();
        return view('front.about')->with(['about'=>$unit]);
    }

    public function aboutpreview($id,$unit_id){
        $id =  Crypt::decrypt($id); $unit_id =  Crypt::decrypt($unit_id);
        $unit = UnitWebsite::where('unit_id',$unit_id)->where('id',$id)->orderby('id','DESC')->first();
        // dd($unit);
        return view('front.about')->with(['about'=>$unit]);
    }

    public function getvigilance(){
        $check = ApprovedWhois::where('status','1')->get();
        // dd($check);
        return view('front.vigilance')->with(['data' => $check]);
    }

    public function getiem(){
        $check = ApprovedWhois::where('status','1')->where('category','IEM')->get();
        return view('whois')->with(['data' => $check]);

    }

    public function getdirectory(){
        $check = ApprovedWhois::where('status','1')->where('category','Directory')->get();
        return view('whois')->with(['data' => $check]);
    }

    public function getdownload(){
        $check = ApprovedDownload::where('status','1')->get();
        return view('front.download')->with(['data' => $check]);
    }

    public static function getunitproductbyid($id){
        $check = ApprovedProduct::where('unit_id',$id)->get();
        $count = $check->count();
        $data['count'] = $count;
        $data['unitproduct'] = $check;
        return $data;
    }

    public function getproductionunitproduct($id){
        $id = Crypt::decrypt($id);
        $unit_item = Unit::where('id', $id)->first();
        $website_contact = DB::table('approved_website_contact')->where('status', '1')->where('unit_id', $id)->orderby('id','DESC')->first();     
        $products = ApprovedProduct::where('unit_id',$id)->get();

        return view('front.productionunitproducts',['unit_item' => $unit_item,'products'=>$products,'footer_content'=>$website_contact,'id'=>$id]);

    }
    public function getproductionunitmanufacturing($id){
        $id = Crypt::decrypt($id);
        $unit_item = Unit::where('id', $id)->first();
        $website_contact = DB::table('approved_website_contact')->where('status', '1')->where('unit_id', $id)->orderby('id','DESC')->first();     
        $products = UnitManufacturingFacility::where('unit_id',$id)->get();

        return view('front.productionunitmanufacturing',['unit_item' => $unit_item,'products'=>$products,'footer_content'=>$website_contact,'id'=>$id]);

    }

    public function getproductionunitcontact($id){
        $id = Crypt::decrypt($id);
        $unit_item = Unit::where('id', $id)->first();
        $website_contact = DB::table('approved_website_contact')->where('status', '1')->where('unit_id', $id)->orderby('id','DESC')->first();     
        $products = UnitManufacturingFacility::where('unit_id',$id)->get();

        return view('front.productionunitcontact',['unit_item' => $unit_item,'products'=>$products,'footer_content'=>$website_contact,'id'=>$id]);
    }


}
