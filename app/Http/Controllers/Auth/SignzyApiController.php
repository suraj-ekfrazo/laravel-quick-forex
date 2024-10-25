<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AgentUsers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SignzyApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.agentLogin');
    }

    public function verifyPanCard(Request $request) 
    {
        $input = $request->all();

        if (isset($input['customer_name']) && isset($input['pancard_no'])) {
            
            $postData = [
                'name' => $input['customer_name'],
                'number' => $input['pancard_no'],
                'fuzzy' => "true",
                'panStatus' => "true"
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.signzy.app/api/v3/pan/verifications',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>json_encode($postData),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: '.env('SIGNZY_API_TOKEN')
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
            } else {
                return response()->json(array('type' => 'SUCCESS', 'message' => 'Pan card details fetched successfully', 'data' => json_decode($response)));
            }
        }
    }

    public function verifyAadhaarCard(Request $request) 
    {
        $input = $request->all();

        if (isset($input['aadhaarcard_no'])) {
            
            $postData = [
                'uid' => $input['aadhaarcard_no']
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.signzy.app/api/v3/aadhaar/basicVerify',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>json_encode($postData),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: '.env('SIGNZY_API_TOKEN')
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
            } else {
                return response()->json(array('type' => 'SUCCESS', 'message' => 'Aadhaar card details fetched successfully', 'data' => json_decode($response)));
            }
        }
    }

    public function getPanAdharLinkStatus(Request $request) 
    {
        $input = $request->all();

        if (isset($input['pancard_no']) && isset($input['aadhaarcard_no'])) {
            
            $postData = [
                "panNumber" => $input['pancard_no'],
                'uid' => $input['aadhaarcard_no']
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.signzy.app/api/v3/pan/aadhaarLinkStatus',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>json_encode($postData),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: '.env('SIGNZY_API_TOKEN')
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
            } else {
                return response()->json(array('type' => 'SUCCESS', 'message' => 'Link status fetched successfully', 'data' => json_decode($response)));
            }
        }
    }

    public function verifyPassportDetails(Request $request) 
    {
        $input = $request->all();

        if (isset($input['passport_file_number']) && isset($input['passport_holder_name']) && isset($input['passport_holder_dob'])) {
            
            $input['passport_holder_dob'] = date("d/m/Y", strtotime($input['passport_holder_dob']));

            $postData = [
                "fileNumber" => $input['passport_file_number'],
                "name" => $input['passport_holder_name'],
                "dob" => $input['passport_holder_dob']
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.signzy.app/api/v3/passport/verification',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>json_encode($postData),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: '.env('SIGNZY_API_TOKEN')
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
            } else {
                return response()->json(array('type' => 'SUCCESS', 'message' => 'Passport details fetched successfully', 'data' => json_decode($response)));
            }
        }
    }

    public function getTcsAmountOnPanNo(Request $request) 
    {
        $input = $request->all();
        $totalTCSAmount = 0;

        if (isset($input['pancard_no']) && isset($input['pancard_no']) && isset($input['pancard_no'])) {
            
            $current_fin_Year = date("y");
            $next_fin_Year = $current_fin_Year + 1;
            $fin_Year = $current_fin_Year."".$next_fin_Year;

            $postData = [
                "Pan" => $input['pancard_no'],
                "Fin_Year" => $fin_Year,
                "Client_Code" => "QFL"
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://tcsapi.fxplus.in/api/FxPlus_BillingByPan/TransactionDetails',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>json_encode($postData),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'secretkey: '.env('TCS_API_TOKEN')
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);

            if ($err) {
                return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => $totalTCSAmount));
            } else {
                $responseArr = json_decode($response, true);
                $totalTCSAmount = $responseArr['Total Amount'];

                return response()->json(array('type' => 'SUCCESS', 'message' => 'TCS details fetched successfully', 'data' => $totalTCSAmount));
            }
        }
    }
}