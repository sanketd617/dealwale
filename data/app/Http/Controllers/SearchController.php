<?php

namespace App\Http\Controllers;

use http\Client;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->q;
        if($query) {
            $output = shell_exec("curl -H \"Fk-Affiliate-Id:dahegaonk\" -H \"Fk-Affiliate-Token:73264ac95fe24adf8eb2836a852cdef6\" \"https://affiliate-api.flipkart.net/affiliate/1.0/search.json?query=$query\"");
            return view('search', ['results' => json_decode($output, true)['products'], 'query' => $query]);
        }
        return view('search');
    }
}
