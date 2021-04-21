<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    public function checkoutPaymentId($price) {

		$url = "https://test.oppwa.com/v1/checkouts";
		$data = "entityId=8a8294174b7ecb28014b9699220015ca" .
	                "&amount=". $price .
	                "&currency=EUR" .
	                "&paymentType=DB";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	                   'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$responseData = curl_exec($ch);
		if(curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		$res = json_decode($responseData, true);

		return view('ajax.formPayment', compact('res'));



    } // end method checkout payment Id



    public function checkoutPaymentStatus(Request $request) {

    	dd($request->all());

    	if(request('id') && request('resourcePath')) {

    	 	$payment_status = $this->getPaymentStatus($request);
    	 	$payment_status = json_decode($payment_status, true);

    		if(isset($payment_status['id'])){ // success payment id -> transaction bank id
    			$SuccessPaymentMessage = true;
    		}else {
    			$SuccessPaymentMessage = false;
    		}

    		return response()->json($SuccessPaymentMessage);
    	}

    } // end method checkout payment Status




    public function getPaymentStatus(Request $request) {
    	$url = "https://test.oppwa.com/v1/checkouts/".$request->id."/payment";
		$url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	                   'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$responseData = curl_exec($ch);
		if(curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $responseData;

    } // end method checkout payment Status
}
