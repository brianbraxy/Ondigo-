<?php

namespace App\Http\Controllers\Agent;

use App\Services\SafeHaven\SafeHavenApiService;
use Exception, DB, Validator;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\{
  AgentRegisteration,
  VehicleDetails,
  UserDetail,
  DateTime,
  RoleUser,
  User,
  Bank,
};

class AgentController
{
  protected $helper;
  protected $user;
  protected $agentRegisteration;
  protected $vehicleDetails;
  protected $userDetails;

  public function __construct()
  {
    $this->helper = new Common();
    $this->user   = new User();
    $this->agentRegisteration = new AgentRegisteration();
    $this->vehicleDetails = new VehicleDetails();
    $this->userDetails = new UserDetail();
  }

  public function dashboard()
  {
    $data['total_passengers'] = User::find(auth()->user()->id)->agentRegisteredPassenger()->count();
    $data['total_drivers'] = User::find(auth()->user()->id)->agentRegisteredDriver()->count();
    $data['registerations'] = AgentRegisteration::where("agent_id", auth()->user()->id)->get();
    return view('agent.dashboard', $data);
  }

  public function newUser()
  {
    $OTPTimestamp = null;
    $isoDate = null;
    if (session('userRegisterationOTP') !== null) {
      $OTPTimestamp = session('userRegisterationOTP')['timestamp'];
    }
    if ($OTPTimestamp instanceof DateTime || $OTPTimestamp instanceof \Carbon\Carbon) {
      $isoDate = $OTPTimestamp->toISOString();
    }
    return view("agent.registerations.userRegisteration")->with('isoDate', $isoDate);
  }

  public function storeUser(Request $request)
  {
    $rules = array(
      'first_name'            => ['required', 'max:30', 'regex:/^[a-zA-Z\s]*$/'],
      'last_name'             => ['required', 'max:30', 'regex:/^[a-zA-Z\s]*$/'],
      // 'email'                 => ['required', 'email', 'unique:users,email'],
      'formattedPhone'        => ['required', 'max:30', 'regex:/^\+(?:[0-9] ?){6,14}[0-9]$/'],
      'otp'                   => ['required', 'max:4', 'digits:4'],
      // 'password'              => ['required', 'confirmed'],
      // 'password_confirmation' => ['required'],
    );

    $fieldNames = array(
      'first_name'            => 'First Name',
      'last_name'             => 'Last Name',
      // 'email'                 => 'Email',
      'formattedPhone'                 => 'Phone',
      'otp'                 => 'OTP',
    );

    $validator = Validator::make($request->all(), $rules);
    $validator->setAttributeNames($fieldNames);

    $data = session('userRegisterationOTP');
    if ($data['attempt'] >= 3) {
      $validator->errors()->add('otp', 'otp invalid');
      throw new \Illuminate\Validation\ValidationException($validator);
    }
    session(['attempt' => $data['attempt']++]);
    if (Carbon::now()->diffInMinutes(Carbon::parse($data['timestamp'])) > 10) {
      $validator->errors()->add('otp', 'otp invalid');
      throw new \Illuminate\Validation\ValidationException($validator);
    }
    if ($request->otp !== $data['code']) {
      $validator->errors()->add('otp', 'otp invalid');
      throw new \Illuminate\Validation\ValidationException($validator);
    }


    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    } else {
      try {

        DB::beginTransaction();

        // Create user
        $request->merge(["email" => $request->first_name . "_" . $request->last_name . rand(10000, 99999) . "@ondigo-ng.com"]);
        $request->merge(['temp_password' => Str::random(8)]);
        $user = $this->user->createNewUser($request, 'user');

        RoleUser::insert(['user_id' => $user->id, 'role_id' => $user->role_id, 'user_type' => 'User']);

        $agentRegisteration = $this->agentRegisteration;
        $agentRegisteration->agent_id = auth()->user()->id;
        $agentRegisteration->user_id = $user->id;
        $agentRegisteration->user_type = "user";
        $agentRegisteration->save();

        if ($user->type == "user") {
          $safeHavenBank = (new SafeHavenApiService)->create_account($user);
          $bank = new Bank();
          $bank->user_id = $user->id;
          $bank->account_id = $safeHavenBank->data->_id;
          $bank->currency_id = $safeHavenBank->data->currencyCode;
          $bank->bank_name = "SAFE HAVEN MFB";
          $bank->account_name = $safeHavenBank->data->accountName;
          $bank->account_number = $safeHavenBank->data->accountNumber;
          $bank->save();
        }

        DB::commit();
        $message = "Welcome to ONDIGO. Your ondigo banking credientials are: Bank name:SAFE HAVEN MFB ,Account number:" . $safeHavenBank->data->accountNumber . ", Account name:" . $safeHavenBank->data->accountName . ", One time login password:" . $request->temp_password . ", Do not disclose this password to anyone";
        sendSMSwithSendChamp($user->formattedPhone, $message);

        $this->helper->one_time_message('success', __('Registration Successful!'));
        return redirect()->back();
      } catch (Exception $e) {
        dd($e->getMessage());
        DB::rollBack();
        $this->helper->one_time_message('error', $e->getMessage());
        return redirect()->back();
      }
    }
    return view("agent.registerations.userRegisteration");
  }

  public function newDriverOnline(Request $request)
  {
    return view("agent.registerations.driverOnlineRegisteration");
  }
  public function storeDriverOnline(Request $request)
  {

    $rules = array(
      'first_name'            => ['required', 'max:30', 'regex:/^[a-zA-Z\s]*$/'],
      'last_name'             => ['required', 'max:30', 'regex:/^[a-zA-Z\s]*$/'],
      'contact_email'         => ['nullable', 'email', 'unique:users,email'],
      // 'formattedPhone'        => ['required', 'max:30', 'regex:/^\+(?:[0-9] ?){6,14}[0-9]$/'],
      // 'password'              => ['required', 'confirmed'],
      // 'password_confirmation' => ['required'],
    );

    $fieldNames = array(
      'first_name'            => 'First Name',
      'last_name'             => 'Last Name',
      // 'email'                 => 'Email',
      'formattedPhone'                 => 'Phone',
      // 'otp'                 => 'OTP',
    );

    $validator = Validator::make($request->all(), $rules);
    $validator->setAttributeNames($fieldNames);
    if ($validator->fails()) {
      dd($validator->messages());
      return redirect('register')->withErrors($validator)->withInput();
    } else {
      try {
        DB::beginTransaction();

        // Create user
        if (!$request->contact_email) {
          $request->merge(["request->contact_email" => $request->first_name . "_" . $request->last_name . "@ondigo-ng.com"]);
        }

        $request->merge(["email" => $request->contact_email]);
        $user = $this->user->createNewUser($request, 'user');

        RoleUser::insert(['user_id' => $user->id, 'role_id' => $user->role_id, 'user_type' => 'User']);

        $agentRegisteration = $this->agentRegisteration;
        $agentRegisteration->agent_id = auth()->user()->id;
        $agentRegisteration->user_id = $user->id;
        $agentRegisteration->user_type = "user";
        $agentRegisteration->save();

        $user->is_driver = true;
        $user->save();

        if ($user->type == "user") {
          $safeHavenBank = (new SafeHavenApiService)->create_account($user);
          $bank = new Bank();
          $bank->user_id = $user->id;
          $bank->account_id = $safeHavenBank->data->_id;
          $bank->currency_id = $safeHavenBank->data->currencyCode;
          $bank->bank_name = "SAFE HAVEN MFB";
          $bank->account_name = $safeHavenBank->data->accountName;
          $bank->account_number = $safeHavenBank->data->accountNumber;
          $bank->save();
        }

        $vehicleDetails = $this->vehicleDetails;
        $vehicleDetails->user_id = $user->id;
        $vehicleDetails->ownership = $request->vehicle_owner;
        $vehicleDetails->vehicle_type = $request->vehicle_type;
        $vehicleDetails->vehicle_plate_number = $request->vehicle_plate_number;
        $vehicleDetails->vehicle_state_reg_number = $request->vehicle_state_registration_number;
        $vehicleDetails->pocket_device_number = $request->pocket_device_number;
        $vehicleDetails->save();

        $userDetails = $this->userDetails;
        $userDetails->user_id = $user->id;
        $userDetails->gender = $user->gender;
        $userDetails->state_of_origin = $user->state_of_origin;
        $userDetails->lga = $user->lga;
        $userDetails->nationality = $user->nationality;
        $userDetails->marital_status = $user->marital_status;
        $userDetails->residential_address = $user->residential_address;
        $userDetails->residential_city = $user->residential_city;
        $userDetails->residential_state = $user->residential_state;
        $userDetails->means_od_id = $user->means_od_id;
        $userDetails->id_number = $user->id_number;
        $userDetails->bvn_number = $user->bvn_number;
        $userDetails->nok_last_name = $user->nok_last_name;
        $userDetails->nok_first_name = $user->nok_first_name;
        $userDetails->nok_relationship = $user->nok_relationship;
        $userDetails->nok_gender = $user->nok_gender;
        $userDetails->nok_address = $user->nok_address;
        $userDetails->nok_city = $user->nok_city;
        $userDetails->nok_lga = $user->nok_lga;
        $userDetails->nok_email = $user->nok_email;
        $userDetails->employer_last_name = $user->employer_last_name;
        $userDetails->employer_first_name = $user->employer_first_name;
        $userDetails->employer_address = $user->employer_address;
        $userDetails->employer_city = $user->employer_city;
        $userDetails->employer_lga = $user->employer_lga;
        $userDetails->employer_email = $user->employer_email;
        $userDetails->bank_name = $user->bank_name;
        $userDetails->account_number = $user->account_number;
        $userDetails->account_name = $user->account_name;
        $userDetails->save();
        DB::commit();
        $this->helper->one_time_message('success', __('Registration Successful!'));
        return redirect()->back();
      } catch (Exception $e) {
        dd($e->getMessage());
        DB::rollBack();
        $this->helper->one_time_message('error', $e->getMessage());
        return redirect()->back();
      }
    }
  }

  public function newDriverUpload()
  {
    return view("agent.uregisterations.driverUploadRegisteration");
  }

  public function userOTP(Request $request)
  {
    try {
      $number = $request->number;
      $hashed = hash_hmac('sha256', $number + time(), "1234");
      $code = substr(preg_replace("/[^0-9]/", "", $hashed), -4);
      $time = Carbon::now();
      session(['userRegisterationOTP' => [
        'code' => $code,
        'timestamp' => $time,
        'attempt' => 0
      ]]);
      // dd($result);
      $message = "Your One Time Password(OTP) for ONDIGO log-in is " . $code . " . Expires in 10mins. If you did not initiate this request kindly call us. Do not share your OTP with anyone.";
      sendSMSwithSendChamp($number, $message);
      //send the result as sms
      return response()->json(["success" => "otp sent successfully", 'isoDate' => $time->toISOString()], 200);
    } catch (Exception $e) {
      return response()->json(['failed' => "failed"]);
    }
  }

  public function verifyUserOTP(Request $request)
  {
    $otp = $request->otp;
    $data = session('userRegisterationOTP');
    if ($data['attempt'] >= 3) {
      return response()->json(["success" => "invalid OTP, please generate a new OTP"], 400);
    }
    session(['attempt' => $data['attempt']++]);
    if (Carbon::now()->diffInMinutes(Carbon::parse($data['timestamp'])) > 10) {
      return response()->json(["success" => "invalid OTP, please generate a new OTP"], 400);
    }
    if ($otp === $data['code']) {
      return response()->json(["success" => "otp verified"], 200);
    }
    return response()->json(["success" => "otp not verified"], 400);
  }
}
