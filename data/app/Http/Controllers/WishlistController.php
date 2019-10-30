<?php

namespace App\Http\Controllers;

use App\Wish;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wish(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'wish_price' => 'required',
            'url' => 'required',
            'image_url' => 'required',
            'product_id' => 'required'
        ]);

        $wish = new Wish([
            'title' => $request['title'],
            'wish_price' => $request['wish_price'],
            'url' => $request['url'],
            'image_url' => $request['image_url'],
            'product_id' => $request['product_id'],
        ]);

        if($wish->save()) {
            return redirect(route('get.wishlist'));
        }
        return redirect()->back()->withErrors('Something went wrong!');
    }

    public function unwish(Request $request) {
        $this->validate($request, [
            'product_id' => 'required|exists:wishes,product_id'
        ]);

        if(Wish::where('product_id', $request->product_id)->first()->delete()) {
            return redirect()->back();
        }

        return redirect()->back()->withErrors('Something went wrong!');
    }

}
