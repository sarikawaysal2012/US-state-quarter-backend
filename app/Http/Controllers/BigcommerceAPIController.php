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

        $productCartData = BigcommerceAPIHelper::addCartLineItem($request->cart_id, json_encode($customProduct) );
        return $productCartData;

    }


}
