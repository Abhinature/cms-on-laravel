<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\Otp;
use App\Models\Milestone;
use App\Models\MediaRelease;
use App\Models\WhatsNew;
use App\Models\AwardAchievements;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Rti,
    Download,
    Unit,
    CmdMessage,
    Career,
    UnitWebsite,
    ApprovedWebsiteSliderImage,
    WebsiteSliderImage,
    ApprovedMediaRelease,
    ApprovedWhatNew,
    ApprovedAwardAchievement,
    ApprovedMilestone,
    UnitWebsiteContact,
    UnitProduct,
    UnitManufacturingFacility,
    ApprovedProduct,
    QuickLink,
    RtiMandatoryDisclosure,
    ELibrary,
    ApprovedUnitWebsite,
    ApprovedWhois,
    Tender,
    ApprovedTender
};
use App\Models\Whois;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;

class UnitWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($tableName = null)
    {
        $active = (!empty($tableName))  ? $tableName = Crypt::decrypt($tableName) : '';

        $contactdetails     = UnitWebsiteContact::where('unit_id', Auth::user()->unit_id)->get();


        if (Auth::user()->user_type == '9') {
            $slider_images_all  = WebsiteSliderImage::whereNotIN('status', ['10','0'])->where('unit_id', Auth::user()->unit_id)->latest('id')->get();
            $slider_count = $slider_images_all->count();
            $websitedata   = UnitWebsite::Select()->where('unit_id', Auth::user()->unit_id)->whereNotIN('status', ['0', '10'])->latest('id')->get();
            $website_products = UnitProduct::where('unit_id', Auth::user()->unit_id)->whereNotIN('status', ['0', '10'])->latest('id')->get();
            $product_count      = $website_products->count();
            $website_manufacturing_facility = UnitManufacturingFacility::where('unit_id', Auth::user()->unit_id)->whereNotIN('status', ['0', '10'])->latest('id')->get();
            $facility_count     = $website_manufacturing_facility->count();
            $cmd_msg = CmdMessage::whereNotIN('status', ['10','0'])->latest('id')->get();
        } else {
            $slider_images_all  = WebsiteSliderImage::whereNotIN('status', ['10'])->where('unit_id', Auth::user()->unit_id)->latest('id')->get();
            $slider_count = $slider_images_all->count();
            $websitedata   = UnitWebsite::Select()->whereNotIN('status', ['10'])->where('unit_id', Auth::user()->unit_id)->latest('id')->get();
            $website_products = UnitProduct::whereNotIN('status', ['10'])->where('unit_id', Auth::user()->unit_id)->latest('id')->get();
            $product_count      = $website_products->count();
            $website_manufacturing_facility = UnitManufacturingFacility::whereNotIN('status', ['10'])->where('unit_id', Auth::user()->unit_id)->latest('id')->get();
            $facility_count     = $website_manufacturing_facility->count();
            $cmd_msg = CmdMessage::where('status', '!=', '10')->latest('id')->get();
        }


        if (Auth::user()->unit_id == '0') {
            $milestone =      Milestone::whereNotIN('status', ['10'])->latest('id')->get();
            $website_products = ApprovedProduct::whereNotIN('status', ['10'])->latest('id')->get();
            if (Auth::user()->user_type == '9') {
                $website_media =  MediaRelease::whereNotIN('status', ['0', '10'])->latest('id')->get();
                $website_new =    WhatsNew::whereNotIN('status', ['0', '10', '12'])->latest('id')->get();
                $website_awards = AwardAchievements::whereNotIN('status', ['0', '10'])->latest('id')->get();
                $website_whois =  Whois::whereNotIN('status', ['0', '10'])->latest('id')->get();
            } else {
                $website_media =  MediaRelease::whereNotIN('status', ['10'])->latest('id')->get();
                $website_new =    WhatsNew::whereNotIN('status', ['10'])->latest('id')->get();
                // dd($website_new);
                $website_awards = AwardAchievements::whereNotIN('status', ['10'])->get();
                $website_whois =  Whois::whereNotIN('status', ['10'])->latest('id')->get();
            }
            // dd('hello');
            $product_count = $website_products->count();
            return  view('unit-website.homepage')->with([
                'websitedata' => $websitedata,
                'contactdetails' => $contactdetails,
                'website_products' => $website_products,
                'product_count' => $product_count,
                'website_manufacturing_facility' => $website_manufacturing_facility,
                'facility_count' => $facility_count,
                'website_milestone' => $milestone,
                'website_media' => $website_media,
                'website_new' => $website_new,
                'website_award' => $website_awards,
                'website_whois' => $website_whois,
                'slider_images_all' => $slider_images_all,
                'slider_count' => $slider_count,
                'active' => $active,
                'data' => $cmd_msg
            ]);
        } else {

            return  view('unit-website.websitepage')->with([
                'websitedata' => $websitedata,
                'contactdetails' => $contactdetails,
                'website_products' => $website_products,
                'product_count' => $product_count,
                'website_manufacturing_facility' => $website_manufacturing_facility,
                'facility_count' => $facility_count,
                'slider_images_all' => $slider_images_all,
                'slider_count' => $slider_count,
                'active' => $active
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function reviewunitproduct(Request $request)
    {
        $id = Auth::user()->unit_id;
        $website_product = DB::table('unit_products')->where('unit_id', $id)->get();
        return view('unit-website.review-product')->with(['products' => $website_product]);
    }

    public function reviewunitmanufacturing(Request $request)
    {
        $id = Auth::user()->unit_id;
        $website_product = DB::table('unit_manufacturing_facility')->where('unit_id', $id)->get();
        return view('unit-website.review-manufacturing')->with(['manufacturing' => $website_product]);
    }

    public function approveunitproduct(Request $request, $id)
    {
        $data = DB::table('unit_products')->where('id', $id)->first();
        $approvdata = DB::table('approved_products')->where('product_id', $id)->first();
        if (!empty($approvdata)) {
            DB::table('approved_products')->where('product_id', $id)->update([
                'product_name' => $data->product_name,
                'product_image' => $data->product_image,
                'unit_id' => $data->unit_id,
                'approved_by' => Auth::user()->id,
                'product_specification' => $data->product_specification
            ]);
        } else {
            DB::table('approved_products')->insertGetId([
                'product_id' => $id,
                'product_name' => $data->product_name,
                'product_image' => $data->product_image,
                'unit_id' => $data->unit_id,
                'approved_by' => Auth::user()->id,
                'product_specification' => $data->product_specification
            ]);
        }
        return redirect()->back()->with(['msg' => 'Product Approved Successfully!!']);
    }

    public function approveunitslideimage(Request $request)
    {
        DB::table('approved_products')->where('id', $request->id)->update([
            'show_in_slider' => $request->val
        ]);
        // dd($request->all());
        echo 'Product Updated for Slider';
    }

    

    public function reviewunitwebsite(Request $request)
    {
        $id = Auth::user()->unit_id;
        $contactdetails = DB::table('unit_website_contact')->where('unit_id', $id)->first();
        $websitedata = UnitWebsite::Select()->where('unit_id', $id)->first();
        $website_products = DB::table('unit_products')->where('unit_id', $id)->get();
        $product_count = $website_products->count();
        $website_manufacturing_facility = DB::table('unit_manufacturing_facility')->where('unit_id', $id)->get();
        $facility_count = $website_manufacturing_facility->count();
        $slider_images_all = DB::table('website_slider_images')->where('is_deleted', '0')->where('unit_id', $id)->get();
        $slider_count = $slider_images_all->count();
        return view('unit-website.review_unit_website')->with([
            'websitedata' => $websitedata,
            'contactdetails' => $contactdetails,
            'website_products' => $website_products,
            'product_count' => $product_count,
            'website_manufacturing_facility' => $website_manufacturing_facility,
            'facility_count' => $facility_count,
            'slider_images_all' => $slider_images_all,
            'slider_count' => $slider_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $web_logo = '';
        $data = UnitWebsite::where('unit_id', Auth::user()->unit_id)->first();


        if ($request->hasFile('website_logo')) {
            $imageName = time() . '.' . $request->website_logo->extension();
            $imgname =  $request->website_logo->getClientOriginalName();
            $dotcount = substr_count($imgname, ".");
            if ($dotcount == '1') {
                $request->website_logo->move('upload/websitelogo', $imageName);
                $web_logo = 'upload/websitelogo/' . $imageName;
            } else {
                Session::flash('message', 'danger|File Name Must Contain Only One "."');
                // $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                return redirect()->back();
            }
        } else {
            $web_logo = '';
        }
        // UnitWebsite::where('unit_id', Auth::user()->unit_id)->update([
        //     'website_title' => $request->input('website_title'),
        //     'website_sub_title' => $request->input('website_sub_title'),
        //     'website_logo' => $web_logo,
        //     'about_description' => $request->input('about_description')

        // ]);

        $unit = new UnitWebsite;
        $unit->unit_id = Auth::user()->unit_id;
        $unit->website_en_title = $request->input('en_title');
        $unit->website_hi_title = $request->input('hi_title');
        $unit->website_en_sub_title = $request->input('en_sub_title');
        $unit->website_hi_sub_title = $request->input('hi_sub_title');
        $unit->website_logo = $web_logo;
        $unit->about_en_description = $request->input('en_about_description');
        $unit->about_hi_description = $request->input('hi_about_description');
        $unit->created_by = Auth::user()->id;
        $unit->save();
        Session::flash('message', 'Success|Data Inserted Successfully');
        return redirect()->back();
    }

    public function saveunitproduct(Request $request)
    {
        $chck = DB::table('unit_products')->where('unit_id', Auth::user()->unit_id)->where('product_name', $request->input('product_name'))->first();
        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Product Already Exist!!']);
        } else {
            $web_logo = '';
            if ($request->hasFile('product_image')) {
                $imageName = time() . '.' . $request->product_image->extension();
                $imgname =  $request->product_image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->product_image->move('upload/products', $imageName);
                    $web_logo = 'upload/products/' . $imageName;
                } else {
                    $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            }



            DB::table('unit_products')->insertGetid([
                'product_name' => $request->input('product_name'),
                'product_image' => $web_logo,
                'product_specification' => $request->product_specification,
                'unit_id' => Auth::user()->unit_id,
                'created_by' => Auth::user()->id

            ]);
        }
        return redirect()->back()->with(['msg' => 'Product Added Successfully', 'active' => 'product']);
    }


    public function savesliderimage(Request $request)
    {
        
        if ($request->hasFile('slider_image')) {
            
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $files = $request->file('slider_image');
            foreach ($files as $file) {
                $filename = '';
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);

                if ($check) {

                    $dotcount = substr_count($filename, ".");
                    
                    if ($dotcount == '1') {
                        $file->move('upload/slider_image', $filename);
                        $web_logo = 'upload/slider_image/' . $filename;
                        WebsiteSliderImage::create([
                            'sequence' => $request->sequence,
                            'unit_id' => Auth::user()->unit_id,
                            'created_by' => Auth::user()->id,
                            'slider_image' => $web_logo
                        ]);
                        $msg =  "Upload Successfully";
                    } else {
                        return  redirect()->back()->with(['msg' => 'Only one (.) Should be there in file name.']);
                    }
                } else {
                    $msg = '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                }
            }
            return redirect()->back()->with(['msg' => $msg, 'active' => 'slider']);
        }
    }

    public function deletesliderimage($id)
    {

        DB::table('website_slider_images')->where('id', $id)->update(['is_deleted' => '1']);
        return redirect()->back()->with(['msg' => 'Image Deleted Successfully', 'active' => 'slider']);
    }

    public function previewsliderimage()
    {
        // dd($id);
        $cmd = DB::table('approved_cmd_messages')->orderby('id', 'DESC')->first();
        $product = ApprovedProduct::where('show_in_slider', 1)->limit('10')->latest()->get();
        // $sliderImage = ApprovedWebsiteSliderImage::whereStatus(3)->where('unit_id','0')->orderBy('sequence', 'ASC')->get();
        $sliderImage = ApprovedWebsiteSliderImage::whereStatus(1)->where('unit_id', '0')->orderBy('sequence', 'ASC')->get();

        $j = json_encode($sliderImage);
        $d = json_decode($j);

        $sliderImagecreated = WebsiteSliderImage::where('unit_id', '0')->orderBy('id', 'DESC')->get();

        $j1 = json_encode($sliderImagecreated);
        $d1 = json_decode($j1);

        $sliderImagePreview = array_merge($d, $d1);

        $mediaRealse = ApprovedMediaRelease::whereStatus(1)->limit(5)->get();
        // dd($mediaRealse);
        $whatnew = ApprovedWhatNew::whereStatus(1)->limit(10)->get();
        $award_achievement = ApprovedAwardAchievement::whereStatus(1)->limit(10)->get();
        $milestone = ApprovedMilestone::whereStatus(1)->limit(10)->get();

        return view('unit-website.slider-preview')->with(['cmd' => $cmd, 'product' => $product, 'sliderImagePreview' => $sliderImagePreview, 'mediaRealse' => $mediaRealse, 'whatnew' => $whatnew, 'award_achievement' => $award_achievement, 'milestone' => $milestone]);
        // dd($id);
    }

    public function editunitproduct($id)
    {
        $dataaa = DB::table('unit_products')->where('id', $id)->first();

        if (!empty($dataaa)) {
            $data =  '<div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" enctype="multipart/form-data" action="' . route('update-unit-product') . '">

                   <div class="modal-body">

                      <div class="form-group">
                        <label>Name</label>
                        <input type="hidden" name="_token" value="' . csrf_token() . '" />
                        <input type="hidden" name="pro_hid" value="' . $dataaa->id . '"/>
                        <input type="text" value="' . $dataaa->product_name . '" class="form-control" name="edit_product_name" />
                      </div>
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="pro_image" />
                        <input type="hidden"  value="' . $dataaa->product_image . '" name="update_product_image"/>
                      </div>
                      <div class="form-group">
                        <label>Specification</label>
                        <textarea class="form-control" name="edit_product_specification">' . $dataaa->product_specification . '</textarea>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>';
            return $data;
        }
        // return $data;
    }


    public function editunitmanufacturing($id)
    {
        $dataaa = DB::table('unit_manufacturing_facility')->where('id', $id)->first();

        if (!empty($dataaa)) {
            $data =  '<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Manufacturing Facility</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" enctype="multipart/form-data" action="' . route('update-unit-manufacturing') . '">
              
               <div class="modal-body">
        
                  <div class="form-group">
                    <label>Title</label>
                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                    <input type="hidden" name="manu_hid" value="' . $dataaa->id . '"/>
                    <input type="text" value="' . $dataaa->title . '" class="form-control" name="title" />
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="manu_image" />
                    <input type="hidden"  value="' . $dataaa->image . '" name="update_manu_image"/>
                  </div>
                  <div class="form-group">
                    <label>Specification</label>
                    <textarea class="form-control" name="edit_manu_description">' . $dataaa->description . '</textarea>
                  </div>
        
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>';
        }
        return $data;
    }

    public function editmilestone($id)
    {
        $dataaa = Milestone::where('id', $id)->first();
        
        if (!empty($dataaa)) {

            $html = view('backend_component.edit-milestone')->with(['dataaa' => $dataaa])->render();
            return response()->json([
                'status'=> 200,
                'html' => $html
            ]);
        
        }

        return response()->json([
            'status'=> 200,
            'html' => ''
        ]);
    }


    public function editunitabout($id)
    {
        $dataaa = UnitWebsite::where('id', $id)->first();
       
        if (!empty($dataaa)) {

            $html = view('backend_component.edit-about')->with(['dataaa' => $dataaa])->render();
            return response()->json([
                'status'=> 200,
                'html' => $html
            ]);
        
        }

        return response()->json([
            'status'=> 200,
            'html' => ''
        ]);
        
    }

    public function editunitcontact($id)
    {
        $dataaa = UnitWebsiteContact::where('id', $id)->first();
        
        if (!empty($dataaa)) {
         
            $html = view('backend_component.edit-contact')->with(['dataaa' => $dataaa])->render();
            return response()->json([
                'status'=> 200,
                'html' => $html
            ]);
        
        }

        return response()->json([
            'status'=> 200,
            'html' => ''
        ]);
        
    }

    public function editpoirti($id)
    {
        $dataaa = Rti::where('id', $id)->first();
        if (!empty($dataaa)) {
            $data =  '<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update POIs </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" enctype="multipart/form-data" action="' . route('update-rti-poi') . '">
              
               <div class="modal-body">
        
                  <div class="form-group">
                    <label>Designation</label>
                    
                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                    <input type="hidden" name="poi_hid" value="' . $dataaa->id . '"/>
                    <input type="text" value="' . $dataaa->designation . '" class="form-control" name="designation" />
                  </div>
                  <div class="form-group">
                  <label>Officer Name</label>
                  <input type="text" value="' . $dataaa->name_of_officer . '" class="form-control" name="name_of_officer" />
                </div>     
                <div class="form-group">
                  <label>Responsibility Assigned</label>
                  <input type="text" value="' . $dataaa->responsibility_assigned . '" class="form-control" name="responsibility_assigned" />
                </div>
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="text" value="' . $dataaa->email_address . '" class="form-control" name="email_address" />
                </div>     
                <div class="form-group">
                <label>Phone No.</label>
                <input type="text" value="' . $dataaa->phone_no . '" class="form-control" name="phone_no" />
              </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>';
            return $data;
        }
    }

    public function editmandatory($id)
    {
        $dataaa = RtiMandatoryDisclosure::where('id', $id)->first();
        if (!empty($dataaa)) {
            $data =  '<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Mandatory Disclosure </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" enctype="multipart/form-data" action="' . route('update-mandatory') . '">
              
               <div class="modal-body">
        
                  <div class="form-group">
                    <label>Title (English)</label>
                    
                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                    <input type="hidden" name="mandatory_hid" value="' . $dataaa->id . '"/>
                    <input type="text" value="' . $dataaa->en_title . '" class="form-control" name="en_title" />
                  </div>
                  <div class="form-group">
                  <label>Title (Hindi)</label>
                  <input type="text" value="' . $dataaa->hi_title . '" class="form-control" name="hi_title" />
                </div>     
                <div class="form-group">
                  <label>Disclosure</label>
                  <input type="file" name="disclosure" class="form-control"/>
                  <input type="hidden" value="' . $dataaa->attachment . '" class="form-control" name="update_attachment" />
                </div>              
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>';
            return $data;
        }
    }



    public function editsliderimage($id)
    {
        $dataaa = WebsiteSliderImage::find($id);      
        $del = '';
        
        if(!empty($dataaa)){
            
            $html = view('backend_component.edit-sliderimage')->with(['dataaa' => $dataaa])->render();
            return response()->json([
                'status'=> 200,
                'html' => $html
            ]);
        }
        return response()->json([
            'status'=> 200,
            'html' => ''
        ]);

    }

    public function editwho($id)
    {
        $dataaa = DB::table('whois')->where('id', $id)->first();
        if (!empty($dataaa)) {
            $html = view('backend_component.edit-whos')->with(['dataaa' => $dataaa])->render();
            return response()->json([
                'status'=> 200,
                'html' => $html
            ]);
        
        }
        return response()->json([
            'status'=> 200,
            'html' => ''
        ]);
           
        
    }
    public function updatesliderimage(Request $request)
    {
        
        if ($request->hasFile('slide_image')) {
            $imageName = time() . '.' . $request->slide_image->extension();
            $imgname =  $request->slide_image->getClientOriginalName();
            $dotcount = substr_count($imgname, ".");
            if ($dotcount == '1') {
                $request->slide_image->move('upload/slider_image', $imageName);
                $web_logo = 'upload/slider_image/' . $imageName;
            } else {
                $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                return redirect()->back();
            }
        } else {
            $web_logo = $request->input('update_slide_image');
        }
       
       
        $live_data = WebsiteSliderImage::where('id', $request->input('slide_hid'))->first();
        if ($live_data->live_table_id == '0' || ($live_data->status != '1')) {
       
            WebsiteSliderImage::find($request->input('slide_hid'))
                ->update([
                    'sequence' => $request->input('sequence'),
                    'slider_image' => $web_logo,
                    'status' => 0
                ]);
        } else {
            WebsiteSliderImage::create([
                'unit_id' => $live_data->unit_id,
                'created_by' => $live_data->created_by,
                'live_table_id' => $live_data->live_table_id,
                'type'  => 1,
                'sequence' => $request->input('sequence'),
                'slider_image' => $web_logo
            ]);
        }
    
        return redirect()->back()->with(['msg' => 'Data Updated Successfully', 'active' => 'slider']);
    }

    public function updateunitabout(Request $request)
    {
        $web_logo = '';
        if ($request->hasFile('website_logo')) {
            $imageName = time() . '.' . $request->website_logo->extension();
            $imgname =  $request->website_logo->getClientOriginalName();
            $dotcount = substr_count($imgname, ".");
            if ($dotcount == '1') {
                $request->website_logo->move('upload/websitelogo', $imageName);
                $web_logo = 'upload/websitelogo/' . $imageName;
            } else {
                Session::flash('message', 'danger|File Name Must Contain Only One "."');
                // $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                return redirect()->back();
            }
        } else {
            $web_logo = '';
            $web_logo = $request->input('update_website_logo');
        }
        $live_data = UnitWebsite::find(($request->about_hid));
        if ($live_data->live_table_id == 0 || ($live_data->status != '1')) {
            UnitWebsite::find(($request->about_hid))->update([
                'website_en_title' => $request->input('en_edit_title'),
                'website_hi_title' => $request->input('hi_edit_title'),
                'website_en_sub_title' => $request->input('web_en_subtitle'),
                'website_hi_sub_title' => $request->input('web_hi_subtitle'),
                'website_logo' => $web_logo,
                'about_en_description' => $request->input('edit_en_about_description'),
                'about_hi_description' => $request->input('edit_hi_about_description')

            ]);
        } else {
            $unit = new UnitWebsite;
            $unit->unit_id = Auth::user()->unit_id;
            $unit->website_en_title = $request->input('en_edit_title');
            $unit->website_hi_title = $request->input('hi_edit_title');
            $unit->website_en_sub_title = $request->input('web_en_subtitle');
            $unit->website_hi_sub_title = $request->input('web_hi_subtitle');
            $unit->website_logo = $web_logo;
            $unit->live_table_id = $live_data->live_table_id;
            $unit->type = '1';
            $unit->about_en_description = $request->input('edit_en_about_description');
            $unit->about_hi_description = $request->input('edit_hi_about_description');
            $unit->created_by = Auth::user()->id;
            $unit->save();
        }

        Session::flash('message', 'Success|Data Inserted Successfuly');
        return redirect()->back();
    }

    public function updateunitcontact(Request $request)
    {
        // dd($request->all());
        $live_data = UnitWebsiteContact::find($request->contact_hid);
        if ($live_data->live_table_id == 0 || ($live_data->status != '1')) {
            UnitWebsiteContact::find($request->contact_hid)->update([
                'en_address' => $request->input('en_editaddress'),
                'hi_address' => $request->input('hi_editaddress'),
                'cin_no' => $request->input('cin_no'),
                'phone_no' => $request->input('phone_no'),
                'email_id' => $request->input('email_id'),
                'map_link' => $request->input('map_link'),
                'fax_no' => $request->input('fax_no')

            ]);
        } else {
            $unit = new UnitWebsiteContact;
            $unit->unit_id = Auth::user()->unit_id;
            $unit->en_address = $request->input('en_editaddress');
            $unit->hi_address = $request->input('hi_editaddress');
            $unit->cin_no = $request->input('cin_no');
            $unit->phone_no = $request->input('phone_no');
            $unit->email_id = $request->input('email_id');
            $unit->map_link = $request->input('map_link');
            $unit->fax_no = $request->input('fax_no');
            $unit->live_table_id = $live_data->live_table_id;
            if($request->request_for == '1'){
                $unit->type = '1'; 
                }
            $unit->created_by = Auth::user()->id;
            $unit->save();
        }
        Session::flash('message', 'Success|Data Inserted Successfuly');
        return redirect()->back();
    }

    public function updateunitproduct(Request $request)
    {
        $check = DB::table('unit_products')->where('id', '!=', $request->input('pro_hid'))->where('product_name', $request->input('product_name'))->first();
        if (!empty($check)) {
            return redirect()->back()->with(['msg' => 'Already Exist!!']);
        } else {
            $web_logo = '';
            if ($request->hasFile('pro_image')) {
                $imageName = time() . '.' . $request->pro_image->extension();
                $imgname =  $request->pro_image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->pro_image->move('upload/products', $imageName);
                    $web_logo = 'upload/products/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $web_logo = $request->input('update_product_image');
            }
            $live_data = WebsiteSliderImage::where('id', $request->input('slide_hid'))->first();
            if ($live_data->live_table_id == '0') {
                DB::table('unit_products')->where('id', $request->input('pro_hid'))->update([
                    'product_name' => $request->input('edit_product_name'),
                    'product_specification' => $request->input('edit_product_specification'),
                    'product_image' => $web_logo
                ]);
            } else {
                DB::table('unit_products')->insertGetid([
                    'product_name' => $request->input('edit_product_name'),
                    'product_image' => $web_logo,
                    'product_specification' => $request->product_specification,
                    'unit_id' => Auth::user()->unit_id,
                    'created_by' => Auth::user()->id

                ]);
            }
        }
        return redirect()->back()->with(['msg' => 'Product Updated Successfully', 'active' => 'product']);
    }



    public function updateunitmanufacturing(Request $request)
    {
        $check = DB::table('unit_manufacturing_facility')->where('id', '!=', $request->input('manu_hid'))->where('title', $request->input('title'))->first();
        if (!empty($check)) {
            return redirect()->back()->with(['msg' => 'Already Exist!!']);
        } else {
            $web_logo = '';
            if ($request->hasFile('manu_image')) {
                $imageName = time() . '.' . $request->manu_image->extension();
                $imgname =  $request->manu_image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->manu_image->move('upload/manufacturing', $imageName);
                    $web_logo = 'upload/manufacturing/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $web_logo = $request->input('update_manu_image');
            }
            DB::table('unit_manufacturing_facility')->where('id', $request->input('manu_hid'))->update([
                'title' => $request->input('title'),
                'description' => $request->input('edit_manu_description'),
                'image' =>  $web_logo
            ]);
        }
        return redirect()->back()->with(['msg' => 'Product Updated Successfully', 'active' => 'manu']);
    }



    public function saveunitmanufacturingfacility(Request $request)
    {
        $chck = DB::table('unit_manufacturing_facility')->where('unit_id', Auth::user()->unit_id)->where('title', $request->input('manu_title'))->first();
        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Product Already Exist!!']);
        } else {
            $web_logo = '';
            if ($request->hasFile('manu_image')) {
                $imageName = time() . '.' . $request->manu_image->extension();
                $imgname =  $request->manu_image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->manu_image->move('upload/manufacturing', $imageName);
                    $web_logo = 'upload/manufacturing/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            }

            DB::table('unit_manufacturing_facility')->insertGetid([
                'title' => $request->input('manu_title'),
                'image' => $web_logo,
                'description' => $request->input('manu_description'),
                'unit_id' => Auth::user()->unit_id,
                'created_by' => Auth::user()->id

            ]);
        }
        return redirect()->back()->with(['msg', 'Manufacturing facility Added Successfully', 'active' => 'manu']);
    }

    public function contactdetails(Request $request)
    {
        // $contactdata = DB::table('unit_website_contact')->where('unit_id',Auth::user()->unit_id)->first();

        $unit = new UnitWebsiteContact;
        $unit->unit_id = Auth::user()->unit_id;
        $unit->en_address = $request->input('en_address');
        $unit->hi_address = $request->input('hi_address');
        $unit->phone_no = $request->input('phone_no');
        $unit->fax_no = $request->input('fax_no');
        $unit->cin_no = $request->input('cin_no');
        $unit->email_id = $request->input('email_id');
        $unit->map_link = $request->input('map_link');
        $unit->created_by = Auth::user()->id;
        $unit->save();
        Session::flash('message', 'Success|Data Inserted Successfully');
        return redirect()->back();
    }

    /**************************add-milestone************************************/
    public function addmilestone(Request $request)
    {
        $chck = Milestone::where('year', $request->year)->where('en_milestone', $request->en_milestone)->first();
        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Milestone Already Exists']);
        } else {
            $unit = new Milestone;
            $unit->year = $request->input('year');
            $unit->en_milestone = $request->input('en_milestone');
            $unit->hi_milestone = $request->input('hi_milestone');
            $unit->created_by = Auth::user()->id;
            $unit->save();
            return redirect()->back()->with(['msg' => 'Milestone Added Successfully']);
        }
    }
    public function previewmilestone()
    {
        //   $id =  Crypt::decrypt($id);
        $milestone =   Milestone::all();
        return view('unit-website.milestone-preview')->with(['milestone' => $milestone]);
    }

    public function previewmedia()
    {

        $website_media =  MediaRelease::all();
        return view('unit-website.media-preview')->with(['website_media' => $website_media]);
    }
    public function addwho(Request $request)
    {
        $chck = Whois::where('en_name', $request->en_name)->where('en_designation', $request->en_designation)->where('email', $request->email)->first();
        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Vigilance already exits']);
        } else {
            $web_logo = '';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $imgname =  $request->image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->image->move('upload/Whois', $imageName);
                    $web_logo = 'upload/Whois/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            }
            $unit = new Whois;
            $unit->en_name = $request->input('en_name');
            $unit->hi_name = $request->input('hi_name');
            $unit->category = $request->input('category');
            $unit->en_department = $request->input('en_department');
            $unit->hi_department = $request->input('hi_department');
            $unit->en_designation = $request->input('en_designation');
            $unit->hi_designation = $request->input('hi_designation');
            $unit->email = $request->input('email');
            $unit->phone_no = $request->input('phone_no');
            $unit->image = $web_logo;
            $unit->created_by = Auth::user()->id;
            $unit->save();
            return redirect()->back()->with(['msg' => 'Milestone Added Successfully']);
        }
    }

    public function updatemilestone(Request $request)
    {

        $chck = Milestone::where('year', $request->edit_year)->where('en_milestone', $request->milestone)->where('id', '!=', Crypt::decrypt($request->milestone_hid))->first();
        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Milestone Already Exists']);
        } else {
            $live_data = Milestone::find(Crypt::decrypt($request->input('milestone_hid')));
            if ($live_data->live_table_id == '0'|| ($live_data->status != '1')) {
                Milestone::find( Crypt::decrypt($request->input('milestone_hid')))->update([
                    'year' => $request->input('edit_year'),
                    'en_milestone' => $request->en_milestone,
                    'hi_milestone' => $request->hi_milestone
                ]);
            } else {
                $unit = new Milestone;
                $unit->year = $request->input('edit_year');
                $unit->en_milestone = $request->input('en_milestone');
                $unit->hi_milestone = $request->input('hi_milestone');
                $unit->live_table_id = $live_data->live_table_id;
                if($request->request_for == '1'){
                    $unit->type = '1';
                    }
                $unit->created_by = Auth::user()->id;
                $unit->save();
            }


            return redirect()->back()->with(['msg' => 'Milestone Added Successfully']);
        }
    }


    public function updatemediarelease(Request $request)
    {

        $chck = MediaRelease::where('en_title', $request->en_title)->where('date_time', $request->date_time)->where('id', '!=', Crypt::decrypt($request->media_hid))->first();

        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Media Release Already Exists']);
        } 
        
        else {

            $image = '';
            if ($request->hasFile('image')) {
                $imageName = time() . 'thumb.' . $request->image->extension();
                $imgname =  $request->image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->image->move('upload/media', $imageName);
                    $image = 'upload/media/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $image = $request->update_image;
            }

            $release_file = '';
            if ($request->hasFile('release_file')) {
                $imageName = time() . 'release.' . $request->release_file->extension();
                $imgname =  $request->release_file->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->release_file->move('upload/media', $imageName);
                    $release_file = 'upload/media/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $release_file = $request->update_file;
            }


           
            $live_data = MediaRelease::where('id', Crypt::decrypt($request->input('media_hid')))->first();
            // dd($live_data);
            if ($live_data->live_table_id == '0' || ($live_data->status != '1')) {
                // dd('hello');
                MediaRelease::find(Crypt::decrypt($request->media_hid))->update([
                    'en_title' => $request->input('en_title'),
                    'hi_title' => $request->input('hi_title'),
                    'date_time' => $request->date_time,
                    'file' =>  $release_file,
                    'image' => $image
                ]);
            } else {
                $mm = new MediaRelease;
                $mm->en_title = $request->en_title;
                $mm->hi_title = $request->hi_title;
                $mm->image = $image;
                $mm->file = $release_file;
                if($request->request_for == '1'){
                $mm->type = '1';
                }
                $mm->live_table_id = $live_data->live_table_id;
                $mm->date_time = $request->date_time;
                $mm->created_by = Auth::user()->id;
                $mm->save();
            }
        
      
            return redirect()->back()->with(['msg' => 'media release updated Successfully']);
        }
    }


    /**************************add-Media-release************************************/

    public function addmediarelease(Request $request)
    {
        $chck = MediaRelease::where('en_title', $request->en_title)->where('date_time', $request->date_time)->first();
        if (empty($chck)) {
            $image = '';
            if ($request->hasFile('image')) {
                $imageName = time() . 'thumb.' . $request->image->extension();
                $imgname =  $request->image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->image->move('upload/media', $imageName);
                    $image = 'upload/media/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            }

            $release_file = '';
            if ($request->hasFile('release_file')) {
                $imageName = time() . 'release.' . $request->release_file->extension();
                $imgname =  $request->release_file->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->release_file->move('upload/media', $imageName);
                    $release_file = 'upload/media/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            }

            $mm = new MediaRelease;
            $mm->en_title = $request->en_title;
            $mm->hi_title = $request->hi_title;
            $mm->image = $image;
            $mm->file = $release_file;
            $mm->date_time = $request->date_time;
            $mm->created_by = Auth::user()->id;
            $mm->save();
            Session::flash('message', 'danger|File Name Must Contain Only One "."');
            return redirect()->back();
        } else {

            return redirect()->back()->with(['msg' => 'Media Release Already Exists']);
        }
    }

    public function editmedia($id)
    {
        $dataaa = DB::table('media_releases')->where('id', $id)->first();
        $del = '';

        if (!empty($dataaa)) {

            $html = view('backend_component.edit-media')->with(['dataaa' => $dataaa])->render();
            return response()->json([
                'status'=> 200,
                'html' => $html
            ]);
        
        }

        return response()->json([
            'status'=> 200,
            'html' => ''
        ]);
    }


    public function editwhatnew($id)
    {
        $dataaa = WhatsNew::find($id);      
        $del = '';
        
        if(!empty($dataaa)){
            
            $html = view('backend_component.edit-whats-new')->with(['dataaa' => $dataaa])->render();
            return response()->json([
                'status'=> 200,
                'html' => $html
            ]);
        }
        return response()->json([
            'status'=> 200,
            'html' => ''
        ]);
    }

    public function modifyedit($id)
    {
        $dataaa = DB::table('whats_news')->where('id', $id)->first();
     
      
    }

    public function editaward($id)
    {
        $dataaa = DB::table('award_achievements')->where('id', $id)->first();
        $data = '';
        if (!empty($dataaa)) {

            $html = view('backend_component.edit-award')->with(['dataaa' => $dataaa])->render();
            return response()->json([
                'status'=> 200,
                'html' => $html
            ]);
        }
        return response()->json([
            'status'=> 200,
            'html' => ''
        ]);
        
    }

    public function addwhatnew(Request $request)
    {
        $chck = WhatsNew::where('news_date', $request->news_date)->where('en_description', $request->en_description)->first();
        if (empty($chck)) {
            $image = '';
            if ($request->hasFile('new_file')) {
                $imageName = time() . 'thumb.' . $request->new_file->extension();
                $imgname =  $request->new_file->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->new_file->move('upload/New', $imageName);
                    $image = 'upload/New/' . $imageName;
                } else {
                    $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            }

            $mm = new WhatsNew;
            $mm->news_date = $request->news_date;
            $mm->news_file = $image;
            $mm->en_description = $request->en_description;
            $mm->hi_description = $request->hi_description;
            $mm->created_by = Auth::user()->id;
            $mm->save();
            return redirect()->back()->with(['msg' => 'Whats new  Added Successfully']);
        } else {

            return redirect()->back()->with(['msg' => 'Whats new  Already Exists']);
        }
    }
    public function updatewhatnew(Request $request)
    {
        // dd($request);


        $chck = WhatsNew::where('news_date', $request->news_date)->where('en_description', $request->en_descriptionWhtsnew)->where('hi_description', $request->hi_descriptionWhtsnew)->where('id', '!=', Crypt::decrypt($request->new_hid))->first();
        
        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Whats New Already Exists']);
        } elseif($request->request_for == '1') {
            $image = '';
            if ($request->hasFile('image')) {
                $imageName = time() . 'thumb.' . $request->image->extension();
                $imgname =  $request->image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->image->move('upload/media', $imageName);
                    $image = 'upload/media/' . $imageName;
                } else {
                    $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $image = $request->update_image;
            }

            $release_file = '';
            if ($request->hasFile('news_file')) {
                $imageName = time() . 'release.' . $request->news_file->extension();
                $imgname =  $request->news_file->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->news_file->move('upload/New', $imageName);
                    $release_file = 'upload/New/' . $imageName;
                } else {
                    $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $release_file = $request->update_image;
            }
            
            $livedata = WhatsNew::find(Crypt::decrypt($request->new_hid));
            if (($livedata->live_table_id == '0')  || ($livedata->status != '1')) {
                WhatsNew::find(Crypt::decrypt($request->new_hid))->update([
                    'news_date' => $request->input('news_date'),
                    'en_description' => $request->en_descriptionWhtsnew,
                    'hi_description' => $request->hi_descriptionWhtsnew,
                    'news_file' => $release_file
                ]);
            } else {
                $mm = new WhatsNew;
                $mm->news_date = $request->news_date;
                $mm->news_file = $image;
                $mm->en_description = $request->en_descriptionWhtsnew;
                $mm->hi_description = $request->hi_descriptionWhtsnew;
                 if($request->request_for == '1')
                  {
                    $mm->type = '1';
                  }
                $mm->live_table_id = $livedata->live_table_id;
                $mm->created_by = Auth::user()->id;
                $mm->save();
            }

            return redirect()->back()->with(['msg' => 'Data Updated Successfully']);
        }
    }

                public function DeleteRequestForApprovalContent($tab,$id){


                    $livedata = WhatsNew::find($id);
                        if($tab =='new'){
 
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                WhatsNew::insert($collectWhatsNew);
                            }
                        }
                        elseif($tab =='slider_image'){
                            $livedata = WebsiteSliderImage::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                
                                WebsiteSliderImage::insert($collectWhatsNew);
                            }
                        }

                        elseif($tab =='cmd_message'){
                            $livedata = CmdMessage::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                CmdMessage::insert($collectWhatsNew);
                            }
                        }
                      
                        elseif($tab =='media'){
                            $livedata = MediaRelease::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                MediaRelease::insert($collectWhatsNew);
                            }
                        }
                        elseif($tab =='award'){
                            $livedata = AwardAchievements::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                AwardAchievements::insert($collectWhatsNew);
                            }
                        }
                        if($tab =='milestone'){
                            $livedata = Milestone::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                Milestone::insert($collectWhatsNew);
                            }
                        }
                        if($tab =='about'){
                            $livedata = UnitWebsite::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                UnitWebsite::insert($collectWhatsNew);
                            } 
                        }
                        if($tab =='whois'){
                            $livedata = Whois::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                Whois::insert($collectWhatsNew);
                            } 
                        }
                        if($tab =='contact'){
                            $livedata = UnitWebsiteContact::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                UnitWebsiteContact::insert($collectWhatsNew);
                            } 
                        }
                        if($tab =='download'){
                            $livedata = Download::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                Download::insert($collectWhatsNew);
                            }
                        }
                        if($tab =='tender'){
                            $livedata = Tender::find($id);
                            if(!empty($livedata)&&($livedata->live_table_id >= '0')){
                                // Copy data model and create array and insert 
                                $collectWhatsNew = collect($livedata->replicate())->toArray();
                                $collectWhatsNew['created_by'] = Auth::id();
                                $collectWhatsNew['status'] = '12';
                                Tender::insert($collectWhatsNew);
                            }
                        }

                            return redirect()->back()->with(['msg' => 'Delete Request Created']);

                        

                       
                 }

    public function ModifyRequestForApprovalContent(Request $request ,$tab, $id) {
        
        $data = $request->clientInfo;
        // dd($data);
          if($tab =='new') {
        
            $livedata = WhatsNew::find($id);
            if(!empty($livedata)&&($livedata->live_table_id >= '0')) {
                $mm = new WhatsNew;
                $mm->news_date = $data['news_date'];
                $mm->news_file = $data['update_image'];
                $mm->en_description =  $data['en_descriptionWhtsnew'];
                $mm->hi_description =  $data['hi_descriptionWhtsnew'];
                $mm->created_by = Auth::user()->id;
                $mm->status = '14';
                $mm->save();
            }
            return redirect()->back()->with(['msg' => 'Modify Request Created']);
        }
    }

    public function addaward(Request $request)
    {
        $chck = AwardAchievements::where('title', $request->title)->where('en_description', $request->en_description)->first();
        if (empty($chck)) {
            $image = '';
            if ($request->hasFile('image')) {
                $imageName = time() . 'thumb.' . $request->image->extension();
                $imgname =  $request->image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->image->move('upload/Award', $imageName);
                    $image = 'upload/Award/' . $imageName;
                } else {
                    $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            }

            $mm = new AwardAchievements;
            $mm->title = $request->title;
            $mm->image = $image;
            $mm->en_description = $request->en_descriptionAward;
            $mm->hi_description = $request->hi_descriptionAward;
            $mm->created_by = Auth::user()->id;
            $mm->save();
            return redirect()->back()->with(['msg' => 'Award Added Successfully']);
        } else {

            return redirect()->back()->with(['msg' => 'Award Already Exists']);
        }
    }
    public function updateaward(Request $request)
    {

        $chck = AwardAchievements::where('title', $request->title)->where('en_description', $request->en_description)->where('hi_description', $request->hi_description)->where('id', '!=', Crypt::decrypt($request->award_hid))->first();

        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Award Already Exists']);
        } elseif($request->request_for == '1') {

            $image = '';
            if ($request->hasFile('image')) {
                $imageName = time() . 'thumb.' . $request->image->extension();
                $imgname =  $request->image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->image->move('upload/Award', $imageName);
                    $image = 'upload/Award/' . $imageName;
                } else {
                    $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $image = $request->update_image;
            }

            $livedata = AwardAchievements::find(Crypt::decrypt($request->award_hid));
            if ($livedata->live_table_id == '0'|| ($livedata->status != '1')) {
                AwardAchievements::find(Crypt::decrypt($request->award_hid))->update([
                    'title' => $request->input('title'),
                    'status' => '0',
                    'en_description' => $request->en_descriptionAwardedit,
                    'hi_description' => $request->hi_descriptionAwardedit,
                    'image' => $image
                ]);
            } else {
                $mm = new AwardAchievements;
                $mm->title = $request->title;
                $mm->image = $image;
                $mm->en_description = $request->en_descriptionAwardedit;
                $mm->hi_description = $request->hi_descriptionAwardedit;
                $mm->live_table_id = $livedata->live_table_id;
                if($request->request_for == '1'){
                $mm->type = '1';
               
                }
                $mm->created_by = Auth::user()->id;
                $mm->save();
            }


            return redirect()->back()->with(['msg' => 'Data Updated Successfully']);
        }
    }


    public function updatewho(Request $request)
    {
        // dd($request->all());
        $chck = Whois::where('en_department', $request->en_editname)->where('en_designation', $request->en_editdesignation)->where('email', $request->email)->where('id', '!=', Crypt::decrypt($request->who_hid))->first();

        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Data Already Exists']);
        } else {

            $image = '';
            if ($request->hasFile('image')) {
                $imageName = time() . 'thumb.' . $request->image->extension();
                $imgname =  $request->image->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->image->move('upload/Who', $imageName);
                    $image = 'upload/Who/' . $imageName;
                } else {
                    $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $image = $request->update_image;
            }


            $live_data = Whois::where('id', Crypt::decrypt($request->input('who_hid')))->first();
            if ($live_data->live_table_id == '0' || ($live_data->status != '1')) {
                // dd('hello');
                Whois::find(Crypt::decrypt($request->who_hid))->update([
                    'en_name' => $request->input('en_editname'),
                    'hi_name' => $request->input('hi_editname'),
                    'en_designation' => $request->en_editdesignation,
                    'hi_designation' => $request->hi_editdesignation,
                    'category' => $request->category,
                    'en_department' => $request->en_department,
                    'hi_department' => $request->hi_department,
                    'email' => $request->email,
                    'phone_no' => $request->phone_no,
                    'image' => $image
                ]);
            } else {
                $mm = new Whois;
                $mm->en_name = $request->en_editname;
                $mm->hi_name = $request->hi_editname;
                $mm->en_designation =$request->en_editdesignation;
                $mm->hi_designation =$request->hi_editdesignation;
                $mm->category =$request->category;
                $mm->en_department =$request->en_department;
                $mm->hi_department =$request->hi_department;
                $mm->email = $request->email;
                $mm->phone_no = $request->phone_no;
                $mm->image = $request->image;
             
                if($request->request_for == '1'){
                $mm->type = '1';
               
                }
                $mm->live_table_id = $live_data->live_table_id;
                $mm->date_time = $request->date_time;
                $mm->created_by = Auth::user()->id;
                $mm->save();
            }
        
            // dd(Crypt::decrypt($request->media_hid));
           

            return redirect()->back()->with(['msg' => 'Data Updated Successfully']);
        }
    }

    public function saveapproval(Request $request)
    {


        $check = Otp::where('otp_for', $request->relation)->where('otp', $request->otpval)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        if (!empty($check)) {
            if ($request->relation == 'slider_image') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                }
                $up =  WebsiteSliderImage::find($request->relid)->update(['status' => '1', 'publish_time' => $request->publish_time]);
                if ($request->publish_time == '') {
                    $wsi = WebsiteSliderImage::find($request->relid);
                    if ($wsi->live_table_id == '0') {
                        // $id =   DB::table('approved_website_slider_images')->insertGetId([
                        $approve = ApprovedWebsiteSliderImage::create([
                            'unit_id' => $wsi->unit_id,
                            'slider_image_id' => $wsi->id,
                            'slider_image' => $wsi->slider_image,
                            'sequence' => $wsi->sequence,
                            'status' => $wsi->status,
                            'created_by' => $wsi->created_by
                        ]);
                        WebsiteSliderImage::find($wsi->id)->update(['live_table_id' => $approve->id]);
                    } else {
                        ApprovedWebsiteSliderImage::find($wsi->live_table_id)->update([
                            // DB::table('approved_website_slider_images')->where('id', $wsi->live_table_id)->update([
                            'unit_id' => $wsi->unit_id,
                            'slider_image_id' => $wsi->id,
                            'slider_image' => $wsi->slider_image,
                            'sequence' => $wsi->sequence,
                            'status' => $wsi->status,
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $approve->id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            /*******************Unit Products**********/
            if ($request->relation == 'unit_product') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  DB::table('unit_products')->where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {

                    $wsi = DB::table('unit_products')->where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {
                        $id =   DB::table('approved_products')->insertGetId([
                            'unit_id' => $wsi->unit_id,
                            'product_id' => $wsi->id,
                            'product_name' => $wsi->product_name,
                            'product_image' => $wsi->product_image,
                            'product_specification' => $wsi->product_specification,
                            'status' => '1'
                        ]);
                        UnitProduct::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_products')->where('id', $wsi->live_table_id)->update([
                            'unit_id' => $wsi->unit_id,
                            'product_id' => $wsi->product_id,
                            'product_image' => $wsi->product_image,
                            'product_specification' => $wsi->product_specification,
                            'status' => '1'
                        ]);
                    }
                }

                if ($up) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            /*****************end unit products********/

            /***********************************Unit Manufacturing Facility  *******************/

            if ($request->relation == 'manu_facility') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  DB::table('unit_manufacturing_facility')->where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {

                    $wsi = DB::table('unit_manufacturing_facility')->where('id', $request->relid)->first();

                    if ($wsi->live_table_id == '0') {

                        $id =   DB::table('approved_unit_manufacturing_facility')->insertGetId([
                            'manufacturing_id' => $wsi->id,
                            'unit_id'   => $wsi->unit_id,
                            'title' => $wsi->title,
                            'image' => $wsi->image,
                            'description' => $wsi->description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        UnitManufacturingFacility::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {

                        DB::table('approved_unit_manufacturing_facility')->where('id', $wsi->live_table_id)->update([
                            'manufacturing_id' => $wsi->id,
                            'unit_id'   => $wsi->unit_id,
                            'title' => $wsi->title,
                            'image' => $wsi->image,
                            'description' => $wsi->description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }

                if ($up) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            /**********************************end Manufacturing Facility *****************/

            /*********MileStone****************/
            if ($request->relation == 'milestone') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Milestone::find($request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {

                    /**********************/
                    $wsi = Milestone::find($request->relid);
                    if ($wsi->live_table_id == '0') {
                        $id =   ApprovedMilestone::insertGetId([
                            'year' => $wsi->year,
                            'milestone_id' => $wsi->id,
                            'en_milestone' => $wsi->en_milestone,
                            'hi_milestone' => $wsi->hi_milestone,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Milestone::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        ApprovedMilestone::find($wsi->live_table_id)->update([
                            'year' => $wsi->year,
                            'milestone_id' => $wsi->id,
                            'en_milestone' => $wsi->en_milestone,
                            'hi_milestone' => $wsi->hi_milestone,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'media') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                // $up =  DB::table('media_releases')->where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                $up = MediaRelease::find($request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {


                    // $wsi = DB::table('media_releases')->where('id', $request->relid)->first();
                    $wsi = MediaRelease::find($request->relid);
                    if ($wsi->live_table_id == '0') {
                        // $id =   DB::table('approved_media_releases')->insertGetId([
                        $id = ApprovedMediaRelease::create([
                            'media_release_id' => $wsi->id,
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'image' => $wsi->image,
                            'date_time' => $wsi->date_time,
                            'file' => $wsi->file,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        MediaRelease::where('id', $wsi->id)->update(['live_table_id' => $id->id]);
                    } else {
                        ApprovedMediaRelease::find($wsi->live_table_id)->update([
                            'media_release_id' => $wsi->id,
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'image' => $wsi->image,
                            'date_time' => $wsi->date_time,
                            'file' => $wsi->file,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                    // DB::table('approved_media_releases')->insertGetId([
                    //     'media_release_id' => $wsi->id,
                    //     'title' => $wsi->title,
                    //     'image' => $wsi->title,
                    //     'date_time' => $wsi->title,
                    //     'file' => $wsi->title,
                    //     'status' => '1',
                    //     'created_by' => $wsi->created_by
                    // ]);
                }







                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'news') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  WhatsNew::find($request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = WhatsNew::find($request->relid);
                    if ($wsi->live_table_id == '0') {
                        $id =   ApprovedWhatNew::insertGetId([
                            'news_id' => $wsi->id,
                            'news_date' => $wsi->news_date,
                            'news_file' => $wsi->news_file,
                            'en_description' => $wsi->en_description,
                            'hi_description' => $wsi->hi_description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                      
                        WhatsNew::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        // dd($request->all());
                        ApprovedWhatNew::where('id',$wsi->live_table_id)->update([
                            'news_id' => $wsi->id,
                            'news_date' => $wsi->news_date,
                            'news_file' => $wsi->news_file,
                            'en_description' => $wsi->en_description,
                            'hi_description' => $wsi->hi_description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }



// dd($request->publish_time);
            if ($request->relation == 'award') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  AwardAchievements::find($request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = AwardAchievements::find($request->relid);

                    if ($wsi->live_table_id == '0') {
                        $id =  ApprovedAwardAchievement::insertGetId([
                            'award_id' => $wsi->id,
                            'title' => $wsi->title,
                            'image' => $wsi->image,
                            'en_description' => $wsi->en_descriptionAward,
                            'hi_description' => $wsi->hi_descriptionAward,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        AwardAchievements::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        ApprovedAwardAchievement::find($wsi->live_table_id)->update([
                            'award_id' => $wsi->id,
                            'title' => $wsi->title,
                            'image' => $wsi->image,
                            'en_description' => $wsi->en_descriptionAward,
                            'hi_description' => $wsi->hi_descriptionAward,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'who') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Whois::find($request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = Whois::find($request->relid);
                    if ($wsi->live_table_id == '0') {

                        $id =  ApprovedWhois::insertGetId([
                            'who_id' => $wsi->id,
                            'category' => $wsi->category,
                            'en_department' => $wsi->en_department,
                            'hi_department' => $wsi->hi_department,
                            'en_designation' => $wsi->en_designation,
                            'hi_designation' => $wsi->hi_designation,
                            'en_name' => $wsi->en_name,
                            'hi_name' => $wsi->hi_name,
                            'email' => $wsi->email,
                            'phone_no' => $wsi->phone_no,
                            'image' => $wsi->image,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Whois::find($wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        ApprovedWhois::find($wsi->live_table_id)->update([
                            'who_id' => $wsi->id,
                            'category' => $wsi->category,
                            'en_department' => $wsi->en_department,
                            'hi_department' => $wsi->hi_department,
                            'en_designation' => $wsi->en_designation,
                            'hi_designation' => $wsi->hi_designation,
                            'en_name' => $wsi->en_name,
                            'hi_name' => $wsi->hi_name,
                            'email' => $wsi->email,
                            'phone_no' => $wsi->phone_no,
                            'image' => $wsi->image,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'about') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  UnitWebsite::find($request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = UnitWebsite::find($request->relid);
                    if ($wsi->live_table_id == '0') {

                        $id =  ApprovedUnitWebsite::insertGetId([
                            'website_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'website_en_title' => $wsi->website_en_title,
                            'website_hi_title' => $wsi->website_hi_title,
                            'website_en_sub_title' => $wsi->website_en_sub_title,
                            'website_hi_sub_title' => $wsi->website_hi_sub_title,
                            'website_logo' => $wsi->website_logo,
                            'about_en_description' => $wsi->about_en_description,
                            'about_hi_description' => $wsi->about_hi_description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        UnitWebsite::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        ApprovedUnitWebsite::find($wsi->live_table_id)->update([
                            'website_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'website_en_title' => $wsi->website_en_title,
                            'website_hi_title' => $wsi->website_hi_title,
                            'website_en_sub_title' => $wsi->website_en_sub_title,
                            'website_hi_sub_title' => $wsi->website_hi_sub_title,
                            'website_logo' => $wsi->website_logo,
                            'about_en_description' => $wsi->about_en_description,
                            'about_hi_description' => $wsi->about_hi_description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'contact') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  UnitWebsiteContact::find($request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = UnitWebsiteContact::find($request->relid);
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_website_contact')->insertGetId([
                            'contact_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'en_address' => $wsi->en_address,
                            'hi_address' => $wsi->hi_address,
                            'cin_no' => $wsi->cin_no,
                            'phone_no' => $wsi->phone_no,
                            'fax_no' => $wsi->fax_no,
                            'email_id' => $wsi->email_id,
                            'map_link' => $wsi->map_link,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        UnitWebsiteContact::find($wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_website_contact')->where('id', $wsi->live_table_id)->update([
                            'contact_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'en_address' => $wsi->en_address,
                            'hi_address' => $wsi->hi_address,
                            'cin_no' => $wsi->cin_no,
                            'phone_no' => $wsi->phone_no,
                            'fax_no' => $wsi->fax_no,
                            'email_id' => $wsi->email_id,
                            'map_link' => $wsi->map_link,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'cmd_message') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  CmdMessage::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = CmdMessage::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_cmd_messages')->insertGetId([
                            'message_id' => $wsi->id,
                            'image' => $wsi->image,
                            'en_description' => $wsi->en_description,
                            'hi_description' => $wsi->hi_description,
                            'created_by' => $wsi->created_by
                        ]);
                        CmdMessage::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_cmd_messages')->where('id', $wsi->live_table_id)->update([
                            'message_id' => $wsi->id,
                            'image' => $wsi->image,
                            'en_description' => $wsi->en_description,
                            'hi_description' => $wsi->hi_description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'poirti') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Rti::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = Rti::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_rtis')->insertGetId([
                            'rti_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'designation' => $wsi->designation,
                            'name_of_officer' => $wsi->name_of_officer,
                            'responsibility_assigned' => $wsi->responsibility_assigned,
                            'email_address' => $wsi->email_address,
                            'status' => '1',
                            'phone_no' => $wsi->phone_no,
                            'created_by' => $wsi->created_by
                        ]);
                        Rti::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_rtis')->where('id', $wsi->live_table_id)->update([
                            'rti_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'designation' => $wsi->designation,
                            'name_of_officer' => $wsi->name_of_officer,
                            'responsibility_assigned' => $wsi->responsibility_assigned,
                            'email_address' => $wsi->email_address,
                            'phone_no' => $wsi->phone_no,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'mandatory') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  RtiMandatoryDisclosure::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = RtiMandatoryDisclosure::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_rti_mandatory_disclosures')->insertGetId([
                            'disclosure_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'hi_title' => $wsi->hi_title,
                            'en_title' => $wsi->en_title,
                            'attachment' => $wsi->attachment,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Rti::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_rti_mandatory_disclosures')->where('id', $wsi->live_table_id)->update([
                            'disclosure_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'hi_title' => $wsi->hi_title,
                            'en_title' => $wsi->en_title,
                            'attachment' => $wsi->attachment,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'download') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Download::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = Download::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_downloads')->insertGetId([
                            'download_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'hi_category' => $wsi->hi_category,
                            'en_category' => $wsi->en_category,
                            'hi_subject' => $wsi->hi_subject,
                            'en_subject' => $wsi->en_subject,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Download::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_downloads')->where('id', $wsi->live_table_id)->update([
                            'download_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'hi_category' => $wsi->hi_category,
                            'en_category' => $wsi->en_category,
                            'hi_subject' => $wsi->hi_subject,
                            'en_subject' => $wsi->en_subject,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'quick') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  QuickLink::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = QuickLink::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_quick_links')->insertGetId([
                            'quick_id' => $wsi->id,
                            'url' => $wsi->url,
                            'logo_image' => $wsi->logo_image,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Rti::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_quick_links')->where('id', $wsi->live_table_id)->update([
                            'quick_id' => $wsi->id,
                            'url' => $wsi->url,
                            'logo_image' => $wsi->logo_image,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'career') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Career::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = Career::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_careers')->insertGetId([
                            'career_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'en_subject' => $wsi->en_subject,
                            'hi_subject' => $wsi->hi_subject,
                            'valid_from' => $wsi->valid_from,
                            'valid_till' => $wsi->valid_till,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Career::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_quick_links')->where('id', $wsi->live_table_id)->update([
                            'career_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'en_subject' => $wsi->en_subject,
                            'hi_subject' => $wsi->hi_subject,
                            'valid_from' => $wsi->valid_from,
                            'valid_till' => $wsi->valid_till,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'tender') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Tender::find($request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = Tender::find($request->relid);
                    if ($wsi->live_table_id == '0') {
                        $id =  DB::table('approved_tenders')->insertGetId([
                            'tender_id' => $wsi->id,
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'file' => $wsi->file,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                      
                        Tender::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_tenders')->where('id',$wsi->live_table_id)->update([
                            'tender_id' => $wsi->id,
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'file' => $wsi->file,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Invalid OTP']);
        }
    }

    public function savechangeapproval(Request $request)
    {
        $check = Otp::where('otp_for', $request->relation)->where('otp', $request->otpval)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        if (!empty($check)) {
            if ($request->relation == 'slider_image') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                }
                // $up =  DB::table('website_slider_images')->
                $up = WebsiteSliderImage::find($request->relid)->update(['status' => '1', 'publish_time' => $request->publish_time]);
                if ($request->publish_time == '') {
                    $wsi = WebsiteSliderImage::find($request->relid);
                    if ($wsi->live_table_id == '0') {
                        // $id =   DB::table('approved_website_slider_images')->insertGetId([
                        $approve = ApprovedWebsiteSliderImage::create([
                            'unit_id' => $wsi->unit_id,
                            'slider_image_id' => $wsi->id,
                            'slider_image' => $wsi->slider_image,
                            'sequence' => $wsi->sequence,
                            'status' => $wsi->status,
                            'created_by' => $wsi->created_by
                        ]);
                        WebsiteSliderImage::where('id', $wsi->id)->update(['live_table_id' => $approve->id]);
                    } else {
                        // DB::table('approved_website_slider_images')->where('id', $wsi->live_table_id)->update([
                        ApprovedWebsiteSliderImage::find($wsi->live_table_id)->update([
                            'unit_id' => $wsi->unit_id,
                            'slider_image_id' => $wsi->id,
                            'slider_image' => $wsi->slider_image,
                            'sequence' => $wsi->sequence,
                            'status' => $wsi->status,
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $approve->id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            /*********MileStone****************/
            if ($request->relation == 'milestone') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  DB::table('milestones')->where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {

                    /**********************/
                    $wsi = DB::table('milestones')->where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {
                        $id =   DB::table('approved_milestones')->insertGetId([
                            'year' => $wsi->year,
                            'milestone_id' => $wsi->id,
                            'en_milestone' => $wsi->en_milestone,
                            'hi_milestone' => $wsi->hi_milestone,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Milestone::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_milestones')->where('id', $wsi->live_table_id)->update([
                            'year' => $wsi->year,
                            'milestone_id' => $wsi->id,
                            'en_milestone' => $wsi->en_milestone,
                            'hi_milestone' => $wsi->hi_milestone,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'media') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  DB::table('media_releases')->where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {


                    $wsi = DB::table('media_releases')->where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {
                        $id =   DB::table('approved_media_releases')->insertGetId([
                            'media_release_id' => $wsi->id,
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'image' => $wsi->image,
                            'date_time' => $wsi->date_time,
                            'file' => $wsi->file,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        MediaRelease::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_media_releases')->where('id', $wsi->live_table_id)->update([
                            'media_release_id' => $wsi->id,
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'image' => $wsi->image,
                            'date_time' => $wsi->date_time,
                            'file' => $wsi->file,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                    // DB::table('approved_media_releases')->insertGetId([
                    //     'media_release_id' => $wsi->id,
                    //     'title' => $wsi->title,
                    //     'image' => $wsi->title,
                    //     'date_time' => $wsi->title,
                    //     'file' => $wsi->title,
                    //     'status' => '1',
                    //     'created_by' => $wsi->created_by
                    // ]);
                }







                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'news') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  WhatsNew::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = WhatsNew::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {
                        $id =   DB::table('approved_whats_news')->insertGetId([
                            'news_id' => $wsi->id,
                            'news_date' => $wsi->news_date,
                            'news_file' => $wsi->news_file,
                            'en_description' => $wsi->en_description,
                            'hi_description' => $wsi->hi_description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        WhatsNew::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_whats_news')->where('id', $wsi->live_table_id)->update([
                            'news_id' => $wsi->id,
                            'news_date' => $wsi->news_date,
                            'news_file' => $wsi->news_file,
                            'en_description' => $wsi->en_description,
                            'hi_description' => $wsi->hi_description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'award') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  DB::table('award_achievements')->where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = DB::table('award_achievements')->where('id', $request->relid)->first();

                    if ($wsi->live_table_id == '0') {
                        $id =  DB::table('approved_award_achievements')->insertGetId([
                            'award_id' => $wsi->id,
                            'title' => $wsi->title,
                            'image' => $wsi->image,
                            'en_description' => $wsi->en_descriptionAward,
                            'hi_description' => $wsi->hi_descriptionAward,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        AwardAchievements::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_award_achievements')->where('id', $wsi->live_table_id)->update([
                            'award_id' => $wsi->id,
                            'title' => $wsi->title,
                            'image' => $wsi->image,
                            'en_description' => $wsi->en_descriptionAward,
                            'hi_description' => $wsi->hi_descriptionAward,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'who') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  DB::table('whois')->where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = DB::table('whois')->where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_whois')->insertGetId([
                            'who_id' => $wsi->id,
                            'category' => $wsi->category,
                            'department' => $wsi->department,
                            'designation' => $wsi->designation,
                            'name' => $wsi->name,
                            'email' => $wsi->email,
                            'phone_no' => $wsi->phone_no,
                            'image' => $wsi->image,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Whois::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_whois')->where('id', $wsi->live_table_id)->update([
                            'who_id' => $wsi->id,
                            'category' => $wsi->category,
                            'department' => $wsi->department,
                            'designation' => $wsi->designation,
                            'name' => $wsi->name,
                            'email' => $wsi->email,
                            'phone_no' => $wsi->phone_no,
                            'image' => $wsi->image,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'contact') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  UnitWebsiteContact::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = UnitWebsiteContact::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_website_contact')->insertGetId([
                            'contact_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'address' => $wsi->address,
                            'cin_no' => $wsi->cin_no,
                            'phone_no' => $wsi->phone_no,
                            'fax_no' => $wsi->fax_no,
                            'email_id' => $wsi->email_id,
                            'map_link' => $wsi->map_link,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        UnitWebsiteContact::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_website_contact')->where('id', $wsi->live_table_id)->update([
                            'contact_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'address' => $wsi->address,
                            'cin_no' => $wsi->cin_no,
                            'phone_no' => $wsi->phone_no,
                            'fax_no' => $wsi->fax_no,
                            'email_id' => $wsi->email_id,
                            'map_link' => $wsi->map_link,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'cmd_message') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  CmdMessage::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = CmdMessage::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_cmd_messages')->insertGetId([
                            'message_id' => $wsi->id,
                            'image' => $wsi->image,
                            'en_description' => $wsi->en_description,
                            'hi_description' => $wsi->hi_description,
                            'created_by' => $wsi->created_by
                        ]);
                        CmdMessage::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_cmd_messages')->where('id', $wsi->live_table_id)->update([
                            'message_id' => $wsi->id,
                            'image' => $wsi->image,
                            'en_description' => $wsi->en_description,
                            'hi_description' => $wsi->hi_description,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'poirti') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Rti::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = Rti::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_rtis')->insertGetId([
                            'rti_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'designation' => $wsi->designation,
                            'name_of_officer' => $wsi->name_of_officer,
                            'responsibility_assigned' => $wsi->responsibility_assigned,
                            'email_address' => $wsi->email_address,
                            'status' => '1',
                            'phone_no' => $wsi->phone_no,
                            'created_by' => $wsi->created_by
                        ]);
                        Rti::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_rtis')->where('id', $wsi->live_table_id)->update([
                            'rti_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'designation' => $wsi->designation,
                            'name_of_officer' => $wsi->name_of_officer,
                            'responsibility_assigned' => $wsi->responsibility_assigned,
                            'email_address' => $wsi->email_address,
                            'phone_no' => $wsi->phone_no,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'mandatory') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  RtiMandatoryDisclosure::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = RtiMandatoryDisclosure::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_rti_mandatory_disclosures')->insertGetId([
                            'disclosure_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'hi_title' => $wsi->hi_title,
                            'en_title' => $wsi->en_title,
                            'attachment' => $wsi->attachment,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Rti::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_rti_mandatory_disclosures')->where('id', $wsi->live_table_id)->update([
                            'disclosure_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'hi_title' => $wsi->hi_title,
                            'en_title' => $wsi->en_title,
                            'attachment' => $wsi->attachment,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'download') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Download::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = Download::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {
                        $id =   DB::table('approved_downloads')->insertGetId([
                            'download_id' => $wsi->id,
                            'en_category' => $wsi->en_category,
                            'hi_category' => $wsi->hi_category,
                            'en_subject' => $wsi->en_subject,
                            'hi_subject' => $wsi->hi_subject,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Download::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_downloads')->where('id', $wsi->live_table_id)->update([
                            'download_id' => $wsi->id,
                            'en_category' => $wsi->en_category,
                            'hi_category' => $wsi->hi_category,
                            'en_subject' => $wsi->en_subject,
                            'hi_subject' => $wsi->hi_subject,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }

            if ($request->relation == 'quick') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  QuickLink::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = QuickLink::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {
                        $id =   DB::table('approved_quick_links')->insertGetId([
                            'quick_id' => $wsi->id,
                            'url' => $wsi->url,
                            'logo_image' => $wsi->logo_image,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        QuickLink::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_quick_links')->where('id', $wsi->live_table_id)->update([
                            'quick_id' => $wsi->id,
                            'url' => $wsi->url,
                            'logo_image' => $wsi->logo_image,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'career') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Career::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = Career::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_careers')->insertGetId([
                            'career_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'en_subject' => $wsi->en_subject,
                            'hi_subject' => $wsi->hi_subject,
                            'valid_from' => $wsi->valid_from,
                            'valid_till' => $wsi->valid_till,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Career::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_careers')->where('id', $wsi->live_table_id)->update([
                            'career_id' => $wsi->id,
                            'unit_id' => $wsi->unit_id,
                            'en_subject' => $wsi->en_subject,
                            'hi_subject' => $wsi->hi_subject,
                            'valid_from' => $wsi->valid_from,
                            'valid_till' => $wsi->valid_till,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'library') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  ELibrary::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = ELibrary::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_e_libraries')->insertGetId([
                            'library_id' => $wsi->id,
                            'unit_id'    =>   $wsi->unit_id,
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'author' => $wsi->author,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        ELibrary::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_e_libraries')->where('id', $wsi->live_table_id)->update([
                            'library_id' => $wsi->id,
                            'unit_id'    =>   $wsi->unit_id,
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'author' => $wsi->author,
                            'document' => $wsi->document,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
            if ($request->relation == 'tender') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                } else {
                    $publish_time = $request->publish_time;
                }
                $up =  Tender::where('id', $request->relid)->update(['status' => '1', 'publish_time' => $publish_time]);
                if ($request->publish_time == '') {
                    $wsi = Tender::where('id', $request->relid)->first();
                    if ($wsi->live_table_id == '0') {

                        $id =  DB::table('approved_tenders')->insertGetId([
                            'tender_id' => $wsi->id,
                        
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'file' => $wsi->file,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                        Tender::where('id', $wsi->id)->update(['live_table_id' => $id]);
                    } else {
                        DB::table('approved_tenders')->where('id', $wsi->live_table_id)->update([
                            'tender_id' => $wsi->id,
                           
                            'en_title' => $wsi->en_title,
                            'hi_title' => $wsi->hi_title,
                            'file' => $wsi->file,
                            'status' => '1',
                            'created_by' => $wsi->created_by
                        ]);
                    }
                }
                if ($up || $id) {
                    return response()->json(['success' => true, 'msg' => 'Content Pulished']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Data Error']);
                }
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Invalid OTP']);
        }
    }

    /*************************Reject************************ */
    public function savereject(Request $request)
    {
        // dd($request->all());
        $check = Otp::where('otp_for', $request->relation)->where('otp', $request->otpval)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        if (!empty($check)) {
            if ($request->relation == 'slider_image') {
                // $table_name = 'website_slider_images';
                $table_name = 'WebsiteSliderImage';
            }
            if ($request->relation == 'poirti') {
                // $table_name = 'rtis';
                $table_name = 'Rti';
            }
            if ($request->relation == 'unit_product') {
                // $table_name = 'unit_products';
                $table_name = 'UnitProduct';
            }
            if ($request->relation == 'milestone') {
                // $table_name = 'milestones';
                $table_name = 'Milestone';
            }
            if ($request->relation == 'media') {
                // $table_name = 'media_releases';
                $table_name = 'MediaRelease';
            }
            if ($request->relation == 'news') {
                // $table_name = 'whats_news';
                $table_name = 'WhatsNew';
            }
            if ($request->relation == 'award') {
                // $table_name = 'award_achievements';
                $table_name = 'AwardAchievements';
            }
            if ($request->relation == 'who') {
                // $table_name = 'whois';
                $table_name = 'Whois';
            }
            if ($request->relation == 'about') {
                // $table_name = 'unit_websites';
                $table_name = 'UnitWebsite';
            }
            if ($request->relation == 'contact') {
                // $table_name = 'unit_website_contact';
                $table_name = 'UnitWebsiteContact';
            }
            if ($request->relation == 'cmd_message') {
                // $table_name = 'cmd_messages';
                $table_name = 'CmdMessage';
            }
            if ($request->relation == 'download') {
                // $table_name = 'downloads';
                $table_name = 'Download';
            }
            if ($request->relation == 'quick') {
                // $table_name = 'quick_links';
                $table_name = 'QuickLink';
            }
            if ($request->relation == 'career') {
                // $table_name = 'careers';
                $table_name = 'Career';
            }
            if ($request->relation == 'library') {
                // $table_name = 'careers';
                $table_name = 'ELibrary';
            }
            if ($request->relation == 'tender') {
                // $table_name = 'careers';
                $table_name = 'Tender';
            }

            // $up =  DB::table($table_name)->where('id', $request->relid)->update(['status' => '4']);
            $entity = 'App\\Models\\' . $table_name;
            $up = $entity::find($request->relid)->update(['status' => '4']);
            if ($up) {
                return response()->json(['success' => true, 'msg' => 'Content Rejected!!']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Data Error']);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Invalid OTP']);
        }
    }


    /*************************save delete Request************************ */
    public function savedeleterequest(Request $request)
    {
    //    dd($request->relation);
        $check = Otp::where('otp_for', $request->relation)->where('otp', $request->otpval)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
    //   dd($check);
        if (!empty($check)) {
            if ($request->relation == 'delete_request_slider') {
                if($request->publish_time == '') {
                $mytime = Carbon::now();
                $current = $mytime->toDateTimeString();
                $publish_time = $mytime->toDateTimeString();

                $table_name = 'website_slider_images';
                $table_name_approved = 'approved_website_slider_images';
                }
                else{
                    $table_name = 'website_slider_images';
                    $table_name_approved = 'approved_website_slider_images';
                }
            }
            if ($request->relation == 'poirti') {
                $table_name = 'rtis';
            }
            if ($request->relation == 'delete_request_milestone') {
                if($request->publish_time == '') {
                $mytime = Carbon::now();
                $current = $mytime->toDateTimeString();
                $publish_time = $mytime->toDateTimeString();
                $table_name = 'milestones';
                $table_name_approved = 'milestones';
                }
                $table_name = 'milestones';
                $table_name_approved = 'approved_milestones';    

            }
            if ($request->relation == 'delete_request_media') {

                if($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                    $table_name = 'media_releases';
                    $table_name_approved = 'approved_media_releases';  
                }
                $table_name = 'media_releases';
                $table_name_approved = 'approved_media_releases';
            }
            if ($request->relation == 'delete_request_new') {
                if($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                $table_name = 'whats_news';
                $table_name_approved = 'approved_whats_news';
                }
                else{
                    $table_name = 'whats_news';
                    $table_name_approved = 'approved_whats_news';
                }
            }


            if ($request->relation == 'award_for_delete') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                    $table_name = 'award_achievements';
                    $table_name_approved = 'approved_award_achievements';
                }
                else{
                    $table_name = 'award_achievements';
                    $table_name_approved = 'approved_award_achievements';
                }
               
             
            }
            if ($request->relation == 'delete_request_whos') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                    $table_name = 'whois';
                    $table_name_approved = 'approved_whois';
                }
                $table_name = 'whois';
                $table_name_approved = 'approved_whois';
            }
            if ($request->relation == 'delete_request_about') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                    $table_name = 'unit_websites';
                    $table_name_approved = 'approved_unit_websites';
                }
                $table_name = 'unit_websites';
                $table_name_approved = 'approved_unit_websites';
            }
            if ($request->relation == 'delete_request_contact') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                    $table_name = 'unit_website_contact';
                    $table_name_approved = 'approved_website_contact';
                }
                $table_name = 'unit_website_contact';
                $table_name_approved = 'approved_website_contact';
            }

            if ($request->relation == 'delete_request_cmdmessage') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                    $table_name = 'cmd_messages';
                    $table_name_approved = 'approved_cmd_messages';
                }
                $table_name = 'cmd_messages';
                $table_name_approved = 'approved_cmd_messages';
            }
            if ($request->relation == 'delete_request_download') {
                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                $table_name = 'downloads';
                $table_name_approved = 'approved_downloads';
                }
                $table_name = 'downloads';
                $table_name_approved = 'approved_downloads';
            }
            if ($request->relation == 'quick') {
                $table_name = 'quick_links';
            }
            if ($request->relation == 'career') {
                $table_name = 'careers';
            }
            if ($request->relation == 'delete_request_tender') {

                if ($request->publish_time == '') {
                    $mytime = Carbon::now();
                    $current = $mytime->toDateTimeString();
                    $publish_time = $mytime->toDateTimeString();
                $table_name = 'tenders';
                $table_name_approved = 'approved_tenders';
                }
                $table_name = 'tenders';
                $table_name_approved = 'approved_tenders';
            }
// dd($request->relid);
            $up =  DB::table($table_name)->where('id', $request->relid)->update(['status' => '10','publish_time' => $request->publish_time]);
            $up2 = DB::table($table_name)->where('id', $request->relid)->first();
            $up1 =  DB::table($table_name_approved)->where('id', $up2->live_table_id)->update(['status' => '0']);
            if ($up || $up1) {
                return response()->json(['success' => true, 'msg' => 'Content Rejected!!']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Data Error']);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Invalid OTP']);
        }
    }

    /***********************Review**********************/
    public function savereview(Request $request)
    {
        // dd($request->all());
        $check = Otp::where('otp_for', $request->relation)->where('otp', $request->otpval)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        if (!empty($check)) {
            if ($request->relation == 'slider_image') {
                // $table_name = 'website_slider_images';
                $table_name = 'WebsiteSliderImage';
            }
            if ($request->relation == 'poirti') {
                // $table_name = 'rtis';
                $table_name = 'Rti';
            }
            if ($request->relation == 'unit_product') {
                // $table_name = 'unit_products';
                $table_name = 'UnitProduct';
            }
            if ($request->relation == 'milestone') {
                // $table_name = 'milestones';
                $table_name = 'Milestone';
            }
            if ($request->relation == 'media') {
                // $table_name = 'media_releases';
                $table_name = 'MediaRelease';
            }
            if ($request->relation == 'news') {
                // $table_name = 'whats_news';
                $table_name = 'WhatsNew';
            }
            if ($request->relation == 'award') {
                // $table_name = 'award_achievements';
                $table_name = 'AwardAchievements';
            }
            if ($request->relation == 'who') {
                // $table_name = 'whois';
                $table_name = 'Whois';
            }
            if ($request->relation == 'about') {
                // $table_name = 'unit_websites';
                $table_name = 'UnitWebsite';
            }
            if ($request->relation == 'contact') {
                // $table_name = 'unit_website_contact';
                $table_name = 'UnitWebsiteContact';
            }
            if ($request->relation == 'cmd_message') {
                // $table_name = 'cmd_messages';
                $table_name = 'CmdMessage';
            }
            if ($request->relation == 'download') {
                // $table_name = 'downloads';
                $table_name = 'Download';
            }
            if ($request->relation == 'quick') {
                // $table_name = 'quick_links';
                $table_name = 'QuickLink';
            }
            if ($request->relation == 'career') {
                // $table_name = 'careers';
                $table_name = 'Career';
            }
            if ($request->relation == 'library') {
                // $table_name = 'careers';
                $table_name = 'ELibrary';
            }
            if ($request->relation == 'tender') {
                // $table_name = 'careers';
                $table_name = 'Tender';
            }


            $entity = 'App\\Models\\' . $table_name;
            $up = $entity::find($request->relid)->update(['status' => '2', 'remarks' => $request->publish_time]);
            // $up =  DB::table($table_name)->where('id', $request->relid)->update(['status' => '2', 'remarks' => $request->publish_time]);
            if ($up) {
                return response()->json(['success' => true, 'msg' => 'Content Submitted For Review!!']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Data Error']);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Invalid OTP']);
        }
    }

    /***********************************************/
    public function cancelapproval(Request $request)
    {
        // dd($request->all());
        $check = Otp::where('otp_for', $request->relation)->where('otp', $request->otpval)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        if (!empty($check)) {
            if ($request->relation == 'slider_image') {
                $table_name = 'website_slider_images';
                $app_table_name = 'approved_website_slider_images';
                $col_name = 'slider_image_id';
            }
            if ($request->relation == 'poirti') {
                $table_name = 'rtis';
                $app_table_name = 'approved_rtis';
                $col_name = 'rti_id';
            }
            if ($request->relation == 'milestone') {
                $table_name = 'milestones';
                $app_table_name = 'approved_milestones';
                $col_name = 'milestone_id';
            }
            if ($request->relation == 'media') {
                $table_name = 'media_releases';
                $app_table_name = 'approved_media_releases';
                $col_name = 'media_release_id';
            }
            if ($request->relation == 'news') {
                $table_name = 'whats_news';
                $app_table_name = 'approved_whats_news';
                $col_name = 'news_id';
            }
            if ($request->relation == 'award') {
                $table_name = 'award_achievements';
                $app_table_name = 'approved_award_achievements';
                $col_name = 'award_id';
            }
            if ($request->relation == 'who') {
                $table_name = 'whois';
                $app_table_name = 'approved_whois';
                $col_name = 'who_id';
            }
            if ($request->relation == 'about') {
                $table_name = 'unit_websites';
                $app_table_name = 'approved_unit_websites';
                $col_name = 'website_id';
            }
            if ($request->relation == 'contact') {
                $table_name = 'unit_website_contact';
                $app_table_name = 'approved_website_contact';
                $col_name = 'contact_id';
            }

            if ($request->relation == 'cmd_message') {
                $table_name = 'cmd_messages';
                $app_table_name = 'approved_cmd_messages';
                $col_name = 'message_id';
            }

            if ($request->relation == 'download') {
                $table_name = 'downloads';
                $app_table_name = 'approved_downloads';
                $col_name = 'download_id';
            }
            if ($request->relation == 'quick') {
                $table_name = 'quick_links';
                $app_table_name = 'approved_quick_links';
                $col_name = 'quick_id';
            }
            if ($request->relation == 'career') {
                $table_name = 'careers';
                $app_table_name = 'approved_careers';
                $col_name = 'career_id';
            }

            if ($request->relation == 'library') {
                $table_name = 'e_libraries';
                $app_table_name = 'approved_e_libraries';
                $col_name = 'library_id';
            }

            if ($request->relation == 'tender') {
                $table_name = 'tenders';
                $app_table_name = 'approved_tenders';
                $col_name = 'tender_id';
            }

            $up =  DB::table($table_name)->where('id', $request->relid)->update(['status' => '4', 'remarks' => $request->publish_time]);

            $checkapproved = DB::table($app_table_name)->where($col_name, $request->relid)->first();
            if (!empty($checkapproved)) {
                $checkapproved = DB::table($app_table_name)->where($col_name, $request->relid)->update(['status' => '0']);
            }

            if ($up) {
                return response()->json(['success' => true, 'msg' => 'Content Approval Rejected!!']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Data Error']);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Invalid OTP']);
        }
    }
    /**********************************************/

    public function getproductunitpage($id)
    {
        $data = Crypt::decrypt($id);
        $unit_item = Unit::where('id', $data)->first();        
        $footer_content = DB::table('approved_website_contact')->where('unit_id', $data)->where('status', '1')->orderby('id', 'DESC')->first();
        $content = DB::table('approved_unit_websites')->where('unit_id', $data)->first();
        return view('productionunitpage', ['content' => $content, 'unit_item' => $unit_item,'footer_content' => $footer_content,'id' => $data]);
    }
    public function unitproductionpage(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $unit_item = Unit::where('id', $id)->first();
        $website_about = DB::table('unit_websites')->where('status', '1')->where('unit_id', $id)->orderby('id','DESC')->first();
        $website_product = DB::table('unit_products')->where('status', '1')->where('unit_id', $id)->get();
        $website_contact = DB::table('unit_website_contact')->where('status', '1')->where('unit_id', $id)->orderby('id','DESC')->first();
        $website_slider = DB::table('website_slider_images')->where('status', '1')->where('unit_id', $id)->orderby('id','DESC')->get();
        $website_manufacturing = DB::table('unit_manufacturing_facility')->where('status', '1')->where('unit_id', $id)->get();
    
        return view('productionunitpage')->with([
            'unit_item' => $unit_item,
            'website_about' => $website_about,
            'website_product' => $website_product,
            'website_contact' => $website_contact,
            'website_slider' => $website_slider,
            'website_manufacturing' => $website_manufacturing,
            'id' => $id 
        ]);
      
    }
    /**
     * Display the specified resource.
     */
    public function show(UnitWebsite $unitWebsite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitWebsite $unitWebsite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitWebsite $unitWebsite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitWebsite $unitWebsite)
    {
        //
    }

    public function getSliderImageHistory(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->_id);
            $page = WebsiteSliderImage::where('id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status' => 200,
                'msg' => $html
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'msg' => ''
            ]);
        }
    }

    public function getCmdMsgHistory(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->_id);
            $page = CmdMessage::where('id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status' => 200,
                'msg' => $html
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'msg' => ''
            ]);
        }
    }

    public function getMediaRealseHistory(Request $request) 
    {   
        try {
            $id = Crypt::decryptString($request->_id);
            $page = MediaRelease::where('id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status' => 200,
                'msg' => $html
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'msg' => ''
            ]);
        }
    }

    public function getWhatsNewHistory(Request $request) 
    {   
        try {
            $id = Crypt::decryptString($request->_id);
            $page = WhatsNew::where('id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status' => 200,
                'msg' => $html
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'msg' => ''
            ]);
        }
    }

    public function getAwardAchievementHistory(Request $request) 
    {   
        try {
            $id = Crypt::decryptString($request->_id);
            $page = AwardAchievements::where('id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status' => 200,
                'msg' => $html
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'msg' => ''
            ]);
        }
    }

    public function getMilestoneHistory(Request $request) 
    {   
        try {
            $id = Crypt::decryptString($request->_id);
            $page = Milestone::where('id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status' => 200,
                'msg' => $html
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'msg' => ''
            ]);
        }
    }

    public function getWebsiteAboutHistory(Request $request) 
    {   
        try {
            $id = Crypt::decryptString($request->_id);
            $page = UnitWebsite::where('id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status' => 200,
                'msg' => $html
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'msg' => ''
            ]);
        }
    }

    public function getWhosWhoHistory(Request $request) 
    {   
        try {
            $id = Crypt::decryptString($request->_id);
            $page = Whois::where('id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status' => 200,
                'msg' => $html
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'msg' => ''
            ]);
        }
    }

    public function getContactDetailHistory(Request $request) 
    {   
        try {
            $id = Crypt::decryptString($request->_id);
            $page = UnitWebsiteContact::where('id', $id)->first();
            $html = view('backend_component.get-history', ['page' => $page->audits ?? ''])->render();

            return response()->json([
                'status' => 200,
                'msg' => $html
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'msg' => ''
            ]);
        }
    }
}
