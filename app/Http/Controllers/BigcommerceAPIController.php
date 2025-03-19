<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BigcommerceAPIHelper;

class BigcommerceAPIController extends Controller
{
    public function addDonationToCart(Request $request)
    {
        
        $donationAmount = ceil($request->donationAmount);
        $customProductId = ceil($request->customProductId);
        if(isset($request->cartId) && isset($request->donationAmount) && isset($request->customProductId) ) {
            $customProduct = [
                "line_items" => [
                    [
                        "quantity" => 1,
                        "product_id" => $customProductId, 
                        "list_price" => (float) $donationAmount,
                        "name" => "Custom Donation",
                        "sku" => "DONATION_CUSTOM",
                        "variant_id" => null
                    ]
                ]
            ];

            $productCartData = BigcommerceAPIHelper::addCartLineItem($request->cartId, json_encode($customProduct) );
            return $productCartData;
        } else {
            if( !isset($request->cartId) ) {
                $message = "Cart Id is required.";
            } else if ( !isset($request->donationAmount) ) {
                $message = "Donation Amount is required.";
            } else if ( !isset($request->customProductId) ) {
                $message = "Custom Product Id is required.";
            }
            return response()->json([
                'message' => $message,
            ], 404);
        }

    }


}
