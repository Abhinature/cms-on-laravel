<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CapexReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UnitUserController;
use App\Http\Controllers\Admin\DynamicPageController;
use App\Http\Controllers\Admin\QuickLinkController;
use App\Http\Controllers\Admin\UnitWebsiteController;
use App\Http\Controllers\Admin\TenderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\CmdMessageController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\FinanceReportController;
use App\Http\Controllers\Admin\ELibraryController;
use App\Http\Controllers\Admin\SupplyReportController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\RtiController;
use App\Http\Controllers\Admin\DashboardSummaryController;
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\OtpController;

use App\Http\Controllers\Common;


use App\Http\Controllers\LanguageController;

use App\Models\UnitWebsite;
use App\Http\Middleware\{PasswordExpired, Authenticate, SetLocale};
use App\Models\FinanceReport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




$locale = Request::segment(1);

if (in_array($locale, Config::get('app.available_locales')) || $locale == '') {
    \App::setLocale($locale);
}


/********************************************** */
Route::post('unit-login',[UserController::class,'unitlogin'])->name('unit-login');
/********************************************** */
Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
Route::get('production-unit-page/{id}',[UnitWebsiteController::class,'getproductunitpage'])->name('production-unit-page');
// Route::get('production-unit-page/{id}',[UnitWebsiteController::class,'unitproductionpage'])->name('production-unit-page');

Route::middleware([Authenticate::class, PasswordExpired::class])->group(function(){

    Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /***************************************Units********************************************** */
    Route::get('/units',[UnitController::class,'index'])->name('units');
    Route::get('add-unit',[UnitController::class,'create'])->name('add-unit');
    Route::post('insertunit',[UnitController::class,'store'])->name('insertunit');
    Route::post('updateunit',[UnitController::class,'update'])->name('updateunit');
    Route::get('edit-unit/{id}',[UnitController::class,'edit'])->name('edit-unit');
    /***************************************End Units********************************************** */

    /*****************************************Users******************************************** */
    Route::get('/users',[UnitUserController::class,'index'])->name('users');
    Route::get('add-unit-user',[UnitUserController::class,'create'])->name('add-unit-user');
    Route::post('insertunituser',[UnitUserController::class,'store'])->name('insertunituser');
    Route::post('updateunituser',[UnitUserController::class,'update'])->name('updateunituser');
    Route::get('edit-unit-user/{id}',[UnitUserController::class,'edit'])->name('edit-unit-user');
    /*****************************************End Users******************************************** */

    /********************************************Pages**************************************************** */
    Route::get('/dynamic-pages',[DynamicPageController::class,'index'])->name('dynamic-pages');
    Route::get('add-page',[DynamicPageController::class,'create'])->name('add-page');
    Route::post('insertpage',[DynamicPageController::class,'store'])->name('insertpage');
    Route::post('updatepage',[DynamicPageController::class,'update'])->name('updatepage');
    Route::get('edit-page/{id}',[DynamicPageController::class,'edit'])->name('edit-dynamic-page');
    Route::get('submit-review/{id}',[DynamicPageController::class,'SubmitReview'])->name('submit-review');
    Route::get('dynamic-pages-review',[DynamicPageController::class,'DynamicPageForReview'])->name('dynamic-pages-review');

    Route::get('approve-page/{id}',[DynamicPageController::class,'ApprovePage'])->name('approve-page');
    Route::get('reject-page/{id}',[DynamicPageController::class,'RejectPage'])->name('reject-page');
    Route::get('publish-page/{id}',[DynamicPageController::class,'PublishPage'])->name('publish-page');
    Route::get('unpublish-page/{id}',[DynamicPageController::class,'UnPublishPage'])->name('unpublish-page');

    /*********************************************Unit Website************************************************************** */
    Route::get('unit-website/{tableName?}',[UnitWebsiteController::class,'index'])->name('unit-website');
    Route::post('save-unit-website',[UnitWebsiteController::class,'store'])->name('save-unit-website');
    Route::post('save-unit-contact',[UnitWebsiteController::class,'contactdetails'])->name('save-unit-contact');
    Route::post('add-unit-product',[UnitWebsiteController::class,'saveunitproduct'])->name('add-unit-product');
    Route::post('add-slider-image',[UnitWebsiteController::class,'savesliderimage'])->name('add-slider-image');
    Route::get('delete-slider-image/{id}',[UnitWebsiteController::class,'deletesliderimage'])->name('del-slider-image');
    Route::get('preview-slider-image',[UnitWebsiteController::class,'previewsliderimage'])->name('preview-slider-image');
    Route::post('add-manufacturing-facility',[UnitWebsiteController::class,'saveunitmanufacturingfacility'])->name('add-manufacturing-facility');
    Route::get('edit-unit-product/{id}',[UnitWebsiteController::class,'editunitproduct'])->name('edit-unit-product');
    Route::get('edit-unit-manu/{id}',[UnitWebsiteController::class,'editunitmanufacturing'])->name('edit-unit-manu');
    Route::get('edit-slide-image/{id}',[UnitWebsiteController::class,'editsliderimage'])->name('edit-slide-image');


    Route::post('update-unit-product',[UnitWebsiteController::class,'updateunitproduct'])->name('update-unit-product');
    Route::post('update-unit-manufacturing',[UnitWebsiteController::class,'updateunitmanufacturing'])->name('update-unit-manufacturing');
    Route::post('update-slider-image',[UnitWebsiteController::class,'updatesliderimage'])->name('update-slider-image');

    
    
    Route::get('review-website',[UnitWebsiteController::class,'reviewunitwebsite'])->name('review-website');
    Route::get('review-product',[UnitWebsiteController::class,'reviewunitproduct'])->name('review-product');
    Route::get('review-manufacturing',[UnitWebsiteController::class,'reviewunitmanufacturing'])->name('review-manufacturing');
    Route::get('approve-product/{id}',[UnitWebsiteController::class,'approveunitproduct'])->name('approve-product');
    
    Route::get('edit-milestone/{id}',[UnitWebsiteController::class,'editmilestone'])->name('edit-milestone');
    Route::get('preview-milestone',[FrontendController::class,'previewmilestone'])->name('preview-milestone');

    Route::get('preview-media',[FrontendController::class,'previewmedia'])->name('preview-media');
    Route::get('preview-whatsnew',[FrontendController::class,'previewwhatsnew'])->name('preview-whatsnew');
    Route::get('preview-award',[FrontendController::class,'previewaward'])->name('preview-award');
    Route::post('approve-slide-image',[UnitWebsiteController::class,'approveunitslideimage'])->name('approve-slide-image');
    Route::get('cmd-preview/{id}',[FrontendController::class,'previewcmd'])->name('cmd-preview');

    /**************************************************************add-milestone***************************************************************************/
    Route::post('add-milestone',[UnitWebsiteController::class,'addmilestone'])->name('add-milestone');
    Route::post('update-milestone',[UnitWebsiteController::class,'updatemilestone'])->name('update-milestone');
    Route::post('add-media-release',[UnitWebsiteController::class,'addmediarelease'])->name('add-media-release');
    Route::get('edit-media/{id}',[UnitWebsiteController::class,'editmedia'])->name('edit-media');
    Route::post('update-media-release',[UnitWebsiteController::class,'updatemediarelease'])->name('update-media-release');
    /**************************************************************add-milestone***************************************************************************/

    /**************************************************************add-what-new***************************************************************************/
    Route::post('add-what-new',[UnitWebsiteController::class,'addwhatnew'])->name('add-what-new');
    Route::post('update-what-new',[UnitWebsiteController::class,'updatewhatnew'])->name('update-what-new');
    Route::get('edit-what-new/{id}',[UnitWebsiteController::class,'editwhatnew'])->name('edit-what-new');
    /**************************************************************add-milestone***************************************************************************/
    /**************************************************************Award & Achievements********************************************************************/
    Route::post('add-award',[UnitWebsiteController::class,'addaward'])->name('add-award');
    Route::post('update-award',[UnitWebsiteController::class,'updateaward'])->name('update-award');
    Route::get('edit-award/{id}',[UnitWebsiteController::class,'editaward'])->name('edit-award');
    /***********************************************************************************************************************************************/
    /**************************************************************Who's Who********************************************************************/
    Route::post('add-who',[UnitWebsiteController::class,'addwho'])->name('add-who');
    Route::post('update-who',[UnitWebsiteController::class,'updatewho'])->name('update-who');
    Route::get('edit-who/{id}',[UnitWebsiteController::class,'editwho'])->name('edit-who');
    /***********************************************************************************************************************************************/
    // Route::get('production-unit-page/{id}',[UnitWebsiteController::class,'getproductunitpage'])->name('production-unit-page');
    /**************************************CMD Message********************************************* */
    Route::get('cmd-message',[CmdMessageController::class,'index'])->name('cmd-message');
    Route::view('add-cmd-message','cmd-message.add')->name('add-cmd-message');
    Route::post('save-cmd-message',[CmdMessageController::class,'savecmdmessage'])->name('save-cmd-message');
    Route::post('update-cmd-message',[CmdMessageController::class,'updatecmdmessage'])->name('update-cmd-message');
    Route::get('edit-cmd-message/{id}',[CmdMessageController::class,'editcmdmessage'])->name('edit-cmd-message');
    /************************************************************************************************************************************* */
    Route::post('update-rti-poi',[RtiController::class,'updatepoirti'])->name('update-rti-pio');
    

    /********************************************************************************************************************************************/
    /** Translation related changes */
    Route::controller(TranslationController::class)->as('translation.')->group(function(){
        Route::prefix('translation')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::get('add', 'add')->name('add');
            Route::post('save', 'save')->name('save');
            Route::post('update', 'update')->name('update');
        });
    });
    /** Translation related changes */

    /** Page Controller */
    Route::controller(PageController::class)->as('page.')->group(function(){
        Route::prefix('page')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('add', 'add')->name('add');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::get('get-page-history', 'getPageHistory')->name('get-page-history');
        });
    });
    /** End Page Controller */

    /** Dashboard realted  */
    Route::controller(DashboardSummaryController::class)->as('dashboard.')->group(function(){
        Route::get('pending', 'pending')->name('pending');
        Route::get('approve', 'approve')->name('approve');
        Route::get('reject', 'reject')->name('reject');
        Route::get('redirect-path/{tableName}', 'redirectPath')->name('redirectPath');
    });

    /** End Dashboard realted  */

    Route::post('sendotp',[OtpController::class,'sendotp'])->name('sendotp');
    Route::post('save-approval',[UnitWebsiteController::class,'saveapproval'])->name('save-approval');
    Route::post('save-reject',[UnitWebsiteController::class,'savereject'])->name('save-reject');
    Route::post('save-review',[UnitWebsiteController::class,'savereview'])->name('save-review');
    // Route::post('save-unit-approval', [UnitWebsiteController::class,'saveunitapproval'])->name('save-unit-approval');
    Route::post('cancel-approval',[UnitWebsiteController::class,'cancelapproval'])->name('cancel-approval');
    Route::post('save-change-approval',[UnitWebsiteController::class,'savechangeapproval'])->name('save-change-approval');

    // History Route
    Route::get('getSliderImageHistory', [UnitWebsiteController::class, 'getSliderImageHistory'])->name('getSliderImageHistory');
    Route::get('getMediaRealseHistory', [UnitWebsiteController::class, 'getMediaRealseHistory'])->name('getMediaRealseHistory');
    Route::get('getWhatsNewHistory', [UnitWebsiteController::class, 'getWhatsNewHistory'])->name('getWhatsNewHistory');
    Route::get('getAwardAchievementHistory', [UnitWebsiteController::class, 'getAwardAchievementHistory'])->name('getAwardAchievementHistory');
    Route::get('getMilestoneHistory', [UnitWebsiteController::class, 'getMilestoneHistory'])->name('getMilestoneHistory');
    Route::get('getWebsiteAboutHistory', [UnitWebsiteController::class, 'getWebsiteAboutHistory'])->name('getWebsiteAboutHistory');
    Route::get('getWhosWhoHistory', [UnitWebsiteController::class, 'getWhosWhoHistory'])->name('getWhosWhoHistory');
    Route::get('getContactDetailHistory', [UnitWebsiteController::class, 'getContactDetailHistory'])->name('getContactDetailHistory');



    /****************************************************************************************************************** */
   
    Route::get('submit-for-review/{id}/{tab}',[Common::class,'submitforreview'])->name('submitforsuperadmin');
    Route::get('edit-unit-about/{id}',[UnitWebsiteController::class,'editunitabout'])->name('editunitabout');
    Route::post('update-website-about',[UnitWebsiteController::class,'updateunitabout'])->name('update-website-about');
    Route::get('edit-unit-contact/{id}',[UnitWebsiteController::class,'editunitcontact'])->name('editunitcontact');
    Route::post('update-website-contact',[UnitWebsiteController::class,'updateunitcontact'])->name('update-website-contact');

    Route::get('rti',[RtiController::class,'index'])->name('rti');
    Route::post('add-rti-pio',[RtiController::class,'store'])->name('add-rti-pio');
    Route::get('edit-poi-rti/{id}',[UnitWebsiteController::class,'editpoirti'])->name('edit-poi-rti');
    Route::get('edit-mandatory/{id}',[UnitWebsiteController::class,'editmandatory'])->name('edit-mandatory');
    Route::post('update-rti-poi',[RtiController::class,'updatepoirti'])->name('update-rti-poi');
    Route::post('update-mandatory',[RtiController::class,'updatemandatory'])->name('update-mandatory');
    Route::post('save-mandatory-disclosure',[RtiController::class,'storedisclosure'])->name('save-mandatory-disclosure');

    /*********************************Start**Tender*28-4-2023*******************************/
    Route::get('tender',[TenderController::class,'index'])->name('tender');
    Route::post('add-tender',[TenderController::class,'store'])->name('add-tender');
    Route::get('edit-tender/{id}',[TenderController::class,'edit'])->name('edit-tender');
    Route::post('update-tender',[TenderController::class,'update'])->name('update-tender');
    /*********************************Start****End*28-4-2023*******************************/

    /***********Downloads*******/
    Route::get('downloads',[DownloadController::class,'index'])->name('download');
    Route::post('save-download',[DownloadController::class,'store'])->name('save-download');
    Route::get('edit-download/{id}',[DownloadController::class,'edit'])->name('edit-download');
    Route::post('update-download',[DownloadController::class,'update'])->name('update-download');
    /*******End Downloads*******/
    /***********Library*******/
    Route::get('library',[ELibraryController::class,'index'])->name('library');
    Route::post('save-library',[ELibraryController::class,'store'])->name('save-library');
    Route::get('edit-library/{id}',[ELibraryController::class,'edit'])->name('edit-library');
    Route::post('update-library',[ELibraryController::class,'update'])->name('update-library');
    /*******End Library*******/



    /******************************** */
    Route::get('quicklinks',[QuickLinkController::class,'index'])->name('quicklinks');
    Route::post('save-quicklinks',[QuickLinkController::class,'store'])->name('save-quicklinks');
    Route::get('edit-quick/{id}',[QuickLinkController::class,'edit'])->name('edit-quick');
    Route::post('update-quicklinks',[QuickLinkController::class,'update'])->name('update-quicklinks');

    /******************Career************** */
    Route::get('career',[CareerController::class,'index'])->name('career');
    Route::post('save-career',[CareerController::class,'store'])->name('save-career');
    Route::get('edit-career/{id}',[CareerController::class,'edit'])->name('edit-career');
    Route::post('update-career',[CareerController::class,'update'])->name('update-career');


/**********************************************Delete Content**********************************************/
Route::get('del-content/{id}/{rel}',[Common::class,'deleteContent'])->name('del-content');
/**************************************************Delete After Approval*************************************/
Route::get('request-for-delete/{rel}/{id}',[UnitWebsiteController::class,'DeleteRequestForApprovalContent'])->name('request-for-delete');
// Route::get('request-for-modify/{tab}/{id}',[UnitWebsiteController::class,'ModifyRequestForApprovalContent'])->name('request-for-modify');



    Route::get('request-for-delete-sent/{id}/{tab}',[Common::class,'sentDeleteRequestForApprovalContent'])->name('request-for-delete-sent');
    Route::post('save-delete-request',[UnitWebsiteController::class,'savedeleterequest'])->name('save-delete-request');
    // Route::get('save-delete-request/{id}/{id}',[Common::class,'saveDeleteRequestForApprovalContent'])->name('request-for-delete-sent');


    /**********************************************************************************************************/
    /**************************************Reports*********************************************************************/
    Route::get('budget',[FinanceReportController::class,'index'])->name('budget');
    Route::post('add-finance',[FinanceReportController::class,'store'])->name('add-finance');
    Route::get('edit-finance/{id}',[FinanceReportController::class,'edit'])->name('edit-finance');
    Route::post('update-finance',[FinanceReportController::class,'update'])->name('update-finance');
    Route::get('admin-reports',[AdminReportController::class,'index'])->name('admin-reports');
    Route::post('add-admin',[AdminReportController::class,'store'])->name('add-admin');
    Route::get('edit-admin/{id}',[AdminReportController::class,'edit'])->name('edit-admin');
    Route::post('update-admin',[AdminReportController::class,'update'])->name('update-admin');
    Route::post('add-supply-order',[SupplyReportController::class,'store'])->name('add-supply-order');
    Route::get('edit-supply-report/{id}',[SupplyReportController::class,'edit'])->name('edit-supply-report');
    Route::post('update-supply-report',[SupplyReportController::class,'update'])->name('update-supply-report');
    Route::get('get-report-supply', [SupplyReportController::class, 'export'])->name('get-report-supply');
    
    Route::post('add-capex-order',[CapexReportController::class,'store'])->name('add-capex-order');
    Route::get('edit-capex/{id}',[CapexReportController::class,'edit'])->name('edit-capex');
    Route::post('update-capex-report',[CapexReportController::class,'update'])->name('update-capex-report');
    Route::get('get-report-capex', [CapexReportController::class, 'export'])->name('get-report-capex');


    /********************************************************************************************************/
    Route::post('view-budget',[FinanceReportController::class,'viewbudgetreport'])->name('view-budget');
    Route::get('view-admin-reports',[AdminReportController::class,'viewreport'])->name('view-admin-reports');
    Route::post('search-admin-report',[AdminReportController::class,'searchadminreport'])->name('search-admin-report');

    Route::get('getCmdMsgHistory', [UnitWebsiteController::class, 'getCmdMsgHistory'])->name('getCmdMsgHistory');

    // password history
    Route::get('password-history', [UnitUserController::class, 'passHistory'])->name('passHistory');
});


// Route::get('/contact-form', [CaptchaServiceController::class, 'index']);
Route::post('/captcha-validation', [CaptchaServiceController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);

Route::get('unit-user-password', [UnitUserController::class, 'unitUserSignIn'])->name('unit-user-password');
Route::get('change-unit-password/{id}', [UnitUserController::class, 'changeUnitPassword'])->name('change-unit-password');
Route::post('change-unit-password-post', [UnitUserController::class, 'changeUnitPasswordPost'])->name('change-unit-password-post');

Route::get('/change-language/{locale}', [LanguageController::class, 'changeLanguage'])->name('changeLanguage');

Route::middleware([SetLocale::class])->group(function(){
    Route::prefix( app()->getLocale() )->group(function(){
        Route::controller(FrontendController::class)->as('front.')->group(function(){
            Route::any('/', 'index')->name('index');
            Route::any('list-of-cpios', 'listOfCpios')->name('list-of-cpios');
            Route::any('career', 'career')->name('career');
            Route::any('open-tenders', 'openTenders')->name('open-tenders');
            Route::any('closed-tenders', 'closedTenders')->name('closed-tenders');
            Route::any('mandatory-disclosures', 'mandatoryDisclosures')->name('mandatory-disclosures');
            Route::any('contact-details','contactdetails')->name('contact-details');
            Route::get('production-units',[Common::class,'productionpage'])->name('production-units');
            Route::get('list-whois-who',[Common::class,'getwhoiswho'])->name('list-whois-who');
            Route::get('yil-products',[Common::class,'getyilproducts'])->name('yil-products');
            Route::get('about-yil',[Common::class,'getaboutyil'])->name('about-yil');
            Route::get('about-preview/{id}/{unit_id}',[Common::class,'aboutpreview'])->name('about-preview');
            Route::get('vigilance',[Common::class,'getvigilance'])->name('vigilance');
            Route::get('iem',[Common::class,'getiem'])->name('iem');
            Route::get('directory',[Common::class,'getdirectory'])->name('directory');
            Route::get('download',[Common::class,'getdownload'])->name('download');
            Route::get('e-library',[Common::class,'getelibrarydata'])->name('elib');
            Route::get('production-unit-product/{id}',[Common::class,'getproductionunitproduct'])->name('production-unit-product');
            Route::get('production-unit-manufacturing/{id}',[Common::class,'getproductionunitmanufacturing'])->name('production-unit-manufacturing');
            Route::get('production-unit-contact/{id}',[Common::class,'getproductionunitcontact'])->name('production-unit-contact');
            Route::get('{slug}', 'findBySlug')->name('findBySlug');

        });
    });
});

// Route::controller(TranslationController::class)->as('translation.')->group(function(){
//     Route::get('translation', 'index');
// });

// Route::post('sendotp',[OtpController::class,'sendotp'])->name('sendotp');
// Route::post('save-approval',[UnitWebsiteController::class,'saveapproval'])->name('save-approval');
// Route::post('save-reject',[UnitWebsiteController::class,'savereject'])->name('save-reject');
// Route::post('save-review',[UnitWebsiteController::class,'savereview'])->name('save-review');
// // Route::post('save-unit-approval', [UnitWebsiteController::class,'saveunitapproval'])->name('save-unit-approval');
// Route::post('cancel-approval',[UnitWebsiteController::class,'cancelapproval'])->name('cancel-approval');
// Route::post('save-change-approval',[UnitWebsiteController::class,'savechangeapproval'])->name('save-change-approval');
// Admin routes
//23march2023








