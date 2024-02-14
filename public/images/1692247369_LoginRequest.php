<?php
namespace App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class LoginRequest
{

    public static function validate(array $data, string $type)
    {
        switch ($type) {
            case 'send-otp':
                return self::validateType1($data);
            case 'otp-verification':
                return self::validateType2($data);
            case 'password':
                return self::validateType3($data);
            case 'login':
                return self::validateType4($data);
            case 'resend-password':
                    return self::validateType5($data);
            default:
                throw new \InvalidArgumentException("Invalid validation type: $type");
        }
    }

    private static function validateType1(array $data)
    {
        $rules = [
            'phone_no' => 'required|digits:10|unique:users,phone_no',
        ];
        self::failedValidation($data,$rules);
    }

    private static function validateType2(array $data)
    {
        $rules = [
            'phone_no' => 'required|digits:10|exists:otp_verifications,phone_no',
            'otp'      => 'required|digits:6',
        ];

        self::failedValidation($data,$rules);

    }

    private static function validateType3(array $data)
    {
        $rules = [
            'token'     => 'required|exists:otp_verifications,token',
            'password'  => 'required|min:8',
        ];

        self::failedValidation($data,$rules);

    }

    private static function validateType4(array $data)
    {
        $rules = [
           'phone_no'  => 'sometimes|digits:10',
           'password'  => 'sometimes|min:8',
           'key'       => 'sometimes|required',
        ];

        self::failedValidation($data,$rules);
    }

    private static function validateType5(array $data)
    {
        $rules = [
            'phone_no'  => 'required|digits:10|exists:users,phone_no',
        ];

        self::failedValidation($data,$rules);

    }

    private static function failedValidation($data,$rules)
    {
        $validator = Validator::make($data, $rules)->getMessageBag()->first();
        if($validator){
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => $validator,
            ]));
        }

    }
}
