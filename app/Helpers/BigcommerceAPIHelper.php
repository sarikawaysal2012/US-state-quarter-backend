<?php 

namespace App\Helpers;

class BigcommerceAPIHelper
{
    
    static public function addCartLineItem($cartId, $customProduct)
    {
          
        $store_hash = env('BC_DEV_STORE_HASH');
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.bigcommerce.com/stores/" . $store_hash . "/v3/carts/" . $cartId . "/items",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $customProduct,
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json",
            "X-Auth-Token: " . env('BC_DEV_ACCESS_TOKEN')
        ],
        ]);
        

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }

    }


}



?>