<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class SmsSender extends Controller
{
    //This method for send sms
    public static function send($numbers, $message){

        $apiURL = 'http://66.45.237.70/api.php';

        $postInput = [
            'username'=>"village",
            'password'=>"BZDAT2QU",
            'number'=>"$numbers",
            'message'=>"$message"
        ];


        $response = Http::get($apiURL, $postInput);
        $statusCode = $response->status();
        return $responseBody = $response->getBody();
    }

    
    //this method for get balance
    public static function getBalance(){
        $api_key = (new static)->getApiKey();
        $apiURL = 'http://isms.engineerbd.net/api/balance';
        $response = Http::get($apiURL);
        $statusCode = $response->status();
        return $responseBody = $response->getBody();
    }

    //this method for get api key
    public static function getApiKey(){
        $key=null;
        $setting = Setting::where('data_id', 'sms_api_key')->first();
        if($setting and $setting->data)
            $key = $setting->data;
        return $key;
    }

}
