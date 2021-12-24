<?php

/* ------------------------ Functions --------------------------------------- */
/*
 * Send Payment Endpoint Function 
 */

namespace App\Http\Services;

class FatoorhServices{
function sendPayment($apiURL, $apiKey, $postFields) {

    $json = $this->callAPI("$apiURL/v2/SendPayment", $apiKey, $postFields);
    return $json->Data;
}

//------------------------------------------------------------------------------
/*
 * Call API Endpoint Function
 */

function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST') {

    $curl = curl_init($endpointURL);
    curl_setopt_array($curl, array(
        CURLOPT_CUSTOMREQUEST  => $requestType,
        CURLOPT_POSTFIELDS     => json_encode($postFields),
        CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
        CURLOPT_RETURNTRANSFER => true,
    ));

    $response = curl_exec($curl);
    $curlErr  = curl_error($curl);

    curl_close($curl);

    if ($curlErr) {
        //Curl is not working in your server
        die("Curl Error: $curlErr");
    }

    $error = $this->handleError($response);
    if ($error) {
        die("Error: $error");
    }

    return json_decode($response);
}

//------------------------------------------------------------------------------
/*
 * Handle Endpoint Errors Function
 */

function handleError($response) {

    $json = json_decode($response);
    if (isset($json->IsSuccess) && $json->IsSuccess == true) {
        return null;
    }

    //Check for the errors
    if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
        $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
        $blogDatas = array_column($errorsObj, 'Error', 'Name');

        $error = implode(', ', array_map(function ($k, $v) {
                    return "$k: $v";
                }, array_keys($blogDatas), array_values($blogDatas)));
    } else if (isset($json->Data->ErrorMessage)) {
        $error = $json->Data->ErrorMessage;
    }

    if (empty($error)) {
        $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
    }

    return $error;
}

}


/*
namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FatoorhServices{

    private $base_url;
    private $headres;
    private $request_client;

    public function __construct(Client $request_client){
        $this->base_url = env('fatoorah_base_url');
        $this->request_client = $request_client;
        $this->headres=[
            'Content-Type'=>'application/json',
            'Authorization'=>'Bearer' .env('fatoorah_token'),
        ];
        
    }
    public function sendPayment($data=[]){
        $response=$this->buildRequest('v2/sendPayment','POST',$data);
    }
    private function buildRequest($url,$method,$data=[]){
        $request = new Request($method , $this->base_url.$url , $this->headres);

        if(!$data)
            return false;
        
        $response = $this->request_client->send($request,[
            'json'=>$data,
        ]);

        if($response->getStatusCode()!=200){
            return false;
        }
        $response = json_decode($response->getBody(),true);
        return $response;
    }
}*/