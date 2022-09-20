<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Company;
use Illuminate\Support\Facades\Http;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::acceptJson()->get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');
        $companies = $response->json();
        foreach ($companies as $company) {
            Company::create(
                [
                    'company_name' =>$company['Company Name'],
                    'financial_status' =>$company['Financial Status'],
                    'market_category' =>$company['Market Category'],
                    'round_lot_size' =>$company['Round Lot Size'],
                    'security_name' =>$company['Security Name'],
                    'symbol' =>$company['Symbol'],
                    'test_issue' =>$company['Test Issue'],
                ]
            );
        }
    }
}
