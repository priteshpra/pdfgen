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
use Maatwebsite\Excel\Facades\Excel;

class ApiController extends Controller
{
    public $per_page_show;
    public $base_url;
    public $profile_path;
    public $banner_path;
    public $event_path;
    public $receipt_path;
    public $event_video_path;
    public $bill_path;
    public $graphic_path;
    public $winner_path;
    public $doc_path;
    public $prize_path;
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

        $email = $request->email;
        $password = $request->password;
        $device_token = isset($request->device_token) ? $request->device_token : '';
        $device_type = $request->device_type;
        $base_url = $this->base_url;
        $otp = rand(1000, 9999); //'0096';
        DB::enableQueryLog();

        $chkUser = User::where('email', $email)->where('Status', 1)->first();
        $token = $chkUser->createToken('authToken')->plainTextToken;
        // Check if the password matches
        if (!Hash::check($password, $chkUser->password)) {
            $result['status'] = false;
            $result['message'] = "Invalid email or password";
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }

        if ($chkUser) {
            $result['status'] = false;
            $result['message'] = "Login Succssfully!";
            $result['data'] = (object) [];
            $user = [
                'id' => (string) $chkUser->id,
                'user_id' => (string) $chkUser->id,
                'user_type' => (string) $chkUser->user_type,
                'name' => (string) $chkUser->name,
                'lname' => (string) $chkUser->lname,
                'storename' => (string) $chkUser->storename,
                'email' => (string) $chkUser->email,
                'date_of_birth' => (string) $chkUser->date_of_birth,
                'phone_number' => (string) $chkUser->phone_number,
                'otp' => (string) $otp,
                'PAN' => (string) $chkUser->PAN,
                'GST' => (string) $chkUser->GST,
                'flatNo' => (string) $chkUser->flatNo,
                'pincode' => (string) $chkUser->pincode,
                'area' => (string) $chkUser->area,
                'city' => (string) $chkUser->city,
                'state' => (string) $chkUser->state,
                'avatar' => ($chkUser->avatar) ? $base_url . $this->profile_path . $chkUser->avatar : '',
                'token' => $token,
            ];

            // add token devices login
            $arr = [
                'status' => 1,
                'device_token' => $device_token,
                'login_token' => $token,
                'device_type' => $device_type,
                'user_id' => $chkUser->id,
            ];
            DB::table('user_devices')->insertGetId($arr);

            return response()->json(['status' => true, 'message' => 'Login successful.', 'data' => $user]);

        } else {
            $result['status'] = false;
            $result['message'] = "Invalid email or password";
            $result['data'] = (object) [];
            return response()->json($result, 200);
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
        if($userDevice) {
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
        $user_id = $request->user_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        $checkToken = $this->tokenVerify($token);
        // Decode the JSON response
        $userData = json_decode($checkToken->getContent(), true);
        if ($userData['status'] == false) {
            return $checkToken->getContent();
        }
        $client = User::select(DB::raw("IFNULL(CONCAT('" . $base_url . "','" . $this->profile_path . "', avatar),'') AS avatarImage"), '*')->where('Status', 1)->where('user_type', '3')->paginate($this->per_page_show, ['*'], 'page', $page_number);

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
    }

    /**
     * get CAS list data.
     */
    public function getCas(Request $request)
    {
        $user_id = $request->user_id;
        $page_number = $request->page;
        $token = $request->header('token');
        $base_url = $this->base_url;
        $checkToken = $this->tokenVerify($token);
        // Decode the JSON response
        $userData = json_decode($checkToken->getContent(), true);
        if ($userData['status'] == false) {
            return $checkToken->getContent();
        }
        $cas = User::select(DB::raw("IFNULL(CONCAT('" . $base_url . "','" . $this->profile_path . "', avatar),'') AS avatarImage"), '*')->where('Status', 1)->where('user_type', '4')->paginate($this->per_page_show, ['*'], 'page', $page_number);

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
        $checkToken = $this->tokenVerify($token);
        // Decode the JSON response
        $userData = json_decode($checkToken->getContent(), true);
        if ($userData['status'] == false) {
            return $checkToken->getContent();
        }
        $employee = User::select(DB::raw("IFNULL(CONCAT('" . $base_url . "','" . $this->profile_path . "', avatar),'') AS avatarImage"), '*')->where('Status', 1)->where('user_type', '2')->paginate($this->per_page_show, ['*'], 'page', $page_number);

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
            ->where('user_type', '=', '2')
            ->get();

        $datas = [];
        foreach ($employees as $key => $value) {
            $evnt[] = $value;
            $datas = $evnt;
        }
        return response()->json(['status' => true, 'message' => 'Get Employee details successfully', 'data' => $datas], 200);
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
    }

    /**
     * add seller register.
     */
    public function addClient(Request $request)
    {
        $user = new User();

        $token = $request->header('token');
        $base_url = $this->base_url;
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
            'firm_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_no' => 'required|min:10|digits:10',
            'address' => 'required',
            'countryID' => 'required',
            'stateID' => 'required',
            'cityID' => 'required',
            'pinCode' => 'required',
            'aadharNumber' => 'required',
            'GST' => 'required',
            'PAN' => 'required',
            'firm_type' => 'required',
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
        $user->pincode = $request->input('pinCode');
        $user->PAN = $request->input('PAN');
        $user->GST = $request->input('GST');
        $user->firm_type = $request->input('firm_type');
        $user->password = Hash::make($request->input('password'));
        $user->user_type = '3';
        $user->save();

        // Return a response
        return response()->json(['status' => true, 'message' => 'Clients created successfully', 'data' => $user], 200);
    }

    /**
     * add Employee register.
     */
    public function addEmployee(Request $request)
    {
        $user = new User();

        $token = $request->header('token');
        $base_url = $this->base_url;
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
            'email' => 'required|email',
            'mobile_no' => 'required|min:10|digits:10',
            'address' => 'required',
            'role' => 'required',
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
        $user->role_id = $request->input('role');
        $user->password = Hash::make('123456');
        $user->user_type = '2';
        $user->save();

        // Return a response
        return response()->json(['status' => true, 'message' => 'Employee created successfully', 'data' => $user], 200);
    }

    /**
     * add CAS register.
     */
    public function addCas(Request $request)
    {
        $user = new User();

        $token = $request->header('token');
        $base_url = $this->base_url;
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
            'firm_name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_no' => 'required|min:10|digits:10',
            'address' => 'required',
            'countryID' => 'required',
            'stateID' => 'required',
            'cityID' => 'required',
            'pinCode' => 'required',
            'aadharNumber' => 'required',
            'GST' => 'required',
            'PAN' => 'required',
            'firm_type' => 'required',
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
        $user->pincode = $request->input('pinCode');
        $user->PAN = $request->input('PAN');
        $user->GST = $request->input('GST');
        $user->firm_type = $request->input('firm_type');
        $user->password = Hash::make($request->input('password'));
        $user->user_type = '3';
        $user->save();

        // Return a response
        return response()->json(['status' => true, 'message' => 'CAS created successfully', 'data' => $user], 200);
    }

    /**
     * get dashboard data data.
     */
    public function getDashboardData(Request $request)
    {
        $base_url = $this->base_url;
        $user_id = $request->user_id;
        $loginType = $request->user_type;
        $token = $request->header('token');
        $checkToken = $this->tokenVerify($token);
        // Decode the JSON response
        $userData = json_decode($checkToken->getContent(), true);
        if ($userData['status'] == false) {
            return $checkToken->getContent();
        }

        return response()->json(['status' => true, 'message' => 'Get Dashboard data successfully', 'data' => []], 200);
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
            ->update(["user_devices.status" => '0',"users.Status" => '0', "user_devices.updated_at" => date("Y-m-d H:i:s"), "users.updated_at" => date("Y-m-d H:i:s"), 'user_devices.device_token' => '']);

        // Return a response
        return response()->json(['status' => true, 'message' => 'Account deleted successfully', 'data' => []], 200);

    }

     public function changePassword(Request $request)
    {
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

        return response()->json(['status' => true, 'message' => 'Password changed successfully.', 'data' => []], 200);
    }


    /**
     * Report Download.
     */
    public function reportCouponDownload(Request $request)
    {
        $user_id = $request->user_id;
        $event_id = $request->event_id;
        $token = $request->header('token');
        $page_number = $request->page;
        $base_url = $this->base_url;
        $checkToken = $this->tokenVerify($token);
        // Decode the JSON response
        $userData = json_decode($checkToken->getContent(), true);
        if ($userData['status'] == false) {
            return $checkToken->getContent();
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'event_id' => 'required',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object) [];
            return response()->json($result, 200);
        }

        $fileName = 'customer_coupons_'.time().'.xlsx';
        $export = new CouponsExport($user_id, $event_id);

        // Use Storage to store the file temporarily
        Excel::store($export, $fileName, 'public');  // Store in the 'public' disk

        // Generate the download link for the stored file
        $fileUrl = $base_url.Storage::url($fileName);  // Get the URL for the stored file


        // return Excel::download(new CouponsExport($user_id, $event_id), $fileName);

        return response()->json(['status' => true, 'message' => 'Report Download Successfully', 'data' => $fileUrl], 200);
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

    public function sendNotification(Request $request) {
        $validator = Validator::make($request->all(), [
            'fcmtoken' => 'required',
            'user_id' => 'required',
            'receiver_id' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);
        $body = $request;
         $newData  = json_encode(array());
        $body = array('user_id' => $request->user_id,'sender_id' => $request->user_id, 'receiver_id' => $request->receiver_id,'title' => $request->title ,'message' => $request->message, 'data' => $newData, 'content_available' => true);
       $sendNotification = $this->fcmNotificationService->sendFcmNotification($body);
       $notifData = json_decode($sendNotification->getContent(), true);

        if (isset($notifData['status']) && $notifData['status'] == true) {
            return $sendNotification->getContent();
        } else {
            return $sendNotification->getContent();
        }
    }

}
