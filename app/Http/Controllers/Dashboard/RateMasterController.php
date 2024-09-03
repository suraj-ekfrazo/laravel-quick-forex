<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\RateMargin;

class RateMasterController extends Controller
{

    public function getCurrencyRate($currencyName = null)
    {
        if ($currencyName != null) {
            $result = RateMargin::where('currency_name' , $currencyName)->first();
            if (isset($result)) {
                $response = ["ResultSet" => ["Table1" => 
                        [
                            array(
                                "CURRENCY_CODE" => $result['currency_name'], 
                                "CURRENCY_TYPE_ID" => "",
                                "LC_EXCHANGE_SELL_RATE_MAX" => 0.0,
                                "CURRENCY_TYPE_NAME" => "SWIFT",
                                "LC_EXCG_SELL_RATE_MAX_DEALING" => $result['xe_rate']
                            )
                        ]
                    ], 
                    "Response" => [
                        array(
                            "RESP_CODE" => "0",
                            "RESP_MSG" => "Success"
                        )
                    ]
                ];    
            }else{
                $response = ["ResultSet" => ["Table1" => 
                        [
                            array(
                                "CURRENCY_CODE" => "", 
                                "CURRENCY_TYPE_ID" => "",
                                "LC_EXCHANGE_SELL_RATE_MAX" => 0.0,
                                "CURRENCY_TYPE_NAME" => "SWIFT",
                                "LC_EXCG_SELL_RATE_MAX_DEALING" => ""
                            )
                        ]
                    ], 
                    "Response" => [
                        array(
                            "RESP_CODE" => "404",
                            "RESP_MSG" => "Invalid Currency Code"
                        )
                    ]
                ]; 
            }
            
        }else{
            $response = ["ResultSet" => ["Table1" => 
                    [
                        array(
                            "CURRENCY_CODE" => "", 
                            "CURRENCY_TYPE_ID" => "",
                            "LC_EXCHANGE_SELL_RATE_MAX" => 0.0,
                            "CURRENCY_TYPE_NAME" => "SWIFT",
                            "LC_EXCG_SELL_RATE_MAX_DEALING" => ""
                        )
                    ]
                ], 
                "Response" => [
                    array(
                        "RESP_CODE" => "400",
                        "RESP_MSG" => "Currency Code Missing"
                    )
                ]
            ]; 
        }

        return response()->json($response);
    }    
}