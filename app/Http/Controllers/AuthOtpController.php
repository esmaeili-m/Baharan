<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthOtpController extends Controller
{
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
            $code=$this->generate_code();
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
    public function generate_code()
    {
        do {
            $otpCode = rand(10000, 99999);
            $exists = Code::where('code', $otpCode)->exists();
        } while ($exists);
        return $otpCode;
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
        $request->license_image=upload_file($request->license_image,'users');
        if ($request->avatar){
            $request->avatar=upload_file($request->avatar,'users');
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
}
