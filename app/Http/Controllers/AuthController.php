<?php

namespace App\Http\Controllers;

use App\Exceptions\registerVerifyException;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterVerifyUserRequest;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $field =$request->has('email')? 'email': 'mobile';
        $value = $request->input($field);
        $code = random_int(100000 , 999999);

        // $expiration = config('auth.register_cache_expiration' , 1440);
        // Cache::put('user-auth-register-'.$value , compact(['code' , 'field']), now()->addMinute($expiration));

        $user = User::create([
            'type' => User::TYPE_USER,
            $field => $value,
            'verify_code' => $code
        ]);
        Log::info('send-register-message-to-user' , [$code=>'code']);
        return response(['message' => 'کاربر با موفقیت ثبت موقت شد' ] , 200);
    }
    public function registerVerify(RegisterVerifyUserRequest $request){

        // $registerData = Cache::get('user-auth-register-'.$field );

        // if(!empty($registerData) && $registerData['code'] == $code){

        // }
        // throw new registerVerifyException('کد تایید وارد شده اشتباه است');

        $code = $request->code;
        $user = User::where('verify_code' , $code)->first();
        if(empty($user)){
            throw new ModelNotFoundException('کاربری با کد موردنظر یافت نشد');
        }
        $user->verify_code = null;
        $user->verified_at = now();
        $user->save();
        return response($user , 200);
    }
}

