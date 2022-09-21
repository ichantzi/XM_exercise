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
        
        $validated = $request->validate([
            'symbol' => 'required',
            'email' => 'required|email',
            'start_date' => 'required|date_format:d/m/Y|before_or_equal:end_date|before_or_equal:today',
            'end_date' => 'required|date_format:d/m/Y|after_or_equal:start_date|before_or_equal:today',
        ]);
        
        $query = $request->all();
        // dd($query['end_date']);
        // dd(strtotime($query['start_date']));
        $this->getResults($query);
    }
    
    public function getResults($query)
    {
        // dd($query);
        $client = new Client();
        $url = "https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data";
        
        $headers = [
            'rapidapi-key' => env('RAPID_API_KEY')
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
