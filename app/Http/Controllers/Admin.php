<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Http\helper;
use App\Mail\SendMailreset;
use App\Models\Ad;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CreditReload;
use App\Models\GeneralSetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PaidTopAd;
use App\Models\PasswordReset;
use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\Permissions;
use App\Models\PostingAds;
use App\Models\Settings;
use App\Models\Task;
use App\Models\Transactions;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Traits\SendNotification;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Dotenv\Dotenv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

function generateTimezoneList()
{
    $regions = [
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    ];

    $timezones = [];

    foreach ($regions as $region) {
        $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
    }

    $timezoneOffsets = [];

    foreach ($timezones as $timezone) {
        $tz = new DateTimeZone($timezone);
        $timezoneOffsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // Sort timezones by offset
    asort($timezoneOffsets);

    $timezoneList = [];

    foreach ($timezoneOffsets as $timezone => $offset) {
        $offsetPrefix = ($offset < 0) ? '-' : '+';
        $offsetFormatted = gmdate('H:i', abs($offset));

        $prettyOffset = "UTC${offsetPrefix}${offsetFormatted}";

        $timezoneList[$timezone] = "(${prettyOffset}) $timezone";
    }

    return $timezoneList;
}

function getCurrencySymbols($code)
{
    $currency_symbols = array(
        'AED' => '&#1583;.&#1573;', // ?
        'AFN' => '&#65;&#102;',
        'ALL' => '&#76;&#101;&#107;',
        'AMD' => '',
        'ANG' => '&#402;',
        'AOA' => '&#75;&#122;', // ?
        'ARS' => '&#36;',
        'AUD' => '&#36;',
        'AWG' => '&#402;',
        'AZN' => '&#1084;&#1072;&#1085;',
        'BAM' => '&#75;&#77;',
        'BBD' => '&#36;',
        'BDT' => '&#2547;', // ?
        'BGN' => '&#1083;&#1074;',
        'BHD' => '.&#1583;.&#1576;', // ?
        'BIF' => '&#70;&#66;&#117;', // ?
        'BMD' => '&#36;',
        'BND' => '&#36;',
        'BOB' => '&#36;&#98;',
        'BRL' => '&#82;&#36;',
        'BSD' => '&#36;',
        'BTN' => '&#78;&#117;&#46;', // ?
        'BWP' => '&#80;',
        'BYR' => '&#112;&#46;',
        'BZD' => '&#66;&#90;&#36;',
        'CAD' => '&#36;',
        'CDF' => '&#70;&#67;',
        'CHF' => '&#67;&#72;&#70;',
        'CLF' => '', // ?
        'CLP' => '&#36;',
        'CNY' => '&#165;',
        'COP' => '&#36;',
        'CRC' => '&#8353;',
        'CUP' => '&#8396;',
        'CVE' => '&#36;', // ?
        'CZK' => '&#75;&#269;',
        'DJF' => '&#70;&#100;&#106;', // ?
        'DKK' => '&#107;&#114;',
        'DOP' => '&#82;&#68;&#36;',
        'DZD' => '&#1583;&#1580;', // ?
        'EGP' => '&#163;',
        'ETB' => '&#66;&#114;',
        'EUR' => '&#8364;',
        'FJD' => '&#36;',
        'FKP' => '&#163;',
        'GBP' => '&#163;',
        'GEL' => '&#4314;', // ?
        'GHS' => '&#162;',
        'GIP' => '&#163;',
        'GMD' => '&#68;', // ?
        'GNF' => '&#70;&#71;', // ?
        'GTQ' => '&#81;',
        'GYD' => '&#36;',
        'HKD' => '&#36;',
        'HNL' => '&#76;',
        'HRK' => '&#107;&#110;',
        'HTG' => '&#71;', // ?
        'HUF' => '&#70;&#116;',
        'IDR' => '&#82;&#112;',
        'ILS' => '&#8362;',
        'INR' => '&#8377;',
        'IQD' => '&#1593;.&#1583;', // ?
        'IRR' => '&#65020;',
        'ISK' => '&#107;&#114;',
        'JEP' => '&#163;',
        'JMD' => '&#74;&#36;',
        'JOD' => '&#74;&#68;', // ?
        'JPY' => '&#165;',
        'KES' => '&#75;&#83;&#104;', // ?
        'KGS' => '&#1083;&#1074;',
        'KHR' => '&#6107;',
        'KMF' => '&#67;&#70;', // ?
        'KPW' => '&#8361;',
        'KRW' => '&#8361;',
        'KWD' => '&#1583;.&#1603;', // ?
        'KYD' => '&#36;',
        'KZT' => '&#1083;&#1074;',
        'LAK' => '&#8365;',
        'LBP' => '&#163;',
        'LKR' => '&#8360;',
        'LRD' => '&#36;',
        'LSL' => '&#76;', // ?
        'LTL' => '&#76;&#116;',
        'LVL' => '&#76;&#115;',
        'LYD' => '&#1604;.&#1583;', // ?
        'MAD' => '&#1583;.&#1605;.', //?
        'MDL' => '&#76;',
        'MGA' => '&#65;&#114;', // ?
        'MKD' => '&#1076;&#1077;&#1085;',
        'MMK' => '&#75;',
        'MNT' => '&#8366;',
        'MOP' => '&#77;&#79;&#80;&#36;', // ?
        'MRO' => '&#85;&#77;', // ?
        'MUR' => '&#8360;', // ?
        'MVR' => '.&#1923;', // ?
        'MWK' => '&#77;&#75;',
        'MXN' => '&#36;',
        'MYR' => '&#82;&#77;',
        'MZN' => '&#77;&#84;',
        'NAD' => '&#36;',
        'NGN' => '&#8358;',
        'NIO' => '&#67;&#36;',
        'NOK' => '&#107;&#114;',
        'NPR' => '&#8360;',
        'NZD' => '&#36;',
        'OMR' => '&#65020;',
        'PAB' => '&#66;&#47;&#46;',
        'PEN' => '&#83;&#47;&#46;',
        'PGK' => '&#75;', // ?
        'PHP' => '&#8369;',
        'PKR' => '&#8360;',
        'PLN' => '&#122;&#322;',
        'PYG' => '&#71;&#115;',
        'QAR' => '&#65020;',
        'RON' => '&#108;&#101;&#105;',
        'RSD' => '&#1044;&#1080;&#1085;&#46;',
        'RUB' => '&#1088;&#1091;&#1073;',
        'RWF' => '&#1585;.&#1587;',
        'SAR' => '&#65020;',
        'SBD' => '&#36;',
        'SCR' => '&#8360;',
        'SDG' => '&#163;', // ?
        'SEK' => '&#107;&#114;',
        'SGD' => '&#36;',
        'SHP' => '&#163;',
        'SLL' => '&#76;&#101;', // ?
        'SOS' => '&#83;',
        'SRD' => '&#36;',
        'STD' => '&#68;&#98;', // ?
        'SVC' => '&#36;',
        'SYP' => '&#163;',
        'SZL' => '&#76;', // ?
        'THB' => '&#3647;',
        'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
        'TMT' => '&#109;',
        'TND' => '&#1583;.&#1578;',
        'TOP' => '&#84;&#36;',
        'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
        'TTD' => '&#36;',
        'TWD' => '&#78;&#84;&#36;',
        'TZS' => '',
        'UAH' => '&#8372;',
        'UGX' => '&#85;&#83;&#104;',
        'USD' => '&#36;',
        'UYU' => '&#36;&#85;',
        'UZS' => '&#1083;&#1074;',
        'VEF' => '&#66;&#115;',
        'VND' => '&#8363;',
        'VUV' => '&#86;&#84;',
        'WST' => '&#87;&#83;&#36;',
        'XAF' => '&#70;&#67;&#70;&#65;',
        'XCD' => '&#36;',
        'XDR' => '',
        'XOF' => '',
        'XPF' => '&#70;',
        'YER' => '&#65020;',
        'ZAR' => '&#82;',
        'ZMK' => '&#90;&#75;', // ?
        'ZWL' => '&#90;&#36;',
    );

    $currency_html_code = $currency_symbols[$code];

    return $currency_html_code;
}
function getCurrencyList()
{
    // count 164
    $currency_list = array(
        "AFA" => "Afghan Afghani",
        "ALL" => "Albanian Lek",
        "DZD" => "Algerian Dinar",
        "AOA" => "Angolan Kwanza",
        "ARS" => "Argentine Peso",
        "AMD" => "Armenian Dram",
        "AWG" => "Aruban Florin",
        "AUD" => "Australian Dollar",
        "AZN" => "Azerbaijani Manat",
        "BSD" => "Bahamian Dollar",
        "BHD" => "Bahraini Dinar",
        "BDT" => "Bangladeshi Taka",
        "BBD" => "Barbadian Dollar",
        "BYR" => "Belarusian Ruble",
        "BEF" => "Belgian Franc",
        "BZD" => "Belize Dollar",
        "BMD" => "Bermudan Dollar",
        "BTN" => "Bhutanese Ngultrum",
        "BTC" => "Bitcoin",
        "BOB" => "Bolivian Boliviano",
        "BAM" => "Bosnia",
        "BWP" => "Botswanan Pula",
        "BRL" => "Brazilian Real",
        "GBP" => "British Pound Sterling",
        "BND" => "Brunei Dollar",
        "BGN" => "Bulgarian Lev",
        "BIF" => "Burundian Franc",
        "KHR" => "Cambodian Riel",
        "CAD" => "Canadian Dollar",
        "CVE" => "Cape Verdean Escudo",
        "KYD" => "Cayman Islands Dollar",
        "XOF" => "CFA Franc BCEAO",
        "XAF" => "CFA Franc BEAC",
        "XPF" => "CFP Franc",
        "CLP" => "Chilean Peso",
        "CNY" => "Chinese Yuan",
        "COP" => "Colombian Peso",
        "KMF" => "Comorian Franc",
        "CDF" => "Congolese Franc",
        "CRC" => "Costa Rican ColÃ³n",
        "HRK" => "Croatian Kuna",
        "CUC" => "Cuban Convertible Peso",
        "CZK" => "Czech Republic Koruna",
        "DKK" => "Danish Krone",
        "DJF" => "Djiboutian Franc",
        "DOP" => "Dominican Peso",
        "XCD" => "East Caribbean Dollar",
        "EGP" => "Egyptian Pound",
        "ERN" => "Eritrean Nakfa",
        "EEK" => "Estonian Kroon",
        "ETB" => "Ethiopian Birr",
        "EUR" => "Euro",
        "FKP" => "Falkland Islands Pound",
        "FJD" => "Fijian Dollar",
        "GMD" => "Gambian Dalasi",
        "GEL" => "Georgian Lari",
        "DEM" => "German Mark",
        "GHS" => "Ghanaian Cedi",
        "GIP" => "Gibraltar Pound",
        "GRD" => "Greek Drachma",
        "GTQ" => "Guatemalan Quetzal",
        "GNF" => "Guinean Franc",
        "GYD" => "Guyanaese Dollar",
        "HTG" => "Haitian Gourde",
        "HNL" => "Honduran Lempira",
        "HKD" => "Hong Kong Dollar",
        "HUF" => "Hungarian Forint",
        "ISK" => "Icelandic KrÃ³na",
        "INR" => "Indian Rupee",
        "IDR" => "Indonesian Rupiah",
        "IRR" => "Iranian Rial",
        "IQD" => "Iraqi Dinar",
        "ILS" => "Israeli New Sheqel",
        "ITL" => "Italian Lira",
        "JMD" => "Jamaican Dollar",
        "JPY" => "Japanese Yen",
        "JOD" => "Jordanian Dinar",
        "KZT" => "Kazakhstani Tenge",
        "KES" => "Kenyan Shilling",
        "KWD" => "Kuwaiti Dinar",
        "KGS" => "Kyrgystani Som",
        "LAK" => "Laotian Kip",
        "LVL" => "Latvian Lats",
        "LBP" => "Lebanese Pound",
        "LSL" => "Lesotho Loti",
        "LRD" => "Liberian Dollar",
        "LYD" => "Libyan Dinar",
        "LTL" => "Lithuanian Litas",
        "MOP" => "Macanese Pataca",
        "MKD" => "Macedonian Denar",
        "MGA" => "Malagasy Ariary",
        "MWK" => "Malawian Kwacha",
        "MYR" => "Malaysian Ringgit",
        "MVR" => "Maldivian Rufiyaa",
        "MRO" => "Mauritanian Ouguiya",
        "MUR" => "Mauritian Rupee",
        "MXN" => "Mexican Peso",
        "MDL" => "Moldovan Leu",
        "MNT" => "Mongolian Tugrik",
        "MAD" => "Moroccan Dirham",
        "MZM" => "Mozambican Metical",
        "MMK" => "Myanmar Kyat",
        "NAD" => "Namibian Dollar",
        "NPR" => "Nepalese Rupee",
        "ANG" => "Netherlands Antillean Guilder",
        "TWD" => "New Taiwan Dollar",
        "NZD" => "New Zealand Dollar",
        "NIO" => "Nicaraguan CÃ³rdoba",
        "NGN" => "Nigerian Naira",
        "KPW" => "North Korean Won",
        "NOK" => "Norwegian Krone",
        "OMR" => "Omani Rial",
        "PKR" => "Pakistani Rupee",
        "PAB" => "Panamanian Balboa",
        "PGK" => "Papua New Guinean Kina",
        "PYG" => "Paraguayan Guarani",
        "PEN" => "Peruvian Nuevo Sol",
        "PHP" => "Philippine Peso",
        "PLN" => "Polish Zloty",
        "QAR" => "Qatari Rial",
        "RON" => "Romanian Leu",
        "RUB" => "Russian Ruble",
        "RWF" => "Rwandan Franc",
        "SVC" => "Salvadoran ColÃ³n",
        "WST" => "Samoan Tala",
        "SAR" => "Saudi Riyal",
        "RSD" => "Serbian Dinar",
        "SCR" => "Seychellois Rupee",
        "SLL" => "Sierra Leonean Leone",
        "SGD" => "Singapore Dollar",
        "SKK" => "Slovak Koruna",
        "SBD" => "Solomon Islands Dollar",
        "SOS" => "Somali Shilling",
        "ZAR" => "South African Rand",
        "KRW" => "South Korean Won",
        "XDR" => "Special Drawing Rights",
        "LKR" => "Sri Lankan Rupee",
        "SHP" => "St. Helena Pound",
        "SDG" => "Sudanese Pound",
        "SRD" => "Surinamese Dollar",
        "SZL" => "Swazi Lilangeni",
        "SEK" => "Swedish Krona",
        "CHF" => "Swiss Franc",
        "SYP" => "Syrian Pound",
        "STD" => "São Tomé and Príncipe Dobra",
        "TJS" => "Tajikistani Somoni",
        "TZS" => "Tanzanian Shilling",
        "THB" => "Thai Baht",
        "TOP" => "Tongan pa'anga",
        "TTD" => "Trinidad & Tobago Dollar",
        "TND" => "Tunisian Dinar",
        "TRY" => "Turkish Lira",
        "TMT" => "Turkmenistani Manat",
        "UGX" => "Ugandan Shilling",
        "UAH" => "Ukrainian Hryvnia",
        "AED" => "United Arab Emirates Dirham",
        "UYU" => "Uruguayan Peso",
        "USD" => "US Dollar",
        "UZS" => "Uzbekistan Som",
        "VUV" => "Vanuatu Vatu",
        "VEF" => "Venezuelan BolÃvar",
        "VND" => "Vietnamese Dong",
        "YER" => "Yemeni Rial",
        "ZMK" => "Zambian Kwacha"
    );


    return $currency_list;
}
// Define the helper function outside of any class
function putPermanentEnv($key, $value)
{
    $path = app()->environmentFilePath();
    $escaped = preg_quote(env($key), '/');

    file_put_contents($path, preg_replace(
        "/^{$key}={$escaped}/m",
        "{$key}={$value}",
        file_get_contents($path)
    ));
}


class Admin extends Controller
{
    use SendNotification;
    public function admin()
    {
        return view('admin.admin');
    }

    public function Delete_service(Request $request)
    {
        $category = Campaign::find($request->id);
        $category->delete();

        return back()->with('success', 'Deleted Succesuufully');
    }
    public function Pcreate()
    {
        if (Session::has('LoggedIn')) {
            $permissions = Permissions::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $title = 'Permission Create';
            return view('admin.permissions.create', compact('user_session', 'permissions', 'title'));
        }
    }
    public function Plist()
    {
        if (Session::has('LoggedIn')) {
            $permissions = Permissions::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $title = 'Permission List';
            return view('admin.permissions.index', compact('user_session', 'permissions', 'title'));
        }
    }
    public function Pstore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:permissions,id'
        ]);

        Permissions::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }
    public function Pedit(Request $request, $id)
    {
        if (Session::has('LoggedIn')) {
            $permission = Permissions::findOrFail($id);
            $permissions = Permissions::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $title = 'Permission Edit';
            return view('admin.permissions.edit', compact('user_session', 'permission', 'permissions', 'title'));
        }
    }
    public function Pupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:permissions,id',
        ]);

        $permission = Permissions::findOrFail($id);
        $permission->name = $request->name;
        $permission->parent_id = $request->parent_id;
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }
    public function pdestroy($id)
    {
        try {
            $permission = Permissions::findOrFail($id);
            $permission->delete();
            return response()->json(['success' => 'Permission deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete permission.'], 500);
        }
    }


    public function registration(Request $request)
    {
        $user = new User();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'pass' => 'required'
        ]);
        $user->name = $request->first_name;
        $user->lastname = $request->last_name;
        $user->email = $request->email;
        $user->password = FacadesHash::make($request->pass);
        $data = $user->save();
        if ($data) {
            return back()->with('success', 'Registered');
        } else {
            return back()->with('fail', 'failed');
        }
    }


    public function notificationUrl($uuid)
    {
        $notification = Notification::whereUuid($uuid)->first();
        $notification->is_seen = 'yes';
        $notification->save();

        if (is_null($notification->target_url)) {
            return redirect(url()->previous());
        } else {
            return redirect($notification->target_url);
        }
    }

    public function markAllAsReadNotification(Request $request)
    {
        $userId = $request->input('user_id');
        $data = User::find($userId);



        Notification::where('user_id', $userId)->where('is_seen', 'no')->update(['is_seen' => 'yes']);


        return back();
    }
    public function login(Request $request)
    {
        $user = new user();
        $request->validate([
            'email' => 'required',
            'password' => 'required'

        ]);

        $data = user::where('email', $request->email)->where('account_type', 'admin')->first();
        // print_r($data->password);

        // die;
        if ($data) {
            if (FacadesHash::check($request->password, $data->password)) {

                $session = $request->session()->all();
                $data->update(['is_online' => 1, 'last_seen' => Carbon::now()]);
                session()->put('LoggedIn', $data->id);

                return redirect('admin/dashboard');
            } else {
                return back()->with('fail', 'Password does not match');
            }
        } else {
            return back()->with('fail', 'Email is not register');
        }
    }

    public function dashboard(Request $request)
    {
        if (Session::has('LoggedIn')) {

            $usersData = DB::table("users")->where('is_super_admin', '0')->orderby('id', 'desc')->limit('5')->get();
            $total_users = User::where('is_super_admin', 0)
                ->whereNot('account_type', 'admin')
                ->get();

            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            $labels2 = [];
            $data2 = [];

            // Get the start and end of the current week
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();

            // Generate labels and fetch data for each day of the current week
            for ($date = $startDate; $date <= $endDate; $date->addDay()) {
                // Append day to labels array
                $labels2[] = $date->format('D, M j');

                // Fetch payments for the current day with 'accepted' = 1
                $totalSale = DB::table('payments')
                    ->where('accepted', 1)
                    ->whereDate('created_at', $date->format('Y-m-d'))
                    ->sum('amount');

                // Append total sale to data array
                $data2[] = $totalSale;
            }

            $chartData2 = [
                'labels2' => $labels2, // Labels in order from start to end of week
                'data2' => $data2, // Data matches the order of labels
            ];


            return view('admin.dashboard', compact('user_session', 'total_users', 'usersData', 'chartData2'));
        }
    }
    public function getPaymentData(Request $request)
    {
        $type = $request->input('type', 'week'); // Default to week if not provided
        $data = [];

        switch ($type) {
            case 'week':
                $data = $this->calculateWeeklyData();
                break;
            case 'month':
                $data = $this->calculateMonthlyData();
                break;
            case 'year':
                $data = $this->calculateYearlyData();
                break;
            default:
                return response()->json(['error' => 'Invalid type provided'], 400);
        }

        return response()->json($data);
    }

    protected function calculateWeeklyData()
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $labels2 = [];
        $data2 = [];

        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $labels2[] = $date->format('D, M j');
            $totalSale = DB::table('payments')

                ->whereDate('created_at', $date->format('Y-m-d'))
                ->sum('amount');
            $data2[] = $totalSale;
        }

        return ['labels2' => $labels2, 'data2' => $data2];
    }

    protected function calculateMonthlyData()
    {
        $labels2 = [];
        $data2 = [];

        $currentMonth = date('m');
        $currentYear = date('Y');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $day);
            $labels2[] = date('d M', strtotime($date)); // Format as 'day Month'
            $totalSale = DB::table('payments')

                ->whereDate('created_at', $date)
                ->sum('amount');
            $data2[] = $totalSale;
        }

        return ['labels2' => $labels2, 'data2' => $data2];
    }

    protected function calculateYearlyData()
    {
        $labels2 = [];
        $data2 = [];

        $currentYear = date('Y');

        for ($month = 1; $month <= 12; $month++) {
            $monthStart = sprintf('%04d-%02d-01', $currentYear, $month);
            $monthEnd = date('Y-m-t', strtotime($monthStart));
            $labels2[] = date('M', strtotime($monthStart)); // Format as 'Month'
            $totalSale = DB::table('payments')

                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('amount');
            $data2[] = $totalSale;
        }

        return ['labels2' => $labels2, 'data2' => $data2];
    }

    public function users(Request $request)
    {
        if (Session::has('LoggedIn')) {
            $usersData = DB::table("users")->where('is_super_admin', '0')->get();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin/users', compact('user_session', 'usersData'));
        }
    }
    public function country(Request $request)
    {
        if (Session::has('LoggedIn')) {
            $countries = Country::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.country', compact('user_session', 'countries'));
        }
    }
    public function city(Request $request)
    {
        if (Session::has('LoggedIn')) {
            $countries = City::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.city', compact('user_session', 'countries'));
        }
    }
    public function edit_user(Request $request, $id)
    {
        if (Session::has('LoggedIn')) {
            $userData = DB::table("users")->where('id', $id)->where('is_super_admin', '0')->first();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin/edit_user', compact('user_session', 'userData'));
        }
    }
    public function change_password(Request $request)
    {

        $data = array();
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', '=', Session::get('LoggedIn'))->first();
        }

        return view('admin.change_password', compact('user_session'));
    }

    public function update_password(Request $request)
    {


        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => ['same:new_password']
        ]);


        $data = User::find(Session::get('LoggedIn'));
        // $data = User::where('id', '=', Session::get('LoggedIn'))->first();
        if (!FacadesHash::check($request->old_password, $data->password)) {
            return back()->with("fail", "Old Password Doesn't match!");
        }
        if (FacadesHash::check($request->new_password, $data->password)) {
            return back()->with("fail", "Please enter a password which is not similar then current password!!");
        }
        #Update the new Password
        $data = User::where('id', '=', $data->id)->update([
            'password' => FacadesHash::make($request->new_password)

        ]);
        return redirect('admin/dashboard')->with('success', 'Successfully Updated');
    }



    public function profile(Request $request)
    {
        $data = array();
        if (Session::has('LoggedIn')) {
            $data = User::where('id', '=', Session::get('LoggedIn'))->first();
        }

        return view('admin.profile', compact('data'));
    }

    public function logout(Request $request)
    {
        if (Session::has('LoggedIn')) {

            $check = User::where('id', Session::get('LoggedIn'))->first();
            if ($check->is_super_admin == 0) {
                Session::forget('LoggedIn');
                $request->session()->invalidate();
                return redirect('/');
            }
            Session::forget('LoggedIn');
            $request->session()->invalidate();
            return redirect('admin/login');
        }
    }
    public function add_user()
    {
        if (Session::has('LoggedIn')) {


            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.add_user', compact('user_session'));
        }
    }
    public function save_user(Request $request)
    {

        $user = new User();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'alter_mobile_number' => 'required',
            'mobile_number' => 'required',
            'location' => 'required',
            'department' => 'required',
            'store' => 'required',
            'city' => 'required'
        ]);
        if (!empty($request->profile_photo)) {

            $image = $request->file('profile_photo')->getClientOriginalName();
            $final =  $request->profile_photo->move(public_path('profile_photo'), $image);
            $profile = $_FILES['profile_photo']['name'];
        } else {
            $profile = '';
        }

        // dd($request->all());

        // Create a new user instance
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => $request->password,
            'city' => ($request->city),
            'store' => $request->store,
            'department' => $request->department,
            'location' => $request->location,
            'price' =>  $request->price,
            'categories' => implode(',', $request->categories),
            'alter_mobile_number' => $request->alter_mobile_number,
            'profile_photo' => $profile,
            'status' => $request->status,
            'ip_address' => request()->ip(),
        ]);

        // Send email verification notification
        $user->notify(new VerifyEmailNotification($user));

        if ($user) {
            return redirect('admin\users')->with('success', 'User Add Successfully');
        } else {
            return back()->with('fail', 'failed');
        }
    }
    public function delete_user($id)
    {

        $user = User::where('id', '=', $id)->first();

        if ($user) {
            $user->delete();
            return back()->with('success', 'Deleted Successfully');
        } else {
            return back()->with('error', 'User not found');
        }
    }



    public function edit_profile()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.edit_profile', compact('user_session'));
        }
    }
    public function update_profile(Request $request)
    {


        if (!empty($request->profile_photo)) {

            $image = $request->file('profile_photo')->getClientOriginalName();
            $final =  $request->profile_photo->move(public_path('profile_photo'), $image);
            $profile = $_FILES['profile_photo']['name'];
        }
        $check = User::find($request->user_id);

        if (empty($request->profile_photo)) {

            $profile = $check->profile_photo;
        }
        $data = User::find(Session::get('LoggedIn'));
        $data = User::where('id', '=', $request->user_id)->update([
            'name' => ($request->name),
            'city' => $request->city,
            'email' => ($request->email),
            'profile_photo' => $profile

        ]);
        if ($data) {
            return redirect('admin/dashboard')->with('success', 'Profile Updted Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function update_user(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        // Perform validation, including potentially unique email for existing users other than the current one
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id, // Exclude current user from email uniqueness check
            // 'password' => 'nullable|confirmed', // Only validate password if provided
            'price' => 'required',
            'categories' => 'required',
            'alter_mobile_number' => 'required',
            'mobile_number' => 'required',
            'location' => 'required',
            'department' => 'required',
            'store' => 'required',
            'city' => 'required'
        ]);

        // Update user information only if fields are filled (prevents unnecessary updates)
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }


        if (!empty($request->profile_photo)) {

            $image = $request->file('profile_photo')->getClientOriginalName();
            $final =  $request->profile_photo->move(public_path('profile_photo'), $image);
            $profile = $_FILES['profile_photo']['name'];
        }
        $check = User::find($request->user_id);

        if (empty($request->profile_photo)) {

            $profile = $check->profile_photo;
        }
        $data = User::find(Session::get('LoggedIn'));
        $data = User::where('id', '=', $request->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'city' => ($request->city),
            'store' => $request->store,
            'department' => $request->department,
            'location' => $request->location,
            'price' =>  $request->price,
            'categories' => implode(',', $request->categories),
            'mobile_number' => $request->mobile_number,
            'alter_mobile_number' => $request->alter_mobile_number,
            'status' => $request->status,
            'ip_address' => request()->ip(),
            'profile_photo' => $profile,


        ]);
        if ($data) {
            return redirect('admin/users')->with('success', 'User Updted Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }
    public function forget_password()
    {

        return view('admin.forget_password');
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
                $data['auth'] = "Endless";

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
                return redirect('admin/forget_password')->with('success', 'Please check your mail to reset your password');
                // return response()->json(['success' => true, 'msg' => 'Please check your mail to reset your password.']);
            } else {
                return redirect('admin/forget_password')->with('fail', 'User not found');
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

            return view('admin.ResetPasswordLoad', ['customer' => $customer]);
        }
    }



    public function ResetPassword(Request $request)
    {

        $request->validate([

            'new_password' => 'required',
            'confirm_password' => ['same:new_password']
        ]);

        $data = User::find($request->user_id);
        if (FacadesHash::check($request->new_password, $data->password)) {
            return back()->with("fail", "Please enter a password which is not similar then current password!!");
        }
        $data->password = FacadesHash::make($request->new_password);
        $data->update();

        PasswordReset::where('email', $data->email)->delete();

        echo "<h1>Successfully Reset Password</h1>";
        return redirect('index');
    }


    public function service() //dispaly course list
    {
        if (Session::has('LoggedIn')) {

            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.services', compact('user_session'));
        }
    }
    public function AddService() //dispaly course list
    {
        if (Session::has('LoggedIn')) {

            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.add-service', compact('user_session'));
        }
    }
    public function save_service(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'category_icon' => 'required',
            'product_photo' => 'required',

            'description' => 'required',

        ]);
        $course = new Campaign();

        if (!empty($request->product_photo)) {

            $image = $request->file('product_photo')->getClientOriginalName();
            $request->product_photo->move(public_path('product_photo'), $image);
        }


        $course->category_id = $request->category_id;
        $course->category_icon = $request->category_icon;
        $course->course_photo = $_FILES['product_photo']['name'];

        $course->description = $request->description;

        $data = $course->save();
        if ($data) {
            return redirect('admin/services')->with('success', 'Service Added Successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function edit_service(Request $request)
    {

        if (Session::has('LoggedIn')) {

            $project_detail = Campaign::where('id', $request->id)->first();
            $category = Category::all();
            $countries = Country::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
        }
        return view('admin.edit_service', compact('countries', 'user_session', 'project_detail', 'category'));
    }

    public function update_service(Request $request)
    {


        // dd($request->all());
        $slug = unique_slug($request->title);

        // Retrieve the existing campaign by its ID
        $campaign = Campaign::findOrFail($request->id);
        $user_id = $campaign->user_id;
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
        $campaign->short_description = $request->short_description;
        $campaign->amount_prefilled = $request->amount_prefilled;
        $campaign->end_method = $request->end_method;
        $campaign->video = $request->video;
        $campaign->status = $request->status; // Assuming status is set to 0 for update
        $campaign->country_id = $request->country_id;
        $campaign->address = $request->address;
        $campaign->is_funded = 0; // Assuming is_funded is set to 0 for update
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;

        // Check if status is approved
        if ($request->status == "1") {
            $text = 'Project has been approved.';
        }
        // Check if status is rejected
        elseif ($request->status == "-1") {
            $text = 'Project has been rejected.';
        }
        // If status is neither approved nor rejected, handle accordingly
        else {
            $text = 'Project status is unknown.';
        }

        // Assuming you're constructing a URL for the project details using $slug
        $target_url = url('project-details', ['slug' => $slug]);

        // Assuming you're sending some API request with parameters
        // Adjust this part according to your API sending mechanism
        $this->sendForApi($text, 2, $target_url, 1, 1);

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
            return back()->with('success', 'Campaign updated successfully');
        }


        // If the update fails, return error message
        return back()->with('fail', 'Failed to update campaign');
    }

    public function smtp_setting()
    {

        if (Session::has('LoggedIn')) {
            $settings = GeneralSetting::findOrFail('1');
            $user_session = User::where('id', '=', Session::get('LoggedIn'))->first();
        }

        return view('admin.smtp_setting', compact('user_session', 'settings'));
    }



    public function update_smtp_setting(Request $request)
    {
        $settings = GeneralSetting::findOrFail('1');
        $inputs = $request->all();

        // Load the existing .env file
        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->load();

        // Update the environment variables
        putPermanentEnv('MAIL_HOST', $inputs['smtp_host']);
        putPermanentEnv('MAIL_PORT', $inputs['smtp_port']);
        putPermanentEnv('MAIL_USERNAME', $inputs['smtp_email']);
        putPermanentEnv('MAIL_PASSWORD', $inputs['smtp_password']);
        putPermanentEnv('MAIL_ENCRYPTION', $inputs['smtp_encryption']);
        putPermanentEnv('MAIL_FROM_ADDRESS', $inputs['smtp_email']);



        // Update the settings in the database
        $settings->smtp_host = $inputs['smtp_host'];
        $settings->smtp_port = $inputs['smtp_port'];
        $settings->smtp_email = $inputs['smtp_email'];
        $settings->smtp_password = $inputs['smtp_password'];
        $settings->smtp_encryption = $inputs['smtp_encryption'];

        $data = $settings->save();

        return back()->with('success', 'Updated Successfully');
    }




    public function webSite_setting()
    {
        if (Session::has('LoggedIn')) {
            $time = generateTimezoneList();
            $currency = getCurrencyList();

            $settings = GeneralSetting::findOrFail('1');


            $user_session = User::where('id', '=', Session::get('LoggedIn'))->first();
        }

        return view('admin.website_setting', compact('user_session', 'settings', 'time', 'currency'));
    }
    public function update_general_settings(Request $request)
    {
        $settings = GeneralSetting::findOrFail(1);

        // Load the existing .env file
        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->load();

        $inputs = $request->all();

        putPermanentEnv('APP_TIMEZONE', $inputs['time_zone']);
        putPermanentEnv('APP_LANG', $inputs['default_language']);

        $settings->time_zone = $inputs['time_zone'];
        $settings->default_language = $inputs['default_language'];
        $settings->styling = $inputs['styling'];
        $settings->address = $inputs['address'];
        $settings->currency_code = $inputs['currency_code'];

        if ($request->hasFile('site_logo')) {
            $image = $request->file('site_logo')->getClientOriginalName();
            $request->file('site_logo')->move(public_path('site_logo'), $image);
            $settings->site_logo = $image;
        }

        if ($request->hasFile('site_favicon')) {
            $image = $request->file('site_favicon')->getClientOriginalName();
            $request->file('site_favicon')->move(public_path('site_favicon'), $image);
            $settings->site_favicon = $image;
        }

        $settings->site_name = addslashes($inputs['site_name']);
        $settings->site_email = $inputs['site_email'];
        $settings->site_description = addslashes($inputs['site_description']);
        $settings->site_keywords = addslashes($inputs['site_keywords']);
        $settings->site_copyright = addslashes($inputs['site_copyright']);

        $settings->footer_fb_link = addslashes($inputs['footer_fb_link']);
        $settings->footer_twitter_link = addslashes($inputs['footer_twitter_link']);
        $settings->footer_instagram_link = addslashes($inputs['footer_instagram_link']);

        $data = $settings->save();

        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function social_lite_login()
    {
        if (Session::has('LoggedIn')) {
            $settings = GeneralSetting::findOrFail('1');

            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.social_lite_login', compact('user_session', 'settings'));
        }
    }
    public function update_social_login_settings(Request $request)
    {

        $settings = GeneralSetting::findOrFail('1');
        $inputs = $request->all();
        // Load the existing .env file
        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->load();
        $google_redirect = URL::to('auth/google/callback');
        $facebook_redirect = URL::to('auth/facebook/callback');
        $git_redirect = URL::to('auth/git/callback');
        $insta_redirect = URL::to('auth/instagram/callback');
        $lindin_redirect = URL::to('auth/lindin/callback');
        $twitter_redirect = URL::to('auth/twitter/callback');

        putPermanentEnv('GOOGLE_CLIENT_DI', $inputs['google_client_id']);
        putPermanentEnv('GOOGLE_SECRET', $inputs['google_secret_id']);
        putPermanentEnv('GOOGLE_REDIRECT', $google_redirect);

        putPermanentEnv('FB_APP_ID', $inputs['Facebook_app_id']);
        putPermanentEnv('FB_SECRET', $inputs['Facebook_client_id']);
        putPermanentEnv('FB_REDIRECT', $facebook_redirect);

        putPermanentEnv('GIT_CLIENT_DI', $inputs['git_app_id']);
        putPermanentEnv('GIT_SECRET', $inputs['git_client_id']);
        putPermanentEnv('GIT_REDIRECT', $google_redirect);

        putPermanentEnv('INSTAGRAM_APP_ID', $inputs['instagram_app_id']);
        putPermanentEnv('INSTAGRAM_SECRET', $inputs['Instagram_client_id']);
        putPermanentEnv('INSTAGRAM_REDIRECT', $facebook_redirect);

        putPermanentEnv('LINKEDIN_CLIENT_DI', $inputs['linkedin_app_id']);
        putPermanentEnv('LINKEDIN_SECRET', $inputs['linkedin_client_id']);
        putPermanentEnv('LINKEDIN_REDIRECT', $facebook_redirect);

        putPermanentEnv('TWITTER_APP_ID', $inputs['twitter_app_id']);
        putPermanentEnv('TWITTER_SECRET', $inputs['twitter_client_id']);
        putPermanentEnv('TWITTER_REDIRECT', $facebook_redirect);


        $settings->google_login = $inputs['google_login'];
        $settings->google_client_id = $inputs['google_client_id'];
        $settings->google_client_secret = $inputs['google_secret_id'];
        $settings->google_redirect = $google_redirect;

        $settings->facebook_login = $inputs['Facebook_login'];
        $settings->facebook_app_id = $inputs['Facebook_app_id'];
        $settings->facebook_client_secret = $inputs['Facebook_client_id'];
        $settings->facebook_redirect = $facebook_redirect;


        $settings->git_login = $inputs['git_login'];
        $settings->git_app_id = $inputs['git_app_id'];
        $settings->git_client_id = $inputs['git_client_id'];
        $settings->google_redirect = $git_redirect;

        $settings->Instagram_login = $inputs['Instagram_login'];
        $settings->instagram_app_id = $inputs['instagram_app_id'];
        $settings->Instagram_client_id = $inputs['Instagram_client_id'];
        $settings->facebook_redirect = $insta_redirect;

        $settings->linkedin_login = $inputs['linkedin_login'];
        $settings->linkedin_app_id = $inputs['linkedin_app_id'];
        $settings->linkedin_client_id = $inputs['linkedin_client_id'];
        $settings->facebook_redirect = $lindin_redirect;


        $settings->twitter_login = $inputs['twitter_login'];
        $settings->twitter_app_id = $inputs['twitter_app_id'];
        $settings->twitter_client_id  = $inputs['twitter_client_id'];
        $settings->facebook_redirect = $twitter_redirect;

        $data = $settings->save();

        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function list()
    {
        if (Session::has('LoggedIn')) {
            $page_title = trans('payment_gateway');

            $list = PaymentGateway::orderBy('id')->get();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.payment_gateway_list', compact('user_session', 'page_title', 'list'));
        }
    }

    public function edit(Request $request, $id)
    {

        if (Session::has('LoggedIn')) {
            $post_info = PaymentGateway::findOrFail($id);

            $gateway_info = json_decode($post_info->gateway_info);
            $user_session = User::where('id', Session::get('LoggedIn'))->first();
            //echo $gateway_info->mode;
            // exit;

            if ($id == 1) {
                $page_title = 'PayPal';

                return view('admin.pages.gateway.paypal', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            } else if ($id == 2) {
                $page_title = 'Stripe';

                return view('admin.pages.gateway.stripe', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            } else if ($id == 3) {
                $page_title = 'Razorpay';

                return view('admin.pages.gateway.razorpay', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            } else if ($id == 4) {
                $page_title = 'Paystack';

                return view('admin.pages.gateway.paystack', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            } else if ($id == 5) {
                $page_title = 'Instamojo';

                return view('admin.pages.gateway.instamojo', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            } else if ($id == 6) {
                $page_title = 'PayUMoney';

                return view('admin.pages.gateway.payu', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            } else if ($id == 7) {
                $page_title = 'mollie';

                return view('admin.pages.gateway.mollie', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            } else if ($id == 8) {
                $page_title = 'Flutterwave';

                return view('admin.pages.gateway.flutterwave', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            } else if ($id == 9) {
                $page_title = 'Paytm';

                return view('admin.pages.gateway.paytm', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            } else if ($id == 10) {
                $page_title = 'Cashfree';

                return view('admin.pages.gateway.cashfree', compact('page_title', 'post_info', 'gateway_info', 'user_session'));
            }
        }
    }

    public function paypal(Request $request)
    {



        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

        putPermanentEnv('PAYPAL_MODE', $inputs['mode']);

        if ($inputs['mode'] == "sandbox") {
            putPermanentEnv('PAYPAL_SANDBOX_CLIENT_ID', $inputs['paypal_client_id']);
            putPermanentEnv('PAYPAL_SANDBOX_CLIENT_SECRET', $inputs['paypal_secret']);
        } else {
            putPermanentEnv('PAYPAL_LIVE_CLIENT_ID', $inputs['paypal_client_id']);
            putPermanentEnv('PAYPAL_LIVE_CLIENT_SECRET', $inputs['paypal_secret']);
        }

        $mode = $inputs['mode'];
        $paypal_client_id = $inputs['paypal_client_id'];
        $paypal_secret = $inputs['paypal_secret'];

        $braintree_merchant_id = $inputs['braintree_merchant_id'];
        $braintree_public_key = $inputs['braintree_public_key'];
        $braintree_private_key = $inputs['braintree_private_key'];
        $braintree_merchant_account_id = $inputs['braintree_merchant_account_id'];

        $gateway_data = json_encode(['mode' => $mode, 'paypal_client_id' => $paypal_client_id, 'paypal_secret' => $paypal_secret, 'braintree_merchant_id' => $braintree_merchant_id, 'braintree_public_key' => $braintree_public_key, 'braintree_private_key' => $braintree_private_key, 'braintree_merchant_account_id' => $braintree_merchant_account_id]);

        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];
        $data =  $ad_obj->save();

        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function stripe(Request $request)
    {

        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

        putPermanentEnv('STRIPE_PUBLISHABLE_KEY', $inputs['stripe_publishable_key']);
        putPermanentEnv('STRIPE_SECRET_KEY', $inputs['stripe_secret_key']);

        $stripe_secret_key = $inputs['stripe_secret_key'];
        $stripe_publishable_key = $inputs['stripe_publishable_key'];

        $gateway_data = json_encode(['stripe_secret_key' => $stripe_secret_key, 'stripe_publishable_key' => $stripe_publishable_key]);

        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];
        $data =  $ad_obj->save();
        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function razorpay(Request $request)
    {


        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

        $razorpay_key = $inputs['razorpay_key'];
        $razorpay_secret = $inputs['razorpay_secret'];

        putPermanentEnv('RAZORPAY_KEY', $inputs['razorpay_key']);
        putPermanentEnv('RAZORPAY_SECRET', $inputs['razorpay_secret']);


        $gateway_data = json_encode(['razorpay_key' => $razorpay_key, 'razorpay_secret' => $razorpay_secret]);

        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];;

        $data =  $ad_obj->save();
        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function paystack(Request $request)
    {

        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

        $paystack_secret_key = $inputs['paystack_secret_key'];
        $paystack_public_key = $inputs['paystack_public_key'];

        putPermanentEnv('PAYSTACK_PUBLIC_KEY', $inputs['paystack_public_key']);
        putPermanentEnv('PAYSTACK_SECRET_KEY', $inputs['paystack_secret_key']);


        $gateway_data = json_encode(['paystack_secret_key' => $paystack_secret_key, 'paystack_public_key' => $paystack_public_key]);

        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];
        $data =  $ad_obj->save();
        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function instamojo(Request $request)
    {

        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

        $mode = $inputs['mode'];
        $instamojo_client_id = $inputs['instamojo_client_id'];
        $instamojo_client_secret = $inputs['instamojo_client_secret'];

        putPermanentEnv('MODE', $inputs['mode']);

        if ($inputs['mode'] == "sandbox") {
            putPermanentEnv('INSTAMOJO_CLIENT_ID', $inputs['instamojo_client_id']);
            putPermanentEnv('INSTAMOJO_CLIENT_SECRET', $inputs['instamojo_client_secret']);
        } else {
            putPermanentEnv('INSTAMOJO_CLIENT_ID', $inputs['instamojo_client_id']);
            putPermanentEnv('INSTAMOJO_CLIENT_SECRET', $inputs['instamojo_client_secret']);
        }

        $gateway_data = json_encode(['mode' => $mode, 'instamojo_client_id' => $instamojo_client_id, 'instamojo_client_secret' => $instamojo_client_secret]);

        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];
        $data =  $ad_obj->save();
        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function payu(Request $request)
    {

        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

        $mode = $inputs['mode'];
        $payu_merchant_id = $inputs['payu_merchant_id'];
        $payu_key = $inputs['payu_key'];
        $payu_salt = $inputs['payu_salt'];


        putPermanentEnv('MODE', $inputs['mode']);

        if ($inputs['mode'] == "sandbox") {
            putPermanentEnv('PAYU_MERCHANT_ID', $inputs['payu_merchant_id']);
            putPermanentEnv('PAYU_KEY', $inputs['payu_key']);
            putPermanentEnv('PAYU_SALT', $inputs['payu_salt']);
        } else {
            putPermanentEnv('PAYU_MERCHANT_ID', $inputs['payu_merchant_id']);
            putPermanentEnv('PAYU_KEY', $inputs['payu_key']);
            putPermanentEnv('PAYU_SALT', $inputs['payu_salt']);
        }

        $gateway_data = json_encode(['mode' => $mode, 'payu_merchant_id' => $payu_merchant_id, 'payu_key' => $payu_key, 'payu_salt' => $payu_salt]);

        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];
        $data =  $ad_obj->save();
        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function mollie(Request $request)
    {

        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

        $mollie_api_key = $inputs['mollie_api_key'];

        $gateway_data = json_encode(['mollie_api_key' => $mollie_api_key]);



        putPermanentEnv('MOLLIE_API_KEY', $inputs['mollie_api_key']);
        putPermanentEnv('GATEWAY_DATA', $gateway_data);

        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];
        $data =  $ad_obj->save();
        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function flutterwave(Request $request)
    {


        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

        $flutterwave_public_key = $inputs['flutterwave_public_key'];
        $flutterwave_secret_key = $inputs['flutterwave_secret_key'];
        $flutterwave_encryption_key = $inputs['flutterwave_encryption_key'];

        putPermanentEnv('FLUTTERWAVE_PUBLIC_KEY', $inputs['flutterwave_public_key']);
        putPermanentEnv('FLUTTERWAVE_SECRET_KEY', $inputs['flutterwave_secret_key']);
        putPermanentEnv('FLUTTERWAVE_ENCRYPTION_KEY', $inputs['flutterwave_encryption_key']);


        $gateway_data = json_encode(['flutterwave_public_key' => $flutterwave_public_key, 'flutterwave_secret_key' => $flutterwave_secret_key, 'flutterwave_encryption_key' => $flutterwave_encryption_key]);

        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];
        $ad_obj->save();


        return redirect('payment_gateway');
    }

    public function paytm(Request $request)
    {

        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

        $mode = $inputs['mode'];
        $paytm_merchant_id = $inputs['paytm_merchant_id'];
        $paytm_merchant_key = $inputs['paytm_merchant_key'];

        $gateway_data = json_encode(['mode' => $mode, 'paytm_merchant_id' => $paytm_merchant_id, 'paytm_merchant_key' => $paytm_merchant_key]);
        putPermanentEnv('MODE', $inputs['mode']);

        if ($inputs['mode'] == "sandbox") {
            putPermanentEnv('PAYTM_MERCHANT_ID', $inputs['paytm_merchant_id']);
            putPermanentEnv('PAYTM_MERCHANT_KEY', $inputs['paytm_merchant_key']);
        } else {
            putPermanentEnv('PAYTM_MERCHANT_ID', $inputs['paytm_merchant_id']);
            putPermanentEnv('PAYTM_MERCHANT_KEY', $inputs['paytm_merchant_key']);
        }
        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];
        $data =  $ad_obj->save();
        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function cashfree(Request $request)
    {

        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);


        $mode = $inputs['mode'];
        $cashfree_appid = $inputs['cashfree_appid'];
        $cashfree_secret_key = $inputs['cashfree_secret_key'];

        $gateway_data = json_encode(['mode' => $mode, 'cashfree_appid' => $cashfree_appid, 'cashfree_secret_key' => $cashfree_secret_key]);
        putPermanentEnv('MODE', $inputs['mode']);

        if ($inputs['mode'] == "sandbox") {
            putPermanentEnv('CASHFREE_APPID', $inputs['cashfree_appid']);
            putPermanentEnv('CASHFREE_SECRET_KEY', $inputs['cashfree_secret_key']);
        } else {
            putPermanentEnv('CASHFREE_APPID', $inputs['cashfree_appid']);
            putPermanentEnv('CASHFREE_SECRET_KEY', $inputs['cashfree_secret_key']);
        }

        $ad_obj->gateway_name = addslashes($inputs['gateway_name']);
        $ad_obj->gateway_info = $gateway_data;

        $ad_obj->status = $inputs['status'];
        $data =  $ad_obj->save();
        if ($data) {
            return back()->with('success', 'Updated Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }



    public function transactions_report(Request $request)
    {

        if (Session::has('LoggedIn')) {

            $transaction = Payment::all();
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.balance', compact('user_session', 'transaction'));
        }
    }
    public function getOrderDetails($orderId)
    {
        // Fetch order details from your database
        $order = Order::where('id', $orderId)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $transaction = Payment::where('order_id', $orderId)->first();

        // Assuming `product_details` field contains JSON data of products
        $products = json_decode($transaction->product_details, true);

        // Prepare an array to store detailed product information
        $aggregatedProducts = [];

        // Aggregate quantities and prices
        foreach ($products as $product) {
            $productId = $product['product_id'];

            // Fetch product details
            $productDetails = Product::find($productId);

            // Skip if product details not found
            if (!$productDetails) {
                continue;
            }

            // Fetch order item to get color
            $orderItem = OrderItem::where('order_id', $orderId)
                ->where('product_id', $productId)
                ->first();

            $productColor = $orderItem ? $orderItem->color : 'N/A';
            $productSku = $productDetails->sku ?? 'N/A';

            // Aggregate product details by product_id
            if (!isset($aggregatedProducts[$productId])) {
                $aggregatedProducts[$productId] = [
                    'title' => $productDetails->title,
                    'sku' => $productSku,
                    'price' => $product['price'],
                    'quantity' => 0,
                    'color' => $productColor,
                    'image' => asset('product_images/' . $productDetails->f_thumbnail),
                ];
            }

            // Combine quantities and calculate total price
            $aggregatedProducts[$productId]['quantity'] += $product['quantity'];
            $aggregatedProducts[$productId]['total'] = $aggregatedProducts[$productId]['price'] * $aggregatedProducts[$productId]['quantity'];
        }

        // Convert aggregated products to a simple array
        $detailedProducts = array_values($aggregatedProducts);

        // Return order details as JSON response with detailed products
        return response()->json(['products' => $detailedProducts]);
    }
    public function accept($id)
    {
        // Accept credit reload request
        $Payment = Payment::findOrFail($id);
        $Payment->accepted = true;
        $Payment->save();

        // Implement any additional logic such as crediting the user's account

        return back()->with('success', 'Fund  accepted');
    }
}
