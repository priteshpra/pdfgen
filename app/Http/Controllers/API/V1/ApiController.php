<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDevices;
use Carbon\Carbon;
use Hash;
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

        try {
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

            $chkUser = User::where('email', $email)->where('Status', 1)
                ->first();

            if ($chkUser) {
                // Check if the password matches
                if (!Hash::check($password, $chkUser->password)) {
                    $result['status'] = false;
                    $result['message'] = "Invalid email or password";
                    $result['data'] = (object) [];
                    return response()->json($result, 200);
                }
            }

            if ($chkUser) {
                // $chkUser->makeHidden(['client_id']);
                $chkUser->CompanyID = $chkUser['CompanyID'];
                $token = $chkUser->createToken('authToken')->plainTextToken;
                $result['status'] = false;
                $result['message'] = "Login Succssfully!";
                $result['data'] = (object) [];

                $chkUser->client_id = $chkUser->id;
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

                return response()->json(['status' => true, 'message' => 'Login successful.', 'data' => $chkUser]);
            } else {
                $result['status'] = false;
                $result['message'] = "Invalid email or password";
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
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
        $user_id = $request->header('user_id');
        $base_url = $this->base_url;
        $checkToken = $this->tokenVerify($token);
        try {
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }
            $client = User::select('*')->where('Status', 1)->where('user_type', '3')->paginate($this->per_page_show, ['*'], 'page', $page_number);

            $pagination = [
                'total' => $client->total(),
                'count' => $client->count(),
                'per_page' => $client->perPage(),
                'current_page' => $client->currentPage(),
                'total_pages' => $client->lastPage(),
            ];

            $dataClients = [
                'pagination' => $pagination,
                'data' => $client,
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
        $user_id = $request->header('user_id');
        $base_url = $this->base_url;
        try {
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }
            $cas = User::select('*')->where('Status', 1)->where('user_type', '4')->paginate($this->per_page_show, ['*'], 'page', $page_number);

            $pagination = [
                'total' => $cas->total(),
                'count' => $cas->count(),
                'per_page' => $cas->perPage(),
                'current_page' => $cas->currentPage(),
                'total_pages' => $cas->lastPage(),
            ];

            $dataCAS = [
                'pagination' => $pagination,
                'data' => $cas,
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
            $employee = User::select('*')->where('Status', 1)->where('client_id', $user_id)->where('user_type', '2')->paginate($this->per_page_show, ['*'], 'page', $page_number);

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
                ->where('status', '=', 1)
                ->get();

            $datas = [];
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
            $cass = User::select('*')
                ->where('id', '=', $cas_id)
                ->where('status', '=', 1)
                ->where('user_type', '=', '4')
                ->get();

            $datas = [];
            foreach ($cass as $key => $value) {
                $evnt[] = $value;
                $datas = $evnt;
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
            $clients = User::select('*')
                ->where('id', '=', $client_id)
                ->where('status', '=', 1)
                ->where('user_type', '=', '4')
                ->get();

            $datas = [];
            foreach ($clients as $key => $value) {
                $evnt[] = $value;
                $datas = $evnt;
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
            // $checkToken = $this->tokenVerify($token);
            // $userData = json_decode($checkToken->getContent(), true);
            // if ($userData['status'] == false) {
            //     return $checkToken->getContent();
            // }

            // Define validation rules
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'firm_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'mobile_no' => 'required|min:10|digits:10',
                'address' => 'required',
                'countryID' => 'required',
                'stateID' => 'required',
                'cityID' => 'required',
                'pincode' => 'required',
                'aadharNumber' => 'required',
                'GST' => 'required',
                // 'user_id' => 'required',
                'PAN' => 'required',
                'firm_type' => 'required',
                'user_type' => 'required',
                'password' => 'required|string|max:100',
            ]);

            // Check if the validation fails
            if ($validator->fails()) {
                $result['status'] = false;
                $result['message'] = $validator->errors()->first();
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }

            // add user details
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->firm_name = $request->input('firm_name');
            $user->email = $request->input('email');
            $user->mobile_no = $request->input('mobile_no');
            $user->address = $request->input('address');
            $user->CountryID = $request->input('countryID');
            $user->StateID = $request->input('stateID');
            $user->CityID = $request->input('cityID');
            $user->pincode = $request->input('pincode');
            $user->PAN = $request->input('PAN');
            $user->GST = $request->input('GST');
            $user->firm_type = $request->input('firm_type');
            // $user->client_id = $request->input('user_id');
            $user->password = Hash::make($request->input('password'));
            $user->user_type = '3';
            $user->role_id = '3';
            $user->save();

            // Get the last inserted ID
            $lastInsertedId = $user->id;
            //add the notification table
            // $notifiArray = ['UserID' => $request->user_id, 'Description' => 'Added the client ' . $user->name . ' ' . $user->lname . '.', 'TypeID' => 0];
            // $this->addNotificationData($notifiArray);

            // Return a response
            return response()->json(['status' => true, 'message' => 'Clients created successfully', 'data' => $user], 200);
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
                'email' => 'required|email|unique:users,email|max:255',
                'mobile_no' => 'required|min:10|digits:10',
                'address' => 'required',
                'user_id' => 'required',
                'user_type' => 'required',
                'password' => 'required|string|max:100',
            ]);

            // Check if the validation fails
            if ($validator->fails()) {
                $result['status'] = false;
                $result['message'] = $validator->errors()->first();
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }

            // add user details
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->email = $request->input('email');
            $user->mobile_no = $request->input('mobile_no');
            $user->address = $request->input('address');
            $user->role_id = '2';
            $user->password = Hash::make($request->input('password'));
            $user->user_type = '2';
            $user->client_id = $request->input('user_id');
            $user->save();

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
            // $checkToken = $this->tokenVerify($token);
            // $userData = json_decode($checkToken->getContent(), true);
            // if ($userData['status'] == false) {
            //     return $checkToken->getContent();
            // }
            // Define validation rules
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'firm_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'mobile_no' => 'required|min:10|digits:10',
                'address' => 'required',
                // 'user_id' => 'required',
                'countryID' => 'required',
                'stateID' => 'required',
                'cityID' => 'required',
                'pincode' => 'required',
                'aadharNumber' => 'required',
                'GST' => 'required',
                'PAN' => 'required',
                'firm_type' => 'required',
                'user_type' => 'required',
                'password' => 'required|string|max:100',
            ]);

            // Check if the validation fails
            if ($validator->fails()) {
                $result['status'] = false;
                $result['message'] = $validator->errors()->first();
                $result['data'] = (object) [];
                return response()->json($result, 200);
            }

            // add user details
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->firm_name = $request->input('firm_name');
            $user->email = $request->input('email');
            $user->mobile_no = $request->input('mobile_no');
            $user->address = $request->input('address');
            $user->CountryID = $request->input('countryID');
            $user->StateID = $request->input('stateID');
            $user->CityID = $request->input('cityID');
            $user->pincode = $request->input('pincode');
            $user->PAN = $request->input('PAN');
            $user->GST = $request->input('GST');
            $user->firm_type = $request->input('firm_type');
            // $user->client_id = $request->input('user_id');
            $user->password = Hash::make($request->input('password'));
            $user->user_type = '4';
            $user->role_id = '4';
            $user->save();

            //add the notification table
            // $notifiArray = ['UserID' => $request->user_id, 'Description' => 'Added the CAs ' . $user->name . ' ' . $user->lname . '.', 'TypeID' => 0];
            // $this->addNotificationData($notifiArray);

            // Return a response
            return response()->json(['status' => true, 'message' => 'CAS created successfully', 'data' => $user], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try after some time.', 'data' => []], 200);
        }
    }

    /**
     * get dashboard data data.
     */
    public function getDashboardData(Request $request)
    {
        $base_url = $this->base_url;
        $loginType = $request->user_type;
        $token = $request->header('token');
        $user_id = $request->user_id;
        $user_type = $request->user_type;
        try {
            $checkToken = $this->tokenVerify($token);
            // Decode the JSON response
            $userData = json_decode($checkToken->getContent(), true);
            if ($userData['status'] == false) {
                return $checkToken->getContent();
            }

            $totalImageCount = Scandocument::where('Status', 1)
                ->where('UserID', $user_id)
                ->sum('ImageCount');

            return response()->json(['status' => true, 'message' => 'Get Dashboard data successfully', 'data' => ['DocumentCount' => $totalImageCount]], 200);
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
            'id' => 'required|numeric',
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
                ->where("users.id", "=", $request->account_id)
                ->where("user_devices.user_id", "=", $request->account_id)
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


    /**
     * Report Download.
     */
    // public function reportCouponDownload(Request $request)
    // {
    //     $user_id = $request->user_id;
    //     $event_id = $request->event_id;
    //     $token = $request->header('token');
    //     $page_number = $request->page;
    //     $base_url = $this->base_url;
    //     $checkToken = $this->tokenVerify($token);
    //     // Decode the JSON response
    //     $userData = json_decode($checkToken->getContent(), true);
    //     if ($userData['status'] == false) {
    //         return $checkToken->getContent();
    //     }

    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required',
    //         'event_id' => 'required',
    //     ]);

    //     // Check if the validation fails
    //     if ($validator->fails()) {
    //         $result['status'] = false;
    //         $result['message'] = $validator->errors()->first();
    //         $result['data'] = (object) [];
    //         return response()->json($result, 200);
    //     }

    //     $fileName = 'customer_coupons_' . time() . '.xlsx';
    //     $export = new CouponsExport($user_id, $event_id);

    //     // Use Storage to store the file temporarily
    //     Excel::store($export, $fileName, 'public');  // Store in the 'public' disk

    //     // Generate the download link for the stored file
    //     $fileUrl = $base_url . Storage::url($fileName);  // Get the URL for the stored file


    //     // return Excel::download(new CouponsExport($user_id, $event_id), $fileName);

    //     return response()->json(['status' => true, 'message' => 'Report Download Successfully', 'data' => $fileUrl], 200);
    // }


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
        $body = array('receiver_id' => $request->user_id, 'fcmtoken' => $request->fcmtoken, 'title' => 'Testing test', 'message' => "Demo Test", 'data' => $newData, 'content_available' => true);
        $sendNotification = $this->fcmNotificationService->sendFcmNotification($body);
        $notifData = json_decode($sendNotification->getContent(), true);

        if (isset($notifData['status']) && $notifData['status'] == true) {
            return $sendNotification->getContent();
        } else {
            return $sendNotification->getContent();
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

            $roles = City::select('*')->where('Status', 1)->orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();

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

            $roles = State::select('*')->where('Status', 1)->orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
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

            return response()->json(['status' => true, 'message' => 'Mail send successfully', 'data' => []], 200);
            // $status = Password::sendResetLink($request->only('email'));

            // if ($status === Password::RESET_LINK_SENT) {
            //     return response()->json([
            //         'status' => true,
            //         'message' => trans($status), // Use trans() for localized messages
            //         'data' => (object) []
            //     ], 200);
            // } else {
            //     return response()->json([
            //         'status' => false,
            //         'message' => trans($status),
            //         'data' => (object) []
            //     ], 400); // Use 400 for bad requests
            // }
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
            'company_id' => '',
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

            // Generate PDF
            $pdf = PDF::loadView('pdf.images', compact('imagePaths'));
            // dd($pdf);
            // Download the PDF
            // return $pdf->download('images.pdf');
            $directory = 'public/pdfs/' . $user_id;
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            $pdfPath = 'pdfs/' . $user_id . '/images_' . date('Y-m-d-h-i-s') . '.pdf';
            Storage::disk('public')->put($pdfPath, $pdf->output());

            $localPath = storage_path("app/public/{$pdfPath}");
            $fpdi = new Fpdi();
            $pageCount = $fpdi->setSourceFile($localPath);
            // Provide download link
            $downloadUrl = route('download.file', ['user_id' => $user_id, 'filename' => basename($pdfPath)]);
            // $downloadUrl = asset("storage/{$pdfPath}");

            $documents = new Scandocument();
            $documents->Title = 'Document';
            $documents->BatchNo = isset($request->batch_no) ? $request->batch_no : date('dmYHis') . '_' . $user_id;
            $documents->CompanyID = $company_id;
            $documents->UserID = $user_id;
            $documents->Remarks = $Remarks;
            $documents->ImageCount = $imageCount;
            $documents->PageCount = $pageCount;
            $documents->DocumentURL = $downloadUrl;
            $documents->save();

            //add the notification table
            $notifiArray = ['UserID' => $user_id, 'Description' => 'Uploaded the scanned document file.', 'TypeID' => 0];
            $this->addNotificationData($notifiArray);

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
            $roles = Scandocument::select('*')->where('Status', 1)->paginate($this->per_page_show, ['*'], 'page', $page_number);

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
            'title' => '',
            'company_id' => '',
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
            // dd($pdf);
            // Download the PDF
            // return $pdf->download('images.pdf');
            $directory = 'public/pdfs/' . $user_id;
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            $pdfPath = 'pdfs/' . $user_id . '/images_' . date('Y-m-d-h-i-s') . '.pdf';
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
            $documents->DocumentURL = $downloadUrl;
            $documents->save();

            //add the notification table
            $notifiArray = ['UserID' => $user_id, 'Description' => 'Uploaded the other documents file.', 'TypeID' => 0];
            $this->addNotificationData($notifiArray);

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
        $user_id = $request->user_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        try {
            $employee = OtherDocument::select([
                'OtherdocumentsID',
                'Title',
                'CompanyID',
                'BatchNo',
                'UserID',
                'Remarks',
                'DocumentURL',
                'DocumentStatus',
                'ImageCount'
                // DB::raw("(SELECT SUM(ImageCount) FROM otherdocuments WHERE Status = 1 AND UserID = $user_id) as totalImageCount")
            ])->where('Status', 1)->where('UserID', $user_id)->paginate($this->per_page_show, ['*'], 'page', $page_number);

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
}
