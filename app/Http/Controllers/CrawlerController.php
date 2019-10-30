<?php

namespace App\Http\Controllers;

use App\Mail\ProductNotificationMail;
use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CrawlerController extends Controller
{
    public static function crawl() {
//        https://affiliate-api.flipkart.net/affiliate/1.0/product.json

        foreach (Wish::all() as $wish) {
            $id = $wish->product_id;
            $output = shell_exec("curl -H \"Fk-Affiliate-Id:dahegaonk\" -H \"Fk-Affiliate-Token:73264ac95fe24adf8eb2836a852cdef6\" \"https://affiliate-api.flipkart.net/affiliate/1.0/product.json?id=$id\"");
            $output = json_decode($output, true);
            $title = $output['productBaseInfoV1']['title'];
            $price = $output['productBaseInfoV1']['flipkartSpecialPrice']['amount'];
            $in_stock = $output['productBaseInfoV1']['inStock'];
            $url = $wish['url'];

            if($in_stock && $price <= $wish->wish_price) {
                Mail::to('dahegaonkarsanket@gmail.com')->send(new ProductNotificationMail($title, $price, $url));
            }
        }
    }
}
