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
			// return $responseData;
			$res = json_decode($responseData, true);

			// $view = view('ajax.formPayment', compact('res'))->renderSections();
			return view('ajax.formPayment', compact('res'));

			// return response()->json([
			// 	'status' => true,
			// 	'content' => view('ajax.formPayment', compact('res'))
			// ]);

			// return $res;


    } // end method checkout payment Id



    public function checkoutPaymentStatus(Request $request) {
    	if(request('id') && request('resourcePath')) {
    		$payment_status == $this->getPaymentStatus(request('id'), request('resourcePath'));

    		
    	}

    } // end method checkout payment Status
}
