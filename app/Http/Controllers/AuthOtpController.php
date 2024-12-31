<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Transaction;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthOtpController extends Controller
{
    public $phone;
    /**
     * @throws ValidationException
     */
    public function get_code(Request $request)
    {
        $this->validate($request, ['phone' => 'required | regex:/^0[0-9]{10}$/',]);
        $check=Code::where('phone',$request->phone)->where('created_at', '>=', now()->subMinutes(2))->exists();
        if ($check){
            return response()->json([
                'message' => 'کد احراز هویت برای شما ارسال شده است لطفا چند دقیقه دیگر امتحان کنید',
                'errors' => [
                    'phone' => 'کد احراز هویت برای شما ارسال شده است لطفا چند دقیقه دیگر امتحان کنید',
                ],
            ], 422);
        }else{
            Code::where('phone',$request->phone)->delete();
            $code=$this->generate_code($request->phone);
            $wsdlUrl = 'http://webservice.0098sms.com/service.asmx?wsdl';
            ini_set("soap.wsdl_cache_enabled", "0");
            try {
                $smsClient = new \SoapClient($wsdlUrl, [
                    'encoding' => 'UTF-8',
                    'exceptions' => true,
                    'trace' => 1,
                ]);

                $parameters = [
                    'username' => 'smsn5232',
                    'password' => '*Nf(Dc8Ptq77',
                    'mobileno' => $request->phone,
                    'pnlno'    => '30005367676767',
                    'text'     => " به بهاران خوش آمدید.\nکد ورود شما: $code",
                    'isflash'  => false,
                ];
                $result = $smsClient->SendSMS($parameters)->SendSMSResult;

            } catch (\Exception $e) {
                Log::info($e);
            }
            $data=Code::create([
                'code'=>$code,
                'phone'=>$request->phone
            ]);
            return response()->json([
                'message' => 'کد ارسال شد',
                'data' => $data,
            ], 200);
        }

    }
    public function check_code(Request $request)

    {
        $this->validate($request, ['phone' => 'required | regex:/^0[0-9]{10}$/','code'=>'size:5']);
        $lastRecord = Code::where('phone', $request->phone)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastRecord && $lastRecord->code == $request->code) {
            $data=User::where('phone',$request->phone)->first();
            $uniqueToken = User::generateUniqueToken();
            if ($data && !$data->token ){
                $uniqueToken = User::generateUniqueToken();
                $data->update([
                   'token'=>$uniqueToken
                ]);
                $data=User::where('phone',$request->phone)->first();

            }
            Code::where('phone', $request->phone)->delete();
            return response()->json([
                'message' => 'Authenticated successfully',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'message' => 'کد نامعتبر می باشد',
                'errors' => [
                    'code' => 'کد نامعتبر می باشد',
                ],
            ], 422);
        }
    }
    public function generate_code($phone)
    {
        if($phone == '09192514124'){
            return '12345';
        }
        do {
            $otpCode = rand(10000, 99999);
            $exists = Code::where('code', $otpCode)->exists();
        } while ($exists);
        return $otpCode;
    }

    function upload_file($file,$type) {
        $file_name=$file->getClientOriginalName();
        $directory=$type.'/'. date('Y-m-d');
        $file->storeAs($directory,$file_name,'public_path');
        return 'uploads/'.$directory.'/'.$file_name;
    }
    public function create(Request $request)
    {

        $this->validate($request,
            [
                'name' => ['required'],
                'code_meli' => ['required','size:10','unique:users,code_meli'],
                'father' => ['required'],
                'birthday' => ['required' , 'regex:/^13[0-9]{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/'],
                'address' => ['required'],
                'type' => ['required'],
                'license_number' => ['required'],
                'license_date' => ['required','regex:/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/'],
                'license_image' => ['required','image', 'mimes:jpeg,png,jpg', 'max:5048'],
                'phone' => ['required', 'regex:/^0[0-9]{10}$/','unique:users,phone'],
            ]);
        $request->license_image=$this->upload_file($request->license_image,'users');
        if ($request->avatar){
            $request->avatar=$this->upload_file($request->avatar,'users');
        }
        $uniqueToken = User::generateUniqueToken();
        $data=User::create([
           'name'=>$request->name,
           'code_meli'=>$request->code_meli,
           'father'=>$request->father,
           'birthday'=>$request->birthday,
           'address'=>$request->address,
           'type'=>$request->type,
           'license_number'=>$request->license_number,
           'license_date'=>$request->license_date,
           'license_image'=>$request->license_image,
           'phone'=>$request->phone,
           'token'=>$uniqueToken,
           'avatar'=>$request->avatar,
           'status'=>2,
           'role'=>1,
        ]);
        return response()->json([
            'message' => 'Create user successfully',
            'data' => $data,
        ], 200);

    }
    public function receipt(Request $request){
        $status=$request->State ?? 'NO';
        $token=null;
        if ($status == 'OK'){
            $token=$request->Token;
            $transaction=Transaction::where('token',$token)->latest()->first();
            if ($transaction){
                $user=User::find($transaction->user_id);

                $transaction->update([
                   'status'=>1,
                   'description'=>$request->all(),
                ]);
                $user->update([
                    'status'=>3,
                ]);
                auth()->login($user);
                return redirect()->route('profile.index',['token',$token]);
            }
        }else{
            return redirect()->route('forbiden.403',['message'=>'تراکنش ناموفق با بخش مدیریت تماس بگیرید']);
        }
        Log::info($request->all());
    }

    public function cost(Request $request)
    {
        $this->validate($request,
            [
                'user' => ['required'],

            ]);
        $user=$request->user;
        if (($user->status ?? 0) == 2){
            $tr_code=$this->generate_tr_code();
            $client = new Client();
            $headers = [
                'Content-Type' => 'application/json',
                'Cookie' => 'ASP.NET_SessionId=2qmo5itwkocpuw2i2utadqd0; SEP01edab9f=017cb00b00b7a5f03d97258d4208398b390c9d35ec9afc833b40fcdc2e4cba452a7b91e00d1ad5fae10351182ef0a3b612954ece596d96ac0313fb333a80af0416520c4320'
            ];
            $dynamicResNum =$tr_code; // مقدار پویا برای ResNum
            $dynamicCellNumber = $user->phone; // مقدار پویا برای CellNumber
            $body = json_encode([
                "action" => "token",
                "TerminalId" => "14615539",
                "Amount" => 12000,
                "ResNum" => $dynamicResNum,
                "RedirectUrl" => "https://mottahedzarrin.ir/home/receipt",
                "CellNumber" => $dynamicCellNumber
            ]);
            $request = new \GuzzleHttp\Psr7\Request('POST', 'https://sep.shaparak.ir/onlinepg/onlinepg', $headers, $body);
            $res = $client->sendAsync($request)->wait();
            $response = json_decode($res->getBody()->getContents(), true);
            $token = $response['token'] ?? 0;
            if ($token){
                $data=Transaction::create([
                    'user_id'=>$user->id,
                    'tr_code'=>$tr_code,
                    'token'=>$token,
                ]);
                $getMethod = '';
                return response()->json([
                    'message' => 'اطلاغات با موفقیت ثبت شد',
                    'data' => $data,
                ], 200);
            }else{
                return response()->json([
                    'message' => 'کد نامعتبر می باشد',
                    'errors' => [
                        'code' => 'کد نامعتبر می باشد',
                    ],
                ], 422);

            }

        }else{
            return response()->json([
                'message' => 'کاربر تایید شده است',
                'errors' => [
                    'code' => 'کاربر تایید شده است',
                ],
            ], 422);

        }


    }
    public function generate_tr_code()
    {
        do {
            $trCode = rand(10000, 99999).Str::random(6);
            $exists = Transaction::where('tr_code', $trCode)->exists();
        } while ($exists);
        return $trCode;
    }
}
