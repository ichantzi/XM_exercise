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
            'start_date' => 'required|date_format:m/d/Y|before_or_equal:end_date|before_or_equal:today',
            'end_date' => 'required|date_format:m/d/Y|after_or_equal:start_date|before_or_equal:today',
        ]);
        
        $query = $request->all();
       
        return redirect()->route('results',['query' => $query]);
    }
    
    public function getResults(Request $request)
    {
        $client = new Client();
        
        $url = env('RAPID_API_URL');
        
        $query = $request->all()['query'];
        $start_date = strtotime($query['start_date']);
        $end_date = strtotime($query['end_date']);
        
        $headers = [
            'rapidapi-key' => env('RAPID_API_KEY')
        ];

        $response = $client->request('GET', $url, [
            'query' => $query,
            'headers' => $headers,
            'verify'  => false,
        ]);

        $results = json_decode($response->getBody());
        
        $temp_prices = $results->prices;
        $prices= [];
        foreach ($temp_prices as $temp_price) {
            if ($temp_price->date >= $start_date && $temp_price->date <= $end_date) {
                array_push($prices, $temp_price);
            }
        }
        
        return view('stockResults', ['prices' => $prices, 'symbol' => $query['symbol']]);
    }
}
