<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\RateMargin;
use App\Models\Currency;

class RateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Current XE Rate For All Standard Currencies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set("Asia/Calcutta");
        $today = Carbon::now();

        if (!$today->isWeekend()) {
            if ((strtotime(date('H:i:s')) > strtotime('10:00:00') && strtotime(date('H:i:s')) < strtotime('16:00:00'))) {
        
                $username = 'dataseedtechsolutions104779792';
                $password = 'ecpcrqaqgc226v1asg6kb60ndc';

                // $currencyArr = Currency::where("status", 1)->pluck('currency_name')->toArray();

                // if(count($currencyArr) > 0){
                //     $currencyArr = implode(',', $currencyArr);

                //     Log::info($currencyArr);
                
                    $curl = curl_init();
            
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://xecdapi.xe.com/v1/convert_from/?from=INR&to=ZAR,USD,THB,SGD,SEK,SAR,NZD,NOK,JPY,HKD,GBP,EUR,DKK,CHF,CAD,AUD,AED&amount=1',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_POSTFIELDS => array(),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: Basic '.base64_encode($username . ":" . $password)
                        ),
                    ));
            
                    $response = curl_exec($curl);
            
                    curl_close($curl);
            
                    $json_data = json_decode($response,TRUE);

                    Log::info(print_r($json_data,true));

                    foreach($json_data['to'] as $val){
                        $newval = 1 / $val['mid'];
                        $buyMargin = $newval;
                        $sellMargin = $newval;

                        Log::info("currency name++++++++++++++".$val['quotecurrency']);
                        Log::info("sellMargin++++++++++++++".$sellMargin);

                        $result = RateMargin::where('currency_name', $val['quotecurrency'])->first();
                        if (isset($result['id'])) {
                            RateMargin::where('id', $result['id'])->update(['xe_rate' => round($sellMargin,2)]);
                        }else{
                            $result = RateMargin::create([
                                'currency_name' => $val['quotecurrency'],
                                'xe_rate' => round($sellMargin,2),
                                'sell_margin_10_12' => 0,
                                'sell_margin_12_2' => 0,
                                'sell_margin_2_3_30' => 0,
                                'sell_margin_3_30_end' => 0,
                                'holiday_margin' => 0,
                            ]);
                        }
                    }

                // }
            }
        }
        
        return 0;
    }
}
