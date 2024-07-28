<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Mail\ComposeMail;
use App\Mail\SendMailreset;
use App\Models\AdditionalService;
use App\Models\BankDetails;
use App\Models\BillingDetail;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Campaign;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Page;
use App\Models\PasswordReset;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Related_product;
use App\Models\Role;
use App\Models\Service;
use App\Models\ServiceTimeSlot;
use App\Models\Subcategory;
use App\Models\TimeLog;
use App\Models\User;
use App\Models\Wishlist;
use App\Notifications\NewUserRegisteredNotification;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\UserRegisteredNotification;
use App\Notifications\VerifyEmailNotification;
use App\Traits\SendNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


function getIp()
{
    $ip = null;
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
    } else {
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
    }
    return $ip;
}

class UserController extends Controller
{
    use SendNotification;
    public function CreateService()
    {
        if (Session::has('LoggedIn')) {
            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();


            $general_setting = GeneralSetting::find('1');
            return view('create-service', compact('user_session', 'general_setting', 'pages'));
        } else {
            return Redirect()->with('fail', 'Tienes que iniciar sesión primero');
        }
    }
    public function ProviderEditService($id)
    {
        if (Session::has('LoggedIn')) {
            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $service = Service::find($id);
            $galleryImages = json_decode($service->gallery_files, true);
            $timeSlots = ServiceTimeSlot::where('provider_id', $service->provider_id)
                ->where('service_id', $service->id)
                ->get();

            $days = $timeSlots->pluck('day')->unique()->map(function ($day) {
                return strtolower($day);
            })->toArray();
            // dd($days);
            $general_setting = GeneralSetting::find('1');
            return view('provider-edit-service', compact('user_session', 'general_setting', 'pages', 'service', 'galleryImages', 'timeSlots', 'days'));
        } else {
            return Redirect()->with('fail', 'Tienes que iniciar sesión primero');
        }
    }
    public function updateService(Request $request)
    {
        // Log the entire request to ensure all data is being passed correctly
        \Log::info($request->all());

        // Fetch the service object using the provided service_id
        $service = Service::findOrFail($request->service_id);
        \Log::info('Service ID: ' . $service->id);

        // Ensure the service object is found
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        // Update service attributes
        $service->service_title = $request->input('service_title');
        $service->category_id = $request->input('category_id');
        $service->subcategory_id = $request->input('subcategory_id');
        $service->price = $request->input('price');
        $service->duration = $request->input('duration');
        $service->description = $request->input('description');
        $service->additional_service_status = $request->input('additional_service_status');
        $service->video_link = $request->input('video_link');
        $service->address = $request->input('address');
        $service->country = $request->input('country');
        $service->city = $request->input('city');
        $service->state = $request->input('state');
        $service->pincode = $request->input('pincode');
        $service->google_maps_place_id = $request->input('google_maps_place_id');
        $service->latitude = $request->input('latitude');
        $service->longitude = $request->input('longitude');
        $service->meta_title = $request->input('meta_title');
        $service->meta_keywords = $request->input('meta_keywords');
        $service->meta_description = $request->input('meta_description');

        // Handle gallery files
        if ($request->hasFile('gallery_files')) {
            $gallery_files = [];
            foreach ($request->file('gallery_files') as $file) {
                $destination = 'Services Images';
                $file_name = time() . '-' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/' . $destination), $file_name);
                $gallery_files[] = 'uploads/' . $destination . '/' . $file_name;
            }
            $service->gallery_files = json_encode($gallery_files);
        }

        $service->save();
        \Log::info('Service updated: ' . $service->id);

        // Handle additional services
        $additionalServiceTitles = $request->input('additional_service_title');
        $additionalServicePrices = $request->input('additional_service_price');
        $additionalServiceDurations = $request->input('additional_service_duration');

        // Delete existing additional services
        AdditionalService::where('service_id', $service->id)->delete();

        // Add new additional services
        if (!empty($additionalServiceTitles)) {
            for ($i = 0; $i < count($additionalServiceTitles); $i++) {
                if (!empty($additionalServiceTitles[$i])) {
                    AdditionalService::create([
                        'provider_id' => $service->provider_id,
                        'service_id' => $service->id,
                        'title' => $additionalServiceTitles[$i],
                        'price' => $additionalServicePrices[$i],
                        'duration' => $additionalServiceDurations[$i],
                    ]);
                }
            }
        }
        // Handle service time slots for each day
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            if ($request->has($day)) {
                $daySlots = $request->input($day, []);

                // Determine the number of slots based on 'from' entries
                $numSlots = count(array_filter($daySlots, function ($slot) {
                    return isset($slot['from']);
                }));

                for ($i = 0; $i < $numSlots; $i++) {
                    $from = $daySlots[$i * 3]['from'] ?? null;
                    $to = $daySlots[$i * 3 + 1]['to'] ?? null;
                    $slots = $daySlots[$i * 3 + 2]['slots'] ?? null;

                    if (!empty($from) && !empty($to) && !empty($slots)) {
                        // Check if a slot for this day and time already exists
                        $serviceTimeSlot = ServiceTimeSlot::where('service_id', $service->id)
                            ->where('provider_id', $service->provider_id)
                            ->where('day', ucfirst($day))
                            ->where('from', $from)
                            ->where('to', $to)
                            ->first();

                        if ($serviceTimeSlot) {
                            // Update the existing slot
                            $serviceTimeSlot->slots = $slots;
                        } else {
                            // Create a new slot
                            $serviceTimeSlot = new ServiceTimeSlot();
                            $serviceTimeSlot->service_id = $service->id;
                            $serviceTimeSlot->provider_id = $service->provider_id;
                            $serviceTimeSlot->day = ucfirst($day);
                            $serviceTimeSlot->from = $from;
                            $serviceTimeSlot->to = $to;
                            $serviceTimeSlot->slots = $slots;
                        }
                        $serviceTimeSlot->save();
                    }
                }
            }
        }


        // Redirect with success message
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect('provider-services')->with('success', 'Service updated successfully!');
    }


    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }
    public function home()
    {

        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $userCategories = !empty($user_session->categories) ? explode(',', $user_session->categories) : [];


        $categories = Category::all();
        $pages = Page::all();
        $general_setting = GeneralSetting::find('1');
        return view('index', compact('categories', 'user_session',  'general_setting', 'pages'));
    }
    public function chooseSignup()
    {

        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $pages = Page::all();
        $general_setting = GeneralSetting::find('1');
        return view('choose-signup', compact('user_session',  'general_setting', 'pages'));
    }
    public function userSignup()
    {

        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $pages = Page::all();
        $general_setting = GeneralSetting::find('1');
        return view('user-signup', compact('user_session',  'general_setting', 'pages'));
    }
    public function providerSignup()
    {

        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $pages = Page::all();
        $general_setting = GeneralSetting::find('1');
        return view('provider-signup', compact('user_session',  'general_setting', 'pages'));
    }

    public function projects()
    {


        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $title = 'Projects';

        $campaigns = Campaign::where('status', 1)->get();
        $totalRaisedArray = [];
        $percentRaisedArray = [];

        foreach ($campaigns as $row) {
            $totalRaised = Payment::whereHas('campaign', function ($query) use ($row) {
                $query->where('id', $row->id);
            })
                ->where('accepted', 1)
                ->sum('amount');

            $percentRaised = intval(($totalRaised / $row->goal) * 100);


            $totalRaisedArray[$row->id] = $totalRaised;
            $percentRaisedArray[$row->id] = $percentRaised;
        }
        $pages = Page::all();
        return view('list', compact('campaigns', 'user_session', 'title', 'pages', 'totalRaisedArray', 'percentRaisedArray'));
    }
    public function project_category($category)
    {
        $campaigns = Campaign::join('categories', 'campaigns.category_id', '=', 'categories.id')
            ->where('categories.name', $category)
            ->where('campaigns.status', 1)
            ->select('campaigns.*')
            ->paginate(10);

        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $title = $category;
        $totalRaisedArray = [];
        $percentRaisedArray = [];

        foreach ($campaigns as $row) {
            $totalRaised = Payment::whereHas('campaign', function ($query) use ($row) {
                $query->where('id', $row->id);
            })
                ->where('accepted', 1)
                ->sum('amount');

            $percentRaised = intval(($totalRaised / $row->goal) * 100);


            $totalRaisedArray[$row->id] = $totalRaised;
            $percentRaisedArray[$row->id] = $percentRaised;
        }
        $pages = Page::all();
        return view('project_category', compact('campaigns', 'title', 'user_session', 'pages', 'totalRaisedArray', 'percentRaisedArray'));
    }
    public function Userlogin()
    {
        $pages = Page::all();
        return view('login', compact('pages'));
    }
    public function admin()
    {
        return view('admin.admin');
    }
    public function signup()
    {
        $pages = Page::all();
        return view('register', compact('pages'));
    }


    public function registration(Request $request)
    {
        $user = new User();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => ['required', 'string', 'min:8', 'max:30'],
            'mobile_number' => 'required'
        ]);
        $mobileNumber = $request->mobile_number;


        // Create a new user instance
        $user = User::create([
            'name' => $request->name,
            'account_type' => 'customer',
            'email' => $request->email,
            'password' => $request->password,
            'mobile_number' => $mobileNumber,
            'ip_address' => getIp(),
        ]);

        // Send email verification notification
        $user->notify(new VerifyEmailNotification($user));
        // Fire the UserRegistered event
        // event(new UserRegistered($user));
        $text = 'A new user has registered on the platform.';
        $target_url = route('users');
        $this->sendForApi($text, 1, $target_url, $user->id, $user->id);
        $pages = Page::all();
        if ($user) {
            return back()->with('success', 'Register Successfully');
        } else {
            return back()->with('fail', 'failed');
        }
    }
    public function pregistration(Request $request)
    {
        $user = new User();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => ['required', 'string', 'min:8', 'max:30'],
            'mobile_number' => 'required'
        ]);
        $mobileNumber = $request->mobile_number;


        // Create a new user instance
        $user = User::create([
            'name' => $request->name,
            'account_type' => 'provider',
            'email' => $request->email,
            'password' => $request->password,
            'mobile_number' => $mobileNumber,
            'ip_address' => getIp(),
        ]);

        // Send email verification notification
        $user->notify(new VerifyEmailNotification($user));
        // Fire the UserRegistered event
        // event(new UserRegistered($user));
        $text = 'A new user has registered on the platform.';
        $target_url = route('users');
        $this->sendForApi($text, 1, $target_url, $user->id, $user->id);
        $pages = Page::all();
        if ($user) {
            return back()->with('success', 'Register Successfully');
        } else {
            return back()->with('fail', 'failed');
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($request->password == $user->password) {
                if ($user->email_verified_at === null) {
                    return back()->with('fail', 'Your account is not verified. Please verify your email.');
                }

                $user->update(['is_online' => 1, 'last_seen' => Carbon::now()]);
                $request->session()->put('LoggedIn', $user->id);

                if ($user->account_type == "customer") {
                    return redirect('dashboard');
                }
                if ($user->account_type == "provider") {
                    return redirect('provider-dashboard');
                }
            } else {
                return back()->with('fail', 'Password does not match');
            }
        } else {
            return back()->with('fail', 'Email is not registered');
        }
    }
    public function ProductDetail($slug)
    {
        if (Session::has('LoggedIn')) {
            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $product = Product::where('slug', $slug)->first();
            $IsVariation = ProductVariations::where('product_id', $product->id)->orderBy('id', 'asc')->first();
            if (!empty($IsVariation)) {
                $IsVariationProductDetails  = Product::where('sku', $IsVariation->sku)->first();
            } else {
                $IsVariationProductDetails = '';
            }


            $latestProductId = $product->id;
            $related_products = DB::table('products')
                ->join('related_products', 'products.id', '=', 'related_products.related_item_id')
                ->select('related_products.id as related_id', 'products.title', 'products.id', 'products.f_thumbnail', 'products.slug', 'products.price1', 'products.price2', 'products.price3', 'products.price4', 'products.price5')
                ->where('related_products.product_id', $product->id)
                ->orderBy('related_products.id', 'desc')
                ->paginate(15);

            $general_setting = GeneralSetting::find('1');
            return view('product_detail', compact('product', 'user_session', 'related_products', 'general_setting', 'pages', 'latestProductId', 'IsVariationProductDetails'));
        } else {
            return Redirect()->with('fail', 'Tienes que iniciar sesión primero');
        }
    }
    public function MyOrders()
    {
        if (Session::has('LoggedIn')) {

            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            // Fetch orders with related order items, products, and payment status
            $orders = Order::where('orders.user_id', Session::get('LoggedIn'))
                ->leftJoin('payments', 'orders.id', '=', 'payments.order_id')

                ->with(['orderItems' => function ($query) {
                    $query->with('product');
                }])
                ->select('orders.id', 'orders.created_at', 'orders.total_amount', 'payments.accepted')
                ->get();



            $general_setting = GeneralSetting::find('1');
            return view('my_orders', compact('user_session',  'general_setting', 'pages', 'orders'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    function userNotifications()
    {
        $notifications = Notification::where('user_type', 2)
            ->where('is_seen', 'no')
            ->orderByDesc('created_at')
            ->paginate(5);
        return response()->json($notifications);
    }
    public function checkout()
    {
        if (Session::has('LoggedIn')) {

            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            $qrcode =  BankDetails::orderby('id', 'desc')->first();
            $carts = Cart::where('user_id', Session::get('LoggedIn'))->get();
            $general_setting = GeneralSetting::find('1');
            return view('checkout', compact('user_session',  'general_setting', 'pages', 'carts', 'qrcode'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function Billingstore(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        $billingDetail = BillingDetail::create([
            'user_id' => auth()->id(),
            'full_name' => $request->full_name,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
        ]);

        // Redirect to the next step or show success message
        return redirect()->route('next.step')->with('success', 'Billing details saved successfully!');
    }
    public function service()
    {
        if (Session::has('LoggedIn')) {

            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $services = Service::where('provider_id', Session::get('LoggedIn'))->get();
            $general_setting = GeneralSetting::find('1');
            return view('provider-services', compact('user_session',  'general_setting', 'pages', 'services'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function ServiceList()
    {
        if (Session::has('LoggedIn')) {

            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $services = Service::where('provider_id', Session::get('LoggedIn'))->get();
            $general_setting = GeneralSetting::find('1');
            return view('provider-services-list', compact('user_session',  'general_setting', 'pages', 'services'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function edit_project(Request $request)
    {

        if (Session::has('LoggedIn')) {

            $project_detail = Campaign::where('id', $request->id)->first();
            $category = Category::all();
            $countries = Country::all();
            $pages = Page::all();
            $general_setting = GeneralSetting::find('1');
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            // dd($request->id);
            return view('edit_courses', compact('countries', 'user_session', 'project_detail', 'category', 'general_setting', 'pages'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function storeLikes(Request $request)
    {



        // Create a new Like record
        $data = Like::create([
            'project_id' => $request->projectId,
        ]);
        // dd($data);
        // Get the updated like count for the project
        $likeCount = Like::where('project_id', $request->projectId)->count();

        // Return response (optional)
        return response()->json([
            'success' => true,
            'likeCount' => $likeCount,
            'message' => 'Liked Successfully'
        ]);
    }

    public function checkLike(Request $request)
    {
        $projectId = $request->projectId; // Get the project ID
        $userId = Session::get('LoggedIn'); // Get the currently logged-in user ID

        // Check if user already liked the project
        $like = Like::where('project_id', $projectId)->exists();

        // Return response
        return response()->json([
            'liked' => $like,
        ]);
    }

    public function update_service(Request $request)
    {

        $user_id = Session::get('LoggedIn');

        $slug = unique_slug($request->title);

        // Retrieve the existing campaign by its ID
        $campaign = Campaign::findOrFail($request->id);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the previous image file if it exists
            if ($campaign->image) {
                // Construct the path to the previous image file
                $previousImagePath = public_path($campaign->image);

                // Check if the file exists before attempting to delete it
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath); // Delete the previous image file
                }
            }

            // Handle the new image upload
            $image = $request->file('image');
            $destination = 'Projects';
            $file_name = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/' . $destination), $file_name);
            $campaign->image = 'uploads/' . $destination . '/' . $file_name;
        }

        // Update other fields with the new values from the request
        $campaign->user_id = $user_id;
        $campaign->category_id = $request->category;
        $campaign->title = $request->title;
        $campaign->slug = $slug;
        $campaign->description = $request->description;
        $campaign->campaign_owner_commission = get_option('campaign_owner_commission');
        $campaign->goal = $request->goal;
        $campaign->min_amount = $request->min_amount;
        $campaign->max_amount = $request->max_amount;

        $campaign->end_method = $request->end_method;
        $campaign->video = $request->video;
        $campaign->status = 0; // Assuming status is set to 0 for update
        $campaign->country_id = $request->country_id;
        $campaign->address = $request->address;
        $campaign->is_funded = 0; // Assuming is_funded is set to 0 for update
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;

        // Handle OG image updates (similar logic as image update)
        // Note: If og_image is also expected to be updated in this form, you should check if og_image file exists before deleting the previous one.
        if ($request->hasFile('og_image')) {
            // Delete the previous OG image file if it exists
            if ($campaign->og_image) {
                $previousOgImagePath = public_path($campaign->og_image);
                if (file_exists($previousOgImagePath)) {
                    unlink($previousOgImagePath); // Delete the previous OG image file
                }
            }

            // Handle the new OG image upload
            $og_image = $request->file('og_image');
            $destination = 'meta';
            $file_name = time() . '-' . Str::random(10) . '.' . $og_image->getClientOriginalExtension();
            $og_image->move(public_path('uploads/' . $destination), $file_name);
            $campaign->og_image = 'uploads/' . $destination . '/' . $file_name;
        }

        // Save the updated campaign
        if ($campaign->save()) {
            // If the update is successful, return success message
            return redirect('provider-services')->with('success', 'Service updated successfully');
        }

        // If the update fails, return error message
        return back()->with('fail', 'Failed to update project');
    }
    public function Delete_service(Request $request)
    {
        $category = Campaign::find($request->id);
        $category->delete();

        return redirect('provider-services')->with('success', 'Deleted Successfully');
    }
    public function sendResetPasswordLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('fail', 'Email address not found.');
        }
        $token = Str::random(40);


        $datetime = Carbon::now()->format('Y-m-d H:i:s');

        $token = PasswordReset::updateOrCreate(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => $datetime
            ]
        );

        // Send the password reset notification
        $user->notify(new ResetPasswordNotification($token));

        return back()->with('success', 'Password reset link sent successfully.');
    }

    public function dashboard()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            // Fetch orders with related order items, products, and payment status
            $orders = Order::where('orders.user_id', Session::get('LoggedIn'))
                ->leftJoin('payments', 'orders.id', '=', 'payments.order_id')
                ->with(['orderItems.product'])
                ->select('orders.*', 'payments.accepted')
                ->get();
            $pages = Page::all();

            return view('dashboard', compact('user_session', 'pages', 'orders'));
        } else {
            return redirect()->route('Userlogin');
        }
    }
    public function ProviderDashboard()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            // Fetch orders with related order items, products, and payment status
            $orders = Order::where('orders.user_id', Session::get('LoggedIn'))
                ->leftJoin('payments', 'orders.id', '=', 'payments.order_id')
                ->with(['orderItems.product'])
                ->select('orders.*', 'payments.accepted')
                ->get();
            $pages = Page::all();

            return view('provider-dashboard', compact('user_session', 'pages', 'orders'));
        } else {
            return redirect()->route('Userlogin');
        }
    }
    public function news()
    {

        $news = Blog::orderBy('id', 'DESC')->paginate(3);

        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $data['blogComments'] = BlogComment::active();
        $blogComments = $data['blogComments']->whereNull('parent_id')->get();
        $pages = Page::all();
        $latest_posts = Blog::orderBy('id', 'DESC')->paginate(3);
        $general_setting = GeneralSetting::find('1');
        return view('ads', compact('user_session', 'latest_posts', 'news', 'pages', 'blogComments', 'general_setting'));
    }
    public function news_category($slug)
    {
        $news = DB::table('blogs')
            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
            ->where('blog_categories.slug', $slug)
            ->select('blogs.*')
            ->get();

        // dd($news);
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $title = $slug;
        $data['blogComments'] = BlogComment::active();
        $blogComments = $data['blogComments']->whereNull('parent_id')->get();
        $pages = Page::all();
        $latest_posts = Blog::orderBy('id', 'DESC')->paginate(3);
        $general_setting = GeneralSetting::find('1');
        return view('news_category', compact('user_session', 'latest_posts', 'title', 'news', 'pages', 'blogComments', 'general_setting'));
    }
    public function blogCommentStore(Request $request)
    {
        $comment = new BlogComment();
        $comment->blog_id = $request->blog_id;
        $comment->user_id = $request->user_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->status = 1;

        if ($comment->save()) {
            // Retrieve updated comments for the specific blog
            $blogComments = BlogComment::active()
                ->where('blog_id', $request->blog_id)
                ->whereNull('parent_id')
                ->get();

            return response()->json([
                'success' => true,

            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function blogCommentReplyStore(Request $request)
    {
        if ($request->user_id && $request->comment) {
            $comment = new BlogComment();
            $comment->blog_id = $request->blog_id;
            $comment->user_id = $request->user_id;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->comment = $request->comment;
            $comment->status = 1;
            $comment->parent_id = $request->parent_id;
            $comment->save();

            return response()->json([
                'success' => true,
                'message' => 'Comment successfully added.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to store comment.',
            ]);
        }
    }

    public function searchBlogList(Request $request)
    {
        $data['blogs'] = Blog::active()->where('title', 'like', "%{$request->title}%")->get();


        return view('frontend.blog.render-search-blog-list', $data);
    }


    public function add_address()
    {

        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $pages = Page::all();


        return view('add_address', compact('user_session', 'pages'));
    }
    public function edit_address()
    {

        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $pages = Page::all();


        return view('edit_address', compact('user_session', 'pages'));
    }
    public function services()
    {

        $pages = Page::all();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $general_setting = GeneralSetting::find('1');
        return view('services', compact('user_session',  'general_setting', 'pages'));
    }
    public function ServiceDetails()
    {

        $pages = Page::all();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $general_setting = GeneralSetting::find('1');
        return view('service-details', compact('user_session',  'general_setting', 'pages'));
    }
    public function blog()
    {

        $pages = Page::all();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $general_setting = GeneralSetting::find('1');
        return view('blog', compact('user_session',  'general_setting', 'pages'));
    }
    public function BlogDetails()
    {

        $pages = Page::all();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $general_setting = GeneralSetting::find('1');
        return view('blog-details', compact('user_session',  'general_setting', 'pages'));
    }
    public function about()
    {

        $pages = Page::all();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $general_setting = GeneralSetting::find('1');
        return view('about', compact('user_session',  'general_setting', 'pages'));
    }
    public function contact()
    {

        $pages = Page::all();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        $general_setting = GeneralSetting::find('1');
        return view('contact', compact('user_session',  'general_setting', 'pages'));
    }
    public function filterProducts(Request $request)
    {


        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        // Assuming $user_session is defined to access user's price field
        $userPriceField = $user_session->price;
        $userCategories = !empty($user_session->categories) ? explode(',', $user_session->categories) : [];
        // Fetch products based on price range
        $minPrice = (int) $request->min_price;
        $maxPrice = (int) $request->max_price;
        $filteredProducts = \DB::table('products as p')
            ->leftJoin('product_variations as pv', function ($join) {
                $join->on('p.id', '=', 'pv.product_id')
                    ->whereRaw('pv.id = (select max(id) from product_variations where product_id = p.id)');
            })
            ->leftJoin('products as variation_products', 'pv.sku', '=', 'variation_products.sku')
            ->whereIn('p.category', $userCategories)
            ->whereNotIn('p.sku', function ($query) {
                $query->select('sku')
                    ->from('product_variations');
            })
            ->whereBetween('p.' . $userPriceField, [$minPrice, $maxPrice])
            ->orderBy('p.id', 'asc')
            ->groupBy('p.id')
            ->select('p.id', 'p.title', 'p.slug', 'p.f_thumbnail', 'p.price', 'variation_products.f_thumbnail as variation_thumbnail')
            ->get();

        // Adjust data structure as needed before returning JSON response
        $products = [];
        foreach ($filteredProducts as $product) {
            $hasVariation = !empty($product->variation_thumbnail);
            $thumbnail = $hasVariation ? $product->variation_thumbnail : $product->f_thumbnail;

            $products[] = [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'f_thumbnail' => $thumbnail,
                'price' => $product->price,
                'has_variation' => $hasVariation,
                'variation_details' => [
                    'f_thumbnail' => $product->variation_thumbnail ?? '',
                ],
            ];
        }

        return response()->json(['products' => $products]);
    }
    public function productbybrand($id)
    {
        if (Session::has('LoggedIn')) {
            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $userCategories = !empty($user_session->categories) ? explode(',', $user_session->categories) : [];
            $products = Product::whereIn('category', $userCategories)->where('brand_id', $id)
                ->whereNotIn('sku', function ($query) {
                    $query->select('sku')
                        ->from('product_variations');
                })
                ->orderBy('id', 'desc')
                ->paginate(9);

            $category = $id;
            $general_setting = GeneralSetting::find('1');
            return view('productbybrand', compact('products', 'user_session',  'general_setting', 'pages', 'category'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function productbyCategory($id)
    {
        if (Session::has('LoggedIn')) {
            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $userCategories = !empty($user_session->categories) ? explode(',', $user_session->categories) : [];
            $products = Product::whereIn('category', $userCategories)->where('category', $id)
                ->whereNotIn('sku', function ($query) {
                    $query->select('sku')
                        ->from('product_variations');
                })
                ->orderBy('id', 'desc')
                ->paginate(9);

            $category = $id;
            $general_setting = GeneralSetting::find('1');
            return view('productbyCategory', compact('products', 'user_session',  'general_setting', 'pages', 'category'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function productbySubCategory($category, $subcategory)
    {
        if (Session::has('LoggedIn')) {
            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $userCategories = !empty($user_session->categories) ? explode(',', $user_session->categories) : [];
            $products = Product::whereIn('category', $userCategories)->where('category', $category)->where('subcategory_id', $subcategory)
                ->whereNotIn('sku', function ($query) {
                    $query->select('sku')
                        ->from('product_variations');
                })
                ->orderBy('id', 'desc')
                ->paginate(9);

            $subcategory = $subcategory;
            $category = $category;
            $general_setting = GeneralSetting::find('1');
            return view('productbySubCategory', compact('products', 'user_session',  'general_setting', 'pages', 'subcategory', 'category'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function productbyChildCategory($category, $subcategory, $childcategory)
    {
        if (Session::has('LoggedIn')) {
            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $userCategories = !empty($user_session->categories) ? explode(',', $user_session->categories) : [];
            $products = Product::whereIn('category', $userCategories)->where('category', $category)->where('subcategory_id', $subcategory)->where('childcategory', $childcategory)
                ->whereNotIn('sku', function ($query) {
                    $query->select('sku')
                        ->from('product_variations');
                })
                ->orderBy('id', 'desc')
                ->paginate(9);

            $childcategory = $childcategory;
            $general_setting = GeneralSetting::find('1');
            return view('productbyChildCategory', compact('products', 'user_session',  'general_setting', 'pages', 'childcategory'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function getProducts(Request $request)
    {
        $searchTerm = $request->input('search');
        $categoryId = $request->input('category_id');

        // Fetch user session and categories
        $user_session = User::find(Session::get('LoggedIn'));

        $userCategories = $user_session->categories ? explode(',', $user_session->categories) : [];

        // Query products based on user's allowed categories
        $query = Product::whereIn('category', $userCategories);

        if (!empty($searchTerm)) {
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        if (!empty($categoryId) && $categoryId != 1) {
            $query->where('category', $categoryId);
        }

        // Exclude products with skus present in product_variations table
        $query->whereNotIn('sku', function ($subquery) {
            $subquery->select('sku')
                ->from('product_variations');
        });

        // Get products matching the query
        $products = $query->get();


        // Return JSON response with a 200 status code (assuming success)
        return response()->json($products, 200);
    }
    public function addToCart($price, $id, $quantity)
    {
        $productSku = Product::where('id', $id)->first();

        if (!$productSku) {
            return back()->with('error', 'Product not found.');
        }

        $variation = ProductVariations::where('sku', $productSku->sku)->first();

        // Check if a variation exists
        if ($variation) {
            $color = $variation->color;
        } else {
            $color = ''; // Handle the case where no variation is found
        }

        // Save into cart
        $saveIntoCart = Cart::create([
            'user_id' => Session::get('LoggedIn'),
            'product_id' => $id,
            'color' => $color,
            'price' => $price,
            'quantity' => $quantity,
        ]);

        return back()->with('success', 'Product is added to cart');
    }

    public function BuyaddToCart($price, $id, $quantity)
    {
        $product = Product::find($id);

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        $variation = ProductVariations::where('sku', $product->sku)->first();

        // Check if a variation exists
        if ($variation) {
            $color = $variation->color;
        } else {
            $color = ''; // Handle the case where no variation is found
        }

        // Save into cart
        $saveIntoCart = Cart::create([
            'user_id' => Session::get('LoggedIn'),
            'product_id' => $id,
            'color' => $color,
            'price' => $price,
            'quantity' => $quantity,
        ]);

        return redirect()->route('cart');
    }

    public function updateQuantity(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        // Validate the input
        $request->validate([
            'productId' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Update the quantity in the database
        $cartItem = Cart::where('product_id', $productId)->where('user_id', Session::get('LoggedIn'))->first();
        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
    }
    public function addToWishlist($price, $id)
    {
        $stock = Product::find($id);
        if (!empty($stock->is_stock)) {
            $stockcheck = $stock->is_stock;
        }
        if ($stock->is_stock == null || empty($stock->is_stock)) {
            $stockcheck = 0;
        }
        $saveIntoWishlist = Wishlist::create([
            'user_id' => Session::get('LoggedIn'),
            'product_id' => $id,
            'price' => $price,
            'is_stock' => $stockcheck,
        ]);
        return back()->with('success', 'Product is added to wishlist');
    }
    public function RemoveWish($id)
    {
        if (Session::has('LoggedIn')) {
            $wishItem = Wishlist::find($id);
            if ($wishItem) {
                $wishItem->delete();
                return redirect()->route('wishlist')->with('success', 'Item removed from wishlist');
            } else {
                return redirect()->route('wishlist')->with('fail', 'Item not found in wishlist');
            }
        } else {
            return redirect()->route('login')->with('fail', 'You have to login first');
        }
    }
    public function removeCart($id)
    {
        if (Session::has('LoggedIn')) {
            $cartItem = Cart::find($id);
            if ($cartItem) {
                $cartItem->delete();
                return redirect()->route('cart')->with('success', 'Item removed from cart');
            } else {
                return redirect()->route('cart')->with('fail', 'Item not found in cart');
            }
        } else {
            return redirect()->route('login')->with('fail', 'You have to login first');
        }
    }

    public function cart()
    {
        if (Session::has('LoggedIn')) {

            $pages = Page::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $userCategories = !empty($user_session->categories) ? explode(',', $user_session->categories) : [];
            $products = Product::whereIn('category', $userCategories)->orderBy('id', 'desc')->paginate(4);

            $latest_products = Product::whereIn('category', $userCategories)
                ->whereNotIn('sku', function ($query) {
                    $query->select('sku')
                        ->from('product_variations');
                })
                ->orderBy('id', 'desc')->get();

            $carts = Cart::where('user_id', Session::get('LoggedIn'))->get();
            $general_setting = GeneralSetting::find('1');
            return view('cart', compact('products', 'user_session',  'general_setting', 'pages', 'latest_products', 'carts'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
    public function ProjectStore(Request $request)
    {

        $rules = [
            'category' => 'required',
            'title' => 'required',
            'image' => 'required',

            'description' => 'required',
            // 'short_description' => 'required|max:200',
            'goal' => 'required',
            'end_method' => 'required',
            'country_id' => 'required',
        ];

        $this->validate($request, $rules);

        $user_id = Session::get('LoggedIn');

        $slug = unique_slug($request->title);
        if ($request->hasFile('image')) {

            // Handle new image upload
            $attribute = $request->file('image');
            $destination = 'Projects';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update image path
            $image = 'uploads/' . $destination . '/' . $file_name;
        }
        //feature image has been moved to update
        $data = [
            'user_id' => $user_id,
            'category_id' => $request->category,
            'title' => $request->title,
            'slug' => $slug,
            'image' => $image,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'campaign_owner_commission' => get_option('campaign_owner_commission'),
            'goal' => $request->goal,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,

            'end_method' => $request->end_method,
            'video' => $request->video,
            'feature_image' => '',
            'status' => 0,
            'country_id' => $request->country_id,
            'address' => $request->address,
            'is_funded' => 0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];
        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            $attribute = $request->file('og_image');
            $destination = 'meta';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update og_image path
            $data['og_image'] = 'uploads/' . $destination . '/' . $file_name;
        }

        $create = Campaign::create($data);
        $text = 'A new project has posted on the platform.';
        $target_url = url('project-details', ['slug' => $slug]);
        $this->sendForApi($text, 1, $target_url, $user_id, $user_id);

        // dd($request->all());
        if ($create) {
            return back()->with('success', 'Project Created');
        }

        return back()->with('fail', 'Something went wrong');
    }

    public function back($id)
    {
        $campaign = campaign::where('id', $id)->first();
        $qrcode =  BankDetails::orderby('id', 'desc')->first();
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $pages = Page::all();
        return view('back', compact('qrcode', 'campaign', 'pages', 'user_session'));
    }
    public function address()
    {
        $user_session = User::where('id', Session::get('LoggedIn'))->first();
        $pages = Page::all();
        return view('address', compact('pages', 'user_session'));
    }
    public function storeBack(Request $request)
    {

        // Store credit reload request
        $request->validate([
            'amount' => 'required|numeric',
            'payment_receipt' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $campaign_owner_user_id = Campaign::find($request->campaign_id)->user_id;
        $campaign_owner = User::find($campaign_owner_user_id);
        // dd($campaign_owner);
        $subject = "You have a new backer on your Campaign";
        $msg = str_ireplace("\r\n", "<br/>", "You have a new backer on your Campaign");

        // Assuming $name represents the name of the user
        $name = $campaign_owner->name;

        // Send email using the ComposeMail Mailable
        Mail::to($campaign_owner->email)->send(new ComposeMail($subject, $msg, $name));
        $text = "You have a new backer on your Campaign";
        $target_url = url('chat');

        $this->sendForApi($text, 2, $target_url, $campaign_owner_user_id, $request->user_id);
        $backer = User::find($request->user_id);
        $Payment = new Payment([
            'name' => $backer->name,
            'payer_email' => $backer->email,
            'user_id' => $request->user_id,
            'campaign_id' => $request->campaign_id,
            'amount' => $request->amount,
            'accepted' => false,
        ]);

        if ($request->hasFile('payment_receipt')) {
            $payment_receipt = $request->file('payment_receipt');
            $imageName = $payment_receipt->getClientOriginalName();
            $payment_receipt->move(public_path('payment_receipt'), $imageName);

            $Payment->payment_receipt = 'payment_receipt/' . $imageName;
        }


        $Payment->save();

        return redirect('dashboard')->with('success', 'Fund has request submitted');
    }

    public function WithdrawFunds()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('WithdrawFunds', compact('user_session'));
        }
    }

    public function change_password(Request $request)
    {

        $data = array();
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', '=', Session::get('LoggedIn'))->first();
        }
        $pages = Page::all();
        return view('change_password', compact('user_session', 'pages'));
    }
    public function update_password(Request $request)
    {


        $request->validate([
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        # Update the new Password
        $data = User::find($request->user_id);
        $data->password = ($request->new_password);
        $data->save();

        return back()->with('success', 'Successfully Updated');
    }
    public function StoreService(Request $request)
    {

        // Validate the incoming request data
        $validated = $request->validate([
            'service_title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
            'additional_service_status' => 'nullable',
            'additional_service_title' => 'nullable|array',
            'additional_service_title.*' => 'nullable|string',
            'additional_service_price' => 'nullable|array',
            'additional_service_price.*' => 'nullable|numeric',
            'additional_service_duration' => 'nullable|array',
            'additional_service_duration.*' => 'nullable|integer',
            // 'video_link' => 'nullable|url',
            'number_of_days' => 'nullable|integer',
            'all_days_slots' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string',
            'google_maps_place_id' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            // 'gallery_files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new service instance
        $service = new Service();
        $service->service_title = $request->input('service_title');
        $service->category_id = $request->input('category_id');
        $service->subcategory_id = $request->input('subcategory_id');
        $service->price = $request->input('price');
        $service->duration = $request->input('duration');
        $service->description = $request->input('description');
        $service->additional_service_status = $request->input('additional_service_status');
        $service->video_link = $request->input('video_link');
        $service->number_of_days = $request->input('number_of_days');
        $service->all_days_slots = $request->input('all_days_slots');
        $service->address = $request->input('address');
        $service->country = $request->input('country');
        $service->city = $request->input('city');
        $service->state = $request->input('state');
        $service->pincode = $request->input('pincode');
        $service->google_maps_place_id = $request->input('google_maps_place_id');
        $service->latitude = $request->input('latitude');
        $service->longitude = $request->input('longitude');
        $service->meta_title = $request->input('meta_title');
        $service->meta_keywords = $request->input('meta_keywords');
        $service->meta_description = $request->input('meta_description');

        // Handle gallery files
        if ($request->hasFile('gallery_files')) {
            $gallery_files = [];
            foreach ($request->file('gallery_files') as $file) {
                $destination = 'Services Images';
                $file_name = time() . '-' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/' . $destination), $file_name);
                $gallery_files[] = 'uploads/' . $destination . '/' . $file_name;
            }
            $service->gallery_files = json_encode($gallery_files);
        }

        // Set provider_id from session
        $service->provider_id = $request->input('provider_id');

        // Save the service
        $service->save();

        // Get the additional services data
        $additionalServiceTitles = $request->input('additional_service_title', []);
        $additionalServicePrices = $request->input('additional_service_price', []);
        $additionalServiceDurations = $request->input('additional_service_duration', []);

        // Loop through the additional services data and save each one
        foreach ($additionalServiceTitles as $index => $title) {
            if (!empty($title)) {
                $additionalService = new AdditionalService();
                $additionalService->provider_id = $service->provider_id;
                $additionalService->service_id = $service->id;
                $additionalService->title = $title;
                $additionalService->price = $additionalServicePrices[$index] ?? null;
                $additionalService->duration = $additionalServiceDurations[$index] ?? null;
                $additionalService->save();
            }
        }


        // Handle service time slots for each day
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            if ($request->has($day)) {
                $daySlots = $request->input($day, []);

                // Determine the number of slots based on 'from' entries
                $numSlots = count(array_filter($daySlots, function ($slot) {
                    return isset($slot['from']);
                }));

                for ($i = 0; $i < $numSlots; $i++) {
                    $from = $daySlots[$i * 3]['from'] ?? null;
                    $to = $daySlots[$i * 3 + 1]['to'] ?? null;
                    $slots = $daySlots[$i * 3 + 2]['slots'] ?? null;

                    if (!empty($from) && !empty($to) && !empty($slots)) {
                        $serviceTimeSlot = new ServiceTimeSlot();
                        $serviceTimeSlot->service_id = $service->id;
                        $serviceTimeSlot->provider_id = $service->provider_id;
                        $serviceTimeSlot->day = ucfirst($day);
                        $serviceTimeSlot->from = $from;
                        $serviceTimeSlot->to = $to;
                        $serviceTimeSlot->slots = $slots;
                        $serviceTimeSlot->save();
                    }
                }
            }
        }
        // dd($serviceTimeSlot->id);
        // Return a response or redirect
        return response()->json(['message' => 'Service created successfully!', 'service' => $service], 201);
    }

    public function updateLogoutTime(Request $request)
    {
        $userId = Session::get('LoggedIn');

        if ($userId) {
            $lastTimeLog = TimeLog::where('user_id', $userId)->latest()->first();
            if ($lastTimeLog) {
                $lastTimeLog->end_time = Carbon::now();
                $lastTimeLog->save();
            }

            Session::forget('LoggedIn');
            return response()->json(['status' => 'updated']);
        }

        return response()->json(['status' => 'error'], 400);
    }
    public function logout(Request $request)
    {
        if (Session::has('LoggedIn')) {
            $data = User::find(Session::get('LoggedIn'));
            if ($data) {
                $data->update(['is_online' => 0, 'last_seen' => Carbon::now()]);
            }

            Session::forget('LoggedIn');
            $request->session()->invalidate();
            return redirect('/');
        }

        return redirect('/'); // In case session is not set
    }

    public function edit_profile()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $pages = Page::all();
            return view('edit_profile', compact('user_session', 'pages'));
        }
    }
    public function update_profile(Request $request)
    {

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required',
            'email' => 'required|email|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        // Check if a new profile photo is provided
        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $imageName = $profilePhoto->getClientOriginalName();

            // Move the uploaded file to the 'profile_photo' directory in the public path
            $profilePhoto->move(public_path('profile_photo'), $imageName);

            // Update the profile photo variable
            $profile = $imageName;
        } else {
            // If no new photo is provided, use the existing one
            $user = User::find($request->user_id);
            $profile = $user->profile_photo;
        }
        $mobileNumber = $request->mobile_number;
        $prefixedMobileNumber = "591" . $mobileNumber;

        // Update user data in the database
        $userUpdate = User::where('id', $request->user_id)->update([
            'name' => $request->name,
            'mobile_number' => $prefixedMobileNumber,
            'email' => $request->email,
            'profile_photo' => $profile,
        ]);

        if ($userUpdate) {
            return redirect('dashboard')->with('success', 'Profile Updated Successfully');
        } else {
            return back()->with('fail', 'Failed to update profile');
        }
    }

    public function forget_password()
    {
        $pages = Page::all();
        return view('forget_password', compact('pages'));
    }
    public function forget_mail(Request $request)
    {
        try {
            $customer = User::where('email', $request->email)->get();

            if (count($customer) > 0) {

                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/ResetPasswordLoad?token=' . $token;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = "Password Reset";
                $data['body'] = "Please click on below link to reset your password.";
                $data['auth'] = "SkyForecastingTeam";

                Mail::to($request->email)->send(
                    new SendMailreset(
                        $token,
                        $request->email,
                        $data
                    )
                );


                $datetime = Carbon::now()->format('Y-m-d H:i:s');

                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                );
                return redirect('forget_password')->with('success', 'Please check your mail to reset your password');
                // return response()->json(['success' => true, 'msg' => 'Please check your mail to reset your password.']);
            } else {
                return redirect('forget_password')->with('fail', 'User not found');
                // return response()->json(['fail' => false, 'msg' => 'User not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
    public function ResetPasswordLoad(Request $request)
    {

        $resetData =  PasswordReset::where('token', $request->token)->get();
        if (isset($request->token) && count($resetData) > 0) {
            $customer = User::where('email', $resetData[0]['email'])->get();
            $pages = Page::all();
            return view('ResetPasswordLoad', ['customer' => $customer], compact('pages'));
        }
    }



    public function ResetPassword(Request $request)
    {

        $request->validate([

            'email' => 'required',
            'password' => ['required', 'string', 'min:8', 'max:30'],
        ]);

        $data = User::where('email', $request->email)->first();

        $data->password = $request->password;
        $data->custom_password = $request->password;
        $data->update();

        PasswordReset::where('email', $data->email)->delete();

        echo "<h1>Successfully Reset Password</h1>";
        return redirect('Userlogin');
    }
}
