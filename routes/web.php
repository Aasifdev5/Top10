<?php

use App\Exports\ProductsExport;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\HomeSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LocationController;

use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Admin\SubcategoryController;

use App\Http\Controllers\Admin\SupportTicketController;

use App\Http\Controllers\Admin\TagController;

use App\Http\Controllers\Admin\TaxController;

use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmailAppController;
use App\Http\Controllers\FacebookSocialiteController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\InvoiceController;

use App\Http\Controllers\MailTemplateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Pages;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ScreenTimeController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Middleware\InactivityTimeout;
use App\Http\Middleware\SetLocale;
use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/forget_password', [UserController::class, 'forget_password'])->name('forget_password');

Route::post('/forget_mail', [UserController::class, 'forget_mail'])->name('forget_mail');
Route::post('/sendResetPasswordLink', [UserController::class, 'sendResetPasswordLink'])->name('sendResetPasswordLink');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/ResetPasswordLoad', [UserController::class, 'ResetPasswordLoad'])->name('ResetPasswordLoad');
Route::post('/ResetPassword', [UserController::class, 'ResetPassword'])->name('ResetPassword');



Route::group(['middleware' => ['prevent-back-history', SetLocale::class]], function () {

    Route::get('/', [UserController::class, 'home'])->name('home');
    Route::get('/local/{ln}', function ($ln) {
        return redirect()->back()->with('local', $ln);
    });

    Route::get('Userlogin', [UserController::class, 'Userlogin'])->name('Userlogin');
    Route::get('provider-signup', [UserController::class, 'providerSignup'])->name('providerSignup');
    Route::get('user-signup', [UserController::class, 'userSignup'])->name('userSignup');
    Route::get('choose-signup', [UserController::class, 'chooseSignup'])->name('chooseSignup');
    Route::get('getProducts', [UserController::class, 'getProducts'])->name('getProducts');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('isLoggedIn');
    Route::get('/provider-dashboard', [UserController::class, 'ProviderDashboard'])->name('ProviderDashboard')->middleware('isLoggedIn');
    Route::post('/ProjectStore', [UserController::class, 'ProjectStore'])->name('ProjectStore');
    Route::get('services', [UserController::class, 'services'])->name('services');
    Route::get('service-details', [UserController::class, 'ServiceDetails'])->name('ServiceDetails');
    Route::get('blog', [UserController::class, 'blog'])->name('blog');
    Route::get('about', [UserController::class, 'about'])->name('about');
    Route::get('contact', [UserController::class, 'contact'])->name('contact');
    Route::get('blog-details', [UserController::class, 'BlogDetails'])->name('BlogDetails');
    Route::post('/post-insert', [UserController::class, 'Ad_insert'])->name('Ad_insert')->middleware('isLoggedIn');
    Route::get('/back/{id}', [UserController::class, 'back'])->name('back')->middleware('isLoggedIn');
    Route::get('address', [UserController::class, 'address'])->name('address')->middleware('isLoggedIn');
    Route::get('create-service', [UserController::class, 'CreateService'])->name('CreateService')->middleware('isLoggedIn');
    Route::post('/StoreService', [UserController::class, 'StoreService'])->name('StoreService');
    Route::get('/change_password', [UserController::class, 'change_password'])->name('change_password')->middleware('isLoggedIn');
    Route::post('/update_password', [UserController::class, 'update_password'])->name('update_password');
    Route::get('/edit_profile', [UserController::class, 'edit_profile'])->middleware('isLoggedIn');
    Route::post('update_profile', [UserController::class, 'update_profile']);
    Route::get('addToCart/{price}/{id}/{quantity}', [UserController::class, 'addToCart'])->name('addToCart');
    Route::get('BuyaddToCart/{price}/{id}/{quantity}', [UserController::class, 'BuyaddToCart'])->name('BuyaddToCart');
    Route::post('/update-quantity', [UserController::class, 'updateQuantity']);
    Route::get('RemoveCart/{id}', [UserController::class, 'removeCart'])->name('remove.cart');
    Route::get('cart', [UserController::class, 'cart'])->name('cart');
    Route::get('/finish', [UserController::class, 'finish'])->name('finish')->middleware('isLoggedIn');
    Route::get('/userNotifications', [UserController::class, 'userNotifications'])->name('userNotifications');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/messages', [ChatController::class, 'getChatMessages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendChatMessage'])->name('chat.send');
    Route::post('/like', [UserController::class, 'storeLikes'])->name('like');
    Route::post('checkLike', [UserController::class, 'checkLike'])->name('checkLike');
    Route::get('checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::post('/billing', [UserController::class, 'Billingstore'])->name('billing.store');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/success', function () {
        return view('success');
    })->name('order.success');
    Route::get('/invoice/{id}', [InvoiceController::class,'generateInvoice'])->name('invoice.generate');
    Route::get('/get-subcategories/{categoryId}', [UserController::class, 'getSubcategories']);

    Route::get('/news-category/{id}', [UserController::class, 'news_category'])->name('news_category');
    Route::get('/provider-edit-service/{id}', [UserController::class, 'ProviderEditService'])->name('ProviderEditService');
    Route::post('/updateService', [UserController::class, 'updateService'])->name('updateService');
    Route::get('/provider-services', [UserController::class, 'service'])->name('service');
    Route::get('/provider-services-list', [UserController::class, 'ServiceList'])->name('ServiceList');
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('addToWishlist/{price}/{id}', [UserController::class, 'addToWishlist'])->name('addToWishlist');
    Route::get('RemoveWish/{id}', [UserController::class, 'RemoveWish'])->name('remove.wish');
    Route::get('/MyOrders', [UserController::class, 'MyOrders'])->name('MyOrders')->middleware('isLoggedIn');
    Route::post('pay_credit/{id}', [UserController::class, 'pay_credit'])->name('pay_credit')->middleware('isLoggedIn');
    Route::get('page/{slug}', [Pages::class, 'get_page']);
    Route::post('contact_send', [Pages::class, 'contact_send']);
    Route::get('/edit_project/{id}', [UserController::class, 'edit_project'])->name('edit_project')->middleware('isLoggedIn');
    Route::post('/update_project', [UserController::class, 'update_project'])->name('update_project');
    Route::get('/Delete_project/{id}', [UserController::class, 'Delete_project'])->name('Delete_project');
    Route::get('/news', [UserController::class, 'news'])->name('news');
    Route::get('/Details', [UserController::class, 'Details'])->name('Details')->middleware('isLoggedIn');
    Route::get('/product-details/{slug}', [UserController::class, 'ProductDetail'])->name('ProductDetail')->middleware('isLoggedIn');
    Route::get('/productbybrand/{id}', [UserController::class, 'productbybrand'])->name('productbybrand')->middleware('isLoggedIn');
    Route::get('/productbyCategory/{id}', [UserController::class, 'productbyCategory'])->name('productbyCategory')->middleware('isLoggedIn');
    Route::get('/productbySubCategory/{category}/{subcategory}', [UserController::class, 'productbySubCategory'])->name('productbySubCategory')->middleware('isLoggedIn');
    Route::get('/productbyChildCategory/{category}/{subcategory}/{childcategory}', [UserController::class, 'productbyChildCategory'])->name('productbyChildCategory')->middleware('isLoggedIn');
    Route::post('/update-logout-time', [UserController::class, 'updateLogoutTime'])->name('update.logout.time');


    Route::get('/CreateProject', [UserController::class, 'CreateProject'])->name('CreateProject')->middleware('isLoggedIn');
    Route::get('/signup', [UserController::class, 'signup'])->name('signup')->middleware('alreadyLoggedIn');

    Route::get('/Userlogin', [UserController::class, 'Userlogin'])->name('Userlogin')->middleware('alreadyLoggedIn');
});

Route::post('/reg', [UserController::class, 'registration']);
Route::post('/preg', [UserController::class, 'pregistration']);
Route::post('/log', [UserController::class, 'login'])->name('login');


Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/blog_details/{id}', [UserController::class, 'blog_details'])->name('blog_details');

Route::get('/projects', [UserController::class, 'projects'])->name('projects');
Route::post('blog-comment', [UserController::class, 'blogCommentStore'])->name('blog-comment.store');
Route::post('blog-comment-reply', [UserController::class, 'blogCommentReplyStore'])->name('blog-comment-reply.store');
Route::get('search-blog-list', [UserController::class, 'searchBlogList'])->name('search-blog.list');
Route::get('/project_category/{category}', [UserController::class, 'project_category'])->name('project_category');
Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->name('verification.verify');



Route::get('/get-states', [UserController::class, 'getStates'])->name('get-states');
Route::get('/get-cities', [UserController::class, 'getCities'])->name('get-cities');

// routes/web.php
Route::get('/payments/data', [Admin::class, 'getPaymentData'])->name('payments.data');
Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin-prevent-back-history', SetLocale::class], function () {
        Route::resource('banners', BannerController::class)->names('admin.banners');

        Route::get('/local/{ln}', function ($ln) {
            $language = Language::where('iso_code', $ln)->first();
            if (!$language) {
                $language = Language::where('default_language', 'on')->first();
                if (!$language) {
                    $language = Language::find(1);
                }
                $ln = $language->iso_code;
            }

            session(['local' => $ln]);
            App::setLocale($ln);
            return redirect()->back();
        });
        Route::get('/getOrderDetails/{orderId}', [Admin::class, 'getOrderDetails'])->name('getOrderDetails');
        Route::get('/filter-products',[UserController::class, 'filterProducts']);
        Route::get('permissions/index', [Admin::class, 'Plist'])->name('permissions.index');
        Route::get('permissions/create', [Admin::class, 'Pcreate'])->name('permissions.create');
        Route::post('permissions', [Admin::class, 'Pstore'])->name('permissions.store');
        Route::get('permissions/{id}/edit', [Admin::class, 'Pedit'])->name('permissions.edit');
        Route::put('permissions/{id}', [Admin::class, 'Pupdate'])->name('permissions.update');
        Route::delete('/permission/{id}', [Admin::class, 'pdestroy'])->name('permissions.delete');
        Route::get('/tracked-times', [ScreenTimeController::class, 'index'])->name('tracked.times');


        Route::get('/qrcode', [QRCodeController::class, 'index'])->name('qrcode.index');
        Route::get('/destroy_qrcode/{id}', [QRCodeController::class, 'destroy'])->name('destroy');
        Route::post('/qrcode/generate', [QRCodeController::class, 'generateQrCode'])->name('qrcode.generate');
        Route::get('/qrcode/download/{data}', [QRCodeController::class, 'downloadQrCode'])->name('qrcode.download');
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            //Start:: General Settings
            Route::get('general-settings', [SettingController::class, 'GeneralSetting'])->name('general_setting');
            Route::post('general-settings-update', [SettingController::class, 'GeneralSettingUpdate'])->name('general_setting.cms.update');

            Route::get('metas', [SettingController::class, 'metaIndex'])->name('meta.index');
            Route::get('meta/edit/{uuid}', [SettingController::class, 'editMeta'])->name('meta.edit');
            Route::post('meta/update/{uuid}', [SettingController::class, 'updateMeta'])->name('meta.update');

            // Route::get('site-share-content', [SettingController::class, 'siteShareContent'])->name('site-share-content');
            Route::get('map-api-key', [SettingController::class, 'mapApiKey'])->name('map-api-key');



            //Start:: Device Control Mode
            Route::get('device-control-changes', [SettingController::class, 'deviceControl'])->name('device_control');
            Route::post('device-control-changes', [SettingController::class, 'deviceControlChange'])->name('device_control.change');
            //End:: Device Control Mode


            //Start:: Social Login Settings
            Route::get('social-login-settings', [SettingController::class, 'socialLoginSettings'])->name('social-login-settings');
            Route::post('social-settings-update', [SettingController::class, 'socialLoginSettingsUpdate'])->name('social-login-settings.update');



            //Start:: Currency Settings
            Route::group(['prefix' => 'currency', 'as' => 'currency.'], function () {
                Route::get('', [CurrencyController::class, 'index'])->name('index');
                Route::post('currency', [CurrencyController::class, 'store'])->name('store');
                Route::get('edit/{id}/{slug?}', [CurrencyController::class, 'edit'])->name('edit');
                Route::patch('update/{id}', [CurrencyController::class, 'update'])->name('update');
                Route::get('delete/{id}', [CurrencyController::class, 'delete'])->name('delete');
            });

            //Start:: Home Settings
            Route::get('theme-settings', [HomeSettingController::class, 'themeSettings'])->name('theme-setting');
            Route::get('section-settings', [HomeSettingController::class, 'sectionSettings'])->name('section-settings');
            Route::post('sectionSettingsStatusChange', [HomeSettingController::class, 'sectionSettingsStatusChange'])->name('sectionSettingsStatusChange');
            Route::get('banner-section-settings', [HomeSettingController::class, 'bannerSection'])->name('banner-section');
            Route::post('banner-section-settings', [HomeSettingController::class, 'bannerSectionUpdate'])->name('banner-section.update');
            Route::get('special-feature-section-settings', [HomeSettingController::class, 'specialFeatureSection'])->name('special-feature-section');
            Route::get('course-section-settings', [HomeSettingController::class, 'courseSection'])->name('course-section');
            Route::get('category-course-section-settings', [HomeSettingController::class, 'categoryCourseSection'])->name('category-course-section');
            Route::get('upcoming-course-section-settings', [HomeSettingController::class, 'upcomingCourseSection'])->name('upcoming-course-section');
            Route::get('product-section-settings', [HomeSettingController::class, 'productSection'])->name('product-section');
            Route::get('bundle-course-section-settings', [HomeSettingController::class, 'bundleCourseSection'])->name('bundle-course-section');
            Route::get('top-category-section-settings', [HomeSettingController::class, 'topCategorySection'])->name('top-category-section');

            Route::get('customer-say-section-settings', [HomeSettingController::class, 'customerSaySection'])->name('customer-say-section');
            Route::get('achievement-section-settings', [HomeSettingController::class, 'achievementSection'])->name('achievement-section');
            //End:: Home Settings

            //Start:: Mail Config
            Route::get('mail-configuration', [SettingController::class, 'mailConfiguration'])->name('mail-configuration');
            Route::post('send-test-mail', [SettingController::class, 'sendTestMail'])->name('send.test.mail');
            Route::post('save-setting', [SettingController::class, 'saveSetting'])->name('save.setting');
            //End:: Mail Config



            //Start:: FAQ Question & Answer
            Route::get('faq-settings', [SettingController::class, 'faqCMS'])->name('faq.cms');
            Route::get('faq-tab', [SettingController::class, 'faqTab'])->name('faq.tab');
            Route::get('faq-question-settings', [SettingController::class, 'faqQuestion'])->name('faq.question');
            Route::post('faq-question-settings', [SettingController::class, 'faqQuestionUpdate'])->name('faq.question.update');
            //End:: FAQ Question & Answer

            //Start:: Support Ticket
            Route::group(['prefix' => 'support-ticket', 'as' => 'support-ticket.'], function () {
                Route::get('/', [SettingController::class, 'supportTicketCMS'])->name('cms');
                Route::get('question-answer', [SettingController::class, 'supportTicketQuesAns'])->name('question');
                Route::post('question-answer', [SettingController::class, 'supportTicketQuesAnsUpdate'])->name('question.update');
                Route::post('questionAnsDelete', [SettingController::class, 'questionAnsDelete'])->name('questionAnsDelete');

                Route::get('department', [SupportTicketController::class, 'Department'])->name('department');
                Route::post('department', [SupportTicketController::class, 'DepartmentStore'])->name('department.store');
                Route::delete('department-delete/{uuid}', [SupportTicketController::class, 'departmentDelete'])->name('department.delete');

                Route::get('priority', [SupportTicketController::class, 'Priority'])->name('priority');
                Route::post('priority', [SupportTicketController::class, 'PriorityStore'])->name('priority.store');
                Route::delete('priorities-delete/{uuid}', [SupportTicketController::class, 'priorityDelete'])->name('priority.delete');

                Route::get('services', [SupportTicketController::class, 'RelatedService'])->name('services');
                Route::post('services', [SupportTicketController::class, 'RelatedServiceStore'])->name('services.store');
                Route::delete('services-delete/{uuid}', [SupportTicketController::class, 'relatedServiceDelete'])->name('services.delete');
            });
            //End:: Support Ticket

            // Start:: Contact Us
            Route::get('contact-us-cms', [ContactUsController::class, 'contactUsCMS'])->name('contact.cms');
            // End:: Contact Us

            Route::get('payment-method', [SettingController::class, 'paymentMethod'])->name('payment_method_settings');

            //start:: Bank
            Route::group(['prefix' => 'bank'], function () {
                Route::get('/', [BankController::class, 'index'])->name('bank.index');
                Route::post('/store', [BankController::class, 'store'])->name('bank.store');
                Route::get('/edit/{id}', [BankController::class, 'edit'])->name('bank.edit');
                Route::patch('/update/{id}', [BankController::class, 'update'])->name('bank.update');
                Route::get('/status/{id}', [BankController::class, 'status'])->name('bank.status');
                Route::delete('delete/{id}', [BankController::class, 'delete'])->name('bank.delete');
            });

            // Start:: About Us
            Route::group(['prefix' => 'about', 'as' => 'about.'], function () {
                Route::get('about-us-gallery-area', [AboutUsController::class, 'galleryArea'])->name('gallery-area');
                Route::post('about-us-gallery-area', [AboutUsController::class, 'galleryAreaUpdate'])->name('gallery-area.update');

                Route::get('about-us-our-history', [AboutUsController::class, 'ourHistory'])->name('our-history');
                Route::post('about-us-our-history', [AboutUsController::class, 'ourHistoryUpdate'])->name('our-history.update');
                Route::post('historyDelete', [AboutUsController::class, 'historyDelete'])->name('historyDelete');

                Route::get('about-us-upgrade-skill', [AboutUsController::class, 'upgradeSkill'])->name('upgrade-skill');
                Route::post('about-us-upgrade-skill', [AboutUsController::class, 'upgradeSkillUpdate'])->name('upgrade-skill.update');

                Route::get('about-us-team-member', [AboutUsController::class, 'teamMember'])->name('team-member');
                Route::post('about-us-team-member', [AboutUsController::class, 'teamMemberUpdate'])->name('team-member.update');
                Route::post('memberDelete', [AboutUsController::class, 'memberDelete'])->name('memberDelete');

                Route::get('about-us-client', [AboutUsController::class, 'client'])->name('client');
                Route::post('about-us-client', [AboutUsController::class, 'clientUpdate'])->name('client.update');
                Route::post('clientDelete', [AboutUsController::class, 'clientDelete'])->name('clientDelete');
            });
            // End:: About Us
            Route::group(['prefix' => 'locations', 'as' => 'location.'], function () {
                Route::get('country', [LocationController::class, 'countryIndex'])->name('country.index');
                Route::post('country', [LocationController::class, 'countryStore'])->name('country.store');
                Route::get('country/{id}/{slug?}', [LocationController::class, 'countryEdit'])->name('country.edit');
                Route::patch('country/{id}', [LocationController::class, 'countryUpdate'])->name('country.update');
                Route::delete('country/delete/{id}', [LocationController::class, 'countryDelete'])->name('country.delete');

                Route::get('state', [LocationController::class, 'stateIndex'])->name('state.index');
                Route::post('state', [LocationController::class, 'stateStore'])->name('state.store');
                Route::get('state/{id}/{slug?}', [LocationController::class, 'stateEdit'])->name('state.edit');
                Route::patch('state/{id}', [LocationController::class, 'stateUpdate'])->name('state.update');
                Route::delete('state/delete/{id}', [LocationController::class, 'stateDelete'])->name('state.delete');

                Route::get('city', [LocationController::class, 'cityIndex'])->name('city.index');
                Route::post('city', [LocationController::class, 'cityStore'])->name('city.store');
                Route::get('city/{id}/{slug?}', [LocationController::class, 'cityEdit'])->name('city.edit');
                Route::patch('city/{id}', [LocationController::class, 'cityUpdate'])->name('city.update');
                Route::delete('city/delete/{id}', [LocationController::class, 'cityDelete'])->name('city.delete');
            });
        });
        Route::get('notification-url/{uuid}', [Admin::class, 'notificationUrl'])->name('notification.url');
        Route::post('mark-all-as-read', [Admin::class, 'markAllAsReadNotification'])->name('notification.all-read');
        Route::prefix('language')->group(function () {
            Route::get('/', [LanguageController::class, 'index'])->name('language.index')->middleware('AdminIsLoggedIn');
            Route::get('create', [LanguageController::class, 'create'])->name('language.create')->middleware('AdminIsLoggedIn');
            Route::post('store', [LanguageController::class, 'store'])->name('language.store');
            Route::get('edit/{id}/{iso_code?}', [LanguageController::class, 'edit'])->name('language.edit')->middleware('AdminIsLoggedIn');
            Route::post('update/{id}', [LanguageController::class, 'update'])->name('language.update');
            Route::get('translate/{id}', [LanguageController::class, 'translateLanguage'])->name('language.translate')->middleware('AdminIsLoggedIn');
            Route::post('update-translate/{id}', [LanguageController::class, 'updateTranslate'])->name('update.translate');
            Route::get('delete/{id}', [LanguageController::class, 'delete'])->name('language.delete');
            Route::post('import', [LanguageController::class, 'import'])->name('language.import');
            Route::post('update-language/{id}', [LanguageController::class, 'updateLanguage'])->name('update-language');
        });

        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('index')->middleware('AdminIsLoggedIn');
            Route::get('create', [RoleController::class, 'create'])->name('create')->middleware('AdminIsLoggedIn');
            Route::post('store', [RoleController::class, 'store'])->name('store');
            Route::get('edit/{id}', [RoleController::class, 'edit'])->name('edit')->middleware('AdminIsLoggedIn');
            Route::post('update/{id}', [RoleController::class, 'update'])->name('update');
            Route::get('delete/{id}', [RoleController::class, 'delete'])->name('delete');
        });
        Route::prefix('tag')->group(function () {
            Route::get('/', [TagController::class, 'index'])->name('tag.index')->middleware('AdminIsLoggedIn');
            Route::get('create', [TagController::class, 'create'])->name('tag.create')->middleware('AdminIsLoggedIn');
            Route::post('store', [TagController::class, 'store'])->name('tag.store');
            Route::get('edit/{uuid}', [TagController::class, 'edit'])->name('tag.edit')->middleware('AdminIsLoggedIn');
            Route::patch('update/{uuid}', [TagController::class, 'update'])->name('tag.update');
            Route::get('delete/{uuid}', [TagController::class, 'delete'])->name('tag.delete');
        });
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index')->middleware('AdminIsLoggedIn');
            Route::get('create', [CategoryController::class, 'create'])->name('category.create')->middleware('AdminIsLoggedIn');
            Route::post('store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('AdminIsLoggedIn');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        });
        Route::prefix('subcategory')->group(function () {
            Route::get('/', [SubcategoryController::class, 'index'])->name('subcategory.index');
            Route::get('create', [SubcategoryController::class, 'create'])->name('subcategory.create');
            Route::post('store', [SubcategoryController::class, 'store'])->name('subcategory.store');
            Route::get('edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
            Route::post('update/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
            Route::delete('delete/{id}', [SubcategoryController::class, 'delete'])->name('subcategory.delete');
        });
        Route::prefix('brands')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('brands.index')->middleware('AdminIsLoggedIn');
            Route::get('create', [BrandController::class, 'create'])->name('brands.create')->middleware('AdminIsLoggedIn');
            Route::post('store', [BrandController::class, 'store'])->name('brands.store');
            Route::get('edit/{uuid}', [BrandController::class, 'edit'])->name('brands.edit')->middleware('AdminIsLoggedIn');
            Route::post('update/{uuid}', [BrandController::class, 'update'])->name('brands.update');
            Route::get('delete/{uuid}', [BrandController::class, 'delete'])->name('brands.delete');
        });


        Route::prefix('tax')->group(function () {
            Route::get('/', [TaxController::class, 'index'])->name('tax.index')->middleware('AdminIsLoggedIn');
            Route::get('create', [TaxController::class, 'create'])->name('tax.create')->middleware('AdminIsLoggedIn');
            Route::post('store', [TaxController::class, 'store'])->name('tax.store');
            Route::get('edit/{uuid}', [TaxController::class, 'edit'])->name('tax.edit')->middleware('AdminIsLoggedIn');
            Route::post('update/{uuid}', [TaxController::class, 'update'])->name('tax.update');
            Route::get('delete/{uuid}', [TaxController::class, 'delete'])->name('tax.delete');
        });


        //Download Sample
        Route::get('/download-sample-file', function () {
            $file = public_path('products.xlsx');
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];
            $fileName = 'products.xlsx';

            return response()->download($file, $fileName, $headers);
        })->name('download.sample.file');

        Route::post('track-time', [ScreenTimeController::class, 'trackTime'])->name('track.time');


        Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
            Route::get('/', [BlogController::class, 'index'])->name('index')->middleware('AdminIsLoggedIn');
            Route::get('create', [BlogController::class, 'create'])->name('create')->middleware('AdminIsLoggedIn');
            Route::post('store', [BlogController::class, 'store'])->name('store');
            Route::get('edit/{uuid}', [BlogController::class, 'edit'])->name('edit')->middleware('AdminIsLoggedIn');
            Route::post('update/{uuid}', [BlogController::class, 'update'])->name('update');
            Route::get('delete/{uuid}', [BlogController::class, 'delete'])->name('delete');
            Route::get('blog-comment-list', [BlogController::class, 'blogCommentList'])->name('blog-comment-list')->middleware('AdminIsLoggedIn');
            Route::post('change-blog-comment-status', [BlogController::class, 'changeBlogCommentStatus'])->name('changeBlogCommentStatus');
            Route::get('blog-comment-delete/{id}', [BlogController::class, 'blogCommentDelete'])->name('blogComment.delete');

            Route::get('blog-category-index', [BlogCategoryController::class, 'index'])->name('blog-category.index')->middleware('AdminIsLoggedIn');
            Route::post('blog-category-store', [BlogCategoryController::class, 'store'])->name('blog-category.store');
            Route::patch('blog-category-update/{uuid}', [BlogCategoryController::class, 'update'])->name('blog-category.update');
            Route::get('blog-category-delete/{uuid}', [BlogCategoryController::class, 'delete'])->name('blog-category.delete');
        });



        Route::get('login', [Admin::class, 'admin'])->name('admin')->middleware('AdminAlreadyLoggedIn');


        Route::get('dashboard', [Admin::class, 'dashboard'])->name('dashboard')->middleware('AdminIsLoggedIn');
        Route::get('/add_category', [Admin::class, 'add_category'])->name('add_category')->middleware('AdminIsLoggedIn');
        Route::post('/save_category', [Admin::class, 'save_category'])->name('save_category')->middleware('AdminIsLoggedIn');
        Route::get('/edit_profile', [Admin::class, 'edit_profile'])->name('edit_profile')->middleware('AdminIsLoggedIn');
        Route::post('update_profile', [Admin::class, 'update_profile'])->name('update_profile')->middleware('AdminIsLoggedIn');
        Route::get('/smtp_setting', [Admin::class, 'smtp_setting'])->name('smtp_setting')->middleware('AdminIsLoggedIn');
        Route::post('/update_smtp_setting', [Admin::class, 'update_smtp_setting'])->name('update_smtp_setting')->middleware('AdminIsLoggedIn');
        Route::get('/website_setting', [Admin::class, 'website_setting'])->name('website_setting')->middleware('AdminIsLoggedIn');
        Route::post('/update_general_settings', [Admin::class, 'update_general_settings'])->name('update_general_settings')->middleware('AdminIsLoggedIn');

        Route::get('/add-service', [Admin::class, 'AddService'])->name('AddService')->middleware('AdminIsLoggedIn');
        Route::post('/update_service', [Admin::class, 'update_service'])->name('update_service')->middleware('AdminIsLoggedIn');
        Route::get('/services', [Admin::class, 'services'])->name('services')->middleware('AdminIsLoggedIn');
        Route::post('/save_service', [Admin::class, 'save_service'])->name('save_service')->middleware('AdminIsLoggedIn');
        Route::get('/Delete_service', [Admin::class, 'Delete_service'])->name('Delete_service')->middleware('AdminIsLoggedIn');
        Route::get('/edit_service', [Admin::class, 'edit_service'])->name('edit_service')->middleware('AdminIsLoggedIn');
        Route::get('/change_password', [Admin::class, 'change_password'])->name('change_password')->middleware('AdminIsLoggedIn');
        Route::post('/update_password', [Admin::class, 'update_password'])->name('update_password')->middleware('AdminIsLoggedIn');
        Route::get('/social_lite_login', [Admin::class, 'social_lite_login'])->name('social_lite_login');
        Route::post('/update_social_login_settings', [Admin::class, 'update_social_login_settings'])->name('update_social_login_settings')->middleware('AdminIsLoggedIn');
        Route::get('payment_gateway', [Admin::class, 'list'])->middleware('AdminIsLoggedIn');
        Route::get('payment_gateway/edit/{id}', [Admin::class, 'edit'])->middleware('AdminIsLoggedIn');
        Route::post('paypal', [Admin::class, 'paypal'])->middleware('AdminIsLoggedIn');
        Route::post('payment_gateway/stripe', [Admin::class, 'stripe'])->middleware('AdminIsLoggedIn');
        Route::post('payment_gateway/razorpay', [Admin::class, 'razorpay'])->middleware('AdminIsLoggedIn');
        Route::post('payment_gateway/paystack', [Admin::class, 'paystack'])->middleware('AdminIsLoggedIn');
        Route::post('payment_gateway/instamojo', [Admin::class, 'instamojo'])->middleware('AdminIsLoggedIn');
        Route::post('payment_gateway/payu', [Admin::class, 'payu'])->middleware('AdminIsLoggedIn');
        Route::post('payment_gateway/mollie', [Admin::class, 'mollie'])->middleware('AdminIsLoggedIn');
        Route::post('payment_gateway/flutterwave', [Admin::class, 'flutterwave'])->middleware('AdminIsLoggedIn');
        Route::post('payment_gateway/paytm', [Admin::class, 'paytm'])->middleware('AdminIsLoggedIn');
        Route::post('payment_gateway/cashfree', [Admin::class, 'cashfree'])->middleware('AdminIsLoggedIn');
        Route::get('pages', [Pages::class, 'pages_list'])->middleware('AdminIsLoggedIn');
        Route::get('add', [Pages::class, 'add'])->middleware('AdminIsLoggedIn');
        Route::get('edit/{id}', [Pages::class, 'edit'])->middleware('AdminIsLoggedIn');
        Route::post('pages/add_edit', [Pages::class, 'addnew'])->middleware('AdminIsLoggedIn');
        Route::get('pages/delete/{id}', [Pages::class, 'delete'])->middleware('AdminIsLoggedIn');



        Route::get('users', [Admin::class, 'users'])->name('users')->middleware('AdminIsLoggedIn');
        Route::get('user/edit/{id}', [Admin::class, 'edit_user'])->name('edit_user')->middleware('AdminIsLoggedIn');
        Route::post('update_user', [Admin::class, 'update_user'])->name('update_user')->middleware('AdminIsLoggedIn');

        Route::get('add_user', [Admin::class, 'add_user'])->middleware('AdminIsLoggedIn');
        Route::post('save_user', [Admin::class, 'save_user'])->middleware('AdminIsLoggedIn');

        Route::get('user/delete_user/{id}', [Admin::class, 'delete_user'])->middleware('AdminIsLoggedIn');


        Route::name('mail-templates.')->prefix('mail-templates')->group(function () {
            Route::get('/', [MailTemplateController::class, 'index'])->name('index')->middleware('AdminIsLoggedIn');
            Route::get('add', [MailTemplateController::class, 'add'])->name('add')->middleware('AdminIsLoggedIn');
            Route::post('save', [MailTemplateController::class, 'save'])->name('save');
            Route::get('edit/{id}', [MailTemplateController::class, 'edit'])->name('edit')->middleware('AdminIsLoggedIn');
            Route::post('update/{id}', [MailTemplateController::class, 'update'])->name('update');
        });
        Route::get('email-application', [EmailAppController::class, 'index'])->name('index')->middleware('AdminIsLoggedIn');
        Route::post('sendMessage', [EmailAppController::class, 'sendMessage'])->name('sendMessage');
        Route::post('sendMail/{id}', [EmailAppController::class, 'sendMail'])->name('sendMail');
        Route::get('email-compose', [EmailAppController::class, 'compose'])->name('compose')->middleware('AdminIsLoggedIn');
        Route::get('/balance', [FundController::class, 'balance'])->name('balance')->middleware('AdminIsLoggedIn');
        Route::get('/withdraws', [FundController::class, 'withdraws'])->name('withdraws')->middleware('AdminIsLoggedIn');
        Route::get('add_balance', [FundController::class, 'add_balance'])->middleware('AdminIsLoggedIn');
        Route::get('edit_balance/{id}', [FundController::class, 'edit_balance'])->middleware('AdminIsLoggedIn');
        Route::post('save_balance', [FundController::class, 'save_balance'])->middleware('AdminIsLoggedIn');
        Route::post('update_balance', [FundController::class, 'update_balance'])->middleware('AdminIsLoggedIn');
        Route::get('delete_balance/{id}', [FundController::class, 'delete_balance'])->middleware('AdminIsLoggedIn');
        Route::post('/deposit', [FundController::class, 'deposit']);
        Route::post('/withdraw', [FundController::class, 'withdraw']);
        Route::get('/transactions_report', [Admin::class, 'transactions_report'])->name('transactions_report')->middleware('AdminIsLoggedIn');
        Route::get('accept/{id}', [Admin::class, 'accept'])->name('accept');
    });
    Route::get('/forget_password', [Admin::class, 'forget_password'])->name('forget_password');
    Route::post('/log', [Admin::class, 'login'])->name('login');
    Route::get('/signout', [Admin::class, 'logout'])->name('logout');
});
Route::get('facebook', [FacebookSocialiteController::class, 'facebookRedirect']);
Route::get('callback/facebook', [FacebookSocialiteController::class, 'loginWithFacebook']);
Route::get('google', [GoogleController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleController::class, 'handleGoogleCallback']);
