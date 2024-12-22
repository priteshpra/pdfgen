<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDevices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Services\CurlApiService;
use App\Services\FcmNotificationService;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;
use App\Exports\CouponsExport;
use App\Models\BussinessCategory;
use App\Models\City;
use App\Models\Cms;
use App\Models\Company;
use App\Models\Configuration;
use App\Models\Country;
use App\Models\Notification;
use App\Models\OtherDocument;
use App\Models\Page;
use App\Models\Role;
use App\Models\Scandocument;
use App\Models\State;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Password;
use PDF;
use PhpParser\Node\Stmt\TryCatch;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public $per_page_show;
    public $base_url;
    public $profile_path;
    public $doc_path;
    protected $curlApiService;
    protected $fcmNotificationService;
    public function __construct(CurlApiService $curlApiService, FcmNotificationService $fcmNotificationService)
    {
        $this->per_page_show = 50;
        $this->base_url = url('/');
        $this->profile_path = '/public/profile_images/';
        $this->curlApiService = $curlApiService;
        $this->fcmNotificationService = $fcmNotificationService;
    }

    /**
     * Login User.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }

        // try {
        $email = $request->email;
        $password = $request->password;
        $device_token = isset($request->device_token) ? $request->device_token : '';
        $device_type =
            isset($request->device_type) ? $request->device_type : 'Android';
        $api_version = isset($request->api_version) ? $request->api_version : '';
        $app_version = isset($request->app_version) ? $request->app_version : '';
        $os_version = isset($request->os_version) ? $request->os_version : '';
        $device_model_name = isset($request->device_model_name) ? $request->device_model_name : '';
        $app_language = isset($request->app_language) ? $request->app_language : '';
        $base_url = $this->base_url;
        DB::enableQueryLog();

        $chkUser = User::select(
            'users.id',
            'users.FirstName',
            'users.FirstName',
            'users.LastName',
            'users.MobileNo',
            'users.RegistrationType',
            'users.CompanyID',
            'users.Email',
            'users.UserType',
            'company.ClientCode',
            'company.FirmName',
            'company.CountryID',
            'company.StateID',
            'company.CityID',
            'company.PinCode',
            'company.AadharNumber',
            'company.GSTNumber',
            'company.PANNumber',
            'company.FirmType',
            'users.password',
            DB::raw('CASE WHEN users.UserType IN (3, 4) THEN company.Address ELSE users.Address END AS Address'),
        )
            ->leftJoin('company', 'company.CompanyID', '=', 'users.CompanyID')->where('users.Email', $email)->where('users.Status', 1)->first();

        if ($chkUser) {
            if (!Hash::check($password, $chkUser->password)) {
                $result['status'] = false;
                $result['message'] = "Invalid email or password";
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }
        }

        if ($chkUser) {
            $chkUser->CompanyID = $chkUser['CompanyID'];
            $token = $chkUser->createToken('authToken')->plainTextToken;
            $result['status'] = false;
            $result['message'] = "Login Succssfully!";
            $result['data'] = (object) [];

            $chkUser->user_id = $chkUser->id;
            $chkUser->token = $token;
            // add token devices login
            $arr = [
                'status' => 1,
                'device_token' => $device_token,
                'login_token' => $token,
                'device_type' => $device_type,
                'api_version' => $api_version,
                'app_version' => $app_version,
                'os_version' => $os_version,
                'device_model_name' => $device_model_name,
                'app_language' => $app_language,
                'user_id' => $chkUser->id,
            ];
            DB::table('user_devices')->insertGetId($arr);
            $userData = $chkUser->toArray();

            $configurationData = DB::table('configuration_table')->select('AndroidAppUrl', 'IOSAppUrl', 'IosAppVersion', 'AndroidAppVersion')->first();
            $userData['AndroidAppUrl'] = $configurationData->AndroidAppUrl;
            $userData['IOSAppUrl'] = $configurationData->IOSAppUrl;
            $userData['IosAppVersion'] = $configurationData->IosAppVersion;
            $userData['AndroidAppVersion'] = $configurationData->AndroidAppVersion;
            unset($userData['password']);

            // dd($userData);
            return response()->json(['status' => true, 'message' => 'Login successfully.', 'data' => $userData]);
        } else {
            $result['status'] = false;
            $result['message'] = "Invalid email or password";
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }
        // } catch (\Throwable $th) {
        //     return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        // }
    }

    /**
     * Logout functionality
     */
    public function logout(Request $request)
    {

        auth()->logout();

        $token = $request->header('token');
        $user = User::where('id', $request->user_id)->where('status', '1')->first();

        $userDevice = UserDevices::where('user_id', $request->user_id)->where('login_token', $token)->where('status', '1')->first();
        if ($userDevice) {
            $userDevice->device_token = '';
            $userDevice->status = '0';
            $userDevice->updated_at = date("Y-m-d H:i:s");
            $userDevice->save();
        }

        DB::table('user_devices')
            ->join("users", "user_devices.user_id", "=", "users.id")
            ->where("user_devices.login_token", "=", $token)
            ->where("user_devices.user_id", "=", $request->user_id)
            ->update(["user_devices.status" => '0', "user_devices.updated_at" => date("Y-m-d H:i:s"), 'user_devices.device_token' => '']);

        $result['status'] = true;
        $result['message'] = "Logout Successfully";
        $result['data'] = (object) [];

        return response()->json($result, 200);
    }

    /**
     * get Client list data.
     */
    public function getClients(Request $request)
    {
        $page_number = $request->page;
        $token = $request->header('token');
        $user_id = $request->user_id;
        $company_id = $request->company_id;
        $base_url = $this->base_url;
        $checkToken = $this->tokenVerify($token);
        try {
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }
            $client = User::leftJoin('company', 'company.CompanyID', '=', 'users.CompanyID')->where('users.Status', 1)->where('users.UserType', '3')->where('users.CompanyID', $company_id)->paginate($this->per_page_show, ['*'], 'page', $page_number);

            $pagination = [
                'total' => $client->total(),
                'count' => $client->count(),
                'per_page' => $client->perPage(),
                'current_page' => $client->currentPage(),
                'total_pages' => $client->lastPage(),
            ];

            $data = $client->map(function ($user) {
                return collect($user)->except(['password', 'role_id', 'email_verified_at'])->put('UserId', $user['id'])->toArray();
            })->toArray();

            $dataClients = [
                'pagination' => $pagination,
                'data' => $data,
            ];

            return response()->json(['status' => true, 'message' => 'Get Client list successfully', 'data' => $dataClients], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get CAS list data.
     */
    public function getCas(Request $request)
    {
        $page_number = $request->page;
        $token = $request->header('token');
        $user_id = $request->user_id;
        $company_id = $request->company_id;
        $base_url = $this->base_url;
        try {
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }
            $cas = User::leftJoin('company', 'company.CompanyID', '=', 'users.CompanyID')->where('users.Status', 1)->where('users.CompanyID', $company_id)->where('users.UserType', '4')->paginate($this->per_page_show, ['*'], 'page', $page_number);

            $pagination = [
                'total' => $cas->total(),
                'count' => $cas->count(),
                'per_page' => $cas->perPage(),
                'current_page' => $cas->currentPage(),
                'total_pages' => $cas->lastPage(),
            ];

            $data = $cas->map(function ($user) {
                return collect($user)->except(['password', 'role_id', 'email_verified_at'])->put('UserId', $user['id'])->toArray();
            })->toArray();

            $dataCAS = [
                'pagination' => $pagination,
                'data' => $data,
            ];

            return response()->json(['status' => true, 'message' => 'Get CAS list successfully', 'data' => $dataCAS], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get Employees list data.
     */
    public function getEmployee(Request $request)
    {
        $user_id = $request->user_id;
        $company_id = $request->company_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }
            $employee = User::select('*')->where('Status', 1)->where('CompanyID', $company_id)->where('UserType', '2')->paginate($this->per_page_show, ['*'], 'page', $page_number);

            $pagination = [
                'total' => $employee->total(),
                'count' => $employee->count(),
                'per_page' => $employee->perPage(),
                'current_page' => $employee->currentPage(),
                'total_pages' => $employee->lastPage(),
            ];
            $data = $employee->map(function ($user) {
                return collect($user)->except(['password', 'role_id', 'email_verified_at'])->put('UserId', $user['id'])->toArray();
            })->toArray();

            $dataEmployee = [
                'pagination' => $pagination,
                'data' => $data,
            ];

            return response()->json(['status' => true, 'message' => 'Get Emaployee list successfully', 'data' => $dataEmployee], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get Employee Detail data.
     */
    public function getEmployeeDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }
        try {
            $token = $request->header('token');
            $base_url = $this->base_url;
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            $employee_id = $request->employee_id;
            $employees = User::select('*')
                ->where('id', '=', $employee_id)
                ->where('Status', '=', 1)
                ->where('UserType', '=', '2')
                ->get();

            $evnt = [];
            foreach ($employees as $key => $value) {
                $evnt[] = $value;
            }
            return response()->json(['status' => true, 'message' => 'Get Employee details successfully', 'data' => $evnt], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get CAS Detail data.
     */
    public function getCASDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cas_id' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }
        try {
            $token = $request->header('token');
            $base_url = $this->base_url;
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            $cas_id = $request->cas_id;
            $cass = User::leftJoin('company', 'company.CompanyID', '=', 'users.CompanyID')
                ->where('users.CompanyID', '=', $cas_id)
                ->where('users.Status', '=', 1)
                ->where('users.UserType', '=', '4')
                ->get();

            $datas = [];
            foreach ($cass as $key => $value) {
                $datas[] = $value;
            }
            return response()->json(['status' => true, 'message' => 'Get CAS details successfully', 'data' => $datas], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get Client Detail data.
     */
    public function getClientDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }
        try {
            $token = $request->header('token');
            $base_url = $this->base_url;
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            $client_id = $request->client_id;
            $clients = User::leftJoin('company', 'company.CompanyID', '=', 'users.CompanyID')
                ->where('users.CompanyID', '=', $client_id)
                ->where('users.Status', '=', 1)
                ->where('users.UserType', '=', '3')
                ->get();

            $datas = [];
            foreach ($clients as $key => $value) {
                $datas[] = $value;
            }
            return response()->json(['status' => true, 'message' => 'Get Client details successfully', 'data' => $datas], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * add seller register.
     */
    public function addClient(Request $request)
    {
        $user = new User();

        $token = $request->header('token');
        $base_url = $this->base_url;
        try {

            $validator = Validator::make($request->all(), [
                'userData.fname' => 'required|string|max:255',
                'userData.lname' => 'required|string|max:255',
                'userData.email' => 'required|email|unique:users,email',
                'userData.mobile_no' => 'required|min:10|digits:10',
                'userData.password' => 'required|string|min:6',
                'userData.user_type' => 'required|integer',
                'clientData.firm_name' => 'required|string|max:255',
                'clientData.client_code' => 'required|string|max:4|unique:company,ClientCode',
                'clientData.PAN' => 'required|string|max:50',
                'clientData.GST' => 'required|string|max:50',
                'clientData.aadharNumber' => 'required|numeric',
                'clientData.address' => 'required|string',
                'clientData.countryID' => 'required|integer',
                'clientData.cityID' => 'required|integer',
                'clientData.stateID' => 'required|integer',
                'clientData.pincode' => 'required|numeric',
                'clientData.firm_type' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                    'data' => (object) [],
                ], 200);
            }
            $validatedData = $validator->validated();
            $email = $validatedData['userData']['email'];
            // Create the User
            $user = User::create([
                'FirstName' => $validatedData['userData']['fname'],
                'LastName' => $validatedData['userData']['lname'],
                'Email' => $validatedData['userData']['email'],
                'MobileNo' => $validatedData['userData']['mobile_no'],
                'password' => bcrypt($validatedData['userData']['password']),
                'UserType' => $validatedData['userData']['user_type'],
                'role_id' => 3
            ]);
            $lastInsertedUserId = $user->id;

            // Create the Client
            $client = Company::create([
                'FirmName' => $validatedData['clientData']['firm_name'],
                'PANNumber' => $validatedData['clientData']['PAN'],
                'ClientCode' => $validatedData['clientData']['client_code'],
                'GSTNumber' => $validatedData['clientData']['GST'],
                'AadharNumber' => $validatedData['clientData']['aadharNumber'],
                'Address' => $validatedData['clientData']['address'],
                'CountryID' => $validatedData['clientData']['countryID'],
                'CityID' => $validatedData['clientData']['cityID'],
                'StateID' => $validatedData['clientData']['stateID'],
                'PinCode' => $validatedData['clientData']['pincode'],
                'FirmType' => $validatedData['clientData']['firm_type'],
                'CreatedBy' => $lastInsertedUserId,
            ]);
            $lastInsertedclientId = $client->CompanyID;
            $updateClient = User::find($lastInsertedUserId);
            $updateClient->CompanyID = $lastInsertedclientId;
            $updateClient->save();

            $clientData = [
                'user' => array_merge(array_diff_key($user->toArray(), ['password' => '', 'role_id' => '', 'Address' => '']), ['CompanyID' => $lastInsertedclientId, 'UserId' => $lastInsertedUserId]),
                'client' => $client,
            ];

            $emailContent = "<html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            color: #333;
                        }
                        h1 {
                            color: #007bff;
                        }
                        .footer {
                            margin-top: 20px;
                            font-size: 12px;
                            color: #999;
                        }
                    </style>
                </head>
                <body>
                    <h1>Registration Confirmation</h1>
                    <p>Hello,</p>
                    <p>Thank you for registering with us. We have successfully received your registration details.</p>
                    <p>Currently, your account is under review and awaiting approval by our administrator. Please expect an update soon once your account is approved.</p>
                    <p>If you did not register for this account or believe there has been a mistake, please contact our support team immediately.</p>
                    <div class='footer'>
                        <p>This email was automatically generated. Do not reply.</p>
                        <p>If you need further assistance, please reach out to our <a href='mailto:support@postsdoc.com'>support team</a>.</p>
                    </div>
                </body>
            </html>";

            // Send the email
            Mail::html($emailContent, function ($message) use ($email) {
                $message->to($email)
                    ->subject('Registration Confirmation and Approval Status')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            // Return a response
            return response()->json(['status' => true, 'message' => 'Clients created successfully', 'data' => $clientData], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time..', 'data' => []], 200);
        }
    }

    /**
     * add Employee register.
     */
    public function addEmployee(Request $request)
    {
        $user = new User();

        $token = $request->header('token');
        $base_url = $this->base_url;
        try {
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            // Define validation rules
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'mobile_no' => 'required|min:10|digits:10',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|max:100',
                'address' => 'required',
                'user_id' => 'required',
                'company_id' => 'required',
                'user_type' => 'required',
            ]);

            // Check if the validation fails
            if ($validator->fails()) {
                $result['status'] = false;
                $result['message'] = $validator->errors()->first();
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }

            // add user details
            $user->FirstName = $request->input('fname');
            $user->LastName = $request->input('lname');
            $user->Email = $request->input('email');
            $user->MobileNo = $request->input('mobile_no');
            $user->Address = $request->input('address');
            $user->role_id = '2';
            $user->password = Hash::make($request->input('password'));
            $user->UserType = '2';
            $user->CompanyID = $request->input('company_id');
            $user->save();

            $user->UserId = $user->id;

            //add the notification table
            $notifiArray = ['UserID' => $request->user_id, 'Description' => 'Added the employee ' . $user->name . ' ' . $user->lname . '.', 'TypeID' => 0];
            $this->addNotificationData($notifiArray);

            // Return a response
            return response()->json(['status' => true, 'message' => 'Employee created successfully', 'data' => $user], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * add CAS register.
     */
    public function addCas(Request $request)
    {
        $user = new User();

        $token = $request->header('token');
        $base_url = $this->base_url;
        try {
            $validator = Validator::make($request->all(), [
                'userData.fname' => 'required|string|max:255',
                'userData.lname' => 'required|string|max:255',
                'userData.email' => 'required|email|unique:users,email',
                'userData.mobile_no' => 'required|min:10|digits:10',
                'userData.password' => 'required|string|min:6',
                'userData.user_type' => 'required|integer',
                'clientData.firm_name' => 'required|string|max:255',
                'clientData.client_code' => 'required|string|max:4|unique:company,ClientCode',
                'clientData.PAN' => 'required|string|max:50',
                'clientData.GST' => 'required|string|max:50',
                'clientData.aadharNumber' => 'required|numeric',
                'clientData.address' => 'required|string',
                'clientData.countryID' => 'required|integer',
                'clientData.cityID' => 'required|integer',
                'clientData.stateID' => 'required|integer',
                'clientData.pincode' => 'required|numeric',
                'clientData.firm_type' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                    'data' => (object) [],
                ], 200);
            }
            $validatedData = $validator->validated();
            $email = $validatedData['userData']['email'];
            // Create the User
            $user = User::create([
                'FirstName' => $validatedData['userData']['fname'],
                'LastName' => $validatedData['userData']['lname'],
                'Email' => $validatedData['userData']['email'],
                'MobileNo' => $validatedData['userData']['mobile_no'],
                'password' => bcrypt($validatedData['userData']['password']),
                'UserType' => $validatedData['userData']['user_type'],
                'role_id' => 4
            ]);
            $lastInsertedUserId = $user->id;

            // Create the Client
            $client = Company::create([
                'FirmName' => $validatedData['clientData']['firm_name'],
                'PANNumber' => $validatedData['clientData']['PAN'],
                'ClientCode' => $validatedData['clientData']['client_code'],
                'GSTNumber' => $validatedData['clientData']['GST'],
                'AadharNumber' => $validatedData['clientData']['aadharNumber'],
                'Address' => $validatedData['clientData']['address'],
                'CountryID' => $validatedData['clientData']['countryID'],
                'CityID' => $validatedData['clientData']['cityID'],
                'StateID' => $validatedData['clientData']['stateID'],
                'PinCode' => $validatedData['clientData']['pincode'],
                'FirmType' => $validatedData['clientData']['firm_type'],
                'CreatedBy' => $lastInsertedUserId,
            ]);
            $lastInsertedclientId = $client->CompanyID;
            $updateClient = User::find($lastInsertedUserId);
            $updateClient->CompanyID = $lastInsertedclientId;
            $updateClient->save();

            $clientData = [
                'user' => array_merge(array_diff_key($user->toArray(), ['password' => '', 'role_id' => '', 'Address' => '']), ['CompanyID' => $lastInsertedclientId, 'UserId' => $lastInsertedUserId]),
                'client' => $client,
            ];

            $emailContent = "<html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            color: #333;
                        }
                        h1 {
                            color: #007bff;
                        }
                        .footer {
                            margin-top: 20px;
                            font-size: 12px;
                            color: #999;
                        }
                    </style>
                </head>
                <body>
                    <h1>Registration Confirmation</h1>
                    <p>Hello,</p>
                    <p>Thank you for registering with us. We have successfully received your registration details.</p>
                    <p>Currently, your account is under review and awaiting approval by our administrator. Please expect an update soon once your account is approved.</p>
                    <p>If you did not register for this account or believe there has been a mistake, please contact our support team immediately.</p>
                    <div class='footer'>
                        <p>This email was automatically generated. Do not reply.</p>
                        <p>If you need further assistance, please reach out to our <a href='mailto:support@postsdoc.com'>support team</a>.</p>
                    </div>
                </body>
            </html>";

            // Send the email
            Mail::html($emailContent, function ($message) use ($email) {
                $message->to($email)
                    ->subject('Registration Confirmation and Approval Status')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            // Return a response
            return response()->json(['status' => true, 'message' => 'CAS created successfully', 'data' => $clientData], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get dashboard data data.
     */
    public function getDashboardData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'company_id' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }

        $token = $request->header('token');
        $user_id = $request->user_id;
        $company_id = $request->company_id;
        $UserType = $request->UserType;
        try {
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            // $totalImageCount = Scandocument::where('Status', 1)
            //     ->where('UserID', $user_id)
            //     ->where('CompanyID', $company_id)
            //     ->sum('ImageCount');
            $result = Scandocument::where('Status', 1)
                ->where('UserID', $user_id)
                ->where('CompanyID', $company_id)
                ->select(
                    DB::raw('SUM(ImageCount) as totalImageCount'),
                    DB::raw('count(CASE WHEN DATE(created_at) = CURDATE() THEN ImageCount ELSE 0 END) as todayImageCount')
                )
                ->first();
            $totalImageCount = $result->totalImageCount;
            $todayImageCount = (string)$result->todayImageCount;

            return response()->json(['status' => true, 'message' => 'Get Dashboard data successfully', 'data' => ['DocumentCount' => $totalImageCount, 'todayDocumentCount' => $todayImageCount]], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * Order Coupon Data.
     */
    public function deleteAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }
        try {
            $user_id = $request->user_id;
            $token = $request->header('token');
            $base_url = $this->base_url;
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            DB::table('user_devices')
                ->join("users", "user_devices.user_id", "=", "users.id")
                ->where("users.id", "=", $user_id)
                ->where("user_devices.user_id", "=", $user_id)
                ->update(["user_devices.status" => '0', "users.Status" => '0', "user_devices.updated_at" => date("Y-m-d H:i:s"), "users.updated_at" => date("Y-m-d H:i:s"), 'user_devices.device_token' => '']);

            //add the notification table
            $notifiArray = ['UserID' => $request->user_id, 'Description' => 'Deleted the account ' . $request->account_id . '.', 'TypeID' => 0];
            $this->addNotificationData($notifiArray);

            // Return a response
            return response()->json(['status' => true, 'message' => 'Account deleted successfully', 'data' => []], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    public function changePassword(Request $request)
    {
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            // Validate the request
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'current_password' => 'required|min:8',
                'confirm_password' => 'required|same:current_password', // Match current_password
            ]);

            if ($validator->fails()) {
                $result['status'] = false;
                $result['message'] = $validator->errors()->first();
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }

            $user = User::find($request->user_id);

            // Check if the old password matches the stored password
            if (!Hash::check($request->old_password, $user->password)) {
                $result['status'] = false;
                $result['message'] = "The old password is incorrect.";
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }
            // Update the password
            $user->update([
                'password' => Hash::make($request->current_password),
            ]);

            //add the notification table
            $notifiArray = ['UserID' => $request->user_id, 'Description' => 'Password changed ' . $request->user_id . '.', 'TypeID' => 0];
            $this->addNotificationData($notifiArray);

            return response()->json(['status' => true, 'message' => 'Password changed successfully.', 'data' => []], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    public function tokenVerify($token)
    {
        $base_url = $this->base_url;
        $user = DB::table('user_devices')
            ->where('user_devices.login_token', '=', $token)
            ->where('user_devices.status', '=', 1)
            ->count();
        // dd($user);
        if ($user == '' || $user == null || $user == 0) {
            $result['status'] = false;
            $result['message'] = "Token given is invalid, Please login again.";
            $result['data'] = [];
            return response()->json($result, 200);
        } else {
            $result['status'] = true;
            return response()->json($result, 200);
        }
    }

    public function sendNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fcmtoken' => 'required',
            'user_id' => 'required',
        ]);
        $newData  = json_encode(array());
        $body = array('receiver_id' => $request->user_id, 'fcmtoken' => $request->fcmtoken, 'title' => 'Testing test test', 'message' => "Demo Test test", 'data' => $newData, 'content_available' => true);
        $sendNotification = $this->fcmNotificationService->sendFcmNotification($body);
        $notifData = json_decode($sendNotification->getContent(), true);

        if (isset($notifData['status']) && $notifData['status'] == true) {
            // return $sendNotification->getContent();
            return response()->json([
                'status' => true,
                'message' => 'Notification has been sent',
                'data' => []
            ], 200);
        } else {
            // return $sendNotification->getContent();
            return response()->json([
                'status' => false,
                'message' => 'Curl Error: ' . $notifData['message']
            ], 500);
        }
    }

    /**
     * get Roles list data.
     */
    public function getRoles(Request $request)
    {
        $user_id = $request->user_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }
            $roles = Role::select('*')->where('Status', 1)->paginate($this->per_page_show, ['*'], 'page', $page_number);

            $pagination = [
                'total' => $roles->total(),
                'count' => $roles->count(),
                'per_page' => $roles->perPage(),
                'current_page' => $roles->currentPage(),
                'total_pages' => $roles->lastPage(),
            ];

            $dataCAS = [
                'pagination' => $pagination,
                'data' => $roles,
            ];

            return response()->json(['status' => true, 'message' => 'Get Roles list successfully', 'data' => $dataCAS], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get Citys list data.
     */
    public function getCity(Request $request)
    {
        $user_id = $request->user_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {

            $roles = City::select('*')->where('Status', 1)->orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->orderBy('City', 'ASC')->get();

            $dataCAS = [
                'data' => $roles,
            ];

            return response()->json(['status' => true, 'message' => 'Get Clity list successfully', 'data' => $dataCAS], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get Citys list data.
     */
    public function getCountry(Request $request)
    {
        $user_id = $request->user_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {

            $roles = Country::select('*')->where('Status', 1)->get();
            $dataCAS = [
                'data' => $roles,
            ];

            return response()->json(['status' => true, 'message' => 'Get Country list successfully', 'data' => $dataCAS], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get Stats list data.
     */
    public function getState(Request $request)
    {
        $user_id = $request->user_id;
        $page_number = $request->page;
        try {
            $token = $request->header('token');
            $base_url = $this->base_url;

            $roles = State::select('*')->where('Status', 1)->orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->orderBy('State', 'ASC')->get();
            $dataCAS = [
                'data' => $roles,
            ];

            return response()->json(['status' => true, 'message' => 'Get State list successfully', 'data' => $dataCAS], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                $result['status'] = false;
                $result['message'] = $validator->errors()->first();
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }
            $password = Str::random(10);
            $email = $request->email;
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {
                // Return a response if the user is not found (even though validation checks for existence)
                return response()->json(['error' => 'User not found'], 404);
            }
            $user->password = Hash::make($password);


            $emailContent = "<html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            color: #333;
                        }
                        h1 {
                            color: #007bff;
                        }
                        .footer {
                            margin-top: 20px;
                            font-size: 12px;
                            color: #999;
                        }
                    </style>
                </head>
                <body>
                    <h1>Password Reset Notification</h1>
                    <p>Hello,</p>
                    <p>We've generated a new password for your account. Your new password is: <strong>{{ $password }}</strong></p>
                    <p>Please log in to your account.</p>
                    <p>If you didn't request a password change, please contact our support team immediately.</p>
                    <div class='footer'>
                        <p>This email was automatically generated. Do not reply.</p>
                        <p>If you need further assistance, please reach out to our <a href='mailto:support@postsdoc.com'>support team</a>.</p>
                    </div>
                </body>
            </html>";

            // Send the email
            Mail::html($emailContent, function ($message) use ($email) {
                $message->to($email)
                    ->subject('Your New Password')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
            return response()->json(['status' => true, 'message' => 'Mail send successfully', 'data' => []], 200);
        } catch (\Throwable $th) {
            // Log the exception for debugging
            Log::error('Password reset error', ['exception' => $th]);

            // Return a generic error response
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try after some time.',
                'data' => (object) []
            ], 500); // Use 500 for server errors
        }
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => bcrypt($password),
                    ])->save();
                }
            );

            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    public function documentUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,svg|max:5048',
            'user_id' => 'required',
            'company_id' => 'required',
            'remarks' => 'required',
            'batch_no' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }
        try {
            $user_id = $request->user_id;
            $company_id = isset($request->company_id) ? $request->company_id : 0;
            $page_number = $request->page;
            $Remarks = isset($request->remarks) ? $request->remarks : '';
            $token = $request->header('token');
            $base_url = $this->base_url;
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            $imagePaths = [];
            if ($request->hasFile('images')) {
                $imageCount = count($request->file('images'));
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');
                    $imagePaths[] = $path;
                }
            }
            $CompanyData = Company::find($company_id);
            $pdfsPath = str_replace(' ', '_', $CompanyData->FirmName) . '_' . $CompanyData->ClientCode;
            // dd($pdfsPath);
            // Generate PDF
            $pdf = PDF::loadView('pdf.images', compact('imagePaths'));
            // Download the PDF
            $directory = 'public/' . $pdfsPath . '/' . $user_id;
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            $pdfPath = $pdfsPath . '/' . $user_id . '/' . $request->batch_no . '.pdf';
            Storage::disk('public')->put($pdfPath, $pdf->output());

            $localPath = storage_path("app/public/{$pdfPath}");
            $fpdi = new Fpdi();
            $pageCount = $fpdi->setSourceFile($localPath);
            // Provide download link
            $downloadUrl = route('download.file', ['user_id' => $user_id, 'filename' => basename($pdfPath)]);
            // $downloadUrl = asset("storage/{$pdfPath}");

            $documents = new Scandocument();
            $documents->Title = $request->title;
            $documents->BatchNo = isset($request->batch_no) ? $request->batch_no : date('dmYHis') . '_' . $user_id;
            $documents->CompanyID = $company_id;
            $documents->UserID = $user_id;
            $documents->Remarks = $Remarks;
            $documents->ImageCount = $imageCount;
            $documents->PageCount = $pageCount;
            $documents->DocumentURL = basename($pdfPath);
            $documents->save();

            //add the notification table
            $notifiArray = ['UserID' => $user_id, 'Description' => 'Uploaded the scanned document file.', 'TypeID' => 0];
            $this->addNotificationData($notifiArray);

            // Notification firebase
            $newData  = json_encode(array());
            $body = array('receiver_id' => $user_id, 'title' => 'Your document has been uploaded successfully!', 'message' => 'Your document ' . basename($pdfPath) . ' uploaded successfully!', 'data' => $newData, 'content_available' => true);
            $sendNotification = $this->fcmNotificationService->sendFcmNotification($body);
            // $notifData = json_decode($sendNotification->getContent(), true);
            // if (isset($notifData['status']) && $notifData['status'] == true) {
            //     return $sendNotification->getContent();
            // } else {
            //     return $sendNotification->getContent();
            // }
            // End Notification firebase

            $dataCAS = [
                'download_link' => $downloadUrl,
            ];
            return response()->json(['status' => true, 'message' => 'PDF created successfully', 'data' => $dataCAS], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get Pages List data.
     */
    public function getPageList(Request $request)
    {
        try {

            $page = Page::select('*')->where('Status', 1)->get();

            $datapages = [
                'data' => $page,
            ];

            return response()->json(['status' => true, 'message' => 'Get pages list successfully', 'data' => $datapages], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get CMS data.
     */
    public function getPageContentById(Request $request)
    {
        $page_id = $request->page_id;
        try {
            $validator = Validator::make($request->all(), [
                'page_id' => 'required',
            ]);

            if ($validator->fails()) {
                $result['status'] = false;
                $result['message'] = $validator->errors()->first();
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }

            $client = Cms::select('*')->where('Status', 1)->where('PageID', $page_id)->get();

            $dataClients = [
                'data' => $client,
            ];

            return response()->json(['status' => true, 'message' => 'Get Content Data successfully', 'data' => $dataClients], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get documents list data.
     */
    public function getDocumentList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'company_id' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }

        $user_id = $request->user_id;
        $company_id = $request->company_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }
            $documets = Scandocument::select('*')->where('Status', 1)->where('CompanyID', $company_id)->where('UserID', $user_id)->paginate($this->per_page_show, ['*'], 'page', $page_number);
            // Update the documentname with the full URL
            $documets->getCollection()->transform(function ($documet) use ($user_id) {
                $originalDocumentURL = $documet->DocumentURL;
                $documet->DocumentURL = $documet->documentname ?? route('download.file', ['user_id' => $user_id, 'filename' => $originalDocumentURL]);
                $documet->documentname = $originalDocumentURL;
                return $documet;
            });
            $pagination = [
                'total' => $documets->total(),
                'count' => $documets->count(),
                'per_page' => $documets->perPage(),
                'current_page' => $documets->currentPage(),
                'total_pages' => $documets->lastPage(),
            ];

            $dataCAS = [
                'pagination' => $pagination,
                'data' => $documets,
            ];

            return response()->json(['status' => true, 'message' => 'Get Document list successfully', 'data' => $dataCAS], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get getAppversion list data.
     */
    public function getAppversion(Request $request)
    {
        $user_id = $request->user_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {
            $roles = Configuration::select('*')->where('Status', 1)->get();
            $dataCAS = [
                'data' => $roles,
            ];

            return response()->json(['status' => true, 'message' => 'Get Configuration Data successfully', 'data' => $dataCAS], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get Business Category list data.
     */
    public function getBusinessCategory(Request $request)
    {
        $user_id = $request->user_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {

            $employee = BussinessCategory::select('*')->where('Status', 1)->paginate($this->per_page_show, ['*'], 'page', $page_number);

            $pagination = [
                'total' => $employee->total(),
                'count' => $employee->count(),
                'per_page' => $employee->perPage(),
                'current_page' => $employee->currentPage(),
                'total_pages' => $employee->lastPage(),
            ];

            $dataEmployee = [
                'pagination' => $pagination,
                'data' => $employee,
            ];

            return response()->json(['status' => true, 'message' => 'Get Bussiness category list successfully', 'data' => $dataEmployee], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * add other Document list data.
     */
    public function otherDocumentUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,svg|max:5048',
            'user_id' => 'required',
            'company_id' => 'required',
            'remarks' => 'required',
            'batch_no' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }
        try {
            $user_id = $request->user_id;
            $company_id = isset($request->company_id) ? $request->company_id : 0;
            $Title = $request->title;
            $Remarks = $request->remarks;

            $token = $request->header('token');
            $base_url = $this->base_url;
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            $imagePaths = [];
            if ($request->hasFile('images')) {
                $imageCount = count($request->file('images'));
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');
                    $imagePaths[] = $path;
                }
            }

            // Generate PDF
            $pdf = PDF::loadView('pdf.images', compact('imagePaths'));

            $CompanyData = Company::find($company_id);
            $pdfsPath = str_replace(' ', '_', $CompanyData->FirmName) . '_' . $CompanyData->ClientCode;
            // Download the PDF
            $directory = 'public/' . $pdfsPath . '/' . $user_id;
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            $pdfPath = $pdfsPath . '/' . $user_id . '/' . $request->batch_no . '.pdf';
            Storage::disk('public')->put($pdfPath, $pdf->output());

            $localPath = storage_path("app/public/{$pdfPath}");
            $fpdi = new Fpdi();
            $pageCount = $fpdi->setSourceFile($localPath);

            // Provide download link
            // $downloadUrl = asset("storage/{$pdfPath}");
            $downloadUrl = route('download.file', ['user_id' => $user_id, 'filename' => basename($pdfPath)]);

            $documents = new OtherDocument();
            $documents->Title = $Title;
            $documents->CompanyID = $company_id;
            $documents->BatchNo = isset($request->batch_no) ? $request->batch_no : date('dmYHis') . '_' . $user_id;
            $documents->UserID = $user_id;
            $documents->ImageCount = $imageCount;
            $documents->PageCount = $pageCount;
            $documents->Remarks = $Remarks;
            $documents->DocumentURL = basename($pdfPath);
            $documents->save();

            //add the notification table
            $notifiArray = ['UserID' => $user_id, 'Description' => 'Uploaded the other documents file.', 'TypeID' => 0];
            $this->addNotificationData($notifiArray);

            // Notification firebase
            $newData  = json_encode(array());
            $body = array('receiver_id' => $user_id, 'title' => 'Your document has been uploaded successfully!', 'message' => 'Your document ' . basename($pdfPath) . ' uploaded successfully!', 'data' => $newData, 'content_available' => true);
            $sendNotification = $this->fcmNotificationService->sendFcmNotification($body);
            // $notifData = json_decode($sendNotification->getContent(), true);
            // if (isset($notifData['status']) && $notifData['status'] == true) {
            //     return $sendNotification->getContent();
            // } else {
            //     return $sendNotification->getContent();
            // }
            // End Notification firebase

            $dataCAS = [
                'download_link' => $downloadUrl,
            ];
            return response()->json(['status' => true, 'message' => 'PDF created successfully', 'data' => $dataCAS], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get other Document list data.
     */
    public function getOtherDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'company_id' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }
        $user_id = $request->user_id;
        $company_id = $request->company_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {
            $documets = OtherDocument::select('*')->where('Status', 1)->where('UserID', $user_id)->where('CompanyID', $company_id)->paginate($this->per_page_show, ['*'], 'page', $page_number);

            $documets->getCollection()->transform(function ($documet) use ($user_id) {
                $originalDocumentURL = $documet->DocumentURL;
                $documet->DocumentURL = $documet->documentname ?? route('download.file', ['user_id' => $user_id, 'filename' => $originalDocumentURL]);
                $documet->documentname = $originalDocumentURL;
                return $documet;
            });

            $pagination = [
                'total' => $documets->total(),
                'count' => $documets->count(),
                'per_page' => $documets->perPage(),
                'current_page' => $documets->currentPage(),
                'total_pages' => $documets->lastPage(),
            ];


            $dataEmployee = [
                'pagination' => $pagination,
                'data' => $documets,
            ];

            return response()->json(['status' => true, 'message' => 'Get Other document list successfully', 'data' => $dataEmployee], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get Notification List data.
     */
    public function getNotificationList(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'company_id' => 'required',
            ]);

            if ($validator->fails()) {
                $result['status'] = false;
                $result['message'] = $validator->errors()->first();
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }
            $user_id = $request->user_id;
            $page_number = $request->page;
            $token = $request->header('token');

            $page = Notification::select('*')->where('UserID', $user_id)->get();

            $datapages = [
                'data' => $page,
            ];

            return response()->json(['status' => true, 'message' => 'Get Notification list successfully', 'data' => $datapages], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * add notification Table.
     */
    public function addNotificationData($request)
    {

        try {
            $notification = new Notification();
            // add notification details
            $notification->UserID = $request['UserID'];
            $notification->Description = $request['Description'];
            $notification->TypeID = $request['TypeID'];
            $notification->save();

            // Return a response
            return response()->json(['status' => true, 'message' => 'CAS created successfully', 'data' => []], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * check Client Code.
     */
    public function CheckClientCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'client_code' => 'required|max:4|regex:/^[A-Z0-9]+$/',
            ]);

            if ($validator->fails()) {
                $result['status'] = false;
                $result['message'] = $validator->errors()->first();
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }

            $client_code = $request->client_code;
            $ClientCode = Company::where('Status', 1)->where('ClientCode', $client_code)->count();
            if ($ClientCode > 0) {
                return response()->json(['status' => true, 'message' => 'This code is already assign to someone. Please try another', 'data' => []], 200);
            } else {
                return response()->json(['status' => true, 'message' => 'This code is available.', 'data' => []], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }
}
