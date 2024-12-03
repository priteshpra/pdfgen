<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public $base_url;
    public $profile_path;
    public function __construct()
    {
        $this->base_url = url('/');
        $this->profile_path = '/public/profile_images/';
    }

    public function getProfileDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object)[];
            return response()->json($result, 200);
        }
        $base_url =  $this->base_url;
        $token = $request->header('token');
        $user = DB::table('user_devices')
            ->where('user_devices.login_token', '=', $token)
            ->where('user_devices.status', '=', 1)
            ->count();
        if ($user == '' || $user == null || $user == 0) {
            $result['status'] = false;
            $result['message'] = "Token given is invalid, Please login again.";
            $result['data'] = (object)[];
            return response()->json($result, 200);
        }

        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();

        $userData = [
            'id' => (string)$user->id,
            'user_id' => (string)$user->id,
            'user_type' => (string)$user->user_type,
            'name' => (string)$user->name,
            'lname' => (string)$user->lname,
            'storename' => (string)$user->storename,
            'email' => (string)$user->email,
            'date_of_birth' => (string)$user->date_of_birth,
            'phone_number' => (string)$user->phone_number,
            'otp' => (string)$user->otp,
            'PAN' => (string)$user->PAN,
            'GST' => (string)$user->GST,
            'flatNo' => (string)$user->flatNo,
            'pincode' => (string)$user->pincode,
            'area' => (string)$user->area,
            'city' => (string)$user->city,
            'state' => (string)$user->state,
            'avatar' => ($user->avatar) ? $base_url . $this->profile_path . $user->avatar : '',
            'is_first_time' => $user->is_first_time,
            'token' => $token
        ];

        return response()->json(['status' => true, 'message' => 'Get Profile details successfully', 'data' => $userData], 200);
    }


    public function updateProfile(Request $request)
    {

        $token = $request->header('token');
        $user_id = $request->user_id;
        $base_url =  $this->base_url;
        $user = DB::table('user_devices')
            ->where('user_devices.login_token', '=', $token)
            ->where('user_devices.status', '=', 1)
            ->count();
        if ($user == '' || $user == null || $user == 0) {
            $result['status'] = false;
            $result['message'] = "Token given is invalid, Please login again.";
            $result['data'] = (object)[];
            return response()->json($result, 200);
        }

        // Get the currently authenticated user
        $user = User::where('id', $user_id)->first();
        // Define validation rules
        if ($request->user_type == 4) {
            $validator = Validator::make($request->all(), [
                'fname' => 'string|max:255',
                'lname' => 'string|max:255',
                'firm_name' => 'string|max:255',
                'email' => 'email',
                'mobile_no' => 'min:10|digits:10',
                'address' => '',
                'pinCode' => '',
                'aadharNumber' => '',
                'GST' => '',
                'PAN' => '',
            ]);
        } else if ($request->user_type == 3) {
            $validator = Validator::make($request->all(), [
                'fname' => 'string|max:255',
                'lname' => 'string|max:255',
                'firm_name' => 'string|max:255',
                'email' => 'email',
                'mobile_no' => 'min:10|digits:10',
                'address' => '',
                'pinCode' => '',
                'aadharNumber' => '',
                'GST' => '',
                'PAN' => '',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fname' => 'string|max:255',
                'email' => 'email',
                'lname' => 'string',
                'mobile' => 'string'
            ]);
        }

        // Check if the validation fails
        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object)[];
            return response()->json($result, 200);
        }

        // Update user details
        $user->name = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->firm_name = $request->input('firm_name');
        $user->email = $request->input('email');
        $user->PAN = $request->input('PAN');
        $user->GST = $request->input('GST');
        $user->pincode = $request->input('pinCode');
        $user->mobile_no = $request->input('mobile_no');
        if ($request->input('aadharNumber')) {
            $user->aadhar = $request->input('aadharNumber');
        }
        $user->save();

        $users = User::where('id', $user_id)->first();

        // Return a response
        return response()->json(['status' => true, 'message' => 'Profile updated successfully', 'data' => $users], 200);
    }

    public function uploadProfileImage(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object)[];
            return response()->json($result, 200);
        }
        $base_url =  $this->base_url;
        $token = $request->header('token');
        $user = DB::table('user_devices')
            ->where('user_devices.login_token', '=', $token)
            ->where('user_devices.status', '=', 1)
            ->count();
        // dd($user);
        if ($user == '' || $user == null || $user == 0) {
            $result['status'] = false;
            $result['message'] = "Token given is invalid, Please login again.";
            $result['data'] = (object)[];
            return response()->json($result, 200);
        }

        $user_id = $request->user_id;
        $users = User::where('id', $user_id)->first();
        // Handle file upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            // $path = $image->store('profile_images', 'public');

            $destinationPath = 'public/profile_images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);

            $users->avatar = $profileImage;
            $users->save();
            $arr = array('image' => $base_url . '/' . $destinationPath . $profileImage);
            return response()->json(['status' => true, 'message' => 'Image uploaded successfully', 'data' => $arr], 200);
        }

        return response()->json(['status' => true, 'message' => 'Image upload failed'], 500);
    }
}
