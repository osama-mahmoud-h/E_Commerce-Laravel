<?php

namespace App\Http\Controllers;
use App\Http\Services\FatoorhServices;
class MyFatoorahController extends Controller{
   
   private $fatoorhServices;
   private $apiURL ;
   private $apiKey;
   public function __construct(FatoorhServices $fatoorhServices ){
      $this->fatoorhServices=$fatoorhServices;
      $this->apiKey=env('fatoorah_token');
      $this->apiURL= 'https://apitest.myfatoorah.com';
   }
   public function payOrder(){
     
      $data=[
         'CustomerName'=>'Osama Mahmoud',
         'NotificationOption'=>'LNK',
         'InvoiceValue'=>'100',
         'CustomerEmail'=>'om9864899@gmail.com',
         'CallBackUrl'=>env('success_url'),
         'ErrorUrl'=>env('error_url'),
         'Language'=>'en',
         'DisplayCurrencyIso'=>'USD',
      ];

        $res= $this->fatoorhServices->
             sendPayment($this->apiURL, $this->apiKey,$data);

       $invoiceId   = $res->InvoiceId;
       $paymentLink = $res->InvoiceURL;

//Redirect your customer to the invoice page to complete the payment process
//Display the payment link to your customer
echo "Click on <a href='$paymentLink' target='_blank'>$paymentLink</a> to pay with invoiceID $invoiceId.";
die;
   }

   
}
