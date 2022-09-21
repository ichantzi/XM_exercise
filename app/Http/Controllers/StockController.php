<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Company;

class StockController extends Controller
{
    public function loadSearchForm() {
        $companies = Company::all();

        return view ('searchStocks', compact('companies'));
    }

    public function searchStocks(Request $request) {
        dd($request->all());
    }
    
    public function getResults(Request $request)
    {
        $client = new Client();
        $url = "https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data";
        $query = [
            'symbol' => 'AAIT',
            'region' => 'US'
        ];
        $headers = [
            'rapidapi-key' => '0dca73c515msh037b7c2e3907972p1356b7jsnd1b4383f841d'
        ];

        $response = $client->request('GET', $url, [
            'query' => $query,
            'headers' => $headers,
            'verify'  => false,
        ]);

        $results = json_decode($response->getBody());
        $prices = $results->prices;
        
        // dd($prices[0]);
        return view('stockResults', ['prices' => $prices]);
    }
}
